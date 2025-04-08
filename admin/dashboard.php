<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
include '../config/db.php';

// Ambil data ringkasan
$totalDosen = $conn->query("SELECT COUNT(*) as total FROM dosen")->fetch_assoc()['total'];
$totalMahasiswa = $conn->query("SELECT COUNT(*) as total FROM mahasiswa")->fetch_assoc()['total'];
$totalMatkul = $conn->query("SELECT COUNT(*) as total FROM matkul")->fetch_assoc()['total'];
$totalJadwal = $conn->query("SELECT COUNT(*) as total FROM krs")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f5f7fa;
        }

        .sidebar {
            width: 260px;
            background-color: #2f3542;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 15px 0;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .sidebar a:hover {
            background-color: #57606f;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .content h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .content p {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            flex: 1 1 200px;
            min-width: 200px;
        }

        .card h3 {
            font-size: 16px;
            color: #666;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            margin-top: 5px;
        }

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .quick-actions a {
            background-color: #1e90ff;
            color: white;
            padding: 14px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }

        .quick-actions a:hover {
            background-color: #0d74d1;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu Admin</h2>
        <a href="dosen.php">Kelola Dosen</a>
        <a href="matkul.php">Kelola Mata Kuliah</a>
        <a href="mahasiswa.php">Kelola Mahasiswa</a>
        <a href="krs.php">Kelola Jadwal Kuliah</a>
        <a href="pengumuman.php">Pengumuman</a>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h1>
        <p>Anda login sebagai <strong>Admin</strong></p>

        <div class="cards">
            <div class="card">
                <h3>Total Dosen</h3>
                <p><?= $totalDosen ?></p>
            </div>
            <div class="card">
                <h3>Total Mahasiswa</h3>
                <p><?= $totalMahasiswa ?></p>
            </div>
            <div class="card">
                <h3>Total Mata Kuliah</h3>
                <p><?= $totalMatkul ?></p>
            </div>
            <div class="card">
                <h3>Total Jadwal Kuliah</h3>
                <p><?= $totalJadwal ?></p>
            </div>
        </div>

        <h3>Aksi Cepat</h3>
        <div class="quick-actions">
            <a href="dosen.php">➕ Tambah Dosen</a>
            <a href="mahasiswa.php">➕ Tambah Mahasiswa</a>
            <a href="krs.php">➕ Tambah Jadwal</a>
            <a href="pengumuman.php">📢 Buat Pengumuman</a>
        </div>
    </div>
</body>
</html>