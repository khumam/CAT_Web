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
                        <h4>Hasil test</h4>
                        <hr>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Nama</th>
                                        <th>Nomor</th>
                                        <th style="width:50px">Aksi</th>
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

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 id="namaSiswa"></h4>
                    </div>
                    <div class="col-md-12">
                        <p id="nomorSiswa"></p>
                    </div>
                </div>
                <h6 class="mt-3">Riwayat tes</h6>
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
    $(document).ready(function () {
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
                    render: function (data, type, row) {
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
                    render: function (data, type, row) {
                        return "<div class='btn-group'><button data-nomor='" + row.nomor_user +
                            "' data-nama='" + row.nama_user + "' data-id = '" + row.kd_user +
                            "' class='btn btn-xs btn-success btn-detail'>Detail</button></div>";
                    }
                }
            ]

        });

        $(document).on('click', '.btn-detail', function () {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var nomor = $(this).data('nomor');
            var content = '';
            var month = new Array();
            month[0] = "Januari";
            month[1] = "Februari";
            month[2] = "Maret";
            month[3] = "April";
            month[4] = "Mei";
            month[5] = "Juni";
            month[6] = "Juli";
            month[7] = "Agustus";
            month[8] = "September";
            month[9] = "Oktober";
            month[10] = "November";
            month[11] = "Desember";
            $.ajax({
                url: "../function/getHasil.php",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                },
                success: function (data) {
                    if (data.length == 0) {
                        $('#contentHasil').html('Belum ada data');
                        $('#namaSiswa').html(nama);
                        $('#nomorSiswa').html(nomor);
                        $('#detailModal').modal('show');
                    } else {
                        $.each(data, function (index, value) {
                            var dates = new Date(value.waktu_tes);
                            var tgl = dates.getDate();
                            var bln = month[dates.getMonth()];
                            var thn = dates.getFullYear();
                            var jam = dates.getHours() + ':' + dates.getMinutes() +
                                ' WIB'
                            content += "<li class='list-group-item'>" +
                                "<div class='row'><div class='col-10'><b>" + value
                                .judul + "</b><br>Pada: " + tgl + '/' + bln + '/' +
                                thn + ', ' + jam +
                                "</div><div class='col-2'><a href='nilai.php?idsiswa=" +
                                value.kd_peserta + "&idkodesoal=" + value
                                .kd_judul_tes + "&sessionid=" + value.session_id +
                                "' class='btn btn-xs btn-info float-right'>Lihat hasil</a></div></div></li>";
                        });
                        $('#contentHasil').html(content);
                        $('#namaSiswa').html(nama);
                        $('#nomorSiswa').html(nomor);
                        $('#detailModal').modal('show');
                    }
                }
            });
        });
    });
</script>
<?php require '../layouts/close.php'; ?>