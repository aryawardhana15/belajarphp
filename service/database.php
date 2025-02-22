<?php
$servername = "localhost"; // Host database
$username = "root"; // Username database
$password = ""; // Password database (kosongkan jika tidak ada)
$dbname = "belajar"; // Nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>