<?php
// require '../function/check_guru.php';
require '../function/getAngketIndividu.php';
require '../layouts/header.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title" id="namauser"></h4>
                        <h4 class="header-title" id="nomoruser"></h4>
                        <a href="angketindividu.php" class="btn btn-danger btn-xs">Kembali</a>
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
                        <h4 class="header-title">Komentar dari Nama User</h4>
                        <hr>
                        <div id="hasilkomentar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
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
                    $('#namauser').html(value.nama_user);
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
</script>
<?php require '../layouts/close.php'; ?>