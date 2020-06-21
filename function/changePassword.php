<?php

require 'db_connect.php';

if (isset($_POST['tombol-ubah'])) {

    $oldPass = md5($_POST['password_lama']);
    $newPass = md5($_POST['password_baru']);
    $id = $_SESSION['id'];

    $sql = "UPDATE cat_users SET password_user = $newPass WHERE kd_user = $id AND password_user = $oldPass";
    $query = mysqli_query($db, $sql);

    if ($query) {
        header('logout.php');
    } else {
        $_SESSION['notif'] = "Password gagal diubah";
        $_SESSION['notif_type'] = "danger";
        header('Location: ../admin/pengaturan.php');
    }
}
