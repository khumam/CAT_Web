<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../function/getListAngketAdmin.php';
require '../function/getDetailHasilAngket.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <a href="angketindividu.php" class="btn btn-success float-right mb-3">Hasil Individu</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Hasil Angket</h4>
                        <hr>
                        <?php if (!empty($dataSub) && !empty($dataAngket)) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th style="width: 40px; text-align: center">No</th>
                                        <th style="text-align: center">Pernyataan</th>
                                        <th style="text-align: center">Hasil</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataSub as $sub) { ?>
                                            <tr>
                                                <td colspan="3"><b><?php echo $sub['nama_sub']; ?></b></td>
                                            </tr>
                                            <?php $index = 1;
                                            foreach ($dataAngket as $angket) { ?>
                                                <?php if ($sub['id'] == $angket['sub_id']) { ?>
                                                    <tr>
                                                        <td><?php echo $index++; ?></td>
                                                        <td><?php echo $angket['angket']; ?></td>
                                                        <td>
                                                            <canvas id="hasil-<?php echo $angket['id']; ?>"></canvas>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            Belum ada data
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Hasil komentar dan saran</h4>
                        <hr>
                        <div class="data-tables">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables">
                                    <thead class="text-center">
                                        <th style="width:12px">No</th>
                                        <th>Komentar</th>
                                        <!-- <th style="width:50px">Aksi</th> -->
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

<?php require '../layouts/footer.php'; ?>
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/chartjs-plugin-annotation.min.js"></script>
<script>
    $(document).ready(function() {
        let index = 1;
        var tabeldata = $('#dataTables').DataTable({
            ajax: {
                url: "../function/getKomentar.php",
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
                    data: 'komentar'
                },
                // {
                //     render: function(data, type, row) {
                //         return "<div class='btn-group'><button data-id = '" + row.id + "' class='btn btn-xs btn-success btn-detail'>Detail</button></div>";
                //     }
                // }
            ]

        });
    })
</script>
<script>
    $(document).ready(function() {
        <?php foreach ($dataAngket as $angketpie) { ?>
            var config<?php echo $angketpie['id']; ?> = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            <?php echo $skorAngket[$angketpie['id']]['1']['data']; ?>,
                            <?php echo $skorAngket[$angketpie['id']]['2']['data']; ?>,
                            <?php echo $skorAngket[$angketpie['id']]['3']['data']; ?>,
                            <?php echo $skorAngket[$angketpie['id']]['4']['data']; ?>,
                        ],
                        backgroundColor: [
                            "<?php echo $skorAngket[$angketpie['id']]['1']['color']; ?>",
                            "<?php echo $skorAngket[$angketpie['id']]['2']['color']; ?>",
                            "<?php echo $skorAngket[$angketpie['id']]['3']['color']; ?>",
                            "<?php echo $skorAngket[$angketpie['id']]['4']['color']; ?>",
                        ],
                        label: "Angket id <?php echo $angketpie['id']; ?>"
                    }],
                    labels: [
                        'Kurang baik',
                        'Cukup baik',
                        'Baik',
                        'Sangat baik',
                    ]
                },
                options: {
                    responsive: true
                }
            }

            var pie<?php echo $angketpie['id']; ?> = $("#hasil-<?php echo $angketpie['id']; ?>");
            var result<?php echo $angketpie['id']; ?> = new Chart(pie<?php echo $angketpie['id']; ?>, config<?php echo $angketpie['id']; ?>);

        <?php } ?>
    });
</script>
<?php require '../layouts/close.php'; ?>