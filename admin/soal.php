<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/listDaftarSoal.php';
require '../layouts/sidebar.php';
require '../function/getSebaranSoal.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Sebaran soal</h4>
                        <hr>
                        <label for="kategori">Pilih daftar tes</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="all" <?php if (!isset($_GET['kategori']) || $_GET['kategori'] == 'all') echo "selected='selected'"; ?>>Tampil semua</option>
                            <?php while ($rowDataTes = mysqli_fetch_assoc($dataTest)) { ?>
                                <option value="<?php echo $rowDataTes['kd_judul_tes']; ?>" <?php if (isset($_GET['kategori']) && $_GET['kategori'] == $rowDataTes['kd_judul_tes']) echo "selected='selected'"; ?>><?php echo $rowDataTes['judul']; ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <div style="height: 200px;">
                            <canvas id="sebaranSoalChart" style="height: 200px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Daftar soal</h4>
                        <hr>
                        <a href="tambahsoal.php" class="btn btn-xs btn-success float-right mb-3">Tambah soal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tablesoal">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Soal</th>
                                        <th>Kunci</th>
                                        <th>Kesulitan</th>
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
<div class="modal" id="detailSoal" tabindex="-1" role="dialog" aria-labelledby="detailSoalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailSoalLabel">Detail Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <p id="soalDetail"></p>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                Kunci : <p id="kunci"></p>
                            </div>
                            <div class="col-md-12">
                                Kesulitan : <p id="kesulitan"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</section>

<?php require '../layouts/footer.php'; ?>
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/chartjs-plugin-annotation.min.js"></script>
<script>
    $(document).ready(function() {
        let index = 1;
        var table = $('#tablesoal').DataTable({
            ajax: {
                url: "../function/getSoal.php",
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
                    data: 'isi_soal'
                },
                {
                    data: 'kunci_soal'
                },
                {
                    data: 'tingkat_kesulitan'
                },
                {
                    render: function(data, type, row) {
                        return "<div class='btn-group'><button class='btn btn-xs btn-info  btn-detail' data-id = '" + row.kd_soal + "'>Detail</button><a href='../admin/editsoal.php?id=" + row.kd_soal + "' class='btn  btn-success btn-xs btn-edit'>Edit</a><button data-id = '" + row.kd_soal + "' class='btn btn-xs   btn-danger btn-hapus'>Hapus</button></div>";
                    }
                }
            ]
        })
    })


    $(document).on('click', '.btn-hapus', function() {
        var result = confirm('Apakah kamu yakin menghapus data ini?');
        let kd_soal = $(this).data('id');
        if (result) {
            $.ajax({
                url: "../function/hapusSoal.php",
                type: "POST",
                dataType: 'JSON',
                data: {
                    id: kd_soal
                },
                success: function(data) {
                    window.location.reload();
                }
            })
        }
    });

    $(document).on('click', '.btn-detail', function() {
        $.ajax({
            url: '../function/getSoal.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kd_soal: $(this).data('id'),
            },
            success: function(data) {
                $('#soalDetail').html(data.data.isi_soal);
                $('#kunci').html(data.data.kunci_soal);
                $('#kesulitan').html(data.data.tingkat_kesulitan);
                $('#detailSoal').modal('show');
            }
        });

    });
</script>
<script>
    var dataScater = {
        labels: [-3,-2,-1,0,1,2,3],
        datasets: [
            <?php foreach ($dataTipeSebaranSoal as $dataTipe) {
                echo "{\n";
                echo "label: '" . $dataTipe . "',\n";
                echo "data: [" . $sebaranSoalImploded[$dataTipe] . "],\n";
                echo "backgroundColor: '". $warna[$dataTipe] ."',\n";
                echo "pointRadius: 5, pointHoverRadius:10 \n";
                echo "},\n";
            } ?>
        ]
    }
    var chart = $('#sebaranSoalChart');
    var result = new Chart(chart, {
        type: 'scatter',
        data: dataScater,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes:
                [
                    {
                        display: true,
                        type: 'linear',
                        position: 'bottom',
                        scaleLabel: {
                            display: true,
                            labelString: 'Tingkat kesulitan'
                        },
                        ticks:
                        {
                            suggestedMin: -3,
                            suggestedMax: 3
                        }
                    }
                ],
                yAxes: 
                [
                    {
                        display: false,
                        ticks:
                        {
                            beginAtZero: true,
                            suggestedMin: -0.1,
                            suggestedMax: 0.1,
                            stepSize: 0.1,
                        }
                    }
                ]
            },
            tooltips: {
                    callbacks: {
                        label: function(data) {
                            var keterangan = ['Tingkat kesulitan: ' + data.label];
                            return keterangan;
                        }
                    }
            }
        }
    });
</script>
<script>
    $('#kategori').on('change', function() {
        var data = $('#kategori').val();
        window.location.href = '?kategori=' + data;
    })
</script>



<?php require '../layouts/close.php'; ?>