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

/* ================ DOWNLOAD FILE =================== */
if(!empty($_GET['file'])) {
	// Mendapatkan nama file
	$namaFile = basename($_GET['file']);
	// Mendapatkan direktori file
	$filepath = '../static/php/files/' . $namaFile;
	
	// Pengecekan apabila nama dan direktori file benar
	if (!empty($namaFile) && file_exists($filepath)) {
		//Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$namaFile");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");

		readfile($filepath);
		exit;

	} else {
		// Apabila file atau direktori tidak ada
		echo "<script>
            alert('File tidak tersedia!');
			window.location.href = 'laporan.php';
        </script>";
	}
}

?>