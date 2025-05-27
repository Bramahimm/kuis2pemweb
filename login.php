<?php
session_start();
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role === 'admin') {
    // Ambil data dari tabel admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
} else {
    // Ambil data dari tabel users
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
}

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    if ($role === 'admin') {
        // Admin: password biasa (plaintext)
        if ($password === $data['password']) {
            $_SESSION['admin_id'] = $data['id_admin'];
            $_SESSION['admin_email'] = $data['email'];
            header("Location: admin_home.php");
            exit;
        }
    } else {
        // User: password di-hash
        if (password_verify($password, $data['password'])) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['user_name'] = $data['name'];
            header("Location: home.php");
            exit;
        }
    }
}

// Jika login gagal
echo "<script>alert('Login gagal!'); location.href='index.php';</script>";
