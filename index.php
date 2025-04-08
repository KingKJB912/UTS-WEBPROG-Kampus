<?php
session_start();
$conn = new mysqli("localhost", "root", "", "kampus_db");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'dosen') {
            $cekDosen = $conn->query("SELECT id FROM dosen WHERE username = '$username'");
            if ($cekDosen->num_rows > 0) {
                $d = $cekDosen->fetch_assoc();
                $_SESSION['id_dosen'] = $d['id'];
            }
        } elseif ($user['role'] == 'mahasiswa') {
            $cekMhs = $conn->query("SELECT nim FROM mahasiswa WHERE user_input = '$username'");
            if ($cekMhs->num_rows > 0) {
                $m = $cekMhs->fetch_assoc();
                $_SESSION['nim_mahasiswa'] = $m['nim'];
            }
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Login Page
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
     background-image: url('https://storage.googleapis.com/a1aa/image/Y7FpkPLyeHJ0Tv03vJYx1sTZS1nWdRnmr17VLwbHYIA.jpg');
     background-size: cover;
     background-position: center;
   }
  </style>
 </head>
 <body class="flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row max-w-4xl w-full">
   <div class="w-full md:w-1/2 hidden md:block">
    <img alt="Illustration of a campus with trees and a large building" class="w-full h-full object-cover rounded-l-lg" height="800" src="https://storage.googleapis.com/a1aa/image/Y7FpkPLyeHJ0Tv03vJYx1sTZS1nWdRnmr17VLwbHYIA.jpg" width="600"/>
   </div>
   <div class="w-full md:w-1/2 p-8">
    <h2 class="text-3xl font-bold text-blue-700 mb-8">
     Selamat Datang di Kampus_id
    </h2>
    <form>
     <div class="mb-4">
      <label class="block text-gray-700" for="username">
       Username
      </label>
      <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600" id="username" type="text" value=""/>
     </div>
     <div class="mb-6">
      <label class="block text-gray-700" for="password">
       Password
      </label>
      <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600" id="password" type="password" value=""/>
     </div>
     <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200" type="submit">
      LOGIN
     </button>
    </form>
   </div>
  </div>
 </body>
</html>