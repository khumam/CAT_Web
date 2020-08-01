<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/getNilai.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4><?php echo $getSiswa['nama_user']; ?> (<?php echo $getSiswa['nomor_user']; ?>)</h4>
                        <h6><?php echo $getTes['judul']; ?></h6>
                        <hr>
                        <div class="btn-group">
                            <a href="hasiltes.php" class="btn btn-danger btn-xs">Kembali</a>
                            <a href="riwayatSoal.php?idsiswa=<?php echo $idsiswa; ?>&idkodesoal=<?php echo $idkodesoal; ?>&sessionid=<?php echo $sessionid; ?>" class="btn btn-primary btn-xs">Riwayat Tes</a>
                            <a href="cetakNilai.php?idsiswa=<?php echo $idsiswa; ?>&idkodesoal=<?php echo $idkodesoal; ?>&sessionid=<?php echo $sessionid; ?>" class="btn btn-success btn-xs">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Hasil tes</h4>
                        <hr>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Kode soal">Kode Soal</th>
                                        <th data-toggle="tooltip" data-placement="top" title="1 jika benar, 0 jika salah">Skor</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Indeks kesukaran butir">b</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Tingkat kemampuan awal">θ awal</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Tingkat kemampuan setelah jawab">θ jawab</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Probabilitas jawab benar butir ke i">Pi(θ)</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Probabilitas jawab salah butir ke i">Q(θ)</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Fungsi informasi">IIF</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Standard error">SE(θ)</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Selisih standar error">Selisih SE</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $stateSoal = [];
                                        $kesulitanSoal = [];
                                        $skorTiapSoal = [];
                                        while ($row = mysqli_fetch_assoc($getNilai)) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row['id_soal']; ?></td>
                                                <td><?php echo $row['skor']; ?></td>
                                                <td><?php echo $row['kesulitan']; ?></td>
                                                <td><?php echo $row['teta_awal']; ?></td>
                                                <td><?php echo $row['teta_jawab']; ?></td>
                                                <td><?php echo round($row['p_teta'], 3); ?></td>
                                                <td><?php echo round($row['q_teta'], 3); ?></td>
                                                <td><?php echo round($row['iif'], 3); ?></td>
                                                <td><?php echo round($row['se_teta'], 4); ?></td>
                                                <td><?php echo round($row['selisih_se'], 4); ?></td>
                                                <?php $stateSoal[] =  $row['state'] + 1; ?>
                                                <?php $kesulitanSoal[] =  $row['kesulitan']; ?>
                                                <?php $skorTiapSoal[] =  round(50 + ((50 / 3) * $row['teta_jawab']), 2); ?>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="3">θ Akhir</td>
                                            <td colspan="8"><?php echo round((float) $dataNilai['teta_jawab'], 3); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Skor</td>
                                            <td colspan="8"><?php echo round(50 + ((50 / 3) * $dataNilai['teta_jawab']), 2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Statistik soal</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Tipe soal</th>
                                    <th>Jumlah</th>
                                </thead>
                                <tbody>
                                    <?php while ($dataTipeSoal = mysqli_fetch_assoc($getTipeSoal)) { ?>
                                        <tr>
                                            <td><?php echo $dataTipeSoal['tipe']; ?></td>
                                            <td><?php echo $dataTipeSoal['totalTipe']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Kesulitan soal</h4>
                        <hr>
                        <div style="height: 30%;">
                            <canvas id="hasilTestChart"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="range" min='0' max='100' value="100" class="form-control" id='kesulitan-range'>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Grafik skor</h4>
                        <hr>
                        <div style="height: 30%;">
                            <canvas id="hasilTestChartSkor"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="range" min='0' max='100' value="100" class="form-control" id='skor-range'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$stateSoalFix = implode(',', $stateSoal);
$kesulitanFix = implode(',', $kesulitanSoal);
$nilaiAkhirPeserta = round(50 + ((50 / 3) * $dataNilai['teta_jawab']), 2);

if ($nilaiAkhirPeserta <= 0) {
    $skorFixArray = array_map(function ($val) {
        return 0;
    }, $skorTiapSoal);
    $skorFix = implode(',', $skorFixArray);
    $skorReady = $skorFixArray;
} else {
    $skorFix = implode(',', $skorTiapSoal);
    $skorReady = $skorTiapSoal;
}

?>

<?php require '../layouts/footer.php'; ?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> -->
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/chartjs-plugin-annotation.min.js"></script>


<script>
    function kesulitangraph(totalTampilData) {

        <?php if ($nilaiAkhirPeserta >= 73) {
            echo "var warnaBatas = 'green';";
            echo "var ketBatas = 'Tinggi';";
        } else if ($nilaiAkhirPeserta >= 50 && $nilaiAkhirPeserta <= 72) {
            echo "var warnaBatas = 'yellow';";
            echo "var ketBatas = 'Sedang';";
        } else if ($nilaiAkhirPeserta < 50) {
            echo "var warnaBatas = 'red';";
            echo "var ketBatas = 'Rendah';";
        } ?>

        var dataAWal = [<?php echo $kesulitanFix; ?>];
        var totalData = <?php echo count($kesulitanSoal); ?>;
        for (var index = 0; index < (totalData - totalTampilData); index++) {
            dataAWal.pop();
        }

        var chart = $('#hasilTestChart');
        var result = new Chart(chart, {
            type: 'line',
            data: {
                labels: [<?php echo $stateSoalFix; ?>],
                datasets: [{
                        label: 'Kesulitan ',
                        data: dataAWal,
                        borderColor: '#FF6384',
                        fill: false,
                        lineTension: 0
                    },
                    {
                        label: 'Tingkat Kemampuan Peserta (Baik)',
                        backgroundColor: 'green',
                    },

                    {
                        label: 'Tingkat Kemampuan Peserta (Sedang)',
                        backgroundColor: 'yellow',
                    },
                    {
                        label: 'Tingkat Kemampuan Peserta (Rendah)',
                        backgroundColor: 'red',
                    }
                ],
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Butir-butir soal yang dikerjakan'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Kesulitan soal",
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                if (index == 0) {
                                    return 'Sulit   ' + value;
                                } else if (index == 6) {
                                    return 'Mudah   ' + value;
                                } else {
                                    return value;
                                }
                            },
                            max: 3,
                            min: -3,
                        },

                    }]
                },
                annotation: {
                    drawTime: 'afterDatasetsDraw',
                    annotations: [{
                        type: 'line',
                        id: 'lineBatasKemampuan',
                        mode: 'horizontal',
                        scaleID: 'y-axis-0',
                        value: <?php echo round((float) $dataNilai['teta_jawab'], 3); ?>,
                        borderColor: warnaBatas,
                        borderWidth: 1,
                        label: {
                            enabled: false,
                            yAdjust: -20,
                            content: 'Tingkat kemampuan peserta'
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(data) {
                            var keterangan = ['Kesulitan : ' + Number(data.yLabel)];
                            var tipeSoal = function() {
                                var tmpTipe = null;
                                $.ajax({
                                    async: false,
                                    url: '../function/getTipeSoal.php',
                                    method: 'POST',
                                    data: {
                                        getTipeSoalChart: true,
                                        idsiswa: "<?php echo $idsiswa; ?>",
                                        idkodesoal: "<?php echo $idkodesoal; ?>",
                                        sessionid: "<?php echo $sessionid; ?>",
                                        state: Number(data.xLabel) - 1,
                                    },
                                    success: function(response) {
                                        tmpTipe = response;
                                    }
                                });
                                return tmpTipe;
                            }();
                            keterangan.push('Tipe soal : ' + tipeSoal);
                            return keterangan;
                        }
                    }
                },
            },

        });
    }

    function skorgraph(totalTampilData) {
        <?php if ($nilaiAkhirPeserta >= 73) {
            echo "var warnaBatas = 'green';";
            echo "var ketBatas = 'Tinggi';";
        } else if ($nilaiAkhirPeserta >= 50 && $nilaiAkhirPeserta <= 72) {
            echo "var warnaBatas = 'yellow';";
            echo "var ketBatas = 'Sedang';";
        } else if ($nilaiAkhirPeserta < 50) {
            echo "var warnaBatas = 'red';";
            echo "var ketBatas = 'Rendah';";
        } ?>

        var dataAWal = [<?php echo $skorFix; ?>];
        var totalData = <?php echo count($skorReady); ?>;
        for (var index = 0; index < (totalData - totalTampilData); index++) {
            dataAWal.pop();
        }

        var chart = $('#hasilTestChartSkor');
        var result = new Chart(chart, {
            type: 'line',
            data: {
                labels: [<?php echo $stateSoalFix; ?>],
                datasets: [{
                        label: 'Skor ',
                        data: dataAWal,
                        borderColor: '#2980b9',
                        fill: false,
                        lineTension: 0
                    },
                    {
                        label: 'Tingkat Kemampuan Peserta (Baik)',
                        backgroundColor: 'green',
                    },

                    {
                        label: 'Tingkat Kemampuan Peserta (Sedang)',
                        backgroundColor: 'yellow',
                    },
                    {
                        label: 'Tingkat Kemampuan Peserta (Rendah)',
                        backgroundColor: 'red',
                    }
                ],
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Butir-butir soal yang dikerjakan'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Skor Tiap soal'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                if (index == 0) {
                                    return 'Tinggi   ' + value;
                                } else if (index == 10) {
                                    return 'Rendah   ' + value;
                                } else {
                                    return value;
                                }
                            },
                            max: 100,
                            min: 0
                        }
                    }]
                },
                annotation: {
                    drawTime: 'afterDatasetsDraw',
                    annotations: [{
                        type: 'line',
                        id: 'lineBatasKemampuan',
                        mode: 'horizontal',
                        scaleID: 'y-axis-0',
                        value: <?php echo round(50 + ((50 / 3) * $dataNilai['teta_jawab']), 2); ?>,
                        borderColor: warnaBatas,
                        borderWidth: 1,
                        label: {
                            enabled: false,
                            yAdjust: -20,
                            content: 'Tingkat kemampuan peserta'
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(data) {
                            var keterangan = ['Skor : ' + Number(data.yLabel)];
                            var tipeSoal = function() {
                                var tmpTipe = null;
                                $.ajax({
                                    async: false,
                                    url: '../function/getTipeSoal.php',
                                    method: 'POST',
                                    data: {
                                        getTipeSoalChart: true,
                                        idsiswa: "<?php echo $idsiswa; ?>",
                                        idkodesoal: "<?php echo $idkodesoal; ?>",
                                        sessionid: "<?php echo $sessionid; ?>",
                                        state: Number(data.xLabel) - 1,
                                    },
                                    success: function(response) {
                                        tmpTipe = response;
                                    }
                                });
                                return tmpTipe;
                            }();
                            keterangan.push('Tipe soal : ' + tipeSoal);
                            return keterangan;
                        }
                    }
                },

            },
        });
    }

    $(document).ready(function() {
        kesulitangraph(<?php echo count($stateSoal); ?>);
        skorgraph(<?php echo count($stateSoal); ?>);
    });

    $('#kesulitan-range').on('change', function() {
        const val = $(this).val();
        const totalData = <?php echo count($stateSoal); ?>;
        var arrayYangDitampilkan = Math.round((val / 100) * totalData);
        kesulitangraph(arrayYangDitampilkan);
    });
    $('#skor-range').on('change', function() {
        const val = $(this).val();
        const totalData = <?php echo count($stateSoal); ?>;
        var arrayYangDitampilkan = Math.round((val / 100) * totalData);
        skorgraph(arrayYangDitampilkan);
    });
</script>
<?php require '../layouts/close.php'; ?>