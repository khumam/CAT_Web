<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/getRiwayatSoal.php';
require '../layouts/sidebar.php'; ?>

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
                            <a href="hasiltes.php" class="btn btn-danger btn-xs">Kembali</a>
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
                                if ($dataRiwayat['jawab'] != null) {
                                    $dataRiwayat['isi_soal'] = str_replace($dataRiwayat['jawab'] . ". ", "<b style='background:red; color:white'>" . $dataRiwayat['jawab'] . ". </b>", $dataRiwayat['isi_soal']);
                                }
                                $dataRiwayat['isi_soal'] = str_replace($dataRiwayat['kunci_soal'] . ". ", "<b style='background:green; color:white'>" . $dataRiwayat['kunci_soal'] . ". </b>", $dataRiwayat['isi_soal']);
                                ?>
                                <p class="lead"><?php echo $dataRiwayat['state'] + 1 . ". " . ltrim($dataRiwayat['isi_soal']); ?> </p>
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
<script>
    $('.MsoListParagraphCxSpFirst').removeClass('MsoListParagraphCxSpFirst');
</script>
<?php require '../layouts/close.php'; ?>