<?php

if (isset($_GET['tes']) && isset($_SESSION['kd_judul_tes'])) {
    if ($_GET['tes'] != $_SESSION['kd_judul_tes']) {
        header('Location: tes.php?tes=' . $_SESSION['kd_judul_tes']);
    }
} else {
    header('Location: ../index.php');
}

if (isset($_SESSION['testIsDone'])) {
    if ($_SESSION['testIsDone'] == 1) {
        // header('Location: ../peserta/done.php');
        header('Location: ../peserta/angket.php?idsiswa=' . $_SESSION['id'] . '&idkodesoal=' . $_SESSION['kd_judul_tes'] . '&sessionid=' . $_SESSION['session_id']);
    }
}
