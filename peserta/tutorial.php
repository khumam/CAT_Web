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
                    <h3 class="mt-3">Turorial Penggunaan Web<br>Computer Adaptive Test</h3>
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
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#materi-tes" aria-expanded="true" aria-controls="materi-tes">
                                Materi Tes
                            </button>
                        </h2>
                    </div>

                    <div id="materi-tes" class="collapse" aria-labelledby="headingOne" data-parent="#tutorial">
                        <div class="card-body text-justify">
                            Materi tes yang akan diujikan adalah materi getaran, gelombang dan bunyi. Getaran adalah
                            suatu benda yang bergerak bolak-balik secara teratur melalui titik kesetimbangan. Dari
                            sebuah energi getaran yang merambat ini disebut dengan gelombang. Sedangkan bunyi adalah
                            gelombang longitudinal yang merambatkan energi gelombang di udara sehingga bisa terdengar
                            oleh pendengar. Selain materi inti yang diujikan kepada peserta terdapat simulasi tes untuk
                            peserta tes sebelum mengerjakan tes inti.
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
                                <li class="my-1"><b>Dashboard</b>
                                    Pengguna sebagai Peserta akan ditampilkan halaman Dashboard setelah
                                    Peserta berhasil login. Halaman Dashboard adalah pusat kontrol panel
                                    berplatform yang berfungsi untuk mengatur semua kegiatan di sebuah situs
                                    web.</li>
                                <li class="my-1"><b>Halaman Daftar Tes</b><br>
                                    Halaman Daftar Tes akan menampilkan tabel daftar tes yang bisa
                                    dikerjakan oleh peserta tes. Peserta dapat memilih tes yang akan
                                    dikerjakan dengan memilih tombol Kerjakan di kolom Aksi.</li>
                                <li class="my-1"><b>Tutorial Penggunaan</b><br>
                                    Tutorial penggunaan bertujuan untuk memberi bimbingan penggunaan kepada Peserta tes. Di halaman ini Peserta tes dapat mencetak Tutorial penggunaan dengan memilih tombol cetak.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bentuk-tes" aria-expanded="true" aria-controls="bentuk-tes">
                                Bentuk Tes
                            </button>
                        </h2>
                    </div>

                    <div id="bentuk-tes" class="collapse" aria-labelledby="headingOne" data-parent="#tutorial">
                        <div class="card-body text-justify">
                            <i>Computerized Adaptive Test</i> (CAT) adalah suatu alat evaluasi berbasis komputer yang
                            menyediakan butir soal menyesuaikan dengan tingkat kemampuan peserta tes. Proses penyajian
                            soal ini dilakukan berulang sampai tingkat kesalahan estimasi atau SE yang telah ditentukan
                            terpenuhi. CAT yang dikembangkan ini memilih tingakat 1 Parameter dengan melihat tingkat
                            kesukaran soal. Bentuk tes yang diujikan merupakan pilihan ganda dengan satu jawaban benar.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#output" aria-expanded="true" aria-controls="output">
                                Output
                            </button>
                        </h2>
                    </div>

                    <div id="output" class="collapse" aria-labelledby="headingOne" data-parent="#tutorial">
                        <div class="card-body text-justify">
                            Output pada program ini dapat dilihat di Hasil tes. Tombol Lihat Hasil akan menampilkan
                            hasil tes peserta. Riwayat hasil
                            peserta akan ditampilkan dengan bentuk tabel dan grafik. Terdapat tombol cetak untuk
                            mengunduh atau mencetak hasil tes
                            dan tombol kembali untuk ke halaman sebelumnya.<br><br>
                            <div class="text-center">
                                <img src="../assets/images/tutorial/output-1.png" alt="Output">
                            </div>
                            <br><br>
                            Tabel akan menampilkan riwayat peserta mengerjakan tes. Dalam tabel terdapat
                            perhitungan-perhitungan yang dihitung
                            dengan persamaan sebagai berikut <br><br>
                            <div class="text-center">
                                <img src="../assets/images/tutorial/rumus-1.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/rumus-2.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/rumus-3.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/rumus-4.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/rumus-5.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/rumus-6.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/rumus-7.png" alt=""><br><br>
                            </div>
                            Keterangan :<br>
                            θ &nbsp;: tingkat kemampuan tes<br>
                            a &nbsp;: indeks daya pembeda butir ke-I (a = 1)<br>
                            b &nbsp;: indeks kesukaran butir ke-i<br>
                            c<sub>1</sub> : indeks tebakan semu butir ke-I (c = 0)<br>
                            D &nbsp;: faktor penskalaan yang bernilai 1,7.<br>
                            P<sub>1</sub> : Probabilitas menjawab benar<br>
                            Q<sub>1</sub> : Probabilitas menjawab salah<br>
                            IIF : Fungsi Informasi<br>
                            SE : Standar error<br><br>
                            <div class="text-center">
                                <img src="../assets/images/tutorial/output-2.png" alt="">
                            </div>
                            <br><br>Untuk mengetahui keterangan pada aplikasi, maka admin dapat mengarahkan kursor pada
                            simbol yang diinginkan, maka akan
                            muncul keterangan pada simbol tersebut.<br><br>
                            <div class="text-center">
                                <img src="../assets/images/tutorial/output-3.png" alt="">
                            </div>
                            <br><br>Selain tabel perhitungan, terdapat tabel statistik soal yang terdapat pada aplikasi,
                            tujuan adanya tabel ini agar admin
                            mengetahui soal yang telah dikerjakan oleh peserta ujian.<br><br>
                            <div class="text-center">
                                <img src="../assets/images/tutorial/output-4.png" alt=""><br><br>
                                <img src="../assets/images/tutorial/output-5.png" alt="">
                            </div>
                            <br><br>Terdapat pula grafik kesulitan soal dan grafik skor. Grafik kesulitan terhadap nomor
                            soal menggambarkan siswa telah
                            mengerjakan soal-soal yang dapat digambarkan dengan grafik soal yang memiliki kesulitan
                            tertentu. sedangkan grafik skor
                            menggambarkan peningkatan atau penurunan skor yang telah didapat oleh siswa.<br><br>
                            Apabila kursor diarahkan pada titik tertentu maka akan ditampilkan tingkat kesulitan atau
                            skor dan tipe soal yang
                            dikerjakan pada soal ke-i. sedangkan garis lurus yang tertera pada grafik menunjukkan
                            kemampuan siswa sebenarnya.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#langkah-mengerjakan" aria-expanded="true" aria-controls="langkah-mengerjakan">
                                Prosedur Pengerjaan Tes
                            </button>
                        </h2>
                    </div>

                    <div id="langkah-mengerjakan" class="collapse" aria-labelledby="headingOne" data-parent="#tutorial">
                        <div class="card-body text-justify">
                            Langkah-langkah mengerjakan tes pada sistem CAT<br>
                            <ol class="mt-2">
                                <li>Peserta tes memasukkan Username dan Password kemudian Klik tombol Submit</li>
                                <li>Periksa data diri Anda di tampilan Dashboard</li>
                                <li>Pilih Daftar Test pada menu navigasi</li>
                                <li>Pilih Tes yang akan dikerjakan lalu klik kerjakan</li>
                                <li>Pahami petunjuk dan waktu per soal yang tertera lalu Klik Kerjakan maka soal akan
                                    ditampilkan</li>
                                <li>Soal akan tertampil dengan tingkat kesulitan sedang dan waktu per soal. Apabila
                                    waktu
                                    habis maka soal akan di anggap
                                    salah</li>
                                <li>Pilih jawaban yang paling benar lalu Klik Selanjutnya. Soal tidak dapat dikembalikan
                                    sebelumnya sehingga Peserta
                                    harus yakin dengan jawaban yang dipilih</li>
                                <li>Apabila soal yang dijawab benar maka soal yang akan tertampil selanjutnya akan
                                    semakin sukar. Apabila soal yang
                                    dijawab salah maka soal yang akan tertampil selanjutnya akan semakin mudah dari soal
                                    sebelumnya.</li>
                                <li>Tes akan berhenti apabila stopping rule tercapai dan akan tertampil “Test telah
                                    selesai. Silahkan klik tombol
                                    Selanjutnya”</li>
                                <li> Pilih Selanjutnya maka hasil akan tertampil. Output berupa Grafik, Statistik soal
                                    dan Skor.</li>
                                Apabila ingin melihat riwayat tes maka Pilih Lihat Riwayat Soal.
                                <li> Pilih Lanjutkan maka otomatis akan Log Out website</li>
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