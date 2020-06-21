<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM cat_tes JOIN cat_daftar_tes ON cat_tes.kd_judul_tes = cat_daftar_tes.kd_judul_tes WHERE cat_tes.kd_peserta = $id ORDER BY cat_tes.kd_tes DESC";
    $query = mysqli_query($db, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
