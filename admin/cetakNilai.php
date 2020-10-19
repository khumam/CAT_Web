<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/getNilai.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Cetak Nilai</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4><?php echo $getSiswa['nama_user']; ?> (<?php echo $getSiswa['nomor_user']; ?>)</h4>
                        <h6><?php echo $getTes['judul']; ?></h6>
                        <hr>
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
                                        <th>Kode Soal</th>
                                        <th>Skor</th>
                                        <th>b</th>
                                        <th>θ awal</th>
                                        <th>θ jawab</th>
                                        <th>Pi(θ)</th>
                                        <th>Q(θ)</th>
                                        <th>IIF</th>
                                        <th>SE(θ)</th>
                                        <th>Selisih SE</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $stateSoal = [];
                                        $kesulitanSoal = [];
                                        $skorTiapSoal = [];
                                        $waktuSoal = [];
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
                                                <td><?php echo round((float) $row['se_teta'], 4); ?></td>
                                                <td><?php echo round((float) $row['selisih_se'], 4); ?></td>
                                                <?php $stateSoal[] =  $row['state'] + 1; ?>
                                                <?php $kesulitanSoal[] =  $row['kesulitan']; ?>
                                                <?php $waktuSoal[] =  $row['waktusoal']; ?>
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

        <div class="row mb-5">
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
        <div style="display: block; page-break-before: always; ">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Kesulitan soal</h4>
                            <hr>
                            <div style="min-height: 300px; width: 80%">
                                <canvas id="hasilTestChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Grafik skor</h4>
                            <hr>
                            <div style="min-height: 300px; width: 80%">
                                <canvas id="hasilTestChartSkor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: block; page-break-before: always; ">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Grafik Kecepatan Pengerjaan</h4>
                            <hr>
                            <div style="min-height: 300px; width: 80%">
                                <canvas id="hasilTestChartWaktu"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    $stateSoalFix = implode(',', $stateSoal);
    $kesulitanFix = implode(',', $kesulitanSoal);
    $waktuFix = implode(',', $waktuSoal);
    $nilaiAkhirPeserta = round(50 + ((50 / 3) * $dataNilai['teta_jawab']), 2);

    if ($nilaiAkhirPeserta <= 0) {
        $skorFixArray = array_map(function ($val) {
            return 0;
        }, $skorTiapSoal);
        $skorFix = implode(',', $skorFixArray);
    } else {
        $skorFix = implode(',', $skorTiapSoal);
    }


    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="../assets/js/Chart.min.js"></script>
    <script src="../assets/js/chartjs-plugin-annotation.min.js"></script>

    <script>
        $(document).ready(function() {

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

            var chart = $('#hasilTestChart');
            var result = new Chart(chart, {
                type: 'line',
                data: {
                    labels: [<?php echo $stateSoalFix; ?>],
                    datasets: [{
                            label: 'Kesulitan ',
                            data: [<?php echo $kesulitanFix; ?>],
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
                    animation: false,
                    maintainAspectRatio: false,
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
                                labelString: 'Kesulitan soal'
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
                                min: -3
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
                            value: <?php echo round((float) $dataNilai['teta_jawab'], 3); ?>,
                            borderColor: '#000',
                            borderWidth: 1,
                            label: {
                                enabled: false,
                                position: "right",
                                content: 'Batas kemampuan'
                            }
                        }]
                    }

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

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

            var chart = $('#hasilTestChartSkor');
            var result = new Chart(chart, {
                type: 'line',
                data: {
                    labels: [<?php echo $stateSoalFix; ?>],
                    datasets: [{
                            label: 'Skor ',
                            data: [<?php echo $skorFix; ?>],
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
                    animation: false,
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
                                labelString: 'Skor Tiap soal',
                                padding: 2
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
                            borderColor: '#000',
                            borderWidth: 1,
                            label: {
                                enabled: false,
                                position: "right",
                                content: 'Batas kemampuan'
                            }
                        }]
                    }


                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var chart = $('#hasilTestChartWaktu');
            var result = new Chart(chart, {
                type: 'line',
                data: {
                    labels: [<?php echo $stateSoalFix; ?>],
                    datasets: [{
                            label: 'Kecepatan ',
                            data: [<?php echo $waktuFix; ?>],
                            borderColor: '#2980b9',
                            fill: false,
                            lineTension: 0
                        },
                        {
                            label: 'Kecepatan Lama',
                            backgroundColor: 'yellow',
                        },

                        {
                            label: 'Kecepatan Sedang',
                            backgroundColor: 'green',
                        },
                        {
                            label: 'Kecepatan Cepat',
                            backgroundColor: 'red',
                        }
                    ],
                },
                options: {
                    responsive: true,
                    animation: false,
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
                                labelString: 'Kecepatan Pengerjaan (detik)'
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    if (index == 0) {
                                        return 'Lama   ' + value;
                                    } else if (index == 10) {
                                        return 'Cepat   ' + value;
                                    } else {
                                        return value;
                                    }
                                },
                                max: 200,
                                min: 0
                            }
                        }]
                    },
                    annotation: {
                        drawTime: 'afterDatasetsDraw',
                        annotations: [{
                            type: 'line',
                            id: 'lineBatasKecepatan',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: <?php echo end($waktuSoal); ?>,
                            borderColor: '#000',
                            borderWidth: 1,
                            label: {
                                enabled: false,
                                yAdjust: -20,
                                content: 'Kecepatan Pengerjaan peserta'
                            }
                        }]
                    },
                },
            });
        })
    </script>

    <script>
        window.print();
    </script>
</body>

</html>