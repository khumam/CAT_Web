<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/getTipeSoal.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Topik Soal</h4>
                        <hr><a href="#" class="btn btn-xs btn-success float-right mb-3" id="btn-tambah">Tambah topik soal</a>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tabeltes">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Nama</th>
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
                <form method="post" id="judulTes">
                    <input type="text" value="" name="id" id="kd_tes" hidden>
                    <div class="form-group">
                        <label for="judul">Nama</label>
                        <input type="text" name="nama" id="judul" class="form-control" placeholder="Nama topik" required>
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
                url: "../function/getTipeSoal.php",
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
                    data: 'nama'
                },
                {
                    render: function(data, type, row) {
                        return "<div class='btn-group'><button data-id='" + row.id + "' data-nama='" + row.nama + "'  class='btn  btn-xs btn-success btn-edit' id='btn-edit'>Edit</button><button data-id = '" + row.id + "' class='btn  btn-xs btn-danger btn-hapus'>Hapus</button></div>";
                    }
                }
            ]
        })
    })


    $("#btn-tambah").on('click', function() {
        $('#judulTes').attr('action', '../function/addTipeSoal.php');
        $('.modal-title').html('Tambah data');
        $('#btn-submit').html('Tambah data');
        $('#judulTes')[0].reset();
        $('#dataModal').modal('show');
    });

    $(document).on('click', '#btn-edit', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $('#judulTes').attr('action', '../function/editTipeSoal.php');
        $('.modal-title').html('Edit data');
        $('#btn-submit').html('Edit data');
        $('#kd_tes').val(id);
        $('#judul').val(nama);
        $('#dataModal').modal('show');
    });

    $(document).on('click', '.btn-hapus', function() {
        var result = confirm('Apakah kamu yakin menghapus data ini?');
        let idTipeSoal = $(this).data('id');
        if (result) {
            $.ajax({
                url: "../function/hapusTipeSoal.php",
                type: "POST",
                dataType: 'JSON',
                data: {
                    id: idTipeSoal
                },
                success: function(data) {
                    window.location.reload();
                }
            })
        }
    });
</script>
<?php require '../layouts/close.php'; ?>