<?php
require '../function/check_peserta.php';
require '../layouts/header.php';
require '../layouts/sidebar.php'; ?>


<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-7 p-3">
                    <h4 class=" display-4">Hai, <?php echo $_SESSION['nama']; ?></h4>
                    <p class="lead">Selamat datang di Computer Adaptive Test</p>
                    <p class="lead">Getaran, Gelombang, dan Bunyi</p>
                    <p class="lead">Pengembang: Husnul Khotimah<br>Email: ayatulhusnul@gmail.com</p>
                    <hr class="my-4">
                    <p>Untuk memulai, silahkan klik <strong>Daftar Test</strong></p>
                </div>
                <div class="col-md-5 p-5 text-center">
                    <img src="../media/img/welcome.svg" alt="Selamat datang" class="img-fluid" width="300" height="auto">
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
<?php require '../layouts/close.php'; ?>