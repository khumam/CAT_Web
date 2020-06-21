<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Computer Adaptive Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="function/login.php" method="POST">
                    <div class="login-form-head">
                        <img src="assets/images/icon/unnes.png" alt="" style="height:100px; width: auto">
                        <h5 class="text-white mt-3">Hai, Selamat datang di Computer Adaptive Test</h5>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Kode peserta</label>
                            <input type="text" id="exampleInputEmail1" name="nomorusername">
                            <i class="ti-shortcode"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button type="submit" name="tombol-login">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Masuk sebagai guru <a href="loginadmin.php">Klik di sini</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- <section>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="display-4">Hello, Selamat datang</h1>
                    <p class="lead">Selamat datang di Computer Adaptive Test</p>
                    <hr class="my-4">
                    <p>Untuk masuk dan mulai menggunakan Computer Adaptive Test, silahkan masukan nomor peserta dan password di samping</p>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4 p-3" style="border: 1px solid #ccc; border-radius: 15px">
                    <form action="function/login.php" method="post" id="loginForm">
                        <div class="form-group">
                            <label for="nomorusername">Nomor Peserta</label>
                            <input type="text" name="nomorusername" id="nomorusername" class="form-control" placeholder="Nomor Peserta">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-info" type="submit" name="tombol-login">Masuk Test</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section> -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>



    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>



    <script>
        $('#tombol-notif').on("click", function() {
            <?php
            unset($_SESSION['notif']);
            unset($_SESSION['notif_type']);
            ?>
        })
    </script>

</body>

</html>