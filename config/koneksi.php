<?php
// Mendefinisikan konstanta koneksi
<<<<<<< HEAD
define('DB_HOST', 'localhost');      // Server database
define('DB_USER', 'root');           // Username
define('DB_PASS', '');               // Password
define('DB_NAME', 'sistem_absensi_siswa'); // Nama database
=======
define('DB_HOST', 'localhost'); // Server database
define('DB_USER', 'root'); // Username
define('DB_PASS', ''); // Password
define('DB_NAME', 'db_pendataan_siswa'); // Nama database
>>>>>>> 9f1a7be1ba9fbb8f0c010c281f0d06c58d93a67a

// Membuat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set karakter
$conn->set_charset("utf8");
?>