<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <h4 class="card-title mb-4 text-center">Edit User</h4>
          <form action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="hidden" name="old_photo" value="<?= $user['photo'] ?>">

            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type=" text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Foto Baru (kosongkan jika tidak diubah)</label>
              <input type="file" name="photo" class="form-control">
              <small>Foto lama:</small><br>
              <img src="uploads/<?= $user['photo'] ?>" width="80" class="mt-2 rounded">
            </div>
            <button type="submit" name="update" class="btn btn-primary w-100">Simpan Perubahan</button>
            <a href="home.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>


