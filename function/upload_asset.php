<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    $nama = $_POST['nama'];
    $type = $_FILES['file']['type'];
    $format = end((explode(".", $_FILES['file']['name'])));
    $error = $_FILES['file']['error'];
    $link = md5($_FILES['file']['name'])  . '.' . $format;

    if ($error == 0) {
        $sql = "INSERT INTO cat_assets (nama, `type`, `format`, link) values ('$nama', '$type', '$format', '$link')";
        $query = mysqli_query($db, $sql);
        if($query){
            move_uploaded_file($_FILES['file']['tmp_name'], '../media/assets/' . $link);
            $_SESSION['notif'] = "Berhasil mengupload data";
            $_SESSION['notif_type'] = "success";
        }
    } else {
        $_SESSION['notif'] = "Gagal upload data, cek kembali file Anda";
        $_SESSION['notif_type'] = "danger";
    }

    header('Location: ../admin/assets.php');
}
