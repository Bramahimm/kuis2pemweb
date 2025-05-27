<?php
require 'db.php';

if (isset($_POST['register'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Upload foto
    $fotoName = $_FILES['photo']['name'];
    $fotoTmp  = $_FILES['photo']['tmp_name'];
    $fotoSize = $_FILES['photo']['size'];

    $ext = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) {
        header("Location: register.php?error=Format foto tidak didukung");
        exit();
    }

    if ($fotoSize > 2 * 1024 * 1024) {
        header("Location: register.php?error=Ukuran foto maksimal 2MB");
        exit();
    }

    $newFileName = uniqid() . '.' . $ext;
    move_uploaded_file($fotoTmp, 'uploads/' . $newFileName);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $newFileName);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        header("Location: register.php?error=Email sudah digunakan");
    }
}
