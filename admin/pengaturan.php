<?php
require '../function/check_guru.php';
require '../layouts/header.php';
require '../layouts/sidebar.php'; ?>

<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <?php require '../function/notif.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Pengaturan</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td style="max-width: 50px">Nama</td>
                                    <td id="namaGuru"></td>
                                </tr>
                                <tr>
                                    <td style="max-width: 50px">Username</td>
                                    <td id="usernameGuru"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Ganti password</h4>
                        <hr>
                        <form action="../function/changePassword.php" method="post">
                            <input type="text" name="id" value="id" hidden>
                            <div class="form-group">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Password lama" required>
                            </div>
                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" name="password_baru" id="password_baru" class="form-control" placeholder="Password baru" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirm" id="password_confirm" placeholder="Konfirmasi password baru" class="form-control" required>
                                <small class="form-text text-danger" id="pass_error"></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="tombol-ubah" id="tombol-ubah">Ubah password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Tambahkan guru baru</h4>
                        <hr>
                        <form action="../function/registGuru.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input type="text" name="nama" id="nama" placeholder="Nama lengkap" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="tombol-daftar" class="btn btn-info">Tambah guru</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>

<script>
    $(document).ready(function() {

        $.ajax({
            url: '../function/getUser.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kd_user: <?php echo $_SESSION['id']; ?>
            },
            success: function(response) {
                $('#namaGuru').html(response.nama_user);
                $('#usernameGuru').html(response.nomor_user);
            }
        })

        $('#password_baru').on("keyup", function() {
            let cek = check();
            console.log(cek);
            if (cek == false) {
                $('#pass_error').html('Password tidak sesuai');
                $('#tombol-ubah').attr('disabled', 'disabled');
            } else {
                $('#pass_error').html('');
                $('#tombol-ubah').removeAttr('disabled');
            }
        })

        $('#password_confirm').on("keyup", function() {
            let cek = check();
            console.log(cek);
            if (cek == false) {
                $('#pass_error').html('Password tidak sesuai');
                $('#tombol-ubah').attr('disabled', 'disabled');
            } else {
                $('#pass_error').html('');
                $('#tombol-ubah').removeAttr('disabled');
            }
        })

        function check() {
            if ($('#password_baru').val() != $('#password_confirm').val()) {
                return false;
            } else {
                return true;
            }
        }
    })
</script>

<?php require '../layouts/close.php'  ?>