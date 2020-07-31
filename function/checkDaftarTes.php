<?php

require 'db_connect.php';

$id_tes = 5;
$id_user = $_SESSION['id'];
$session_id = $_SESSION['session_id'];

$sql = "SELECT * FROM cat_hasil WHERE id_tes = $id_tes AND id_user = $id_user LIMIT 1";
$query = mysqli_query($db, $sql);

$checkDaftarTes = mysqli_fetch_assoc($query);
