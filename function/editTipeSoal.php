<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['tombol-tambah'])) {
    $nama = $_POST['nama'];
    $id = $_POST['id'];

    $sql = "UPDATE cat_tipesoal SET nama = '$nama' WHERE id = $id";
    $query = mysqli_query($db, $sql);


    if ($query) {
        $_SESSION['notif'] = "Tipe soal berhasil diubah";
        $_SESSION['notif_type'] = "success";
    } else {
        $_SESSION['notif'] = "Tipe soal gagal diubah";
        $_SESSION['notif_type'] = "danger";
    }

    header('Location: ../admin/tipesoal.php');
}
