<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center align-items-center">
    
    <!-- Jumbotron Kiri -->
    <div class="col-md-6 d-none d-md-block">
      <div class="bg-primary text-white p-5 rounded shadow">
        <h1 class="display-5 fw-bold">Blue Archive</h1>
        <p class="lead mt-3">Selamat datang! ❤️❤️❤️❤️❤️</p>
        <hr class="my-4">
        <p>
          Buat akun dan mulai mengarsipkan dokumen pentingmu dengan mudah, cepat, dan aman.  
          <br><br><em>"Masa depan skripsimu dimulai di sini!"</em> 😄
        </p>
      </div>
    </div>

    <!-- Form Register -->
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Daftar Akun Baru</h3>

          <?php if (!empty($error)) : ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-info w-100 text-white">Daftar</button>
          </form>

          <p class="mt-3 text-center">
            Sudah punya akun? <a href="index.php">Login</a>
          </p>
        </div>
      </div>
    </div>

  </div>
</div>

</body>
</html>
