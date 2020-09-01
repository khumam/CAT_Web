<?php
include '../layouts/header.php';
require '../function/getListAngketPeserta.php';
?>

<?php if (isset($_GET['idsiswa']) && isset($_GET['idkodesoal']) && isset($_GET['sessionid'])) {
?>

    <?php if ($_GET['idkodesoal'] == 5) {
        header('Location: ../peserta/done.php?idsiswa=' . $_GET['idsiswa'] . '&idkodesoal=' . $_GET['idkodesoal'] . '&sessionid=' . $_GET['sessionid']);
    } ?>

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
                    <p class="lead mb-5">Pilihlah pernyataan pada option dibawah ini yang Anda anggap sesuai dengan aspek penilaian yang ada.</p>
                    <form action="../function/submitAngket.php" method="POST">
                        <input type="hidden" name="idsiswa" value="<?php echo $_GET['idsiswa']; ?>">
                        <input type="hidden" name="kd_judul_tes" value="<?php echo $_GET['idkodesoal']; ?>">
                        <input type="hidden" name="session_id" value="<?php echo $_GET['sessionid']; ?>">

                        <?php $index = 1;
                        foreach ($dataAngket as $ang) { ?>
                            <p class="lead"><b><?php echo $index . '. ' . $ang['angket']; ?></p></b><br>
                            <table class="table table-borderless">
                                <tr>
                                    <td style="width: 10px;"><input type="hidden" name="angket_id[]" value="<?php echo $ang['id'] ?>">
                                        <input type="radio" id="jawaban-<?php echo $ang['id'] ?>-1" name="jawaban-<?php echo $ang['id'] ?>" value="1" required>
                                    </td>
                                    <td>
                                        <label for="jawaban-<?php echo $ang['id'] ?>-1">Kurang Baik</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 10px;"><input type="radio" id="jawaban-<?php echo $ang['id'] ?>-2" name="jawaban-<?php echo $ang['id'] ?>" value="2" required></td>
                                    <td><label for="jawaban-<?php echo $ang['id'] ?>-2">Cukup Baik</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 10px;"><input type="radio" id="jawaban-<?php echo $ang['id'] ?>-3" name="jawaban-<?php echo $ang['id'] ?>" value="3" required></td>
                                    <td><label for="jawaban-<?php echo $ang['id'] ?>-3">Baik</label></td>
                                </tr>
                                <tr>
                                    <td style="width: 10px;"><input type="radio" id="jawaban-<?php echo $ang['id'] ?>-4" name="jawaban-<?php echo $ang['id'] ?>" value="4" required></td>
                                    <td><label for="jawaban-<?php echo $ang['id'] ?>-4">Sangat Baik</label></td>
                                </tr>
                            </table>
                            <br>
                            <?php $index++; ?>
                        <?php } ?>

                        <div class="form-group mt-5">
                            <p class="lead"><b><label for="komentar">Komentar dan saran</label></b></p>
                            <textarea name="komentar" id="komentar" class="form-control" placeholder="Masukan komentar dan saran"></textarea>
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
}
?>