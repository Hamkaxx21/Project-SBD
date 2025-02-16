<?php
$servername = "localhost"; // Nama server database
$username = "root";        // Username database
$password = "";            // Password database
$dbname = "konselling"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
