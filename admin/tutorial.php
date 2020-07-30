<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Computer Adaptive Test</title>
</head>

<body style="background: #fdfdfd">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm" style="background: #8655FC">
        <div class="container">
            <a class="navbar-brand" href="index.php">Computer Adaptive Test</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active" href="" id="cetak-btn">Cetak</a>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <div class="row my-5 text-center">
                <div class="col-12">
                    <img src="../assets/images/icon/unnes.png" alt="Logo UNNES" height="120">
                    <h3 class="mt-3">Turorial Penggunaan Web<br>Computer Adaptive Test Bagi Admin</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container">
            <div class="accordion" id="tutorial">
                <div class="card" id="video-session">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#video-tes" aria-expanded="true" aria-controls="video-tes">
                                Video Tutorial
                            </button>
                        </h2>
                    </div>

                    <div id="video-tes" class="collapse show" aria-labelledby="headingOne" data-parent="#tutorial">
                        <div class="card-body text-center">
                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-12">
                                    <iframe width="752" height="380" src="https://www.youtube.com/embed/kkEE9SbgeRA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#fitur-tes-cat" aria-expanded="true" aria-controls="fitur-tes-cat">
                                Fitur Tes Adaptif
                            </button>
                        </h2>
                    </div>

                    <div id="fitur-tes-cat" class="collapse" aria-labelledby="headingOne" data-parent="#tutorial">
                        <div class="card-body">
                            <ol>
                                <li class="my-1"><b>Dashboard</b><br>
                                    Halaman Dashboard adalah pusat kontrol panel berplatform yang berfungsi
                                    untuk mengatur semua kegiatan di sebuah situs web. Dashboard akan
                                    menampilkan perkembangan total peserta, total tes dan total soal pada
                                    sistem admin.</li>
                                <li class="my-1"><b>List Soal</b><br>
                                    Halaman List Soal adalah halaman untuk menambahkan soal dan menampilkan
                                    soal yang telah dimasukkan pada sistem. Pada tampilan list soal terdapat
                                    tombol tambah soal untuk menambahkan soal.</li>
                                <li class="my-1"><b>Topik Soal</b><br>
                                    Halaman Topik Soal akan ditampilkan topik-topik soal yang akan
                                    dimasukkan ke Tes. Untuk menambahkan topik soal maka pilih tombol Tambah
                                    topik soal.</li>
                                <li class="my-1"><b>List Tes</b><br>
                                    Halaman List Tes akan ditampilkan tabel Daftar Tes. Untuk menambahkan
                                    Tes maka pilih tombol Tambah Tes.</li>
                                <li class="my-1"><b>List Peserta</b><br>
                                    Halaman List Peserta menampilkan tabel Daftar Peserta. Untuk menambahkan
                                    peserta tes dapat memilih tambah data. Untuk menambahkan peserta dalam
                                    jumlah banyak, dapat memilih tombol Upload Data Peserta. Di sini file
                                    yang harus dimasukkan adalah bentuk excel. Kolom yang harus ada dalam
                                    excel harus terdapat Nomor, Nama Peserta, Nomor Peserta dan Password.
                                </li>
                                <li class="my-1"><b>Hasil Tes</b><br>
                                    Halaman Hasil Tes akan menampilkan tabel yang merupakan hasil tes setiap
                                    Peserta yang telah mengerjakan tes. Tombol Lihat Hasil akan menampilkan
                                    hasil tes peserta. Riwayat hasil peserta akan ditampilkan dengan bentuk
                                    tabel dan grafik. Terdapat tombol cetak untuk mengunduh atau mencetak
                                    hasil tes dan tombol kembali untuk ke halaman sebelumnya.</li>
                                <li class="my-1"><b>Halaman Assets</b><br>
                                    Halaman Assets bertujuan untuk menambahkan aset-aset gambar. Gambar ini
                                    akan ditampilkan pada soal yang akan dikerjakan oleh siswa. Dengan
                                    mengunggah gambar maka gambar pasti akan tertampil pada soal peserta.
                                </li>
                                <li class="my-1"><b>Halaman Pengaturan</b><br>
                                    Halaman Pengaturan menampilkan Pengaturan, Ganti Password dan Tambahkan
                                    Guru Baru. Ganti Password untuk penggantian Password Admin. Tambahkan
                                    guru untuk menambahkan Guru Baru sebagai pengakses admin yang baru.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5 p-2" style="background: #8655FC">
        <div class="container-fluid mt-2">
            <p class="text-center text-white">Copyright @2020 Computer Adaptive Test</p>
        </div>
    </section>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $('#cetak-btn').on('click', function() {
            $('#video-session').hide();
            $('#materi-tes').addClass('show');
            $('#fitur-tes-cat').addClass('show');
            $('#bentuk-tes').addClass('show');
            $('#output').addClass('show');
            $('#langkah-mengerjakan').addClass('show');
            window.print();
        });
    </script>
</body>

</html>