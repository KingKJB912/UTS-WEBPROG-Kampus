<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../index.php");
    exit;
}

$nim = $_SESSION['nim_mahasiswa'] ?? null;

$qNama = mysqli_query($conn, "SELECT nama FROM mahasiswa WHERE nim = '$nim'");
$mhs = mysqli_fetch_assoc($qNama);
$nama_mhs = $mhs['nama'] ?? 'Nama tidak ditemukan';

$data = mysqli_query($conn, "
    SELECT krs.*, matkul.nama_matkul, matkul.sks, dosen.nama AS nama_dosen
    FROM krs
    JOIN matkul ON krs.kode_matkul = matkul.kode_matkul
    JOIN dosen ON krs.id_dosen = dosen.id
    WHERE krs.nim_mahasiswa = '$nim'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jadwal Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
        }
        h2 {
            color: #2c3e50;
        }
        .info {
            margin-bottom: 20px;
            background: #ffffff;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 14px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .btn-back {
            display: inline-block;
            margin-top: 30px;
            background: #6c757d;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📖 Laporan Jadwal Kuliah</h2>
        <div class="info">
            <p><strong>Nama Mahasiswa:</strong> <?= $nama_mhs; ?></p>
            <p><strong>NIM:</strong> <?= $nim; ?></p>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Dosen Pengajar</th>
                <th>Hari</th>
                <th>Ruangan</th>
            </tr>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_matkul']; ?></td>
                <td><?= $row['sks']; ?></td>
                <td><?= $row['nama_dosen']; ?></td>
                <td><?= $row['hari']; ?></td>
                <td><?= $row['ruangan']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>