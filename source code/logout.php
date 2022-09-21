<?php
/* ==================== SESSION ==================== */
// start session
session_start();
// mengakhiri session
$_SESSION = [];
session_unset();
session_destroy();

/* ==================== COOKIE ==================== */
// Menghapus cookie
setcookie('id', '', time() - 86400);
setcookie('pengawas', '', time() - 86400);
setcookie('admin', '', time() - 86400);

// Redirect ke halaman login
header("Location: login.php");

?>