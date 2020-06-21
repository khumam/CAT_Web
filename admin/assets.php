<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/listDaftarSoal.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Daftar asset</h4>
                        <hr>
                        <a href="#" class="btn btn-xs btn-success float-right mb-3" data-toggle="modal" data-target="#tambahassets">Tambah asset</a>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tableassets">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Nama file</th>
                                        <th>Format</th>
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
    <div class="modal" id="tambahassets" tabindex="-1" role="dialog" aria-labelledby="tambahassetsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahassetsLabel">Upload Assets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../function/upload_asset.php" method="post" id="upload" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama file</label>
                            <input type="text" name="nama" id="nama" class="form-control" required placeholder="Nama file...">
                        </div>
                        <div class="form-group">
                            <label for="file">Upload file</label>
                            <input type="file" name="file" id="file" class="form-control" placeholder="Upload file..." required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" form="upload" name="tombol-tambah">Upload</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        let index = 1;
        var table = $('#tableassets').DataTable({
            ajax: {
                url: "../function/getAssets.php",
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
                    data: 'format'
                },
                {
                    render: function(data, type, row) {
                        return "<div class='btn-group'><button class='btn btn-info btn-xs btn-detail' data-id = '" + row.id + "'>Lihat</button><button data-id = '" + row.id + "' class='btn btn-xs btn-danger btn-hapus'>Hapus</button></div>";
                    }
                }
            ]
        })
    })


    $(document).on('click', '.btn-hapus', function() {
        var result = confirm('Apakah kamu yakin menghapus data ini?');
        var id_assets = $(this).data('id');
        if (result) {
            $.ajax({
                url: "../function/hapusAssets.php",
                type: "POST",
                dataType: 'JSON',
                data: {
                    id: id_assets
                },
                success: function(data) {
                    window.location.reload();
                }
            })
        }
    });

    $(document).on('click', '.btn-detail', function() {
        $.ajax({
            url: '../function/getAssets.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: $(this).data('id'),
            },
            success: function(data) {
                $('#assetsDetail').html("<img class='img-fluid' src='../media/assets/" + data.link + "'>");
                $('#urlImage').val("../media/assets/" + data.link);
                $('#detailSoal').modal('show');
            }
        });

    });
</script>


<?php require '../layouts/close.php'; ?>