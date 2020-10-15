<?php

require 'db_connect.php';

if (isset($_POST['all'])) {
    $sql = "SELECT * FROM cat_tipesoal ORDER BY id DESC";
    $query = mysqli_query($db, $sql);
    $data = [];

    while ($list = mysqli_fetch_assoc($query)) {
        $data[] = $list;
    }

    echo json_encode($data);
} else if (isset($_POST['byid'])) {
    $id = mysqli_real_escape_string($db, $_POST['byid']);
    $sql = "SELECT * FROM cat_tipesoal WHERE id = $id";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($query);

    echo json_encode($data);
} else {
    $sqlTipeSoal = "SELECT * FROM cat_tipesoal ORDER BY id DESC";
    $queryTipeSoal = mysqli_query($db, $sqlTipeSoal);
    $queryTipeSoalAdd = mysqli_query($db, $sqlTipeSoal);
}

if (isset($_POST['getTipeSoalChart'])) {
    $idsiswa = mysqli_real_escape_string($db, $_POST['idsiswa']);
    $idkodesoal = mysqli_real_escape_string($db, $_POST['idkodesoal']);
    $sessionid = mysqli_real_escape_string($db, $_POST['sessionid']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $cekTipe = '';

    $getTipe = mysqli_query($db, "SELECT h.state, s.tipe, h.waktuSoal FROM `cat_hasil` as h JOIN cat_soal as s ON h.id_soal = s.kd_soal WHERE h.id_user = '$idsiswa' && h.id_tes = '$idkodesoal' && h.session_id = '$sessionid' && h.state = $state LIMIT 1");

    $tipeSoal = mysqli_fetch_assoc($getTipe);
    if (isset($_POST['getTipe'])) {
        $cekTipe = $tipeSoal['tipe'];
    } else if (isset($_POST['waktuSoal'])) {
        $cekTipe = $tipeSoal['waktuSoal'];
    } else {
        $cekTipe = $tipeSoal['tipe'];
    }

    echo json_encode($cekTipe);
}
