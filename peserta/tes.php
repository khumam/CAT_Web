<?php
require '../function/check_peserta.php';
require '../layouts/header.php';
require '../function/check_tes.php';
require '../layouts/sidebar.php';
require '../function/getNilaiReal.php';
?>



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
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">
                            Sisa waktu
                        </h4>
                        <hr>
                        <h3 id="time"></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">
                            Soal Ke- <?php echo $_SESSION['state'] + 1; ?>
                        </h4>
                        <hr>
                        <form action="../function/mainFunction.php" method="post" id="formSoal">
                            <div class="container p-3" id="soal">
                            </div>
                            <input type="hidden" id='waktu-soal' name='waktu-soal'>
                            <input type="hidden" id="kesulitan-soal-ini">
                            <input type="hidden" id="jenis-soal-ini">
                        </form>
                        <button class="mt-3 btn btn-success" id="submit" name="tombol-next" form="formSoal">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['kd_judul_tes'] == 5) { ?>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-header">Grafik Kesulitan</h4>
                    <div class="card-body">
                        <div style="height: 250px; width:100%">
                            <canvas id="hasilTestChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-header">Grafik Skor</h4>
                    <div class="card-body">
                        <div style="height: 250px; width:100%">
                            <canvas id="hasilTestChartSkor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
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
$skorSiswa =  round(50 + ((50 / 3) * $_SESSION['teta_jawab']), 2);

?>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        var startTime = new Date();
        var tesWaktu = {};
        var detailTes = $.ajax({
            url: "../function/getDaftarTes.php",
            type: 'POST',
            dataType: 'JSON',
            data: {
                byid: <?php echo $_GET['tes']; ?>
            },
            success: function(response) {
                tesWaktu = startTime.getTime() + (parseInt(response.waktu) * 60 * 1000);
                $('#namates').html(response.judul);
            },
            done: function(response) {
                tesWaktu = response;
            }
        });

        var tampilSoal = $.ajax({
            url: "../function/getSoal.php",
            type: 'POST',
            dataType: 'JSON',
            data: {
                kesulitan: "<?php echo $_SESSION['kesulitan']; ?>", //ubah kesulitan
                sign: "<?php echo $_SESSION['sign']; ?>"
            },
            success: function(response) {
                if (typeof(response.isi_soal) != "undefined" && response.isi_soal !== null) {
                    var soal = response.isi_soal;
                    $('#kesulitan-soal-ini').val(response.tingkat_kesulitan);
                    $('#jenis-soal-ini').val(response.tipe);
                    if (soal == '<h6>Test telah selesai. Silahkan klik tombol Selanjutnya.</h6>') {
                        $('#kesulitan-soal-ini').val('DONE');
                        $('#jenis-soal-ini').val('DONE');
                    }
                    soal = soal.replace("A. ", "<table style='margin-top: 2em; width: 100%'><tr><td style='padding: 1em'><input type='radio' value='A' name='jawaban'> A. ");
                    soal = soal.replace("B. ", "</td></tr><tr><td style='padding: 1em'><input type='radio' value='B' name='jawaban'> B. ");
                    soal = soal.replace("C. ", "</td></tr><tr><td style='padding: 1em'><input type='radio' value='C' name='jawaban'> C. ");
                    soal = soal.replace("D. ", "</td></tr><tr><td style='padding: 1em'><input type='radio' value='D' name='jawaban'> D. ");
                    soal = soal.replace("E. ", "</td></tr><tr><td style='padding: 1em'><input type='radio' value='E' name='jawaban'> E. ");
                    $('#soal').html(soal + "</td></tr></table>");
                } else {
                    $('#soal').html("Test telah selesai, terima kasih sudah mengerjakan. Silahkan klik tombol di bawah");
                }

                if (response.is.testIsDone == true) {
                    window.location.replace('../function/logout.php');
                }
            }
        });

        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return hours + ":" + minutes + ":" + seconds;
        }

        function initializeClock(id, endtime) {
            function updateClock() {
                var t = getTimeRemaining(endtime);
                $(id).html(t);

                if (t == '0:0:0') {
                    window.location.replace('../function/mainFunction.php?waktuHabis=1');
                }

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        var timeDuration = new Date();
        var deadline = new Date(timeDuration.getTime() + <?php echo $_SESSION['timeDuration']; ?> * 60000);
        initializeClock('#time', deadline);
    });

    $(document).ready(function() {
        var timeSpent = 0;
        var doUpdate = function() {
            timeSpent = timeSpent + 1;
            $('#waktu-soal').val(timeSpent);
        };
        setInterval(doUpdate, 1000);
    });
</script>

<?php if ($_SESSION['kd_judul_tes'] == 5) { ?>
    <script src="../assets/js/Chart.min.js"></script>
    <script src="../assets/js/chartjs-plugin-annotation.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
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

                var kesulitanSaatIni = $('#kesulitan-soal-ini').val();
                var dataKesulitan = [<?php echo $kesulitanFix; ?>];
                var labels = [<?php echo $stateSoalFix; ?>];
                if (kesulitanSaatIni != 'DONE') {
                    dataKesulitan.push(kesulitanSaatIni);
                    labels.push(labels.length + 1);
                }
                var chart = $('#hasilTestChart');
                var result = new Chart(chart, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Kesulitan ',
                                data: dataKesulitan,
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
                                                getTipe: true,
                                            },
                                            success: function(response) {
                                                tmpTipe = response;
                                            }
                                        });
                                        return tmpTipe;
                                    }();
                                    var waktuSoal = function() {
                                        var tmpWaktu = null;
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
                                                waktuSoal: true,
                                            },
                                            success: function(response) {
                                                tmpWaktu = response;
                                            }
                                        });
                                        return tmpWaktu;
                                    }();
                                    if (tipeSoal != 'null') {
                                        keterangan.push('Tipe soal : ' + tipeSoal);
                                    } else {
                                        keterangan.push('Tipe soal : ' + $('#jenis-soal-ini').val());
                                    }
                                    if (waktuSoal != 'null') {
                                        keterangan.push('Kecepatan : ' + waktuSoal + ' detik');
                                    } else {
                                        keterangan.push('Kecepatan : ' + $('#waktu-soal').val() + ' detik');
                                    }
                                    return keterangan;
                                }
                            }
                        },

                    }
                });
            }, 1500);
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

            var labelsskors = [<?php echo $stateSoalFix; ?>];
            var skors = [<?php echo $skorTiapSoalFix; ?>];
            <?php if ($_SESSION['state'] == 0) { ?>
                skors.push(50);
            <?php } ?>
            var chart = $('#hasilTestChartSkor');
            var result = new Chart(chart, {
                type: 'line',
                data: {
                    labels: labelsskors,
                    datasets: [{
                            label: 'Skor ',
                            data: skors,
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
                                if (tipeSoal != 'null') {
                                    keterangan.push('Tipe soal : ' + tipeSoal);
                                } else {
                                    keterangan.push('Tipe soal : ' + $('#jenis-soal-ini').val());
                                }
                                return keterangan;
                            }
                        }
                    },


                },
            });
        });
    </script>
<?php } ?>

<?php require '../layouts/close.php'; ?>