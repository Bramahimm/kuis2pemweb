<?php
require 'db.php';

if (isset($_POST['update'])) {
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $pass   = $_POST['password'];
    $old_photo = $_POST['old_photo'];
    $photo  = $old_photo;

    // hash password
    if (!empty($pass)) {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $pass_sql = ", password = '$pass'";
    } else {
        $pass_sql = "";
    }

    // Jika ada poto baru
    if ($_FILES['photo']['name']) {
        $fotoTmp  = $_FILES['photo']['tmp_name'];
        $fotoName = $_FILES['photo']['name'];
        $fotoSize = $_FILES['photo']['size'];
        $ext = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($ext, $allowed) && $fotoSize <= 2 * 1024 * 1024) {
            $newName = uniqid() . '.' . $ext;
            move_uploaded_file($fotoTmp, 'uploads/' . $newName);
            // hapus foto lama
            if (file_exists("uploads/$old_photo")) {
                unlink("uploads/$old_photo");
            }
            $photo = $newName;
        }
    }

    $conn->query("UPDATE users SET name='$name', email='$email', photo='$photo' $pass_sql WHERE id=$id");

    header("Location: home.php");
}
