<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>  
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand">Admin GudangNET</span>
    <a href="logout.php" class="btn btn-outline-light">Logout</a>
  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-body">
      <h4>Selamat datang Admin, <?= htmlspecialchars($_SESSION['admin_email']) ?></h4>
      <p>Ini adalah halaman dashboard admin.</p>
    </div>
  </div>
</div>

</body>
</html>
