<?php

session_start();

if ($_SESSION['role'] != 'Guru' || $_SESSION['role'] == '' || !isset($_SESSION['role'])) {
    header('Location: ../index.php');
}
