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
                        <h4 class="header-title">Tambah soal</h4>
                        <hr>
                        <div class="btn-group float-right">
                            <a href="soal.php" class="btn btn-xs btn-danger">Kembali</a>
                            <a href="#" class="btn btn-xs btn-success" id="tambah_form">Tambah field</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../function/addSoal.php" method="post" id="form_soal">
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
                                <textarea name="soal[]" id="soal" class="form-control textareaSoal" placeholder="Soal" required></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="kunci">Kunci jawaban</label>
                                    <input type="text" name="kunci[]" id="kunci" class="form-control" placeholder="Kunci jawaban" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kesulitan">Tingkat kesulitan</label>
                                    <input type="text" name="kesulitan[]" id="kesulitan" class="form-control" placeholder="Tingkat kesulitan" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tipe">Topik soal</label>
                                    <select name="tipesoal[]" id="tipe" class="custom-select" required>
                                        <?php while ($tipeSoal = mysqli_fetch_assoc($queryTipeSoal)) { ?>
                                            <option value="<?php echo $tipeSoal['nama']; ?>"><?php echo $tipeSoal['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-success btn-block" form="form_soal" name="tombol-tambah">Tambah soal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('.textareaSoal').summernote();

        var max = 10;
        var wrapper = '#form_soal';
        var x = 1;
        var tipesoal = '';
        <?php while ($tipeSoalAdd = mysqli_fetch_assoc($queryTipeSoalAdd)) { ?>
            tipesoal += "<option value='" + "<?php echo $tipeSoalAdd['nama']; ?>" + "'>" + "<?php echo $tipeSoalAdd['nama']; ?>" + "</option>";
        <?php } ?>

        $('#tambah_form').click(function(e) {
            e.preventDefault();
            if (x < max) {
                x++;
                $(wrapper).append('<div class="form-tambahan"><hr>' +
                    '<div class="form-group">' +
                    '<label for = "soal">Soal <a class="badge badge-danger btn-delete text-white">Hapus</a></label>' +
                    '<textarea name = "soal[]" id = "soal" class = "form-control textareaSoal" placeholder = "Soal" required> </textarea></div>' +
                    '<div class = "row">' +
                    '<div class = "form-group col-md-4">' +
                    '<label for = "kunci"> Kunci jawaban</label>' +
                    '<input type = "text" name = "kunci[]" id = "kunci" class = "form-control" placeholder = "Kunci jawaban" required></div>' +
                    '<div class = "form-group col-md-4">' +
                    '<label for = kesulitan"> Tingkat kesulitan </label> <input type = "text"name = "kesulitan[]" id = kesulitan" class = "form-control" placeholder = "Tingkat kesulitan" required></div>' +
                    '<div class="form-group col-md-4">' +
                    '<label for="tipe">Topik soal</label>' +
                    '<select name="tipesoal[]" id="tipe" class="custom-select" required>' +
                    tipesoal +
                    '</select>' +
                    '</div>'
                );
            }
            $('.textareaSoal').summernote();

        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            $(this).parents('.form-tambahan').remove();
            x--;
        })

    });
</script>
<?php require '../layouts/close.php'; ?>