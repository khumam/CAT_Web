<?php

session_start();
require 'db_connect.php';

if (isset($_POST['kd_soal'])) {
    $id = mysqli_real_escape_string($db, $_POST['kd_soal']);
    $sql = "SELECT * FROM cat_soal WHERE kd_soal = $id";
    $query = mysqli_query($db, $sql);
    $dataSoal = mysqli_fetch_assoc($query);

    if ($query) {
        if (mysqli_num_rows($query) == 0) {
            $response = [
                'status' => false,
                'message' => 'Tidak ada ada',
                'data' => null
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $dataSoal
            ];
        }
    } else {
        $response = [
            'status' => false,
            'message' => 'Gagal koneksi',
            'data' => null
        ];
    }

    echo json_encode($response);
}
if (isset($_POST['all'])) {
    $sql = "SELECT * FROM cat_soal ORDER BY kd_soal DESC";
    $query = mysqli_query($db, $sql);
    $data = [];

    while ($list = mysqli_fetch_assoc($query)) {
        $data[] = $list;
    }

    echo json_encode($data);
}

if (isset($_POST['kesulitan'])) {
    $kesulitan = mysqli_real_escape_string($db, $_POST['kesulitan']);
    $kategori = $_SESSION['kd_judul_tes'];

    if ($_POST['sign'] != null) {
        $_SESSION['sign'] = $_POST['sign'];
    }

    if ($_SESSION['state'] == 0 && $kesulitan == 'start') {
        $sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan > '-0.5' and  tingkat_kesulitan < '0.5' and kategori = $kategori ORDER BY rand() limit 1";
    } else {
        $sign = $_SESSION['sign'];
        $banned_soal = implode(', ', $_SESSION['id_soal']);
        $tipeSebelumnya = $_SESSION['tipe_sebelumnya'];
        if ($sign == '>') {
            $batas = $kesulitan + 0.5;
            $sqlCheck = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and tingkat_kesulitan < $batas and kd_soal NOT IN ($banned_soal) and kategori = $kategori and tipe <> '$tipeSebelumnya' ORDER BY rand() limit 1";
            if (mysqli_num_rows(mysqli_query($db, $sqlCheck)) == 0) {
                $sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and tingkat_kesulitan < $batas and kd_soal NOT IN ($banned_soal) and kategori = $kategori ORDER BY rand() limit 1";
            } else {
                $sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and tingkat_kesulitan < $batas and kd_soal NOT IN ($banned_soal) and kategori = $kategori and tipe <> '$tipeSebelumnya' ORDER BY rand() limit 1";
            }
        } else if ($sign == '<') {
            $batas = $kesulitan - 0.5;
            $sqlCheck = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and tingkat_kesulitan > $batas and kd_soal NOT IN ($banned_soal) and kategori = $kategori and tipe <> '$tipeSebelumnya' ORDER BY rand() limit 1";
            if (mysqli_num_rows(mysqli_query($db, $sqlCheck)) == 0) {
                $sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and tingkat_kesulitan > $batas and kd_soal NOT IN ($banned_soal) and kategori = $kategori ORDER BY rand() limit 1";
            } else {
                $sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and tingkat_kesulitan > $batas and kd_soal NOT IN ($banned_soal) and kategori = $kategori and tipe <> '$tipeSebelumnya' ORDER BY rand() limit 1";
            }
        } else {
            $sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan $sign $kesulitan and kd_soal NOT IN ($banned_soal) and kategori = $kategori ORDER BY rand() limit 1";
        }
    }

    if (mysqli_num_rows(mysqli_query($db, $sql)) == 0) {
        // header('Location: ../peserta/done.php');
        if (isset($_SESSION['cekSemuaJawab'])) {
            $checkAllWrong = array_filter($_SESSION['cekSemuaJawab']);
            if (empty($checkAllWrong)) {
                $_SESSION['teta_jawab'] = -3;
            }
        }
        $_SESSION['testIsDone'] = true;
        $sql = "SELECT * FROM cat_soal order by rand() limit 1";
    }

    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);

    if (isset($_SESSION['testIsDone'])) {
        if ($_SESSION['testIsDone'] == true) {
            $data['isi_soal'] = "<h6>Test telah selesai. Silahkan klik tombol Selanjutnya.</h6>";
        }
    }

    if (isset($_SESSION['selisih_se'])) {
        if ((float) end($_SESSION['selisih_se']) <= 0.01) {
            // header('Location: ../peserta/done.php');
            $_SESSION['testIsDone'] = true;
            $data['isi_soal'] = "<h6>Test telah selesai. Silahkan klik tombol Selanjutnya.</h6>";
        }
    }

    $_SESSION['id_soal'][$_SESSION['state']] = $data['kd_soal'];
    $_SESSION['kesulitan'] = $data['tingkat_kesulitan'];

    echo json_encode($data);
}
