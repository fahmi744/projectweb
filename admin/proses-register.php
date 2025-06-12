<?php
require_once '../model/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin/register.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

if (!$email || !$password || !$konfirmasi) {
    die('Semua field wajib diisi.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Email tidak valid.');
}

if ($password !== $konfirmasi) {
    die('Konfirmasi password tidak cocok.');
}

if (strlen($password) < 5) {
    die('Password minimal 5 karakter.');
}

// Hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

$conn = (new koneksi())->getConnection();

// Cek apakah email sudah ada
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die('Email sudah terdaftar.');
}
$stmt->close();

// Simpan user baru dengan level default 1 (user)
$stmt = $conn->prepare("INSERT INTO users (email, password, level) VALUES (?, ?, 1)");
$stmt->bind_param('ss', $email, $hashed);
$exec = $stmt->execute();

if ($exec) {
    echo "Registrasi berhasil. <a href='login.php'>Login di sini</a>";
} else {
    echo "Gagal mendaftar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
