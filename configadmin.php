<?php
$servername = "localhost";  // Nama server MySQL
$username = "root";         // Username database
$password = "16102005";             // Password database
$dbname = "user_system";      // Nama database yang telah dibuat

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>