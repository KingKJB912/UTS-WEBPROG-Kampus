<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../index.php");
    exit;
}

$nim = $_SESSION['nim_mahasiswa'];
$result = mysqli_query($conn, "SELECT nama FROM mahasiswa WHERE nim = '$nim'");
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        h2 {
            color: #2c3e50;
        }
        .card {
            background: #fff;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            padding: 12px 20px;
            margin-top: 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #218838;
        }
        .logout {
            background-color: #dc3545;
        }
        .logout:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, <?= $nama; ?> 👩‍🎓</h2>
        <div class="card">
            <p>Silakan akses fitur yang tersedia untuk melihat jadwal kuliah Anda.</p>
            <a href="laporan.php" class="btn">📅 Lihat Laporan Jadwal Kuliah</a><br>
            <a href="../logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>
</body>
</html>