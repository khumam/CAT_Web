<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    if ($_POST['jenis'] == 'angket') {
        $angket = mysqli_real_escape_string($db, $_POST['angket']);
        $tipe = mysqli_real_escape_string($db, $_POST['tipe']);
        $sub_id = mysqli_real_escape_string($db, $_POST['sub_id']);

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
        $nama_sub = mysqli_real_escape_string($db, $_POST['nama_sub']);

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
