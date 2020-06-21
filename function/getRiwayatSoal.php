<?php

require 'db_connect.php';

if (isset($_GET['idsiswa']) && isset($_GET['idkodesoal']) && isset($_GET['sessionid'])) {
    $idsiswa = $_GET['idsiswa'];
    $idkodesoal = $_GET['idkodesoal'];
    $sessionid = $_GET['sessionid'];

    $sql = "SELECT a.id, a.state, a.id_soal, a.jawab, b.isi_soal, b.kunci_soal FROM cat_hasil a JOIN cat_soal b ON a.id_soal = b.kd_soal WHERE a.id_user = '$idsiswa' && a.id_tes = '$idkodesoal' && a.session_id = '$sessionid' ORDER BY a.state asc";

    $listRiwayatSoal = mysqli_query($db, $sql);

    $getTes = mysqli_fetch_assoc(mysqli_query($db, "SELECT judul FROM cat_daftar_tes WHERE kd_judul_tes = $idkodesoal"));
    $getSiswa = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_user,nomor_user FROM cat_users WHERE kd_user = $idsiswa"));

    

}