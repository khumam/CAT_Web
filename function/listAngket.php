<?php

require 'db_connect.php';

$selectAngket = "SELECT * FROM cat_angket";
$queryAngket = mysqli_query($db, $selectAngket);
