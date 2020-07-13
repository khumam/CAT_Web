<?php
// require '../function/check_peserta.php';
include '../layouts/header.php';
require '../function/getNilai.php';
?>


<div class="main-content-inner">
    <div class="sales-report-area mb-5">
        <div class="row">
            <div class="col-md-6 p-5 text-center">
                <h4 class="mb-3">Grafik Kesulitan</h4>
                <div style="height: 250px; width:100%">
                    <canvas id="hasilTestChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 p-5 text-center">
                <h4 class="mb-3">Grafik Skor</h4>
                <div style="height: 250px; width:100%">
                    <canvas id="hasilTestChartSkor"></canvas>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <?php $skorSiswa =  round(50 + ((50 / 3) * $dataNilai['teta_jawab']), 2); ?>
                <h3>Skor: <?php echo $skorSiswa; ?></h3>
                <?php if ($skorSiswa >= 0 && $skorSiswa <= 50) { ?>
                    <h4 class="mt-3">Belajarlah dengan sungguh-sungguh</h4>
                <?php } ?>
                <?php if ($skorSiswa >= 51 && $skorSiswa <= 72) { ?>
                    <h4 class="mt-3">Jangan pantang menyerah. Tingkatkan prestasimu</h4>
                <?php } ?>
                <?php if ($skorSiswa >= 73 && $skorSiswa <= 89) { ?>
                    <h4 class="mt-3">Selamat Anda Lulus, Kejar terus prestasimu</h4>
                <?php } ?>
                <?php if ($skorSiswa >= 90 && $skorSiswa <= 100) { ?>
                    <h4 class="mt-3">Excellent. Pertahankan prestasimu</h4>
                <?php } ?>
            </div>
            <div class="col-md-12 p-3 text-center">
                <h4 class=" display-4">Hai, <?php echo $dataDiri['nama_user']; ?></h4>
                <p class="lead">Terima kasih sudah mengerjakan Test</p>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 p-5 text-center">
                        <h4 class="mb-3">Statistik soal</h4>
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
                    <div class="col-md-3"></div>
                </div>
                <p>Silahkan klik tombol di bawah ini untuk melihat riwayat soal atau menyelesaikan sesi test</p>
                <a href="riwayatSoal.php?idsiswa=<?php echo $idsiswa; ?>&idkodesoal=<?php echo $idkodesoal; ?>&sessionid=<?php echo $sessionid; ?>" class="btn btn-primary mt-2">Lihat Riwayat Soal</a>
                <a href="../function/lanjutkan.php" class="mt-2 btn btn-success">Lanjutkan</a>
            </div>
        </div>
    </div>
</div>

<?php
$stateSoal = [];
$kesulitanSoal = [];
$skorTiapSoal = [];
while ($row = mysqli_fetch_assoc($getNilai)) {
    $stateSoal[] =  $row['state'] + 1;
    $kesulitanSoal[] =  $row['kesulitan'];
    $skorTiapSoal[] = round(50 + ((50 / 3) * $row['teta_jawab']), 2);
}

$stateSoalFix = implode(',', $stateSoal);
$kesulitanFix = implode(',', $kesulitanSoal);
$skorTiapSoalFix = implode(',', $skorTiapSoal);

?>

<?php require '../layouts/footer.php'; ?>
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/chartjs-plugin-annotation.min.js"></script>

<script>
    $(document).ready(function() {

        <?php if ($skorSiswa >= 73) {
            echo "var warnaBatas='green';";
            echo "var ketBatas='Tinggi';";
        } else if ($skorSiswa >= 50 && $skorSiswa <= 72) {
            echo "var warnaBatas='yellow';";
            echo "var ketBatas='Sedang';";
        } else if ($skorSiswa < 50) {
            echo "var warnaBatas='red';";
            echo "var ketBatas='Rendah';";
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
                        label: 'Tingkat Kemampuan Peserta (' + ketBatas + ")",
                        backgroundColor: warnaBatas,
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Nomor soal'
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
                        borderColor: warnaBatas,
                        borderWidth: 1,
                        label: {
                            enabled: false,
                            position: "right",
                            content: 'Batas kemampuan'
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

            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        <?php if ($skorSiswa >= 73) {
            echo "var warnaBatas='green';";
            echo "var ketBatas='Tinggi';";
        } else if ($skorSiswa >= 50 && $skorSiswa <= 72) {
            echo "var warnaBatas='yellow';";
            echo "var ketBatas='Sedang';";
        } else if ($skorSiswa < 50) {
            echo "var warnaBatas='red';";
            echo "var ketBatas='Rendah';";
        } ?>

        var chart = $('#hasilTestChartSkor');
        var result = new Chart(chart, {
            type: 'line',
            data: {
                labels: [<?php echo $stateSoalFix; ?>],
                datasets: [{
                        label: 'Skor ',
                        data: [<?php echo $skorTiapSoalFix; ?>],
                        borderColor: '#2980b9',
                        fill: false,
                        lineTension: 0
                    },
                    {
                        label: 'Tingkat Kemampuan Peserta (' + ketBatas + ")",
                        backgroundColor: warnaBatas,
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
                            labelString: 'Nomor soal'
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
                            position: "right",
                            content: 'Batas kemampuan'
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
    });
</script>
<?php require '../layouts/close.php'; ?>