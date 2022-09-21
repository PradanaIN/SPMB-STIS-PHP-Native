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

/* =================== QUERY DATA =================== */
$peserta = query("SELECT * FROM peserta");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/img/logo.png">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../static/css/sidebar.css">
    <link rel="stylesheet" href="../static/css/dashboard-pengawas.css">
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
                <h3>Dashboard</h3>
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
            <!-- Calendar : jadwal (import google calendar)  -->
            <div class="calendar">
                <iframe src="https://calendar.google.com/calendar/embed?height=350&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FJakarta&showCalendars=0&showTz=0&showTabs=0&showPrint=0&showTitle=0&showNav=0&src=MjIyMDExNDM2QHN0aXMuYWMuaWQ&src=Y19jbGFzc3Jvb21kYzU5MGMzZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21hYWUyY2JjYkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb201Njg2NDQyZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20xNTRkNTdiZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb204NDQ5YWM5M0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21jMGJjZWM4M0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21iYjllODQ5Y0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb202MGY4MjhjN0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21jMWQyNmIyMkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21hODk3MjY4OUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20yMjMyMThjN0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&src=Y19jbGFzc3Jvb21jNjM1ODEwZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20xYTJiNWM3Y0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb201ZDY0OWJiNEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb20wOThmZWE4YkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb205NDdiNWZhYkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%230047a8&color=%230047a8&color=%2333B679&color=%230047a8&color=%23137333&color=%230047a8&color=%23c26401&color=%230047a8&color=%23c26401&color=%23007b83&color=%230047a8&color=%23202124&color=%230B8043&color=%23202124&color=%23137333&color=%230047a8&color=%23137333&color=%23137333" style="border-width:0" frameborder="0" scrolling="no"></iframe>
            </div>
            <!-- Task : ringkasan task user -->
            <div class="task">
                <ul>
                    <li>
                        <div class="task-box">
                            <div class="task-border">
                            </div>
                            <div class="task-content">
                                <div class="task-title">
                                    <h4>Rapat Pembukaan SPMB 2023</h4>
                                    <p>Zoom Meeting</p>
                                </div>
                                <div class="task-icon">
                                    <i class="fa-solid fa-calendar">
                                        <span>20 Maret 2023</span>
                                    </i>
                                    <i class="fa-solid fa-clock">
                                        <span>08.00 - 10.00</span>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="task-box">
                            <div class="task-border">
                            </div>
                            <div class="task-content">
                                <div class="task-title">
                                    <h4>Pengawas Ujian Tahap 1</h4>
                                    <p>Zoom Meeting</p>
                                </div>
                                <div class="task-icon">
                                    <i class="fa-solid fa-calendar">
                                        <span>21 Maret 2023</span>
                                    </i>
                                    <i class="fa-solid fa-clock">
                                        <span>08.00 - 10.00</span>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="task-box">
                            <div class="task-border">
                            </div>
                            <div class="task-content">
                                <div class="task-title">
                                    <h4>Pengawas Ujian Tahap 2</h4>
                                    <p>Zoom Meeting</p>
                                </div>
                                <div class="task-icon">
                                    <i class="fa-solid fa-calendar">
                                        <span>05 April 2023</span>
                                    </i>
                                    <i class="fa-solid fa-clock">
                                        <span>13.00 - 15.00</span>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <!-- button more -->
                        <a id="button" href="jadwal.php">
                            <button type="submit">
                                Tampilkan Lebih Banyak
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Right Menu : Shortcut daftar peserta dan pesan -->
            <div class="shortcut">
                <div class="peserta-shortcut">
                    <div class="peserta-header">
                        <div class="daftar-peserta">
                            <h3>Daftar Peserta</h3>
                            <p><?php echo count($peserta);?> Peserta Tahap Ini</p>
                        </div>
                    </div>
                    <div class="peserta-content">
                        <ul>
                            <?php foreach (array_slice($peserta, 0, 7) as $row) : ?>
                            <li>
                                <div class="peserta-profile">
                                    <div class="peserta-image">
                                        <img src="../static/img/peserta/<?= $row['gambar']; ?>" width=50>
                                    </div>
                                    <div class="peserta-id">
                                        <h4><?= $row['nama']; ?></h4>
                                        <p><?= $row['formasi']; ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="btn">
                            <!-- button more -->
                                <a id="button" href="daftar-peserta.php">
                                    <button type="submit">
                                            Tampilkan Lebih Banyak
                                    </button>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="../static/js/script.js"></script>
    <script src="https://kit.fontawesome.com/6265d9d0e3.js" crossorigin="anonymous"></script>
</body>
</html>