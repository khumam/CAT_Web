<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/listDaftarTes.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Daftar test</h4>
                        <hr><a href="#" class="btn btn-xs btn-success float-right mb-3" id="btn-tambah">Tambah test</a>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tabeltes">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Nama</th>
                                        <th>Durasi per soal</th>
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


<div class="modal" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Tambah data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../function/addJudulTes.php" method="post" id="judulTes">
                    <input type="text" value="" name="kd_tes" id="kd_tes" hidden>
                    <div class="form-group">
                        <label for="judul">Nama Test</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Nama test" required>
                    </div>
                    <div class="form-group">
                        <label for="waktutes">Waktu per soal (menit)</label>
                        <input type="number" name="waktutes" id="waktutes" class="form-control" placeholder="Durasi tes" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tombol-tambah" class="btn btn-success" id="btn-submit" form="judulTes">Tambah data</button>
            </div>
        </div>
    </div>
</div>


<?php require '../layouts/footer.php'; ?>
<script>
    $(document).ready(function() {
        let index = 1;
        var table = $('#tabeltes').DataTable({
            ajax: {
                url: "../function/getDaftarTes.php",
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
                    data: 'judul'
                },
                {
                    render: function(data, type, row) {
                        return row.waktu + ' Menit';
                    },
                    width: '100px'
                },
                {
                    render: function(data, type, row) {
                        return "<div class='btn-group'><button data-id='" + row.kd_judul_tes + "' data-nama='" + row.judul + "' data-waktu='" + row.waktu + "' class='btn  btn-xs btn-success btn-edit' id='btn-edit'>Edit</button><button data-id = '" + row.kd_judul_tes + "' class='btn  btn-xs btn-danger btn-hapus'>Hapus</button></div>";
                    }
                }
            ]
        })
    })


    $("#btn-tambah").on('click', function() {
        $('#judulTes').attr('action', '../function/addJudulTes.php');
        $('.modal-title').html('Tambah data');
        $('#btn-submit').html('Tambah data');
        $('#judulTes')[0].reset();
        $('#dataModal').modal('show');
    });

    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var waktu = $(this).data('waktu');
        $('#judulTes').attr('action', '../function/editJudulTes.php');
        $('.modal-title').html('Edit data');
        $('#btn-submit').html('Edit data');
        $('#kd_tes').val(id);
        $('#judul').val(nama);
        $('#waktutes').val(waktu);
        $('#dataModal').modal('show');
    });

    $(document).on('click', '.btn-hapus', function() {
        var result = confirm('Apakah kamu yakin menghapus data ini?');
        let kd_judul_tes = $(this).data('id');
        if (result) {
            $.ajax({
                url: "../function/hapusTes.php",
                type: "POST",
                dataType: 'JSON',
                data: {
                    id: kd_judul_tes
                },
                success: function(data) {
                    window.location.reload();
                }
            })
        }
    });
</script>
<?php require '../layouts/close.php'; ?>