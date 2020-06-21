<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/getDaftarTes.php';
require '../function/getTipeSoal.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">
                            Edit soal
                        </h4>
                        <hr>
                        <form action="../function/editSoal.php" method="post" id="form_soal">
                            <input type="text" id="kd_soal" name="kd_soal" hidden>
                            <div class="form-group">
                                <label for="jenisTes">Kategori tes</label>
                                <select name="jenisTes" id="jenisTes" class="custom-select" required>
                                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                                        <option value="<?php echo $data['kd_judul_tes']; ?>"><?php echo $data['judul']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="soal">Soal</label>
                                <textarea name="soal" id="soal" class="form-control textareaSoal" placeholder="Soal" required></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="kunci">Kunci jawaban</label>
                                    <input type="text" name="kunci" id="kunci" class="form-control" placeholder="Kunci jawaban" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kesulitan">Tingkat kesulitan</label>
                                    <input type="text" name="kesulitan" id="kesulitan" class="form-control" placeholder="Tingkat kesulitan" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tipe">Topik soal</label>
                                    <select name="tipesoal" id="tipesoal" class="custom-select" required>
                                        <?php while ($tipeSoal = mysqli_fetch_assoc($queryTipeSoal)) { ?>
                                            <option value="<?php echo $tipeSoal['nama']; ?>"><?php echo $tipeSoal['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-success btn-block" form="form_soal" name="tombol-edit">Edit soal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '../function/getSoal.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kd_soal: <?php echo $_GET['id']; ?>,
            },
            success: function(data) {
                $('.textareaSoal').summernote('code', data.data.isi_soal);
                $('#kd_soal').val(data.data.kd_soal);
                $('#jenisTes').val(data.data.kategori);
                $('#kunci').val(data.data.kunci_soal);
                $('#kesulitan').val(data.data.tingkat_kesulitan);
                $('#tipesoal').val(data.data.tipe);
                $('#kd_soal').val(data.data.kd_soal);
            }
        });
    });
</script>
<?php require '../layouts/close.php'; ?>