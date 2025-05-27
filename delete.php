<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

// ambil data user untuk hapus foto
$res = $conn->query("SELECT photo FROM users WHERE id=$id");
$user = $res->fetch_assoc();

if ($user) {
    if (file_exists("uploads/" . $user['photo'])) {
        unlink("uploads/" . $user['photo']);
    }
}

$conn->query("DELETE FROM users WHERE id=$id");
header("Location: home.php");
