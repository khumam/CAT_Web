<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../layouts/sidebar.php';
require '../function/countAll.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="seo-fact sbg2">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-user"></i> Total Peserta</div>
                            <h2><?php echo $countUser['totalUser']; ?></h2>
                        </div>
                        <canvas id="seolinechart2" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="seo-fact sbg1">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-layout-list-post"></i> Total Test</div>
                            <h2><?php echo $countTest['totalTest']; ?></h2>
                        </div>
                        <canvas id="seolinechart2" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-layout-list-thumb-alt"></i> Total Soal</div>
                            <h2><?php echo $countSoal['totalSoal']; ?></h2>
                        </div>
                        <canvas id="seolinechart2" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <a href="../assets/Buku-Panduan-Penggunaan-CAT.pdf">
                    <div class="card">
                        <div class="seo-fact sbg4">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-arrow-circle-down"></i> Download Buku Panduan</div>
                            </div>
                            <canvas id="seolinechart2" height="50"></canvas>
                        </div>
                    </div>
                </a>
            </div>
        </div </div> </div> <?php require '../layouts/footer.php'; ?> <?php require '../layouts/close.php'; ?>