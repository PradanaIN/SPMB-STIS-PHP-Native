<?php
/* ==================== SESSION ==================== */
// start session
session_start();
// cek session 
if (!isset($_SESSION["pengawas"])) {
    // session "pengawas" = false, arahkan ke login 
    header("Location: ../login.php");
    exit;
}

/* ==================== FUNCTION ==================== */
require '../static/php/functions.php';

/* ================= SESSION DATA =================== */
$username = $_SESSION["username"];
$pengawas = query("SELECT * FROM pengawas WHERE username = '$username'");

/* ================ TAMBAH LAPORAN ================== */
// Pengecekan ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    if (tambah_laporan($_POST) > 0) {
        // Apabila data berhasil ditambahkan
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'laporan.php';
            </script>
        ";
    } else {
        // Apabila data gagal ditambahkan
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'laporan.php';
            </script>
        ";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/img/logo.png">
    <title>Laporan</title>
    <link rel="stylesheet" href="../static/css/sidebar.css">
    <link rel="stylesheet" href="../static/css/laporan-upload.css">
    <link rel="stylesheet" href="../static/css/upload.css">
</head>
<body>
    <!-- Sidebar : navigasi halaman lainnya -->
    <div class="sidebar">
        <div class="logo-details">
            <img src="../static/img/logo.png">
            <div class="logo-name">
                SPMB
                <p>POLITEKNIK STATISTIKA STIS</p>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="dashboard.php">
                    <i class="fa-solid fa-house"></i>
                    <span class="links-name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="daftar-pengawas.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="links-name">Pengawas</span>
                </a>
                <span class="tooltip">Pengawas</span>
            </li>
            <li>
                <a href="daftar-peserta.php">
                    <i class="fa-solid fa-user"></i>
                    <span class="links-name">Peserta</span>
                </a>
                <span class="tooltip">Peserta</span>
            </li>
            <li>
                <a href="jadwal.php">
                    <i class="fa-solid fa-calendar-alt"></i>
                    <span class="links-name">Jadwal</span>
                </a>
                <span class="tooltip">Jadwal</span>
            </li>
            <li>
                <a href="laporan.php">
                    <i class="fa-solid fa-file-alt"></i>
                    <span class="links-name">Laporan</span>
                </a>
                <span class="tooltip">Laporan</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                <?php foreach ($pengawas as $row) : ?>
                    <div class="name_status">
                        <div class="name"><?= $row["nama"]; ?></div>
                        <div class="status"><?= $row["status"]; ?></div>
                    </div>
                <?php endforeach; ?>
                </div>
                <a href="../logout.php" id="logout">
                    <i class="fa-solid fa-sign-out-alt" id="logout"></i>
                    <span class="tooltip">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Section : konten yang ditampilkan -->
    <section>
        <div class="container">
            <!-- Header : judul halaman dan akun aktif pengguna -->
            <div class="header">
                <h3>Laporan</h3>
                <?php foreach ($pengawas as $row) : ?>
                <div class="user-profile">
                    <div class="status">
                        <h4><?= $row["nama"]; ?></h4>
                        <p><?= $row["status"]; ?></p>
                    </div>
                    <div class="photo">
                        <img src="../static/img/pengawas/<?= $row['gambar']; ?>" width=50>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="content">
                <form action="#" method="post" enctype="multipart/form-data" id="form-upload">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detail Pelaksanaan Tes</span>
                            <div class="fields">
                                <?php foreach ($pengawas as $row) : ?>
                                <div class="input-field">
                                    <label>Nama Pengawas</label>
                                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="<?= $row["nama"]; ?>" required>
                                </div>

                                <div class="input-field">
                                    <label>Nomor Induk Pegawai</label>
                                    <input type="text" id="nip" name="nip"  placeholder="Masukkan NIP" value="<?= $row["username"]; ?>"  required>
                                </div>
                                <?php endforeach; ?>
                                <div class="input-field">
                                    <label>Tanggal Tes</label>
                                    <input type="date" name="tanggal_tes" id="tanggal_tes" required>
                                </div>


                                <div class="input-field">
                                    <label>Tahap Tes</label>
                                    <select id="tahap_tes" name="tahap_tes" required>
                                        <option value="" disabled selected>Pilih Tahap Tes</option>
                                        <option value="Tahap 1">Tahap 1</option>
                                        <option value="Tahap 2">Tahap 2</option>
                                        <option value="Tahap 3">Tahap 3</option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <label>Lokasi Tes</label>
                                    <select id="lokasi_tes" name="lokasi_tes" required>
                                        <option value="" disabled selected>Pilih Lokasi Tes</option>
                                        <option value="Zoom 001">Zoom 001</option>
                                        <option value="Zoom 002">Zoom 002</option>
                                        <option value="Zoom 003">Zoom 003</option>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label>Sesi Tes</label>
                                    <select id="sesi_tes" name="sesi_tes" required>
                                        <option value="" disabled selected>Pilih Sesi Tes</option>
                                        <option value="Sesi 1">Sesi 1</option>
                                        <option value="Sesi 2">Sesi 2</option>
                                        <option value="Sesi 3">Sesi 3</option>
                                    </select>
                                </div>

                            </div>
                            
                            <span class="title">Upload Laporan Tes</span>
                            <div class="fields">
                                <div class="wrapper">
                                    <input class="file-input" id="input-file" type="file" name="file" hidden>
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p>Klik Dua Kali Untuk Memilih File</p>
                                </div>
                                <div id="section" class="progress-area"></div>
                                <div id="section" class="uploaded-area"></div>
                            </div>
                        </div>

                        <div class="buttons">
                                    <input type="reset" class="reset" id="button" name="reset" value="Batal" onclick="location.href='dashboard.php'"></input>

                                    
                                    <input type="submit" class="submit" id="button" name="submit" value="Upload"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="../static/js/script.js"></script>
    <script src="../static/js/upload.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6265d9d0e3.js" crossorigin="anonymous"></script>
</body>
</html>