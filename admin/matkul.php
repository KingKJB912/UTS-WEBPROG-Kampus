<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

include '../config/db.php';

// Tambah data
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_matkul'];
    $nama = $_POST['nama_matkul'];
    $sks = $_POST['sks'];
    $user_input = $_SESSION['username'];
    $tanggal = date('Y-m-d');

    $conn->query("INSERT INTO matkul (kode_matkul, nama_matkul, sks, user_input, tgl_input) 
                  VALUES ('$kode', '$nama', '$sks', '$user_input', '$tanggal')");
    header("Location: matkul.php");
    exit;
}

// Edit data
if (isset($_POST['edit'])) {
    $kode = $_POST['kode_matkul'];
    $nama = $_POST['nama_matkul'];
    $sks = $_POST['sks'];
    $user_input = $_SESSION['username'];
    $tanggal = date('Y-m-d');

    $conn->query("UPDATE matkul SET 
        nama_matkul='$nama', 
        sks='$sks', 
        user_input='$user_input', 
        tgl_input='$tanggal' 
        WHERE kode_matkul='$kode'");
    header("Location: matkul.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $kode = $_GET['hapus'];
    $conn->query("DELETE FROM matkul WHERE kode_matkul='$kode'");
    header("Location: matkul.php");
    exit;
}

// Ambil semua data matkul
$data = $conn->query("SELECT * FROM matkul ORDER BY kode_matkul");

$editMode = isset($_GET['edit']);
$editData = $editMode ? $conn->query("SELECT * FROM matkul WHERE kode_matkul='{$_GET['edit']}'")->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Mata Kuliah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
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
        input {
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
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
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
        a {
            text-decoration: none;
        }
        .edit {
            color: #007bff;
            margin-right: 10px;
        }
        .hapus {
            color: red;
        }
        .btn-kembali {
            display: inline-block;
            margin-top: 25px;
            background: #6c757d;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Manajemen Mata Kuliah</h2>

<form method="POST">
    <label>Kode Mata Kuliah:</label>
    <input type="text" name="kode_matkul" required value="<?= $editData['kode_matkul'] ?? '' ?>" <?= $editMode ? 'readonly' : '' ?>>

    <label>Nama Mata Kuliah:</label>
    <input type="text" name="nama_matkul" required value="<?= $editData['nama_matkul'] ?? '' ?>">

    <label>SKS:</label>
    <input type="number" name="sks" required value="<?= $editData['sks'] ?? '' ?>">

    <button type="submit" name="<?= $editMode ? 'edit' : 'tambah' ?>">
        <?= $editMode ? 'Simpan Perubahan' : 'Tambah Mata Kuliah' ?>
    </button>
    <?php if ($editMode): ?>
        <a href="matkul.php" style="margin-left: 10px;">Batal</a>
    <?php endif; ?>
</form>

<table>
    <tr>
        <th>Kode</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>User Input</th>
        <th>Tgl Input</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $row['kode_matkul'] ?></td>
        <td><?= $row['nama_matkul'] ?></td>
        <td><?= $row['sks'] ?></td>
        <td><?= $row['user_input'] ?></td>
        <td><?= $row['tgl_input'] ?></td>
        <td>
            <a class="edit" href="?edit=<?= $row['kode_matkul'] ?>">Edit</a> |
            <a class="hapus" href="?hapus=<?= $row['kode_matkul'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>

</body>
</html>