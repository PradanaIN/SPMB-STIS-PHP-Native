<?php
/* ==================== FUNCTION ==================== */
require '../php/functions.php';

/* =================== SEARCHING ==================== */
$keyword = $_GET["keyword"];
// Menangkap output ajax untuk pencarian data
$query = "SELECT * FROM laporan
            WHERE nama LIKE '%$keyword%' OR
            tanggal_tes LIKE '%$keyword%'OR
            tahap_tes LIKE '%$keyword%'OR
            lokasi_tes LIKE '%$keyword%' OR
            sesi_tes LIKE '%$keyword%' OR
            file LIKE '%$keyword%'
        ";

$laporan = query($query);

/* ==================== NOTE ==================== */
/*
* File ini merupakan Konfigurasi untuk live search
* Live search ini ditujukan untuk admin
* Karena nantinya admin memiliki kolom Aksi
*/
/* ==================== NOTE ==================== */

?>



<table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengawas</th>
                            <th>Tanggal Tes</th>
                            <th>Tahap Tes</th>
                            <th>Lokasi Tes</th>
                            <th>Sesi Tes</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($laporan as $row) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['tanggal_tes']; ?></td>
                            <td><?= $row['tahap_tes']; ?></td>
                            <td><?= $row['lokasi_tes']; ?></td>
                            <td><?= $row['sesi_tes']; ?></td>
                            <td><?= $row['file']; ?></td>

                            <td>
                                <button>
                                    <a href="download-laporan.php?file=<?= $row["file"]; ?>">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </button>
                                <button>
                                    <a href="hapus-laporan.php?id=<?= $row["id"]; ?>" onclick="return confirm('Hapus data terpilih?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>