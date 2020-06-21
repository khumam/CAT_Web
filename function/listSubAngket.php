<?php

require 'db_connect.php';

$selectSubAngket = "SELECT * FROM cat_sub_angket";
$querySubAngket = mysqli_query($db, $selectSubAngket);
$querySubAngket2 = mysqli_query($db, $selectSubAngket);
