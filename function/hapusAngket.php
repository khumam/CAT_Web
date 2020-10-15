<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['id'])) {
    if ($_POST['jenis'] == 'angket') {
        $id = mysqli_real_escape_string($db, $_POST['id']);

        $sql = "DELETE FROM cat_angket WHERE id = $id";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['notif'] = "Data berhasil dihapus";
            $_SESSION['notif_type'] = "success";
        } else {
            $_SESSION['notif'] = "Data gagal dihapus";
            $_SESSION['notif_type'] = "danger";
        }

        echo json_encode(
            [
                "status" => true,
                "message" => $_SESSION['notif'],
            ]
        );
    } else if ($_POST['jenis'] == 'subangket') {
        $id = mysqli_real_escape_string($db, $_POST['id']);

        $sql = "DELETE FROM cat_sub_angket WHERE id = $id";
        $query = mysqli_query($db, $sql);

        if ($query) {
            $_SESSION['notif'] = "Data berhasil dihapus";
            $_SESSION['notif_type'] = "success";
        } else {
            $_SESSION['notif'] = "Data gagal dihapus";
            $_SESSION['notif_type'] = "danger";
        }

        echo json_encode(
            [
                "status" => true,
                "message" => $_SESSION['notif'],
            ]
        );
    }
} else {
    header('Location: ../admin/angket.php');
}
