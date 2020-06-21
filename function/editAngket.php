<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    if ($_POST['jenis'] == 'angket') {
        $id = $_POST['id'];
        $angket = $_POST['angket'];
        $tipe = $_POST['tipe'];
        $sub_id = $_POST['sub_id'];

        $sql = "UPDATE cat_angket SET sub_id = '$sub_id', angket = '$angket', tipe = '$tipe' WHERE id = $id";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['notif'] = "Data berhasil disunting";
            $_SESSION['notif_type'] = "success";
            header('Location: ../admin/angket.php');
        } else {
            $_SESSION['notif'] = "Data gagal disunting";
            $_SESSION['notif_type'] = "danger";
            header('Location: ../admin/angket.php');
        }
    } else if ($_POST['jenis'] == 'subangket') {
        $id = $_POST['id'];
        $nama_sub = $_POST['nama_sub'];

        $sql = "UPDATE cat_sub_angket SET nama_sub = '$nama_sub' WHERE id = $id";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['notif'] = "Data berhasil disunting";
            $_SESSION['notif_type'] = "success";
            header('Location: ../admin/angket.php');
        } else {
            $_SESSION['notif'] = "Data gagal disunting";
            $_SESSION['notif_type'] = "danger";
            header('Location: ../admin/angket.php');
        }
    }
} else {
    header('Location: ../admin/angket.php');
}
