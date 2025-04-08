<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

switch ($_SESSION['role']) {
    case 'admin':
        header("Location: admin/dashboard.php");
        break;
    case 'dosen':
        header("Location: dosen/dashboard.php");
        break;
    case 'mahasiswa':
        header("Location: mahasiswa/dashboard.php");
        break;
    default:
        echo "Role tidak dikenali!";
}
?>