<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    $judul = $_POST['judul'];
    $waktu = $_POST['waktutes'];

    $sql = "INSERT INTO cat_daftar_tes (judul, waktu) VALUES ('$judul', '$waktu')";
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
