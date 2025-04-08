<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

include '../config/db.php';

// Tambah data
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tahun = $_POST['tahun_masuk'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $user_input = $_SESSION['username'];
    $tanggal = date('Y-m-d');

    $conn->query("INSERT INTO mahasiswa (nim, nama, tahun_masuk, alamat, telp, user_input, tgl_input) 
                  VALUES ('$nim', '$nama', '$tahun', '$alamat', '$telp', '$user_input', '$tanggal')");
    header("Location: mahasiswa.php");
    exit;
}

// Edit data
if (isset($_POST['edit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tahun = $_POST['tahun_masuk'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $user_input = $_SESSION['username'];
    $tanggal = date('Y-m-d');

    $conn->query("UPDATE mahasiswa SET 
        nama='$nama', 
        tahun_masuk='$tahun', 
        alamat='$alamat', 
        telp='$telp', 
        user_input='$user_input', 
        tgl_input='$tanggal' 
        WHERE nim='$nim'");
    header("Location: mahasiswa.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    $conn->query("DELETE FROM mahasiswa WHERE nim='$nim'");
    header("Location: mahasiswa.php");
    exit;
}

// Ambil semua data mahasiswa
$data = $conn->query("SELECT * FROM mahasiswa ORDER BY tahun_masuk, nim");

$editMode = isset($_GET['edit']);
$editData = $editMode ? $conn->query("SELECT * FROM mahasiswa WHERE nim='{$_GET['edit']}'")->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 16px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 6px 0 12px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
        }
        .btn-kembali {
            display: inline-block;
            margin-top: 20px;
            background: #6c757d;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-batal {
            margin-left: 10px;
            color: #333;
        }
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        th {
            background-color: #3399ff;
            color: white;
        }
        .edit {
            color: #007bff;
        }
        .hapus {
            color: red;
        }
    </style>
</head>
<body>

    <h2>Manajemen Mahasiswa</h2>

    <form method="POST">
        <label>NIM:</label>
        <input type="text" name="nim" required value="<?= $editData['nim'] ?? '' ?>" <?= $editMode ? 'readonly' : '' ?>>

        <label>Nama:</label>
        <input type="text" name="nama" required value="<?= $editData['nama'] ?? '' ?>">

        <label>Tahun Masuk:</label>
        <input type="number" name="tahun_masuk" required value="<?= $editData['tahun_masuk'] ?? '' ?>">

        <label>Alamat:</label>
        <textarea name="alamat" rows="2" required><?= $editData['alamat'] ?? '' ?></textarea>

        <label>Telp:</label>
        <input type="text" name="telp" required value="<?= $editData['telp'] ?? '' ?>">

        <button type="submit" name="<?= $editMode ? 'edit' : 'tambah' ?>">
            <?= $editMode ? 'Simpan Perubahan' : 'Tambah Mahasiswa' ?>
        </button>
        <?php if ($editMode): ?>
            <a href="mahasiswa.php" class="btn-batal">Batal</a>
        <?php endif; ?>
    </form>

    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tahun Masuk</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>User Input</th>
            <th>Tgl Input</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['tahun_masuk'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['telp'] ?></td>
            <td><?= $row['user_input'] ?></td>
            <td><?= $row['tgl_input'] ?></td>
            <td>
                <a href="?edit=<?= $row['nim'] ?>" class="edit">Edit</a> |
                <a href="?hapus=<?= $row['nim'] ?>" class="hapus" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>

</body>
</html>