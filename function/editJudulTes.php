<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    $judul = mysqli_real_escape_string($db, $_POST['judul']);
    $waktu = mysqli_real_escape_string($db, $_POST['waktutes']);
    $kd_tes = mysqli_real_escape_string($db, $_POST['kd_tes']);

    $sql = "UPDATE cat_daftar_tes SET judul = '$judul', waktu = '$waktu' WHERE kd_judul_tes = $kd_tes";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['notif'] = "Data berhasil ditambahkan";
        $_SESSION['notif_type'] = "success";
        header('Location: ../admin/daftartes.php');
    } else {
        $_SESSION['notif'] = "Data gagal ditambahkan";
        $_SESSION['notif_type'] = "danger";
        header('Location: ../admin/daftartes.php');
    }
}
