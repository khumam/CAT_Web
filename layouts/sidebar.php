<div class="page-container sbar_collapsed" id="mainSidebar">
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo bg-light">
                <a href="#"><img src="../assets/images/icon/unnes.png" alt="logo" style="height: 100px"></a>
            </div>
        </div>
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <?php if ($_SESSION['role'] == 'Peserta') { ?>
                            <li class="active">
                                <a href="../peserta/index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="../peserta/daftartes.php" aria-expanded="true"><i class="ti-layout-list-thumb"></i><span>Daftar Test
                                    </span></a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == 'Guru') { ?>
                            <li class="active">
                                <a href="../admin/index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="../admin/soal.php" aria-expanded="true"><i class="ti-layout-list-post"></i><span>List Soal
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/tipesoal.php" aria-expanded="true"><i class="ti-view-grid"></i><span>Topik Soal
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/daftartes.php" aria-expanded="true"><i class="ti-view-list-alt"></i><span>List Tes
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/daftarpeserta.php" aria-expanded="true"><i class="ti-face-smile"></i><span>List Peserta
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/hasiltes.php" aria-expanded="true"><i class="ti-write"></i><span>Hasil Tes
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/assets.php" aria-expanded="true"><i class="ti-image"></i><span>Assets
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/angket.php" aria-expanded="true"><i class="ti-write"></i><span>Angket
                                    </span></a>
                            </li>
                            <li>
                                <a href="../admin/pengaturan.php" aria-expanded="true"><i class="ti-settings"></i><span>Pengaturan
                                    </span></a>
                            </li>

                        <?php } ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>


    <div class="main-content">
        <div class="header-area">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="search-box pull-left">
                        <h4 class="page-title pull-left mt-2">Computer Adaptive Test</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-4 clearfix">
                    <ul class="notification-area pull-right">
                        <li id=""><i class="ti-announcement" id="tutorialBtn"></i></li>
                        <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        <li class="dropdown">
                            <i class="ti-user dropdown-toggle" data-toggle="dropdown">
                            </i>
                            <div class="dropdown-menu bell-notify-box notify-box">
                                <span class="notify-title">Hai <?php echo $_SESSION['nama']; ?></span>
                                <div class="nofity-list">
                                    <a href="../function/logout.php" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-arrow-circle-down btn-danger"></i></div>
                                        <div class="notify-text">
                                            <h6>Keluar</h6>
                                            <span>Keluar aplikasi</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>