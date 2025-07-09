<?php
session_start(); 
include 'koneksi.php';

$identifier = $_POST['identifier'] ?? '';
$password   = $_POST['password'] ?? '';

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'username' => $user['username']
        ];
        header("Location: index.php");
        exit();
    }
}

// Jika gagal login
header("Location: index.php?error=1");
exit();
?>
