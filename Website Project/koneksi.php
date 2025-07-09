<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "coral_interaction";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>