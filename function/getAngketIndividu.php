<?php

require 'check_guru.php';
require 'db_connect.php';

if (isset($_POST['komentar'])) {
    if (isset($_POST['idsiswa'])) {

        $idsiswa = mysqli_real_escape_string($db, $_POST['idsiswa']);
        $sql = "select * from cat_komentar where user_id = $idsiswa order by id desc";
        $query = mysqli_query($db, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
} else {
    if (isset($_POST['idsiswa']) && isset($_POST['sessionid'])) {

        $idsiswa = mysqli_real_escape_string($db, $_POST['idsiswa']);
        $sessionid = mysqli_real_escape_string($db, $_POST['sessionid']);

        $sql = "SELECT cat_hasil_angket.*, cat_users.nama_user, cat_users.nomor_user, cat_users.kd_user, cat_angket.sub_id, cat_angket.angket FROM `cat_hasil_angket` join cat_angket on cat_angket.id = cat_hasil_angket.angket_id join cat_users on cat_users.kd_user = cat_hasil_angket.user_id WHERE cat_users.kd_user = $idsiswa and cat_hasil_angket.session_id = '$sessionid'";
        $query = mysqli_query($db, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
}

if (isset($_POST['all'])) {
    $sql = "SELECT angket_id, user_id, cat_users.nama_user, cat_users.nomor_user from cat_hasil_angket join cat_users on cat_users.kd_user = cat_hasil_angket.user_id WHERE cat_users.role = 'Peserta' GROUP BY angket_id, user_id, cat_users.nama_user, cat_users.nomor_user";
    $query = mysqli_query($db, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
