<?php

require 'db_connect.php';

if (isset($_POST['kd_user'])) {
    $id = mysqli_real_escape_string($db, $_POST['kd_user']);

    $sql =  "SELECT * FROM cat_users WHERE kd_user = $id";
    $data = mysqli_fetch_assoc(mysqli_query($db, $sql));

    echo json_encode($data);
}
