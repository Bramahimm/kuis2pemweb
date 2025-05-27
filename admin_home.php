<?php
session_start();
require 'db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Ambil data semua user
$users = $conn->query("SELECT * FROM users");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="mb-4">
        <h2>Selamat datang, Admin</h2>
        <p>Email: <strong><?= $_SESSION['admin_email']; ?></strong></p>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>

    <h4>Data Pengguna:</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Foto Profil</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td>
                    <?php if ($row['photo']): ?>
                        <img src="uploads/<?= $row['photo']; ?>" alt="Foto" width="50" height="50">
                    <?php else: ?>
                        <em>Tidak ada foto</em>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                      onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
