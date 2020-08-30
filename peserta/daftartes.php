<?php
require '../function/check_peserta.php';
require '../layouts/header.php';
require '../layouts/sidebar.php';
require '../function/checkDaftarTes.php' ?>


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6 py-3">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Nama : <?php echo $_SESSION['nama']; ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Simak video tutorial terlebih dahulu</h4>
                        <hr>
                        <div class="text-center">
                            <iframe width="752" height="380" src="https://www.youtube.com/embed/ZFhxTaLyBWs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe id='videoplayer'>
                        </div>
                        <!-- <p class="lead">Pastikan saudara juga sudah melihat tutorial CAT <a href="http://localhost/newcat/peserta/tutorial.php">Di sini</a> </p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Daftar tes tersedia</h4>
                        <p class="mt-0">Sebelum menegerjakan tes utama, pastikan saudara mengerjakan demo tes terlebih dahulu.</p>
                        <hr>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tabeltes">
                                    <thead class="text-center bg-light">
                                        <th style="width:12px">No</th>
                                        <th>Nama tes</th>
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
<div class="modal" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Kamu akan mengerjakan tes?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin akan mengerjakan soal ini? Baca doa sebelum mengerjakan. Semoga berhasil.</p>
                <p>Waktu per soal <b><span id="waktusoal"></span> menit</b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn-confirm">Kerjakan</button>
            </div>
        </div>
    </div>
</div>
</section>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        let index = 1;
        var tabel = $('#tabeltes').DataTable({
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
                    // data: 'judul',
                    render: function(data, type, row) {
                        if (row.kd_judul_tes == '5') {
                            return row.judul + '<br>(Pilihan jawaban yang bertanda bintang merupakan kunci jawaban yang benar)';
                        } else {
                            return row.judul;
                        }
                    }
                },
                {
                    render: function(data, type, row) {
                        if (row.kd_judul_tes == '4') {
                            return "<div class='btn-group text-center'><button <?php echo ($checkDaftarTes == null) ? 'disabled' : '' ?>  data-id='" + row.kd_judul_tes + "' data-waktu='" + row.waktu + "' class='btn btn-xs btn-success btn-kerjakan'>Kerjakan Tes</button></div>";
                        } else {
                            return "<div class='btn-group text-center'><button id='btn-demo' data-id='" + row.kd_judul_tes + "' data-waktu='" + row.waktu + "' class='btn btn-xs btn-success btn-kerjakan'>Kerjakan Demo</button></div>";
                        }
                    }
                }
            ]
        });

        $(document).on('click', '.btn-kerjakan', function() {
            var id = $(this).data('id');
            $('#waktusoal').html($(this).data('waktu'));
            $('#btn-confirm').attr('data-id', id);
            $('#alertModal').modal('show');
        });

        $('#btn-confirm').on('click', function() {
            var idtes = $(this).data('id');
            $.ajax({
                url: "../function/rollTes.php",
                type: 'POST',
                data: {
                    date: new Date(),
                    kd_judul_tes: idtes
                },
                success: function(response) {
                    window.location.replace('../peserta/tes.php?tes=' + idtes);
                }
            })

        })
    });
</script>

<?php require '../layouts/close.php'; ?>