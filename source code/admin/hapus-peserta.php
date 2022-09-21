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

/* ================= HAPUS PENGAWAS ================= */
// Mendapatkan id peserta dari database
$id = $_GET["id"];

if (hapus_peserta($id) > 0) {
    // Apabila data berhasil dihapus
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'daftar-peserta.php';
        </script>
    ";
} else {
    // Apabila data gagal dihapus
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'daftar-peserta.php';
        </script>
    ";
}

?>