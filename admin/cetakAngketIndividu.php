<?php
// require '../function/check_guru.php';
require '../function/getAngketIndividu.php';
require '../layouts/header.php';
// require '../layouts/sidebar.php'; 
?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title namauser" id="namauser"></h4>
                        <h4 class="header-title" id="nomoruser"></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Hasil Angket Individu</h4>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-stripped table-bordered" id="tableangket">
                                        <thead>
                                            <th style="width: 10px">No</th>
                                            <th>Isi Angket</th>
                                            <th style="width: 100px">Nilai</th>
                                        </thead>
                                        <tbody id="konten"></tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td cols="3" style="font-weight: 600">Rata-rata</td>
                                                <td id="rata-rata" style="font-weight: 600;"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
                        <h4 class="header-title">Komentar dari <span class="namauser"></span></h4>
                        <hr>
                        <div id="hasilkomentar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap 4 js -->
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/metisMenu.min.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/jquery.slicknav.min.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<!-- others plugins -->
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/scripts.js"></script>

<script>
    $('#full-view-tutorial').on('click', function() {
        window.open('../tutorial.html');
    });
    $('#tutorialBtn').on('click', function() {
        <?php if ($_SESSION['role'] == 'Guru') { ?>
            window.open('../admin/tutorial.php');
        <?php } ?>
        <?php if ($_SESSION['role'] == 'Peserta') { ?>
            window.open('../peserta/tutorial.php');
        <?php } ?>
    });
</script>

<script>
    $('#tombol-notif').on("click", function() {
        <?php
        unset($_SESSION['notif']);
        unset($_SESSION['notif_type']);
        ?>
    })
</script>
<script>
    $(document).ready(function() {
        var content = '';
        var total = 0;
        var jawaban = 0;
        $.ajax({
            url: "../function/getAngketIndividu.php",
            method: 'POST',
            data: {
                idsiswa: "<?php echo $_GET['idsiswa']; ?>",
                sessionid: "<?php echo $_GET['sessionid']; ?>",
            },
            success: function(res) {
                res = JSON.parse(res);
                $.each(res, function(index, value) {
                    $('.namauser').html(value.nama_user);
                    $('#nomoruser').html(value.nomor_user);
                    content += "<tr>" +
                        "<td>" + (index + 1) + "</td>" +
                        "<td>" + value.angket + "</td>" +
                        "<td>" + value.jawaban + "</td>" +
                        "</tr>";
                    total += 1;
                    jawaban += parseInt(value.jawaban);
                });
                $('#konten').html(content);
                $('#rata-rata').html((jawaban / total).toFixed(2));
            }
        });

        var komentar = '';
        $.ajax({
            url: "../function/getAngketIndividu.php",
            method: 'POST',
            data: {
                idsiswa: "<?php echo $_GET['idsiswa']; ?>",
                komentar: true,
            },
            success: function(res) {
                res = JSON.parse(res);
                $.each(res, function(index, value) {
                    if (value.komentar != '') {
                        komentar += "<li class='list-group-item'>" +
                            "<td>" + value.komentar + "</td>" +
                            "</li>";
                    }
                });
                $('#hasilkomentar').html(komentar);
            }
        })
    })

    window.print()
</script>
<?php require '../layouts/close.php'; ?>