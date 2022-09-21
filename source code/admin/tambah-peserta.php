<?php
/* ==================== SESSION ==================== */
// start session
session_start();
// cek session 
if (!isset($_SESSION["admin"])) {
    // session "admin" = false, arahkan ke login 
    header("Location: ../login.php");
    exit;
}

/* ==================== FUNCTION ==================== */
require '../static/php/functions.php';

/* ================= SESSION DATA =================== */
$username = $_SESSION["username"];
$admin = query("SELECT * FROM admin WHERE username = '$username'");

/* ================ TAMBAH PESERTA ================== */
// Pengecekan ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    if (tambah_peserta($_POST) > 0) {
        // Apabila data berhasil ditambahkan
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'daftar-peserta.php';
            </script>
        ";
    } else {
        // Apabila data gagal ditambahkan
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'tambah-peserta.php';
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
    <title>Tambah Peserta</title>
    <link rel="stylesheet" href="../static/css/sidebar.css">
    <link rel="stylesheet" href="../static/css/tambah-peserta.css">
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
                <?php foreach ($admin as $row) : ?>
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
                <h3>Tambah Peserta</h3>
                <?php foreach ($admin as $row) : ?>
                <div class="user-profile">
                    <div class="status">
                        <h4><?= $row["nama"]; ?></h4>
                        <p><?= $row["status"]; ?></p>
                    </div>
                    <div class="photo">
                        <img src="../static/img/<?= $row['gambar']; ?>" width=50>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="content">
                <form method="post" enctype="multipart/form-data">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Data Diri Peserta</span>
        
                            <div class="fields">

                                <div class="input-field">
                                    <label>Nomor Induk Kependudukan</label>
                                    <input type="text" id="nik" name="nik"  placeholder="masukkan NIK" required>
                                </div>

                                <div class="input-field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="input-field">
                                    <label>Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
        
                                <div class="input-field">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir" required>
                                </div>
        
                                <div class="input-field">
                                    <label>Alamat</label>
                                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat" required>
                                </div>

                                <div class="input-field">
                                    <label for="photo">Pas Foto</label>
                                    <div class="input-photo">
                                        <input type="file" id="gambar" name="gambar" value="Pilih foto" required>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="details ID">
                            <span class="title">Detail Pelaksanaan Tes</span>
        
                            <div class="fields">
                                <div class="input-field">
                                    <label>Nomor Tes</label>
                                    <input type="text" id="nomor_test" name="id" placeholder="Masukkan nomor tes">
                                </div>
        
                                <div class="input-field">
                                    <label>Prodi</label>
                                    <select name="prodi" id="prodi" required>
                                        <option disabled selected>Pilihan prodi</option>
                                        <option value="D3 Statistika">D3 Statistika</option>
                                        <option value="D4 Statistika">D4 Statistika</option>
                                        <option value="D4 Komputasi Statistik">D4 Komputasi Statistik</option>
                                    </select>
                                </div>
        
                                <div class="input-field">
                                    <label>Plihan Formasi</label>
                                    <select name="formasi" id="formasi" required>
                                        <option disabled selected>Pilihan formasi</option>
                                        <option value="BPS Pusat">BPS Pusat</option>
                                        <option value="Aceh">Aceh</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Banten">Banten</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                    </select>
                                </div>
        
                                <div class="input-field">
                                    <label>Jadwal Tes Tahap 1</label>
                                    <input type="date" name="tahap_1" id="tahap_1" required>
                                </div>

                                <div class="input-field">
                                    <label>Jadwal Tes Tahap  2</label>
                                    <input type="date" name="tahap_2" id="tahap_2">
                                </div>

                                <div class="input-field">
                                    <label>Jadwal Tes Tahap  3</label>
                                    <input type="date" name="tahap_3" id="tahap_3">
                                </div>
                                
                                
                            </div>

                            <div class="buttons">

                                <input type="reset" class="reset" id="button" name="reset" value="Batal" onclick="location.href='daftar-peserta.php'"></input>

                                <input type="submit" class="submit" id="button" name="submit" value="Simpan"></input>

                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="../static/js/script.js"></script>
    <script src="https://kit.fontawesome.com/6265d9d0e3.js" crossorigin="anonymous"></script>
</body>
</html>