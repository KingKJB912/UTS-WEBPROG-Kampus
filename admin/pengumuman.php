<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Proses Tambah atau Update
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $user = $_SESSION['username'];
    $tgl = date('Y-m-d');

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $update = mysqli_query($conn, "UPDATE pengumuman SET judul='$judul', isi='$isi' WHERE id='$id'");
        $msg = $update ? 'diupdate' : 'gagal diupdate';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO pengumuman (judul, isi, user_input, tgl_input) VALUES ('$judul', '$isi', '$user', '$tgl')");
        $msg = $insert ? 'disimpan' : 'gagal disimpan';
    }

    echo "<script>alert('Data berhasil $msg!'); location.href='pengumuman.php';</script>";
    exit;
}

// Proses Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pengumuman WHERE id='$id'");
    echo "<script>alert('Data berhasil dihapus!'); location.href='pengumuman.php';</script>";
    exit;
}

$pengumuman = mysqli_query($conn, "SELECT * FROM pengumuman ORDER BY tgl_input DESC");

$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $get = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id='$id'");
    $editData = mysqli_fetch_assoc($get);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Pengumuman</title>
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
        h3 {
            margin-top: 30px;
            color: #333;
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
            text-decoration: none;
        }
        .hapus {
            color: red;
            text-decoration: none;
        }
        .btn-kembali {
            display: inline-block;
            margin-top: 30px;
            background: #6c757d;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-batal {
            margin-left: 10px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h2>Manajemen Pengumuman</h2>

    <h3><?= $editData ? "Edit Pengumuman" : "Tambah Pengumuman" ?></h3>
    <form method="POST">
        <?php if ($editData): ?>
            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>
        <label>Judul:</label>
        <input type="text" name="judul" value="<?= $editData['judul'] ?? '' ?>" required>
        <label>Isi Pengumuman:</label>
        <textarea name="isi" rows="5" required><?= $editData['isi'] ?? '' ?></textarea>
        <button type="submit" name="simpan"><?= $editData ? 'Simpan Perubahan' : 'Simpan Pengumuman' ?></button>
        <?php if ($editData): ?>
            <a href="pengumuman.php" class="btn-batal">Batal</a>
        <?php endif; ?>
    </form>

    <h3>Daftar Pengumuman</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>User</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($pengumuman)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['isi'])) ?></td>
            <td><?= $row['user_input'] ?></td>
            <td><?= $row['tgl_input'] ?></td>
            <td>
                <a href="?edit=<?= $row['id'] ?>" class="edit">Edit</a> |
                <a href="?hapus=<?= $row['id'] ?>" class="hapus" onclick="return confirm('Hapus pengumuman ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a>

</body>
</html>