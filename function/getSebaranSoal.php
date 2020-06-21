<?php

function rand_color() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

require 'db_connect.php';
if (isset($_GET['kategori'])) {
    $cat = $_GET['kategori'];
    if ($cat == 'all') {
        $listSebaranSoal = mysqli_query($db, "SELECT * FROM cat_soal");
        $listTipeSoal = mysqli_query($db, "SELECT count(*), tipe FROM cat_soal GROUP BY tipe");
    } else {
        $listSebaranSoal = mysqli_query($db, "SELECT * FROM cat_soal WHERE kategori = $cat");
        $listTipeSoal = mysqli_query($db, "SELECT count(*), tipe FROM cat_soal WHERE kategori = $cat GROUP BY tipe");
    }
} else {
    $listSebaranSoal = mysqli_query($db, "SELECT * FROM cat_soal");
    $listTipeSoal = mysqli_query($db, "SELECT count(*), tipe FROM cat_soal GROUP BY tipe");
}
$dataTest = mysqli_query($db, "SELECT * FROM cat_daftar_tes ORDER BY kd_judul_tes DESC");
$dataSebaranSoal = [];
$dataTipeSebaranSoal = [];
$iterasiSebaranSoal = 0;
$sebaranSoalGrouped = [];
$sebaranSoalImploded = [];
$warna = [];
while ($sebaranSoal = mysqli_fetch_assoc($listSebaranSoal)) {
    $dataSebaranSoal[$iterasiSebaranSoal]['tipe'] = $sebaranSoal['tipe'];
    $dataSebaranSoal[$iterasiSebaranSoal]['tingkat_kesulitan'] = $sebaranSoal['tingkat_kesulitan'];
    $dataSebaranSoal[$iterasiSebaranSoal]['color'] = rand_color();
    $iterasiSebaranSoal++;
}
while ($sebaranTipeSoal = mysqli_fetch_assoc($listTipeSoal)) {
    $dataTipeSebaranSoal[] = $sebaranTipeSoal['tipe'];
}
foreach ($dataSebaranSoal as $data) {
    $sebaranSoalGrouped[$data['tipe']][] = "{ x: " . $data['tingkat_kesulitan'] . ", y:0 }";
    $warna[$data['tipe']] = $data['color'];
}
foreach ($sebaranSoalGrouped as $dataGroup => $valueGroup) {
    $sebaranSoalImploded[$dataGroup] = implode(',', $valueGroup);
}

