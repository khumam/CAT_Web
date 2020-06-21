<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['all'])) {
    $sql = "SELECT kd_user, nama_user, nomor_user, role FROM cat_users WHERE role ='Peserta' ORDER BY kd_user DESC";
    $query = mysqli_query($db, $sql);
    $data = [];

    while ($list = mysqli_fetch_assoc($query)) {
        $data[] = $list;
    }

    echo json_encode($data);
} else if (isset($_POST['byid'])) {
    $id = $_POST['byid'];
    $sql = "SELECT kd_user, nama_user, nomor_user, role FROM cat_users WHERE role ='Peserta' AND kd_user = $id";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);

    echo json_encode($data);
}
