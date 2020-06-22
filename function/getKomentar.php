<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['all'])) {
    $sql = "SELECT * FROM cat_komentar ORDER BY id DESC";
    $query = mysqli_query($db, $sql);
    $data = [];

    while ($list = mysqli_fetch_assoc($query)) {
        $data[] = $list;
    }

    echo json_encode($data);
}