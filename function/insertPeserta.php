<?php

require 'check_guru.php';
require 'db_connect.php';
require "excel_reader2.php";

if (isset($_POST['tombol-tambah'])) {
    $data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);
    $hasildata = $data->rowcount($sheet_index = 0);
    $berhasil = 0;
    $error = 0;

    for ($i = 2; $i <= $hasildata; $i++) {
        $nama = $data->val($i, '2');
        if (strstr($nama, "'")) {
            $nama = str_replace("'", "''", $nama);
        }
        $nomor = $data->val($i, 'C');
        $password = md5($data->val($i, 'D'));
        $sql = "INSERT INTO cat_users (nama_user, nomor_user, password_user, role) VALUES ('$nama', '$nomor', '$password', 'Peserta')";
        $query = mysqli_query($db, $sql);
        if ($query) {
            $berhasil++;
        } else {
            $error++;
        }

        // echo $sql . "<br>";
    }

    if ($berhasil == 0) {
        $_SESSION['notif'] = $error . " Peserta gagal ditambahkan";
        $_SESSION['notif_type'] = "danger";
    } else if ($error == 0) {
        $_SESSION['notif'] = $berhasil . " Peserta berhasil ditambahkan";
        $_SESSION['notif_type'] = "success";
    } else {
        $_SESSION['notif'] = $berhasil . " Peserta berhasil ditambahkan dan " . $error . " Peserta gagal ditambahkan";
        $_SESSION['notif_type'] = "warning";
    }

    header('Location: ../admin/daftarpeserta.php');
}
