<?php

session_start();
require 'db_connect.php';

if (isset($_POST['tombol-login'])) {

    $nomorOrUsername = mysqli_real_escape_string($db, $_POST['nomorusername']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM  cat_users WHERE nomor_user = '$nomorOrUsername' and  password_user = '$password'";
    $query = mysqli_query($db, $sql);
    $count = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);

    if ($count == 1) {
        if ($data['role'] == 'Guru') {
            $_SESSION['username'] = $data['nomor_user'];
            $_SESSION['id'] = $data['kd_user'];
            $_SESSION['nama'] = $data['nama_user'];
            $_SESSION['role'] = $data['role'];

            header('Location: ../admin/index.php');
        } else if ($data['role'] == 'Peserta') {
            $_SESSION['username'] = $data['nomor_user'];
            $_SESSION['id'] = $data['kd_user'];
            $_SESSION['nama'] = $data['nama_user'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['session_id'] =  $data['kd_user'] . $data['nomor_user'] . '_' . substr(md5(microtime()), rand(0, 26), 5);

            header('Location: ../peserta/index.php');
        } else {
            print_r($data['role']);
            die;
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }
}
