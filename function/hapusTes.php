<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['id'])) {

    $id = mysqli_real_escape_string($db, $_POST['id']);

    $sql = "DELETE FROM cat_daftar_tes WHERE kd_judul_tes = $id";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['notif'] = "Berhasil menghapus data";
        $_SESSION['notif_type'] = "success";
    } else {
        $_SESSION['notif'] = "Gagal menghapus data";
        $_SESSION['notif_type'] = "danger";
    }

    echo json_encode(
        [
            "status" => true,
            "message" => $_SESSION['notif'],
        ]
    );
}
