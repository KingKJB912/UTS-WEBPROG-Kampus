<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "kampus_db");

$id = $_GET['id'];
$dosen = $conn->query("SELECT * FROM dosen WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $gelar = $_POST['gelar'];
    $lulusan = $_POST['lulusan'];
    $telp = $_POST['telp'];

    $conn->query("UPDATE dosen SET nik='$nik', nama='$nama', gelar='$gelar', lulusan='$lulusan', telp='$telp' WHERE id=$id");
    header("Location: dosen.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Dosen</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        form input[type="text"], form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        form button:hover {
            background-color: #0056b3;
        }
        .btn-kembali {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 8px 16px;
            background: #6c757d;
            color: #fff;
            border-radius: 5px;
        }
        .btn-kembali:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Dosen</h2>
        <form method="POST">
            <input type="text" name="nik" value="<?= $dosen['nik'] ?>" placeholder="NIK" required>
            <input type="text" name="nama" value="<?= $dosen['nama'] ?>" placeholder="Nama" required>
            <input type="text" name="gelar" value="<?= $dosen['gelar'] ?>" placeholder="Gelar" required>
            <input type="text" name="lulusan" value="<?= $dosen['lulusan'] ?>" placeholder="Lulusan" required>
            <input type="text" name="telp" value="<?= $dosen['telp'] ?>" placeholder="No. Telp" required>
            <button type="submit" name="update">Simpan Perubahan</button>
        </form>
        <a class="btn-kembali" href="dosen.php">← Kembali ke Daftar Dosen</a>
    </div>
</body>
</html>