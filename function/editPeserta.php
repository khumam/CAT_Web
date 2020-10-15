<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-simpan'])) {
    $kd_user = mysqli_real_escape_string($db, $_POST['kd_user']);
    $nama_user = mysqli_real_escape_string($db, $_POST['nama_user']);
    $nomor_user = mysqli_real_escape_string($db, $_POST['nomor_user']);

    $sql = "UPDATE cat_users SET nama_user = '$nama_user', nomor_user = '$nomor_user' WHERE kd_user = $kd_user";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['notif'] = "Data berhasil diedit";
        $_SESSION['notif_type'] = "success";
        header('Location: ../admin/daftarpeserta.php');
    } else {
        $_SESSION['notif'] = "Data gagal diedit";
        $_SESSION['notif_type'] = "danger";
        header('Location: ../admin/daftarpeserta.php');
    }
}
