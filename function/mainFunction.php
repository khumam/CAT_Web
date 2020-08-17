<?php

require 'check_peserta.php';
require 'db_connect.php';
require 'math.php';

if (isset($_SESSION['testIsDone'])) {
    if ($_SESSION['testIsDone'] == 1) {
        //angket di sini
        header('Location: ../peserta/angket.php?idsiswa=' . $_SESSION['id'] . '&idkodesoal=' . $_SESSION['kd_judul_tes'] . '&sessionid=' . $_SESSION['session_id']);
        // header('Location: ../peserta/done.php?idsiswa=' . $_SESSION['id'] . '&idkodesoal=' . $_SESSION['kd_judul_tes'] . '&sessionid=' . $_SESSION['session_id']);
    }
} else {

    if (isset($_POST['tombol-next'])) {

        // Cek jawaban peserta
        $jawaban = ucwords($_POST['jawaban']);
        $id_soal = $_SESSION['id_soal'][$_SESSION['state']];

        $getSoal = "SELECT * FROM cat_soal WHERE kd_soal = $id_soal";
        $dataSoal = mysqli_query($db, $getSoal);
        $dataSoal = mysqli_fetch_assoc($dataSoal);
        $_SESSION['waktu-jawab-per-soal'] = $_POST['waktu-soal'];

        if ($dataSoal['kunci_soal'] == $jawaban) {
            // SETTING JAWAB BENAR
            $_SESSION['skor'] = 1;
            $_SESSION['cekSemuaJawab'][$_SESSION['state']] = $_SESSION['skor'];
            $_SESSION['teta_awal'] = $_SESSION['teta_jawab'];
            $_SESSION['teta_jawab'] = countTetha($_SESSION['kesulitan']);
            $_SESSION['p_teta'] = countPi($_SESSION['teta_jawab'], $_SESSION['kesulitan']);
            $_SESSION['q_teta'] = countQi($_SESSION['p_teta']);
            $_SESSION['iif'][$_SESSION['state']] = countLi($_SESSION['p_teta'], $_SESSION['q_teta']);
            $_SESSION['kesulitan'] = $_SESSION['teta_jawab'];
            $_SESSION['se_teta'][$_SESSION['state']] = countSe($_SESSION['iif']);
            $_SESSION['sign'] = '>';
            $_SESSION['jawabanPeserta'] = $jawaban;
            $_SESSION['tipe_sebelumnya'] = $dataSoal['tipe'];

            if ($_SESSION['state'] == 0) {
                $_SESSION['selisih_se'][$_SESSION['state']] = countSe($_SESSION['iif']);
            } else {
                $_SESSION['selisih_se'][$_SESSION['state']] = $_SESSION['se_teta'][$_SESSION['state'] - 1] - $_SESSION['se_teta'][$_SESSION['state']];
            }

            // $_SESSION['se_teta'] = $countSe;

            $save = saveHasil();
            $_SESSION['state'] += 1;
            if ($save) {
                header('Location: ../peserta/tes.php?tes=' . $_SESSION['kd_judul_tes']);
            }
        } else {

            $_SESSION['skor'] = 0;
            $_SESSION['cekSemuaJawab'][$_SESSION['state']] = $_SESSION['skor'];
            $_SESSION['teta_awal'] = $_SESSION['teta_jawab'];
            $_SESSION['teta_jawab'] = $_SESSION['teta_awal'];
            $_SESSION['p_teta'] = 1 - countPi($_SESSION['teta_jawab'], $_SESSION['kesulitan']);
            $_SESSION['q_teta'] = countQi($_SESSION['p_teta']);
            $_SESSION['iif'][$_SESSION['state']] = countLi($_SESSION['p_teta'], $_SESSION['q_teta']);
            $_SESSION['kesulitan'] = $_SESSION['teta_jawab'];
            $_SESSION['se_teta'][$_SESSION['state']] = countSe($_SESSION['iif']);
            $_SESSION['sign'] = '<';
            $_SESSION['jawabanPeserta'] = $jawaban;
            $_SESSION['tipe_sebelumnya'] = $dataSoal['tipe'];

            if ($_SESSION['state'] == 0) {
                $_SESSION['selisih_se'][$_SESSION['state']] = countSe($_SESSION['iif']);
            } else {
                $_SESSION['selisih_se'][$_SESSION['state']] = $_SESSION['se_teta'][$_SESSION['state'] - 1] - $_SESSION['se_teta'][$_SESSION['state']];
            }

            $save = saveHasil();
            $_SESSION['state'] += 1;
            if ($save) {
                header('Location: ../peserta/tes.php?tes=' . $_SESSION['kd_judul_tes']);
            }
        }
    }
}

if (isset($_GET['waktuHabis'])) {
    if ($_GET['waktuHabis'] == 1) {
        $_SESSION['skor'] = 0;
        $_SESSION['cekSemuaJawab'][$_SESSION['state']] = $_SESSION['skor'];
        $_SESSION['teta_awal'] = $_SESSION['teta_jawab'];
        $_SESSION['teta_jawab'] = $_SESSION['teta_awal'];
        $_SESSION['p_teta'] = 1 -  countPi($_SESSION['teta_jawab'], $_SESSION['kesulitan']);
        $_SESSION['q_teta'] = countQi($_SESSION['p_teta']);
        $_SESSION['iif'][$_SESSION['state']] = countLi($_SESSION['p_teta'], $_SESSION['q_teta']);
        $_SESSION['kesulitan'] = $_SESSION['teta_jawab'];
        $_SESSION['se_teta'][$_SESSION['state']] = countSe($_SESSION['iif']);
        $_SESSION['sign'] = '<';
        $_SESSION['jawabanPeserta'] = null;
        $_SESSION['tipe_sebelumnya'] = '0';
        $_SESSION['waktu-jawab-per-soal'] = $_SESSION['timeDuration'] * 60;

        if ($_SESSION['state'] == 0) {
            $_SESSION['selisih_se'][$_SESSION['state']] = countSe($_SESSION['iif']);
        } else {
            $_SESSION['selisih_se'][$_SESSION['state']] = $_SESSION['se_teta'][$_SESSION['state'] - 1] - $_SESSION['se_teta'][$_SESSION['state']];
        }

        $save = saveHasil();
        $_SESSION['state'] += 1;
        if ($save) {
            header('Location: ../peserta/tes.php?tes=' . $_SESSION['kd_judul_tes']);
        }
    }
}


function saveHasil()
{
    include 'db_connect.php';

    $id_soal = $_SESSION['id_soal'][$_SESSION['state']];
    $state = $_SESSION['state'];
    $id_user = $_SESSION['id'];
    $kesulitan = $_SESSION['kesulitan'];
    $skor = $_SESSION['skor'];
    $teta_awal = $_SESSION['teta_awal'];
    $teta_jawab = $_SESSION['teta_jawab'];
    $p_teta = $_SESSION['p_teta'];
    $q_teta = $_SESSION['q_teta'];
    $iif = $_SESSION['iif'][$_SESSION['state']];
    $se_teta = $_SESSION['se_teta'][$_SESSION['state']];
    $selisih_se = $_SESSION['selisih_se'][$_SESSION['state']];
    $session_id = $_SESSION['session_id'];
    $id_tes = $_SESSION['kd_judul_tes'];
    $jawab = $_SESSION['jawabanPeserta'];
    $waktusoal = $_SESSION['waktu-jawab-per-soal'];

    $getKesulitan = "SELECT tingkat_kesulitan FROM cat_soal WHERE kd_soal = $id_soal";
    $queryKesulitan = mysqli_fetch_assoc(mysqli_query($db, $getKesulitan));
    $kesulitanSoalKini = $queryKesulitan['tingkat_kesulitan'];

    $sql = "INSERT INTO cat_hasil (`state`, id_soal, id_tes, id_user, jawab, kesulitan, skor, teta_awal, teta_jawab, p_teta, q_teta, `iif`, se_teta, selisih_se, waktusoal, `session_id`) VALUES ('$state', '$id_soal', '$id_tes','$id_user', '$jawab',  '$kesulitanSoalKini', '$skor', '$teta_awal', '$teta_jawab', '$p_teta', '$q_teta', '$iif', '$se_teta', '$selisih_se', '$waktusoal', '$session_id')";
    $query = mysqli_query($db, $sql);

    $_SESSION['kesulitan'] = $kesulitanSoalKini;

    return $query ? true : false;
}
