<?php
$host = 'localhost';
$user = 'root'; // Default user XAMPP
$password = 'hafiz1180'; // Default password XAMPP biasanya kosong
$database = 'form'; // Ganti sesuai nama database kamu

$conn = new mysqli($host, $user, $password, $database);



// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
