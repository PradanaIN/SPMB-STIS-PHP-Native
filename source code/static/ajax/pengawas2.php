<?php
/* ==================== FUNCTION ==================== */
require '../php/functions.php';

/* =================== SEARCHING ==================== */
$keyword = $_GET["keyword"];
// Menangkap output ajax untuk live search
$query = "SELECT * FROM pengawas
            WHERE nama LIKE '%$keyword%' OR
            alamat LIKE '%$keyword%'
            ";

$pengawas = query($query);

/* ==================== NOTE ==================== */
/*
* File ini merupakan Konfigurasi untuk live search
* Live search ini ditujukan untuk pengawas
*/
/* ==================== NOTE ==================== */

?>



            <div class="content">
                <!-- box card untuk profil daftar pengawas -->
                <div class="box-container">
                    <?php foreach ($pengawas as $row) : ?>
                    <div class="box">
                        <img src="../static/img/pengawas/<?= $row['gambar']; ?>">
                        <div class="details">
                            <div class="status">
                                <h4><?= $row['nama']; ?></h4>
                                <p><?= $row['alamat']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>