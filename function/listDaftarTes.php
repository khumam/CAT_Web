<?php

require 'db_connect.php';

$selectListTest = "SELECT * FROM cat_daftar_tes order by kd_judul_tes DESC";
$queryListTest = mysqli_query($db, $selectListTest);
