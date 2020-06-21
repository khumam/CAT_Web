<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/listDaftarPeserta.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Daftar peserta</h4>
                        <hr>
                        <div class="btn-group float-right mb-3">
                            <button id="btn-tambah-data" class="btn btn-xs btn-info">Tambah data</button>
                            <button id="btn-tambah" class="btn btn-xs btn-success">Upload data peserta</button>
                        </div>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Nama</th>
                                        <th>Nomor</th>
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

<!-- Modal -->
<div class="modal" id="tambahPeserta" tabindex="-1" role="dialog" aria-labelledby="tambahPesertaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPesertaLabel">Tambah peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../function/insertPeserta.php" method="POST" enctype="multipart/form-data" id="formTambahPeserta">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="file">.xls file</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" aria-describedby="file" name="file">
                            <label class="custom-file-label" for="file">Pilih file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" form="formTambahPeserta" name="tombol-tambah">Tambah peserta</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="pesertaModal" tabindex="-1" role="dialog" aria-labelledby="pesertaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pesertaModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="pesertaForm">
                    <input type="text" value="" name="kd_user" id="kd_user" hidden>
                    <div class="form-group">
                        <label for="nama_user">Nama peserta</label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" required placeholder="Nama peserta">
                    </div>
                    <div class="form-group">
                        <label for="nomor_user">Nomor peserta</label>
                        <input type="text" name="nomor_user" id="nomor_user" class="form-control" required placeholder="Nomor peserta">
                    </div>
                    <div class="form-group" id="passwordfield">
                        <label for="password_user">Password</label>
                        <input type="password" name="password_user" id="password_user" class="form-control" placeholder="Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="btn-submit" name="tombol-simpan" form="pesertaForm">Save changes</button>
            </div>
        </div>
    </div>
</div>
</section>

<?php require '../layouts/footer.php'; ?>

<script>
    $('#btn-tambah').on('click', function() {
        $('#tambahPeserta').modal('show');
    });

    $(document).ready(function() {
        let index = 1;
        var tabeldata = $('#dataTables').DataTable({
            ajax: {
                url: "../function/getPeserta.php",
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
                    data: 'nama_user'
                },
                {
                    data: 'nomor_user'
                },
                {
                    render: function(data, type, row) {
                        return "<div class='btn-group'><button data-id = '" + row.kd_user + "' class='btn btn-xs     btn-success btn-edit'>Edit</button><button data-id = '" + row.kd_user + "' class='btn btn-xs    btn-danger btn-hapus'>Hapus</button></div>";
                    }
                }
            ]

        });

        $(document).on('click', '.btn-hapus', function() {
            var result = confirm('Apakah kamu yakin menghapus data ini?');
            let id = $(this).data('id');
            if (result) {
                $.ajax({
                    url: "../function/hapusPeserta.php",
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        tabeldata.ajax.reload(null, false);
                    }
                })
            }
        });

        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "../function/getPeserta.php",
                type: "POST",
                dataType: 'JSON',
                data: {
                    byid: id
                },
                success: function(data) {
                    $('#pesertaForm').attr('action', '../function/editPeserta.php');
                    $('.modal-title').html('Edit data peserta');
                    $('#btn-submit').html('Edit data');
                    $('#nama_user').val(data.nama_user);
                    $('#nomor_user').val(data.nomor_user);
                    $('#kd_user').val(data.kd_user);
                    $('#passwordfield').css('display', 'none');
                    $('#pesertaModal').modal('show');
                }
            })
        });

        $('#btn-tambah-data').on('click', function() {
            $('#pesertaForm').attr('action', '../function/tambahPeserta.php');
            $('#pesertaForm')[0].reset();
            $('#pesertaModal').modal('show');
            $('#passwordfield').css('display', 'block');
            $('.modal-title').html('Tambah data peserta');
            $('#btn-submit').html('Tambah data');

        })
    });
</script>
<?php require '../layouts/close.php'; ?>