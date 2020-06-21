<?php
require '../function/check_peserta.php';
require '../layouts/header.php';
require '../layouts/sidebar.php'; ?>


<!-- <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6 py-3">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.html">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
</div> -->

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 p-3">
                <h4 class=" display-4">Hai, <?php echo $_SESSION['nama']; ?></h4>
                <p class="lead">Selamat datang di Computer Adaptive Test</p>
                <hr class="my-4">
                <p>Untuk memulai, silahkan klik <strong>Daftar Test</strong></p>
            </div>
            <div class="col-md-6 p-5 text-center">
                <img src="../media/img/welcome.svg" alt="Selamat datang" class="img-fluid" width="300" height="auto">
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
<?php require '../layouts/close.php'; ?>