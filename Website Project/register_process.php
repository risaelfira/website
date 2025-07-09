<?php
session_start();
include 'koneksi.php';

$nama     = $_POST['nama'] ?? '';
$email    = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

// Validasi form kosong
if (empty($nama) || empty($username) || empty($email) || empty($password) || empty($confirm)) {
    header("Location: register.php?error=empty");
    exit();
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: register.php?error=emailformat");
    exit();
}

// Validasi konfirmasi password
if ($password !== $confirm) {
    header("Location: register.php?error=mismatch");
    exit();
}

// Validasi kekuatan password
function isValidPassword($password, $username, $nama, $email) {
    if (strlen($password) < 8) return false;
    if (!preg_match('/[A-Z]/', $password)) return false;
    if (!preg_match('/[a-z]/', $password)) return false;
    if (!preg_match('/[0-9]/', $password)) return false;
    if (!preg_match('/[\W_]/', $password)) return false;

    $passwordLower = strtolower($password);
    if (
        strpos($passwordLower, strtolower($username)) !== false ||
        strpos($passwordLower, strtolower($nama)) !== false ||
        strpos($passwordLower, strtolower($email)) !== false
    ) {
        return false;
    }
    return true;
}

if (!isValidPassword($password, $username, $nama, $email)) {
    header("Location: register.php?error=password");
    exit();
}

// Cek apakah username/email sudah ada
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header("Location: register.php?error=duplicate");
    exit();
}
$stmt->close();

// Simpan user ke database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $email, $username, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['user'] = [
        'name' => $nama,
        'email' => $email,
        'username' => $username
    ];
    header("Location: index.php");
    exit();
} else {
    header("Location: register.php?error=registerfail");
    exit();
}
?>