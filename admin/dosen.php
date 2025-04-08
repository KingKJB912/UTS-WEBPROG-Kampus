<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "kampus_db");

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM dosen WHERE id = '$id'");
    header("Location: dosen.php");
    exit;
}

// Tambah data
if (isset($_POST['tambah'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $gelar = $_POST['gelar'];
    $lulusan = $_POST['lulusan'];
    $telp = $_POST['telp'];
    $user_input = $_SESSION['username'];
    $tgl_input = date("Y-m-d");

    $conn->query("INSERT INTO dosen (nik, nama, gelar, lulusan, telp, user_input, tanggal_input)
                  VALUES ('$nik', '$nama', '$gelar', '$lulusan', '$telp', '$user_input', '$tgl_input')");
    header("Location: dosen.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Dosen</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f6fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
        }

        form input {
            flex: 1 1 30%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 10px 16px;
            background-color: #2d89e1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #1765b2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fefefe;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2d89e1;
            color: white;
        }

        a {
            text-decoration: none;
            color: #2d89e1;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn-hapus {
            color: red;
        }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .kembali:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manajemen Data Dosen</h2>

    <!-- Form Tambah Dosen -->
    <form method="POST">
        <input type="text" name="nik" placeholder="NIK" required>
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="gelar" placeholder="Gelar" required>
        <input type="text" name="lulusan" placeholder="Lulusan" required>
        <input type="text" name="telp" placeholder="No. Telp" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Tabel Dosen -->
    <table>
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Gelar</th>
            <th>Lulusan</th>
            <th>Telp</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM dosen");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['nik']}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['gelar']}</td>";
            echo "<td>{$row['lulusan']}</td>";
            echo "<td>{$row['telp']}</td>";
            echo "<td>
                    <a href='edit_dosen.php?id={$row['id']}'>Edit</a> |
                    <a href='dosen.php?hapus={$row['id']}' class='btn-hapus' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="dashboard.php" class="kembali">← Kembali ke Dashboard</a>
</div>
</body>
</html>