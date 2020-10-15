<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['all'])) {
    $sql = "SELECT cat_angket.*, cat_sub_angket.id as kd_sub, cat_sub_angket.nama_sub FROM cat_angket JOIN cat_sub_angket ON cat_angket.sub_id = cat_sub_angket.id ORDER BY cat_angket.id DESC";
    $query = mysqli_query($db, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sql = "SELECT * FROM cat_angket WHERE id = $id";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);
    echo json_encode($data);
}
