<?php
require '../function/check_peserta.php';
require '../layouts/header.php';
require '../function/check_tes.php';
require '../layouts/sidebar.php';
?>

<!-- <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6 py-3">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.html">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
</div> -->

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
                        </form>
                        <button class="mt-3 btn btn-success" id="submit" name="tombol-next" form="formSoal">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                console.log(response);
                if (typeof(response.isi_soal) != "undefined" && response.isi_soal !== null) {
                    var soal = response.isi_soal;
                    soal = soal.replace("A. ", "<input type='radio' value='A' name='jawaban'> A. ");
                    soal = soal.replace("B. ", "<input type='radio' value='B' name='jawaban'> B. ");
                    soal = soal.replace("C. ", "<input type='radio' value='C' name='jawaban'> C. ");
                    soal = soal.replace("D. ", "<input type='radio' value='D' name='jawaban'> D. ");
                    soal = soal.replace("E. ", "<input type='radio' value='E' name='jawaban'> E. ");
                    $('#soal').html(soal);
                } else {
                    $('#soal').html("Test telah selesai, terima kasih sudah mengerjakan. Silahkan klik tombol di bawah");
                }

                if (response.is.testIsDone == true) {
                    window.location.replace('../function/logout.php');
                }
            }
        });

        // $('#submit').on('click', function() {
        //     window.location.reload();
        // });

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
    })
</script>

<?php require '../layouts/close.php'; ?>