<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {

    $soal = mysqli_real_escape_string($db, $_POST['soal']);
    $kunci = mysqli_real_escape_string($db, $_POST['kunci']);
    $kesulitan = mysqli_real_escape_string($db, $_POST['kesulitan']);
    $tipe = mysqli_real_escape_string($db, $_POST['tipesoal']);
    $kategori = mysqli_real_escape_string($db, $_POST['jenisTes']);

    $berhasil = 0;
    $error = 0;

    for ($i = 0; $i < count($_POST['soal']); $i++) {

        $sql = "INSERT INTO cat_soal (isi_soal, kunci_soal, tingkat_kesulitan, tipe, kategori) VALUES ('$soal[$i]', '$kunci[$i]', '$kesulitan[$i]', '$tipe[$i]', $kategori)";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $berhasil++;
        } else {
            $error++;
        }
    }

    if ($berhasil == 0) {
        $_SESSION['notif'] = $error . " Soal gagal ditambahkan";
        $_SESSION['notif_type'] = "danger";
    } else if ($error == 0) {
        $_SESSION['notif'] = $berhasil . " Soal berhasil ditambahkan";
        $_SESSION['notif_type'] = "success";
    } else {
        $_SESSION['notif'] = $berhasil . " Soal berhasil ditambahkan dan " . $error . " Soal gagal ditambahkan";
        $_SESSION['notif_type'] = "warning";
    }

    header('Location: ../admin/soal.php');
}
