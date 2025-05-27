<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Quiz</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-lg">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Login Kuis Pemrograman web</h3>
          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
          <?php endif; ?>
          <form action="login.php" method="POST">
  <div class="btn-group w-100 mb-3">
    <input type="radio" class="btn-check" name="role" id="customer" value="user" autocomplete="off" checked>
    <label class="btn btn-outline-secondary" for="customer">Customer</label>

    <input type="radio" class="btn-check" name="role" id="admin" value="admin" autocomplete="off">
    <label class="btn btn-outline-primary" for="admin">Admin</label>
  </div>

  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary w-100">LOGIN</button>

  <!-- Tautan Registrasi (Hanya Customer) -->
  <div id="register-link" class="text-center mt-3">
    <a href="register.php">Belum punya akun? Daftar di sini</a>
  </div>
</form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const customerRadio = document.getElementById("customer");
  const adminRadio = document.getElementById("admin");
  const registerLink = document.getElementById("register-link");

  function toggleRegister() {
    if (customerRadio.checked) {
      registerLink.style.display = "block";
    } else {
      registerLink.style.display = "none";
    }
  }

  toggleRegister();
  customerRadio.addEventListener("change", toggleRegister);
  adminRadio.addEventListener("change", toggleRegister);
</script>

</body>
</html>
