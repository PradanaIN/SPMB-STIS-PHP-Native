<?php
/* ========== KONEKSI KE DATABASE ========== */
$conn = mysqli_connect("localhost", "root", "", "spmb_stis");

/* ========== MENGAMBIL DATA DARI DATABASE ========== */
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

/* ========== TAMBAH PESERTA BARU ========== */
function tambah_peserta($data)
{
    global $conn;
    // data diri peserta
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $gambar = htmlspecialchars($data["gambar"]);
    // detail pelaksanaan tes
    // $nomor_tes = htmlspecialchars($data["nomor_tes"]);
    $prodi = htmlspecialchars($data["prodi"]);
    $formasi = htmlspecialchars($data["formasi"]);
    $tahap_1 = htmlspecialchars($data["tahap_1"]);
    $tahap_2 = htmlspecialchars($data["tahap_2"]);
    $tahap_3 = htmlspecialchars($data["tahap_3"]);

    // cek nik sudah ada atau belum
    $result = mysqli_query($conn, "SELECT * FROM peserta WHERE nik = '$nik'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('NIK sudah terdaftar!');
            </script>";
        return false;
    }

    // upload gambar
    $gambar = upload_gambar_peserta();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO peserta
                VALUES
                ('', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$nik', '$alamat', '$prodi', '$formasi', '$tahap_1', '$tahap_2', '$tahap_3', '$gambar')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

/* ========== TAMBAH PENGAWAS BARU ========== */
function tambah_pengawas($data)
{
    global $conn;
    // data diri pengawas
    $nama = htmlspecialchars($data["nama"]);
    $status = htmlspecialchars($data["status"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nip = htmlspecialchars($data["nip"]);
    $password = htmlspecialchars($data["password"]);
    $gambar = htmlspecialchars($data["gambar"]);
    // detail pelaksanaan tes
    $tahap_1 = htmlspecialchars($data["tahap_1"]);
    $lokasi_1 = htmlspecialchars($data["lokasi_1"]);
    $tahap_2 = htmlspecialchars($data["tahap_2"]);
    $lokasi_2 = htmlspecialchars($data["lokasi_2"]);
    $tahap_3 = htmlspecialchars($data["tahap_3"]);
    $lokasi_3 = htmlspecialchars($data["lokasi_3"]);

    // cek nip sudah ada atau belum
    $result = mysqli_query($conn, "SELECT * FROM pengawas WHERE username = '$nip'");
    
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('NIP sudah terdaftar!');
            </script>";
        return false;
    }

    // upload gambar
    $gambar = upload_gambar_pengawas();
    if (!$gambar) {
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query insert data
    $query = "INSERT INTO pengawas
                VALUES
                ('', '$nama', '$status', '$alamat', '$nip', '$password', '$gambar', '$tahap_1', '$lokasi_1' , '$tahap_2', '$lokasi_2', '$tahap_3', '$lokasi_3')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

/* ========== VALIDASI UPLOAD GAMBAR ========== */
function upload_gambar_peserta()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('File tidak sesuai format!');
            </script>";
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 3000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../static/img/peserta/' . $namaFileBaru);

    return $namaFileBaru;
}

function upload_gambar_pengawas()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('File tidak sesuai format!');
            </script>";
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 3000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../static/img/pengawas/' . $namaFileBaru);

    return $namaFileBaru;
}

/* ========== EDIT DATA PESERTA ========== */
function edit_peserta($data)
{
    global $conn;
    // data diri peserta
    $id = $data["id"];
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $gambar = htmlspecialchars($data["gambar"]);
    // detail pelaksanaan tes
    // $nomor_tes = htmlspecialchars($data["nomor_tes"]);
    $prodi = htmlspecialchars($data["prodi"]);
    $formasi = htmlspecialchars($data["formasi"]);
    $tahap_1 = htmlspecialchars($data["tahap_1"]);
    $tahap_2 = htmlspecialchars($data["tahap_2"]);
    $tahap_3 = htmlspecialchars($data["tahap_3"]);

    // upload gambar
    $gambar = upload_gambar_peserta();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "UPDATE peserta SET
                nik = '$nik',
                nama = '$nama',
                jenis_kelamin = '$jenis_kelamin',
                tanggal_lahir = '$tanggal_lahir',
                alamat = '$alamat',
                gambar = '$gambar',
                prodi = '$prodi',
                formasi = '$formasi',
                tahap_1 = '$tahap_1',
                tahap_2 = '$tahap_2',
                tahap_3 = '$tahap_3'
                WHERE id = '$id'";
    
    //mengeksekusi query
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

/* ========== EDIT DATA PENGAWAS ========== */
function edit_pengawas($data)
{
    global $conn;
    // data diri pengawas
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $status = htmlspecialchars($data["status"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nip = htmlspecialchars($data["nip"]);
    $password = htmlspecialchars($data["password"]);
    $gambar = htmlspecialchars($data["gambar"]);
    // detail pelaksanaan tes
    $tahap_1 = htmlspecialchars($data["tahap_1"]);
    $lokasi_1 = htmlspecialchars($data["lokasi_1"]);
    $tahap_2 = htmlspecialchars($data["tahap_2"]);
    $lokasi_2 = htmlspecialchars($data["lokasi_2"]);
    $tahap_3 = htmlspecialchars($data["tahap_3"]);
    $lokasi_3 = htmlspecialchars($data["lokasi_3"]);

    // upload gambar
    $gambar = upload_gambar_pengawas();
    if (!$gambar) {
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query insert data
    $query = "UPDATE pengawas SET
                nama = '$nama',
                status = '$status',
                alamat = '$alamat',
                username = '$nip',
                password = '$password',
                gambar = '$gambar',
                tahap_1 = '$tahap_1',
                lokasi_1 = '$lokasi_1',
                tahap_2 = '$tahap_2',
                lokasi_2 = '$lokasi_2',
                tahap_3 = '$tahap_3',
                lokasi_3 = '$lokasi_3'
                WHERE id = '$id'";

    //mengeksekusi query
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

/* ========== HAPUS DATA PESERTA ========== */
function hapus_peserta($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM peserta WHERE id = $id");
    return mysqli_affected_rows($conn);
}

/* ========== HAPUS DATA PENGAWAS ========== */
function hapus_pengawas($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pengawas WHERE id = $id");
    return mysqli_affected_rows($conn);
}

/* ========== CARI DATA PESERTA ========== */
function cari_peserta($keyword)
{
    $query = "SELECT * FROM peserta
                WHERE nama LIKE '%$keyword%' OR
                nik LIKE '%$keyword%' OR
                prodi LIKE '%$keyword%' OR
                formasi LIKE '%$keyword%'  OR
                id LIKE '%$keyword%'OR 
                tahap_1 LIKE '%$keyword%'
                ";
    return query($query);
}

/* ========== CARI DATA PENGAWAS ========== */
function cari_pengawas($keyword)
{
    $query = "SELECT * FROM pengawas
                WHERE nama LIKE '%$keyword%' OR
                alamat LIKE '%$keyword%'
                ";
    return query($query);
}

/* ========== CARI DATA PENGAWAS ========== */
function cari_laporan($keyword)
{
    $query = "SELECT * FROM laporan
                WHERE nama LIKE '%$keyword%' OR
                tanggal_tes LIKE '%$keyword%'OR
                tahap_tes LIKE '%$keyword%' OR
                lokasi_tes LIKE '%$keyword%' OR
                sesi_tes LIKE '%$keyword%' OR
                file LIKE '%$keyword%'
                ";
    return query($query);
}


/* ========== TAMBAH LAPORAN ========== */
function tambah_laporan($data)
{
    global $conn;
    // data detail pengawasan
    $nama = htmlspecialchars($data["nama"]);
    $nip = htmlspecialchars($data["nip"]);
    $tanggal_tes = htmlspecialchars($data["tanggal_tes"]);
    $tahap_tes = htmlspecialchars($data["tahap_tes"]);
    $lokasi_tes = htmlspecialchars($data["lokasi_tes"]);
    $sesi_tes = htmlspecialchars($data["sesi_tes"]);
    $file = htmlspecialchars($data["file"]);

    // upload file
    $file = upload_laporan();
    if (!$file) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO laporan VALUES
                ('', '$nama', '$nip', '$tanggal_tes', '$tahap_tes', '$lokasi_tes', '$sesi_tes', '$file')";

    //mengeksekusi query
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


/* ========== UPLOAD LAPORAN ========== */
function upload_laporan()
{
    $namaFile = $_FILES['file']['name'];
    $ukuranFile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpName = $_FILES['file']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih file untuk di upload terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah file
    $ekstensiFileValid = ['zip', 'rar', 'tar'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));
    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('File tidak sesuai format!');
            </script>";
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1000000000) {
        echo "<script>
                alert('Ukuran file terlalu besar!');
            </script>";
        return false;
    }

    // generate nama file baru agar unik
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, '../static/php/files/' . $namaFileBaru);

    return $namaFileBaru;
}

/* ========== UPLOAD LAPORAN ========== */
function hapus_laporan($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM laporan WHERE id = $id");
    return mysqli_affected_rows($conn);
}

?>