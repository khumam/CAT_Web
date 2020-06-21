<?php

session_start();

if ($_SESSION['role'] == 'Guru') {
    $redirect = 'loginadmin.php';
} else if ($_SESSION['role'] == 'Peserta') {
    $redirect = 'index.php';
}

session_unset();

header("Location: ../$redirect");
