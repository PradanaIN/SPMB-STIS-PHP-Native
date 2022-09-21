<?php
/* ==================== SESSION ==================== */
// start session
session_start();

/* ==================== FUNCTION ==================== */
require 'static/php/functions.php';

/* ======== PENGECEKAN COOKIE HISTORY LOGIN ========= */
if (isset($_COOKIE['id']) && isset($_COOKIE['pengawas'])) {
    // Mengecek cookie untuk pengawas
    $id = $_COOKIE['id'];
    $login = $_COOKIE['pengawas'];

    // mendapatkan data username pengawas dari database
    $result = mysqli_query($conn, "SELECT username FROM pengawas WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username pengawas
    if ($login === hash('sha256', $row['username'])) {
        $_SESSION['pengawas']  = true;
    }

} else if (isset($_COOKIE['id']) && isset($_COOKIE['admin'])) {
    // Mengecek cookie untuk pengawas
    $id = $_COOKIE['id'];
    $login = $_COOKIE['admin'];

    // mendapatkan data username admin dari database
    $result = mysqli_query($conn, "SELECT username FROM admin WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username admin
    if ($login === hash('sha256', $row['username'])) {
        $_SESSION['admin']  = true;
    }
}


/* ======== PENGECEKAN SESSION HISTORY LOGIN ======== */
    if (isset($_SESSION["pengawas"])) {
        // session "pengawas" = true, arahkan ke dashboard pengawas 
        header("Location: pengawas/dashboard.php");
        exit;
    } else if (isset($_SESSION["admin"])) {
        // session "admin" = true, arahkan ke dashboard admin
        header("Location: admin/dashboard.php");
        exit;
    }

/* ========= APABILA BARU MELAKUKAN LOGIN ========== */
if (isset($_POST['login'])) {
    // Mendapatkan inputan username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // AUTHENTICATION
    // 1. Query data pengawas berdasarkan input username
    $result = mysqli_query($conn, "SELECT * FROM pengawas WHERE username = '$username'");
    // 2. Query data admin berdasarkan input username
    $result2 = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    // Pengecekan kecocokan data input dengan data di database
    if (mysqli_num_rows($result) === 1 && mysqli_num_rows($result2) === 0) {
        // 1. Pengecekan untuk Pengawas
        // Cek input password pengawas
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // AUTHORIZATION 
            // 1. Session untuk pengawas
            $_SESSION['pengawas'] = true;
            $_SESSION['username'] = $username;
            // 2. Cookie untuk pengawas
            if (isset($_POST['login'])) {
                // Set cookie selama satu hari (customable)
                setcookie('id', $row['id'], time() + 86400);
                setcookie('pengawas', hash('sha256', $row['nip'] ), time() + 86400);
            }
            // 3. Redirect ke halaman dashboard pengawas
            header("Location: pengawas/dashboard.php");
            exit;
        }
    } elseif (mysqli_num_rows($result2) === 1 && mysqli_num_rows($result) === 0) {
        // 1. Pengecekan untuk Admin
        // Cek input password admin
        $row = mysqli_fetch_assoc($result2);
        if ($password === $row['password']) {
            // AUTHORIZATION 
            // 1. Session untuk admin
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            // 2. Cookie untuk admin
            if (isset($_POST['login'])) {
                // Set cookie selama satu hari (customable)
                setcookie('id', $row['id'], time() + 86400);
                setcookie('admin', hash('sha256', $row['username'] ), time() + 86400);
            }
            // 3. Redirect ke halaman dashboard admin
            header("Location: admin/dashboard.php");
            exit;
        }
    }  
    
    // Jika login gagal
    echo "<script>
            alert('Username atau Password Salah!');
        </script>";
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/img/logo.png">
    <title>SPMB Politeknik Statistika STIS</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body{
            margin: 0;
            padding: 0;
            background: #2980b9;
            height: 100vh;
            overflow: hidden;
            }
        .center{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 350px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
            }

        .center .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0; 
        }
        .center .logo-details img {
            width: 60px;
            height: 60px;
            transition: all 0.5s ease;
        }
        .center .logo-details .logo-name {
            margin-left: 10px;
            color: black;
            font-size: 25px;
            font-weight: 600;
            transition: all 0.5s ease;
        }
        .center .logo-details .logo-name p {
            color: black;
            font-size: 12px;
            transition: all 0.5s ease;
        }
        .center form{
            padding: 0 40px;
            box-sizing: border-box;
            border-top: 1px solid silver;
        }
        form .txt_field{
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
        }
        .txt_field input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }
        .txt_field label{
            position: absolute;
            top: 50%;
            left: 5px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
        }       
        .txt_field span::before{
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: .5s;
        }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
            top: -5px;
            color: #2691d9;
        }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
            width: 100%;
        }
        .pass{
            margin: 0px 0 20px 5px;
            color: #a6a6a6;
            cursor: pointer;
        }
        .pass:hover{
            text-decoration: underline;
        }
        input[type="submit"]{
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }
        input[type="submit"]:hover{
            border-color: #2691d9;
            transition: .5s;
        }

        @media screen and (max-width: 578px) {
            .center{
                width: 300px;
                height: 300px;
            }
            .center .logo-details {
                height: 40px;
                margin: 10px 0; 
            }
            .center .logo-details img {
                width: 40px;
                height: 40px;
            }
            .center .logo-details .logo-name {
                font-size: 15px;
            }
            .center .logo-details .logo-name p {
                font-size: 10px;
            }
            .center form{
                padding: 0 20px;
            }
            form .txt_field{
                margin: 30px 0;
            }
            .txt_field input{
                height: 30px;
                font-size: 14px;
            }
            .txt_field label{
                top: 50%;
                left: 0;
                font-size: 14px;
            }
            .txt_field span::before{
                top: 30px;
            }
            .txt_field input:focus ~ label,
            .txt_field input:valid ~ label{
                top: -5px;
                color: #2691d9;
            }
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="logo-details">
            <img src="https://stis.ac.id/media/source/up.png">
            <div class="logo-name">
                SPMB
                <p>POLITEKNIK STATISTIKA STIS</p>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <form method="post">
        <div class="txt_field">
            <input type="text" name="username" required>
            <span></span>
            <label>Username</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" required>
            <span></span>
            <label>Password</label>
        </div>
        <input type="submit" value="Login" name="login" id="login">
        </form>
    </div>
</body>
</html>