<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    if ($_POST['jenis'] == 'angket') {
        $angket = $_POST['angket'];
        $tipe = $_POST['tipe'];
        $sub_id = $_POST['sub_id'];

        $sql = "INSERT INTO cat_angket(sub_id, angket, tipe) VALUES ('$sub_id', '$angket', '$tipe')";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['notif'] = "Data berhasil ditambahkan";
            $_SESSION['notif_type'] = "success";
            header('Location: ../admin/angket.php');
        } else {
            $_SESSION['notif'] = "Data gagal ditambahkan";
            $_SESSION['notif_type'] = "danger";
            header('Location: ../admin/angket.php');
        }
    } else if ($_POST['jenis'] == 'subangket') {
        $nama_sub = $_POST['nama_sub'];

        $sql = "INSERT INTO cat_sub_angket(nama_sub) VALUES ('$nama_sub')";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['notif'] = "Data berhasil ditambahkan";
            $_SESSION['notif_type'] = "success";
            header('Location: ../admin/angket.php');
        } else {
            $_SESSION['notif'] = "Data gagal ditambahkan";
            $_SESSION['notif_type'] = "danger";
            header('Location: ../admin/angket.php');
        }
    }
} else {
    header('Location: ../admin/angket.php');
}
