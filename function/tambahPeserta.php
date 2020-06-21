<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-simpan'])) {

    $nama_user = $_POST['nama_user'];
    $nomor_user = $_POST['nomor_user'];
    $password_user = md5($_POST['password_user']);

    $sql = "INSERT INTO cat_users (nama_user, nomor_user, password_user, role) VALUES ('$nama_user', '$nomor_user', '$password_user', 'Peserta')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['notif'] = "Data berhasil ditambahkan";
        $_SESSION['notif_type'] = "success";
        header('Location: ../admin/daftarpeserta.php');
    } else {
        $_SESSION['notif'] = "Data gagal ditambahkan";
        $_SESSION['notif_type'] = "danger";
        header('Location: ../admin/daftarpeserta.php');
    }
}
