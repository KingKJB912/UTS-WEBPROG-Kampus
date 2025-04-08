<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "kampus_db");
$id_dosen = $_SESSION['id_dosen'];
$q = $conn->query("SELECT nama FROM dosen WHERE id = '$id_dosen'");
$data = $q->fetch_assoc();
$nama_dosen = $data['nama'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Dosen</title>
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
            margin-bottom: 10px;
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
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            margin-top: 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
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
        <h2>Selamat Datang, Dosen <?= $nama_dosen; ?> 👨‍🏫</h2>
        <div class="card">
            <p>Silakan akses fitur yang tersedia untuk melihat jadwal mengajar Anda.</p>
            <a href="laporan.php" class="btn">📄 Lihat Laporan Jadwal Mengajar</a><br>
            <a href="../logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>
</body>
</html>