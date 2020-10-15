<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['all'])) {
    $sql = "SELECT * FROM cat_assets ORDER BY id DESC";
    $query = mysqli_query($db, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sql = "SELECT * FROM cat_assets WHERE id = $id";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);
    echo json_encode($data);
}
