<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    $nama = mysqli_real_escape_string($db, $_POST['nama']);

    $sql = "INSERT INTO cat_tipesoal (nama) VALUES ('$nama')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['notif'] = "Tipe soal berhasil ditambahkan";
        $_SESSION['notif_type'] = "success";
    } else {
        $_SESSION['notif'] = "Tipe soal gagal ditambahkan";
        $_SESSION['notif_type'] = "danger";
    }

    header('Location: ../admin/tipesoal.php');
}
