<?php
require '../function/check_guru.php';
require '../layouts/header.php';
// require '../function/getAngketIndividu.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Hasil Angket Individu</h4>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-stripped" id="tableangket">
                                        <thead>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th style="width: 100px">Aksi</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailmodal" tabindex="-1" aria-labelledby="detailmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailmodalLabel">Detail Angket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 id="namauser"></h4>
                    </div>
                    <div class="col-md-12">
                        <p id="nomoruser"></p>
                    </div>
                </div>
                <h6 class="mt-3">Riwayat Isi Angket</h6>
                <hr>
                <div class="row mt-3" style="max-height: 300px; overflow:auto">
                    <div class="col-md-12" id="contentHasil"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        let index = 1;
        var table = $('#tableangket').DataTable({
            ajax: {
                url: "../function/getAngketIndividu.php",
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
                    class: 'text-center',
                    render: function(data, type, row) {
                        return "<div class='btn-group text-center'><button class='btn btn-info btn-xs btn-detail' data-id = '" + row.user_id + "' data-nama='" + row.nama_user + "' data-nomor='" + row.nomor_user + "'>Detail</button></div>";
                    }
                }
            ]
        })
    });

    $(document).on('click', '.btn-detail', function() {
        $('#nomoruser').html($(this).data('nomor'));
        $('#namauser').html($(this).data('nama'));
        $('#detailmodal').modal('show');
        var userid = $(this).data('id');
        var content = '';
        $.ajax({
            url: "../function/getAngketByUser.php",
            method: 'POST',
            data: {
                id: userid
            },
            success: function(res) {
                if (res.length == 0) {
                    $('#contentHasil').html('Belum ada data');
                } else {
                    res = JSON.parse(res);
                    $.each(res, function(index, value) {
                        content += "<li class='list-group-item'>" +
                            "<div class='row'><div class='col-10'><b>Riwayat " + (index + 1) +
                            "</b></div>" +
                            "<div class='col-2'><a href='showAngketIndividu.php?idsiswa=" +
                            value.user_id + "&sessionid=" + value.session_id +
                            "' class='btn btn-xs btn-info float-right'>Lihat hasil</a></div></div></li>"
                    });
                    $('#contentHasil').html(content);
                }
            }
        })
    })
</script>

<?php require '../layouts/close.php'; ?>