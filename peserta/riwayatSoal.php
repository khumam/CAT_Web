<?php
require '../function/check_peserta.php';
require '../layouts/header.php';
require '../function/getRiwayatSoal.php';
require '../layouts/sidebar.php'; ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6 py-3">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Nama : <?php echo $_SESSION['nama']; ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4><?php echo $getSiswa['nama_user']; ?> (<?php echo $getSiswa['nomor_user']; ?>)</h4>
                        <h6><?php echo $getTes['judul']; ?></h6>
                        <hr>
                        <div class="btn-group">
                            <!-- <a href="../function/lanjutkan.php" class="btn btn-danger btn-xs">Kembali</a> -->
                            <a href="<?php echo '../peserta/done.php?idsiswa=' . $_GET['idsiswa'] . '&idkodesoal=' . $_GET['idkodesoal'] . '&sessionid=' . $_GET['sessionid'] ?>"" class=" btn btn-danger btn-xs">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Riwayat Tes</h4><br>
                        <span style="background: green; padding 4px; color: white"> Jawaban benar </span><br>
                        <span style="background: red; padding 3px; color: white"> Jawaban salah/peserta </span>
                        <hr>
                        <?php while ($dataRiwayat = mysqli_fetch_assoc($listRiwayatSoal)) { ?>
                            <div class="my-3">
                                <?php
                                $dataRiwayat['isi_soal'] = str_replace($dataRiwayat['jawab'] . ". ", "<b style='background:red; color:white'>" . $dataRiwayat['jawab'] . ". </b>", $dataRiwayat['isi_soal']);
                                $dataRiwayat['isi_soal'] = str_replace($dataRiwayat['kunci_soal'] . ". ", "<b style='background:green; color:white'>" . $dataRiwayat['kunci_soal'] . ". </b>", $dataRiwayat['isi_soal']);
                                ?>
                                <?php echo $dataRiwayat['state'] + 1 . ". " . ltrim(nl2br($dataRiwayat['isi_soal']), '<p>'); ?>
                                <hr>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require '../layouts/footer.php'; ?>
<?php require '../layouts/close.php'; ?>