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

/* =================== SEARCHING ==================== */
if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
}
else{
    $keyword = '';
}


/* =================== PAGINATION =================== */
// Konfigurasi Pagination
$jumlahDataPerHalaman=5;
$jumlahData=count(query("SELECT * FROM peserta WHERE nama LIKE '%$keyword%' 
                            OR nik LIKE '%$keyword%' OR prodi LIKE '%$keyword%' 
                            OR formasi LIKE '%$keyword%' OR
                            id LIKE '%$keyword%'OR tahap_1 LIKE '%$keyword%'"));
$jumlahHalaman=ceil($jumlahData/$jumlahDataPerHalaman);
$halamanAktif=(isset($_GET["halaman"])) ? $_GET["halaman"] : 1; 
$awalData= ($jumlahDataPerHalaman*$halamanAktif)-$jumlahDataPerHalaman;

// Konfigurasi jumlah link pagination yang dimunculkan
$jumlahLink= 1;
if($halamanAktif > $jumlahLink) {
    $start_number = $halamanAktif - $jumlahLink;
} else {
    $start_number = 1;
}

if($halamanAktif < ($jumlahHalaman - $jumlahLink)) {
    $end_number = $halamanAktif + $jumlahLink;
} else {
    $end_number = $jumlahHalaman;
}

// Query data peserta
$peserta = query("SELECT * FROM peserta WHERE nama LIKE '%$keyword%' 
                    OR nik LIKE '%$keyword%' OR prodi LIKE '%$keyword%' 
                    OR formasi LIKE '%$keyword%'  OR
                    id LIKE '%$keyword%'OR tahap_1 LIKE '%$keyword%'
                    LIMIT $awalData, $jumlahDataPerHalaman");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/img/logo.png">
    <title>Daftar Peserta</title>
    <link rel="stylesheet" href="../static/css/sidebar.css">
    <link rel="stylesheet" href="../static/css/daftar-peserta.css">
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
                <div class="top">
                <h3>Daftar Peserta</h3>
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
                <div class="bottom">
                    <form class="search" method="post">
                        <!-- icon search -->
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" placeholder="Cari" name="keyword" autocomplete="off" id="keyword">
                    </form>
                </div>
            </div>
            <!-- Content : tabel daftar peserta spmb -->
            <div class="content" id="content">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th></th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Formasi</th>
                            <th>Nomor Tes</th>
                            <th>Tanggal Tes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $awalData + 1; ?>
                        <?php foreach ($peserta as $row) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="../static/img/peserta/<?= $row['gambar']; ?>"></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['prodi']; ?></td>
                            <td><?= $row['formasi']; ?></td>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['tahap_1']; ?></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="pagination">
                <?php if ($halamanAktif>1): ?>
                    <a href="?halaman=<?= $halamanAktif-1; ?>" class="previous"><i class="fa fa-angle-left"></i></a>
                <?php endif; ?>
                <?php for ($i=$start_number; $i <=$end_number ; $i++) : ?>
                    <?php if ($i==$halamanAktif): ?>
                        <a href="?halaman=<?= $i; ?>" class="btn" style="background-color: #303972; color: white;"><?= $i; ?></a>	
                    <?php else : ?>
                        <a href="?halaman=<?= $i; ?>"  class="btn"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($halamanAktif<$jumlahHalaman): ?>
                    <a href="?halaman=<?= $halamanAktif+1; ?>" class="next"><i class="fa fa-angle-right"></i></a>
                <?php endif; ?>
            </div>
    </section>

    <!-- JavaScript -->
    <script src="../static/js/script.js"></script>
    <script src="../static/js/peserta2.js"></script>
    <script src="https://kit.fontawesome.com/6265d9d0e3.js" crossorigin="anonymous"></script>
</body>
</html>