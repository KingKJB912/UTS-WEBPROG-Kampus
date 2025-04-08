<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kampus_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>