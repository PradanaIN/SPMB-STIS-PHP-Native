<?php
// start session
session_start();
// cek session 
if (!isset($_SESSION["login"])) { 
    header("Location: login.php");
    exit;
}

?>