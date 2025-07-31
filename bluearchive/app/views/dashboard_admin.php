<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - Blue Archive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand" ><b>Blue Archive</b></a>
  <div class="ms-auto">
    <a href="?logout=1" class="btn btn-outline-light">Logout</a>
  </div>
</nav>

<div class="container mt-4">
  <h2 class="mb-4">Admin Dashboard</h2>

  <!-- Form Tambah User -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">Manajemen User</div>
    <div class="card-body">
      <form method="POST" class="row g-3">
        <div class="col-md-4">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="col-md-4">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="col-md-2">
          <select name="role" class="form-select">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" name="add_user" class="btn btn-success w-100">Add User</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Tabel User -->
  <div class="card">
    <div class="card-header bg-secondary text-white">Daftar User</div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th><th>Username</th><th>Role</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
            <tr>
              <td><?= $u['id'] ?></td>
              <td><?= $u['username'] ?></td>
              <td><?= $u['role'] ?></td>
              <td>
                <a href="?delete_user=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
