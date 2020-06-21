<?php

require 'db_connect.php';

$selectListSoal = "SELECT * FROM cat_soal order by kd_soal DESC";
$queryListSoal = mysqli_query($db, $selectListSoal);
