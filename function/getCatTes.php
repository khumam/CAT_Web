<?php
require 'check_peserta.php';
require 'db_connect.php';

if (isset($_POST['kd_judul_tes'])) {

    $kd_judul_tes = $_POST['kd_judul_tes'];
    $kd_peserta = $_SESSION['id'];

    $sql = "SELECT * FROM cat_tes WHERE kd_judul_tes = $kd_peserta AND kd_peserta = $kd_judul_tes ORDER BY kd_tes ASC LIMIT 1";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);
    echo json_encode($data);
}
