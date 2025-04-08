<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

include '../config/db.php';

// Tambah data jadwal
if (isset($_POST['tambah'])) {
    $kode_matkul = $_POST['kode_matkul'];
    $id_dosen = $_POST['id_dosen'];
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $hari = $_POST['hari'];
    $ruangan = $_POST['ruangan'];
    $user_input = $_SESSION['username'];
    $tgl_input = date('Y-m-d');

    $conn->query("INSERT INTO krs (kode_matkul, id_dosen, nim_mahasiswa, hari, ruangan, user_input, tgl_input)
                  VALUES ('$kode_matkul', '$id_dosen', '$nim_mahasiswa', '$hari', '$ruangan', '$user_input', '$tgl_input')");
    header("Location: krs.php");
    exit;
}

// Edit data jadwal
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kode_matkul = $_POST['kode_matkul'];
    $id_dosen = $_POST['id_dosen'];
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $hari = $_POST['hari'];
    $ruangan = $_POST['ruangan'];
    $user_input = $_SESSION['username'];
    $tgl_input = date('Y-m-d');

    $conn->query("UPDATE krs SET 
        kode_matkul='$kode_matkul', 
        id_dosen='$id_dosen', 
        nim_mahasiswa='$nim_mahasiswa', 
        hari='$hari', 
        ruangan='$ruangan', 
        user_input='$user_input', 
        tgl_input='$tgl_input' 
        WHERE id='$id'");
    header("Location: krs.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM krs WHERE id='$id'");
    header("Location: krs.php");
    exit;
}

// Ambil data untuk ditampilkan
$data = $conn->query("SELECT krs.*, m.nama AS nama_mhs, d.nama AS nama_dosen, mk.nama_matkul 
                      FROM krs 
                      JOIN mahasiswa m ON krs.nim_mahasiswa = m.nim
                      JOIN dosen d ON krs.id_dosen = d.id
                      JOIN matkul mk ON krs.kode_matkul = mk.kode_matkul
                      ORDER BY krs.hari, krs.ruangan");

// Data untuk dropdown
$mahasiswa = $conn->query("SELECT * FROM mahasiswa");
$dosen = $conn->query("SELECT * FROM dosen");
$matkul = $conn->query("SELECT * FROM matkul");

$editMode = isset($_GET['edit']);
$editData = $editMode ? $conn->query("SELECT * FROM krs WHERE id='{$_GET['edit']}'")->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Jadwal Kuliah</title>
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
        input, select {
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

<h2>Manajemen Jadwal Kuliah</h2>

<form method="POST">
    <?php if ($editMode): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
    <?php endif; ?>

    <label>Mata Kuliah:</label>
    <select name="kode_matkul" required>
        <option value="">-- Pilih Mata Kuliah --</option>
        <?php while ($row = $matkul->fetch_assoc()): ?>
            <option value="<?= $row['kode_matkul'] ?>" <?= isset($editData) && $editData['kode_matkul'] == $row['kode_matkul'] ? 'selected' : '' ?>>
                <?= $row['nama_matkul'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Dosen Pengajar:</label>
    <select name="id_dosen" required>
        <option value="">-- Pilih Dosen --</option>
        <?php while ($row = $dosen->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>" <?= isset($editData) && $editData['id_dosen'] == $row['id'] ? 'selected' : '' ?>>
                <?= $row['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Mahasiswa:</label>
    <select name="nim_mahasiswa" required>
        <option value="">-- Pilih Mahasiswa --</option>
        <?php while ($row = $mahasiswa->fetch_assoc()): ?>
            <option value="<?= $row['nim'] ?>" <?= isset($editData) && $editData['nim_mahasiswa'] == $row['nim'] ? 'selected' : '' ?>>
                <?= $row['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Hari:</label>
    <input type="text" name="hari" required value="<?= $editData['hari'] ?? '' ?>">

    <label>Ruangan:</label>
    <input type="text" name="ruangan" required value="<?= $editData['ruangan'] ?? '' ?>">

    <button type="submit" name="<?= $editMode ? 'edit' : 'tambah' ?>">
        <?= $editMode ? 'Simpan Perubahan' : 'Tambah Jadwal' ?>
    </button>
    <?php if ($editMode): ?>
        <a href="krs.php" class="btn-batal">Batal</a>
    <?php endif; ?>
</form>

<table>
    <tr>
        <th>Mata Kuliah</th>
        <th>Dosen</th>
        <th>Mahasiswa</th>
        <th>Hari</th>
        <th>Ruangan</th>
        <th>User Input</th>
        <th>Tgl Input</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $row['nama_matkul'] ?></td>
        <td><?= $row['nama_dosen'] ?></td>
        <td><?= $row['nama_mhs'] ?></td>
        <td><?= $row['hari'] ?></td>
        <td><?= $row['ruangan'] ?></td>
        <td><?= $row['user_input'] ?></td>
        <td><?= $row['tgl_input'] ?></td>
        <td>
            <a href="?edit=<?= $row['id'] ?>" class="edit">Edit</a> |
            <a href="?hapus=<?= $row['id'] ?>" class="hapus" onclick="return confirm('Hapus jadwal ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>

</body>
</html>