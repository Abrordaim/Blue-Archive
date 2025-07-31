<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  

  <div class="container mt-5">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6 d-none d-md-block">
        <div class="bg-primary text-white p-5 rounded shadow">
          <h1 class="display-4 fw-bold">Blue Archive</h1>
          <p class="lead mt-3">
            Selamat datang di sistem dokumen <strong>Blue Archive</strong>.<br>
            Simpan, kelola, dan lihat file PDF dengan mudah.  
          </p>
          <hr class="my-4">
          <p>
            Kami siap membantu menyimpan semua kenangan digitalmu... 
          </p>
          <p></p>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            <form method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-center">
              Belum punya akun? <a href="index.php?register=1">Daftar di sini</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>