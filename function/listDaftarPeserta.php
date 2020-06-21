<?php

require 'db_connect.php';

$selectListUser = "SELECT * FROM cat_users WHERE role = 'Peserta' order by kd_user DESC";
$queryListUser = mysqli_query($db, $selectListUser);
