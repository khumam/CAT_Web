<?php

require 'db_connect.php';

$totalUser = "Select count(*) as totalUser from cat_users Where role = 'Peserta'";
$totalTest = "Select count(*) as totalTest from cat_daftar_tes";
$totalSoal = "Select count(*) as totalSoal from cat_soal";

$queryUser = mysqli_query($db, $totalUser);
$queryTest = mysqli_query($db, $totalTest);
$querySoal = mysqli_query($db, $totalSoal);

$countUser = mysqli_fetch_assoc($queryUser);
$countTest = mysqli_fetch_assoc($queryTest);
$countSoal = mysqli_fetch_assoc($querySoal);
