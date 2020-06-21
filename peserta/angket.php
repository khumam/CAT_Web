<?php
include '../layouts/header.php';
require '../function/getListAngketPeserta.php';
?>

<?php if (isset($_GET['idsiswa']) && isset($_GET['idkodesoal']) && isset($_GET['sessionid'])) { ?>

    <div class="main-content-inner mt-5">
        <div class="sales-report-area mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Terima kasih, sebelum melihat hasil tes, silahkan isi angket di bawah ini</h4>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form action="../function/submitAngket.php" method="POST">
                        <input type="hidden" name="idsiswa" value="<?php echo $_GET['idsiswa']; ?>">
                        <input type="hidden" name="kd_judul_tes" value="<?php echo $_GET['idkodesoal']; ?>">
                        <input type="hidden" name="session_id" value="<?php echo $_GET['sessionid']; ?>">
                        <?php foreach ($dataSub as $suba) { ?>
                            <p class="lead"><b><?php echo $suba['nama_sub'] ?></b></p><br>
                            <?php $index = 1;
                            foreach ($dataAngket as $ang) { ?>
                                <?php if ($suba['id'] == $ang['sub_id']) { ?>
                                    <p class="lead"><?php echo $index . '. ' . $ang['angket']; ?></p><br>
                                    <input type="hidden" name="angket_id[]" value="<?php echo $ang['id'] ?>">
                                    <input type="radio" id="jawaban-<?php echo $ang['id'] ?>-1" name="jawaban-<?php echo $ang['id'] ?>" value="1" required>
                                    <label for="jawaban-<?php echo $ang['id'] ?>-1">Kurang Baik</label><br>
                                    <input type="radio" id="jawaban-<?php echo $ang['id'] ?>-2" name="jawaban-<?php echo $ang['id'] ?>" value="2" required>
                                    <label for="jawaban-<?php echo $ang['id'] ?>-2">Cukup Baik</label><br>
                                    <input type="radio" id="jawaban-<?php echo $ang['id'] ?>-3" name="jawaban-<?php echo $ang['id'] ?>" value="3" required>
                                    <label for="jawaban-<?php echo $ang['id'] ?>-3">Baik</label><br>
                                    <input type="radio" id="jawaban-<?php echo $ang['id'] ?>-4" name="jawaban-<?php echo $ang['id'] ?>" value="4" required>
                                    <label for="jawaban-<?php echo $ang['id'] ?>-4">Sangat Baik</label><br>
                                    <br>
                                <?php $index++;
                                } ?>
                            <?php } ?>
                        <?php } ?>
                        <div class="form-group mt-5">
                            <p class="lead"><b><label for="komentar">Komentar dan saran</label></b></p>
                            <textarea name="komentar" id="komentar" class="form-control" placeholder="Masukan komentar dan saran" required></textarea>
                        </div>
                        <div class="form-group">
                            <?php if (count($dataAngket) != 0) { ?>
                                <button type="submit" class="btn btn-success btn-block">Kirimkan</button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <?php require '../layouts/footer.php'; ?>
    <?php require '../layouts/close.php'; ?>
<?php } else {
    header('location: ../index.php');
} ?>