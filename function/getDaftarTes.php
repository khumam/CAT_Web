<?php

require 'db_connect.php';

if (isset($_POST['all'])) {
    $sql = "SELECT * FROM cat_daftar_tes ORDER BY kd_judul_tes DESC";
    $query = mysqli_query($db, $sql);
    $data = [];

    while ($list = mysqli_fetch_assoc($query)) {
        $data[] = $list;
    }

    echo json_encode($data);
} else if (isset($_POST['byid'])) {
    $id = mysqli_real_escape_string($db, $_POST['byid']);
    $sql = "SELECT * FROM cat_daftar_tes WHERE kd_judul_tes = $id";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);

    echo json_encode($data);
} else {
    $sql = "SELECT * FROM cat_daftar_tes ORDER BY kd_judul_tes DESC";
    $query = mysqli_query($db, $sql);
}
