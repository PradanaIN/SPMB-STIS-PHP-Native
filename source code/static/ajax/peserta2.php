<?php
/* ==================== FUNCTION ==================== */
require '../php/functions.php';

/* =================== SEARCHING ==================== */
$keyword = $_GET["keyword"];
// Menangkap output ajax untuk pencarian data
$query = "SELECT * FROM peserta
            WHERE nama LIKE '%$keyword%' OR
            nik LIKE '%$keyword%' OR
            prodi LIKE '%$keyword%' OR
            formasi LIKE '%$keyword%' OR
            id LIKE '%$keyword%'OR
            tahap_1 LIKE '%$keyword%'
        ";

$peserta = query($query);

/* ==================== NOTE ==================== */
/*
* File ini merupakan Konfigurasi untuk live search
* Live search ini ditujukan untuk admin
*/
/* ==================== NOTE ==================== */

?>



                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th></th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Formasi</th>
                            <th>Nomor Test</th>
                            <th>Tanggal Ujian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
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