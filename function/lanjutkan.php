<?php

session_start();

$redirect = 'peserta/index.php';

$username = $_SESSION['username'];
$kd_user = $_SESSION['id'];
$nama_user = $_SESSION['nama'];
$role = $_SESSION['role'];

session_unset();

$_SESSION['username'] = $username;
$_SESSION['id'] = $kd_user;
$_SESSION['nama'] = $nama_user;
$_SESSION['role'] = $role;
$_SESSION['session_id'] = $kd_user . $username . '_' . substr(md5(microtime()), rand(0, 26), 5);

header("Location: ../$redirect");
