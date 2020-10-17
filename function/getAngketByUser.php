<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['id'])) {
    
    $idsiswa = mysqli_real_escape_string($db, $_POST['id']);
    $sql = "select user_id, session_id from cat_hasil_angket where user_id = $idsiswa group by session_id, user_id";
    $query = mysqli_query($db, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    echo json_encode($data);
}