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

/* ================= EDIT PENGAWAS ================== */
// Mendapatkan id pengawas dari database
$id = $_GET["id"];
// Query data untuk 1 data id terpilih
$pengawas = query("SELECT * FROM pengawas WHERE id = $id")[0];

// Pengecekan ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    if (edit_pengawas($_POST) > 0) {
        // Apabila data berhasil diubah
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'daftar-pengawas.php';
            </script>
        ";
    } else {
        // Apabila data gagal diubah
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'daftar-pengawas.php';
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
    <title>Edit Pengawas</title>
    <link rel="stylesheet" href="../static/css/sidebar.css">
    <link rel="stylesheet" href="../static/css/tambah-pengawas.css">
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
                <h3>Edit Pengawas</h3>
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

                    <input type="hidden" name="id" value="<?= $pengawas["id"]; ?>">
                    <!-- mengirim image lama bila user tidak ganti image -->
                    <input type="hidden" name="gambarLama" value="<?= $pengawas["gambar"]; ?>">

                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Data Diri Pengawas</span>
        
                            <div class="fields">

                                <div class="input-field">
                                    <label>Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required value="<?= $pengawas["nama"]; ?>">
                                </div>

                                <div class="input-field">
                                    <label>Status</label>
                                    <select id="status" name="status" required value="<?= $pengawas["status"]; ?>">
                                        <option disabled selected>Pilih Status</option>
                                        <option value="Pengawas SPMB">Pengawas SPMB</option>
                                        <option value="Panitia SPMB">Panitia SPMB</option>
                                    </select>
                                </div>
        
                                <div class="input-field">
                                    <label>Alamat Kantor</label>
                                    <select name="alamat" id="alamat" required value="<?= $pengawas["alamat"]; ?>">
                                        <option disabled selected>Pilih Alamat Kantor</option>
                                        <option value="Politeknik Statistika STIS">Politeknik Statistika STIS</option>
                                        <option value="BPS Pusat">BPS Pusat</option>
                                        <option value="BPS Aceh">BPS Aceh</option>
                                        <option value="BPS Sumatera Utara">BPS Sumatera Utara</option>
                                        <option value="BPS Sumatera Barat">BPS Sumatera Barat</option>
                                        <option value="BPS Riau">BPS Riau</option>
                                        <option value="BPS Jambi">BPS Jambi</option>
                                        <option value="BPS Sumatera Selatan">BPS Sumatera Selatan</option>
                                        <option value="BPS Bengkulu">BPS Bengkulu</option>
                                        <option value="BPS Lampung">BPS Lampung</option>
                                        <option value="BPS Banten">BPS Banten</option>
                                        <option value="BPS DKI Jakarta">BPS DKI Jakarta</option>
                                        <option value="BPS Jawa Barat">BPS Jawa Barat</option>
                                        <option value="BPS Jawa Tengah">BPS Jawa Tengah</option>
                                        <option value="BPS Jawa Timur">BPS Jawa Timur</option>
                                        <option value="BPS DI Yogyakarta">BPS DI Yogyakarta</option>
                                        <option value="BPS Bali">BPS Bali</option>
                                        <option value="BPS Nusa Tenggara Barat">BPS Nusa Tenggara Barat</option>
                                        <option value="BPS Nusa Tenggara Timur">BPS Nusa Tenggara Timur</option>
                                        <option value="BPS Kalimantan Barat">BPS Kalimantan Barat</option>
                                        <option value="BPS Kalimantan Tengah">BPS Kalimantan Tengah</option>
                                        <option value="BPS Kalimantan Selatan">BPS Kalimantan Selatan</option>
                                        <option value="BPS Kalimantan Timur">BPS Kalimantan Timur</option>
                                        <option value="BPS Kalimantan Utara">BPS Kalimantan Utara</option>
                                        <option value="BPS Sulawesi Utara">BPS Sulawesi Utara</option>
                                        <option value="BPS Sulawesi Tengah">BPS Sulawesi Tengah</option>
                                        <option value="BPS Sulawesi Selatan">BPS Sulawesi Selatan</option>
                                        <option value="BPS Sulawesi Tenggara">BPS Sulawesi Tenggara</option>
                                        <option value="BPS Sulawesi Barat">BPS Sulawesi Barat</option>
                                        <option value="BPS Gorontalo">BPS Gorontalo</option>
                                        <option value="BPS Sulawesi Barat">BPS Sulawesi Barat</option>
                                        <option value="BPS Maluku">BPS Maluku</option>
                                        <option value="BPS Maluku Utara">BPS Maluku Utara</option>
                                        <option value="BPS Papua Barat">BPS Papua Barat</option>
                                        <option value="BPS Papua">BPS Papua</option>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label>Nomor Induk Pegawai</label>
                                    <input type="text" id="nip" name="nip"  placeholder="Masukkan NIP" required value="<?= $pengawas["username"]; ?>">
                                </div>

                                <div class="input-field">
                                    <label>Password</label>
                                    <input type="text" id="password" name="password" placeholder="Masukkan password" required value="<?= $pengawas["password"]; ?>">
                                </div>

                                <div class="input-field">
                                    <label for="photo">Pas Foto</label>
                                    <div class="input-photo">
                                        <input type="file" id="gambar" name="gambar" value="Pilih foto" value="<?= $pengawas["gambar"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="details ID">
                            <span class="title">Detail Pelaksanaan Tes</span>
                            
                            <div class="fields">

                                <div class="input-field">
                                    <label>Jadwal Tes Tahap 1</label>
                                    <input type="date" name="tahap_1" id="tahap_1" value="<?= $pengawas["tahap_1"]; ?>">
                                </div>

                                <div class="input-field">
                                    <label>Jadwal Tes Tahap  2</label>
                                    <input type="date" name="tahap_2" id="tahap_2" value="<?= $pengawas["tahap_2"]; ?>">
                                </div>

                                <div class="input-field">
                                    <label>Jadwal Tes Tahap  3</label>
                                    <input type="date" name="tahap_3" id="tahap_3" value="<?= $pengawas["tahap_3"]; ?>">
                                </div>

                                <div class="input-field">
                                    <label>Lokasi Tes Tahap 1</label>
                                    <select id="lokasi_1" name="lokasi_1" value="<?= $pengawas["lokasi_1"]; ?>">
                                        <option disabled selected>Pilih Lokasi</option>
                                        <option value="Zoom 001 - Sesi 1">Zoom 001 - Sesi 1</option>
                                        <option value="Zoom 001 - Sesi 2">Zoom 001 - Sesi 2</option>
                                        <option value="Zoom 001 - Sesi 3">Zoom 001 - Sesi 3</option>
                                        <option value="Zoom 002 - Sesi 1">Zoom 002 - Sesi 1</option>
                                        <option value="Zoom 002 - Sesi 2">Zoom 002 - Sesi 2</option>
                                        <option value="Zoom 002 - Sesi 3">Zoom 002 - Sesi 3</option>
                                        <option value="Zoom 003 - Sesi 1">Zoom 003 - Sesi 1</option>
                                        <option value="Zoom 003 - Sesi 2">Zoom 003 - Sesi 2</option>
                                        <option value="Zoom 003 - Sesi 3">Zoom 003 - Sesi 3</option>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label>Lokasi Tes Tahap  2</label>
                                    <select id="lokasi_2" name="lokasi_2" value="<?= $pengawas["lokasi_2"]; ?>">
                                        <option disabled selected>Pilih Lokasi</option>
                                        <option value="Zoom 001 - Sesi 1">Zoom 001 - Sesi 1</option>
                                        <option value="Zoom 001 - Sesi 2">Zoom 001 - Sesi 2</option>
                                        <option value="Zoom 001 - Sesi 3">Zoom 001 - Sesi 3</option>
                                        <option value="Zoom 002 - Sesi 1">Zoom 002 - Sesi 1</option>
                                        <option value="Zoom 002 - Sesi 2">Zoom 002 - Sesi 2</option>
                                        <option value="Zoom 002 - Sesi 3">Zoom 002 - Sesi 3</option>
                                        <option value="Zoom 003 - Sesi 1">Zoom 001 - Sesi 1</option>
                                        <option value="Zoom 003 - Sesi 2">Zoom 003 - Sesi 2</option>
                                        <option value="Zoom 003 - Sesi 3">Zoom 003 - Sesi 3</option>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label>Lokasi Tes Tahap  3</label>
                                    <select id="lokasi_3" name="lokasi_3" value="<?= $pengawas["lokasi_3"]; ?>">
                                        <option disabled selected>Pilih Lokasi</option>
                                        <option value="Zoom 001 - Sesi 1">Zoom 001 - Sesi 1</option>
                                        <option value="Zoom 001 - Sesi 2">Zoom 001 - Sesi 2</option>
                                        <option value="Zoom 001 - Sesi 3">Zoom 001 - Sesi 3</option>
                                        <option value="Zoom 002 - Sesi 1">Zoom 002 - Sesi 1</option>
                                        <option value="Zoom 002 - Sesi 2">Zoom 002 - Sesi 2</option>
                                        <option value="Zoom 002 - Sesi 3">Zoom 002 - Sesi 3</option>
                                        <option value="Zoom 003 - Sesi 1">Zoom 001 - Sesi 1</option>
                                        <option value="Zoom 003 - Sesi 2">Zoom 003 - Sesi 2</option>
                                        <option value="Zoom 003 - Sesi 3">Zoom 003 - Sesi 3</option>
                                    </select>
                                </div>

                            </div>


                        </div>
                        <div class="buttons">
                            <input type="reset" class="reset" id="button" name="reset" value="Batal" onclick="location.href='daftar-pengawas.php'"></input>

                            <input type="submit" class="submit" id="button" name="submit" value="Tambah"></input>
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