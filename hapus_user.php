<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file foto untuk dihapus dari folder
    $get = $conn->prepare("SELECT photo FROM users WHERE id = ?");
    $get->bind_param("i", $id);
    $get->execute();
    $result = $get->get_result();
    $data = $result->fetch_assoc();

    if ($data && $data['photo']) {
        $filepath = 'uploads/' . $data['photo'];
        if (file_exists($filepath)) {
            unlink($filepath); //ini untuk menghapus file foto
        }
    }

    // Hapus user dari database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: admin_home.php");
exit;
