<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/listSubAngket.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Daftar angket</h4>
                        <hr>
                        <div class="btn-group float-right">
                            <a href="#" class="btn btn-xs btn-primary float-right mb-3">Hasil angket</a>
                            <a href="#" class="btn btn-xs btn-success float-right mb-3" data-toggle="modal" data-target="#tambahangket">Tambah angket</a>
                            <a href="#" class="btn btn-xs btn-warning float-right mb-3" data-toggle="modal" data-target="#tambahsubangket">Tambah sub angket</a>
                        </div>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tableangket">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Isi angket</th>
                                        <th>Sub angket</th>
                                        <th>Tipe</th>
                                        <th style="width:150px">Aksi</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section>

    <!-- Modal -->
    <div class="modal" id="detailSoal" tabindex="-1" role="dialog" aria-labelledby="detailSoalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailSoalLabel">Detail Asset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p id="assetsDetail"></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <input type="text" id="urlImage" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="tambahangket" tabindex="-1" role="dialog" aria-labelledby="tambahangketLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahangketLabel">Tambah angket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../function/addAngket.php" method="post" id="addAngket">
                        <input type="hidden" name="jenis" value="angket">
                        <div class="form-group">
                            <label for="angket">Isi angket</label>
                            <textarea name="angket" id="angket" placeholder="Isi angket" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sub_id">Bagian dari sub</label>
                            <select name="sub_id" id="sub_id" class="custom-select">
                                <?php while ($row = mysqli_fetch_assoc($querySubAngket)) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_sub']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipe">Tipe</label>
                            <select name="tipe" id="tipe" class="custom-select">
                                <option value="4 Pilihan">4 Pilihan</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" form="addAngket" name="tombol-tambah">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="editangketmodal" tabindex="-1" role="dialog" aria-labelledby="editangketmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editangketmodalLabel">Edit angket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../function/editAngket.php" method="post" id="editangketform">
                        <input type="hidden" name="jenis" value="angket">
                        <input type="hidden" name="id" id="editid" value="">
                        <div class="form-group">
                            <label for="angket">Isi angket</label>
                            <textarea name="angket" id="editangket" placeholder="Isi angket" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sub_id">Bagian dari sub</label>
                            <select name="sub_id" id="editsub_id" class="custom-select">
                                <?php while ($row = mysqli_fetch_assoc($querySubAngket2)) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_sub']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipe">Tipe</label>
                            <select name="tipe" id="edittipe" class="custom-select">
                                <option value="4 Pilihan">4 Pilihan</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" form="editangketform" name="tombol-tambah">Sunting</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="tambahsubangket" tabindex="-1" role="dialog" aria-labelledby="tambahsubangketLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahsubangketLabel">Tambah sub angket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../function/addAngket.php" method="post" id="addSubAngket">
                        <input type="hidden" name="jenis" value="subangket">
                        <div class="form-group">
                            <label for="nama_sub">Nama sub angket</label>
                            <input type="text" name="nama_sub" id="nama_sub" class="form-control" placeholder="Nama sub angket">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" form="addSubAngket" name="tombol-tambah">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        let index = 1;
        var table = $('#tableangket').DataTable({
            ajax: {
                url: "../function/getAngket.php",
                dataSrc: "",
                type: 'POST',
                data: {
                    all: true
                }
            },
            columns: [{
                    render: function(data, type, row) {
                        return index++;
                    }
                },
                {
                    data: 'angket'
                },
                {
                    data: 'nama_sub'
                },
                {
                    data: 'tipe'
                },
                {
                    class: 'text-center',
                    render: function(data, type, row) {
                        return "<div class='btn-group text-center'><button class='btn btn-warning btn-xs btn-edit' data-id = '" + row.id + "' data-angket='" + row.angket + "' data-namasub='" + row.sub_id + "' data-tipe='" + row.tipe + "'>Edit</button><button data-id = '" + row.id + "' class='btn btn-xs btn-danger btn-hapus'>Hapus</button></div>";
                    }
                }
            ]
        })
    })


    $(document).on('click', '.btn-hapus', function() {
        var result = confirm('Apakah kamu yakin menghapus data ini?');
        var id = $(this).data('id');
        if (result) {
            $.ajax({
                url: "../function/hapusAngket.php",
                type: "POST",
                dataType: 'JSON',
                data: {
                    id: id,
                    jenis: 'angket'
                },
                success: function(data) {
                    window.location.reload();
                }
            })
        }
    });

    $(document).on('click', '.btn-edit', function() {

        var angket = $(this).data('angket');
        var namasub = $(this).data('namasub');
        var tipe = $(this).data('tipe');
        var id = $(this).data('id');

        $('#editangket').val(angket);
        $('#editsub_id').val(namasub);
        $('#edittipe').val(tipe);
        $('#editid').val(id);

        $('#editangketmodal').modal('show');

    });
</script>


<?php require '../layouts/close.php'; ?>