<?php

require 'check_peserta.php';
require 'db_connect.php';

if (isset($_POST['date'])) {
    $kd_judul_tes = $_POST['kd_judul_tes'];
    $date = $_POST['date'];
    $kd_peserta = $_SESSION['id'];

    $getTes = "SELECT * FROM cat_daftar_tes WHERE kd_judul_tes = $kd_judul_tes";
    $dataTes = mysqli_fetch_assoc(mysqli_query($db, $getTes));

    $_SESSION['timeStart'] = $date;
    $_SESSION['timeDuration'] = (int) $dataTes['waktu'];
    $_SESSION['kd_judul_tes'] = $kd_judul_tes;
    $_SESSION['teta_awal'] = 0;
    $_SESSION['teta_jawab'] = 0;
    $_SESSION['kesulitan'] = "start";
    $_SESSION['state'] = 0;
    $_SESSION['sign'] = null;
    $session_id = $_SESSION['session_id'];
    $_SESSION['sessiontest'] = true;

    $sql = "INSERT INTO cat_tes (kd_judul_tes, waktu_tes, kd_peserta, session_id) VALUES ('$kd_judul_tes', '$date', '$kd_peserta', '$session_id')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        echo json_encode(
            [
                'status' => true
            ]
        );
    } else {
        echo json_encode(
            [
                'status' => false
            ]
        );
    }
}
