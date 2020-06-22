<?php

require '../function/db_connect.php';

$listSub = mysqli_query($db, 'SELECT * FROM cat_sub_angket');
$listAngket = mysqli_query($db, 'SELECT * FROM cat_angket');
$dataSub = [];
$dataAngket = [];

while ($sub = mysqli_fetch_assoc($listSub)) {
    $dataSub[] = $sub;
}

while ($angket = mysqli_fetch_assoc($listAngket)) {
    $dataAngket[] = $angket;
}