<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "coral_interaction";

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
