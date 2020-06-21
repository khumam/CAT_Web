<?php

require 'db_connect.php';

if (isset($_POST['kd_user'])) {
    $id = $_POST['kd_user'];

    $sql =  "SELECT * FROM cat_users WHERE kd_user = $id";
    $data = mysqli_fetch_assoc(mysqli_query($db, $sql));

    echo json_encode($data);
}
