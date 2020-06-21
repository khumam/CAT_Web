<?php

require 'db_connect.php';

$idsoal = [8, 9, 10, 11, 12, 13];

$banned_soal = implode(', ', $idsoal);

$sql = "SELECT * FROM cat_soal WHERE tingkat_kesulitan > -0.5 and kd_soal NOT IN ($banned_soal) ORDER BY rand() limit 1";

$query = mysqli_query($db, $sql);
$data = mysqli_num_rows(mysqli_query($db, $sql));
$cek = mysqli_fetch_assoc($query);
$cek['is']['done'] = false;

if (mysqli_num_rows(mysqli_query($db, $sql)) == 0) {
    $cek['is']['done'] = true;
}

print_r($banned_soal);
echo "<br>";
print_r($data);
echo "<br>";
print_r(json_encode($cek));
// echo "<br>";
// echo $sql;
