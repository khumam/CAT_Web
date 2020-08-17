<?php

require 'db_connect.php';
$idsiswa = $_SESSION['id'];
$idkodesoal = $_SESSION['kd_judul_tes'];
$sessionid = $_SESSION['session_id'];
$cekSalahSemua = 0;
$cekTipe = [];

$dataDiri = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_user FROM cat_users WHERE kd_user = $idsiswa"));

$getSiswa = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_user,nomor_user FROM cat_users WHERE kd_user = $idsiswa"));
$getTes = mysqli_fetch_assoc(mysqli_query($db, "SELECT judul FROM cat_daftar_tes WHERE kd_judul_tes = $idkodesoal"));
$getNilai = mysqli_query($db, "SELECT * FROM cat_hasil WHERE id_user = '$idsiswa' && id_tes = '$idkodesoal' && session_id = '$sessionid' ORDER BY state asc");
$getSkor = mysqli_query($db, "SELECT skor FROM cat_hasil WHERE id_user = '$idsiswa' && id_tes = '$idkodesoal' && session_id = '$sessionid' ORDER BY state asc");
$getTipeSoal = mysqli_query($db, "SELECT count(*) as totalTipe, s.tipe FROM `cat_hasil` as h JOIN cat_soal as s ON h.id_soal = s.kd_soal WHERE h.id_user = '$idsiswa' && h.id_tes = '$idkodesoal' && h.session_id = '$sessionid' GROUP BY s.tipe");
// $getTipe = mysqli_query($db, "SELECT h.state, s.tipe FROM `cat_hasil` as h JOIN cat_soal as s ON h.id_soal = s.kd_soal WHERE h.id_user = '$idsiswa' && h.id_tes = '$idkodesoal' && h.session_id = '$sessionid' ORDER BY h.state ASC");

// while ($tipeSoal = mysqli_fetch_assoc($getTipe)) {
//     $cekTipe[] = $tipeSoal['tipe'];
// }


while ($cekSkor = mysqli_fetch_assoc($getSkor)) {
    $cekSalahSemua += $cekSkor['skor'];
}

if ($cekSalahSemua == 0) {
    $dataNilai['teta_jawab'] = -3;
} else {
    $getTetaAkhir = mysqli_query($db, "SELECT * FROM cat_hasil WHERE id_user = '$idsiswa' && id_tes = '$idkodesoal' && session_id = '$sessionid' ORDER BY state desc LIMIT 1");
    $dataNilai = mysqli_fetch_assoc($getTetaAkhir);
}
