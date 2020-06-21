<?php

session_start();
require 'db_connect.php';

if (isset($_POST['tombol-daftar'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $role = 'Guru';

    $sql = "INSERT INTO cat_users (nama_user, nomor_user, password_user, role) VALUES ('$nama', '$username', '$password', '$role')";

    $query = mysqli_query($db, $sql);

    if ($query) {
        header('Location: ../loginadmin.php');
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}
