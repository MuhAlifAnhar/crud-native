<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
            </script>";
    exit;
}
  $title = "Users";

  require "../layout/header.php";

  if(isset($_SESSION['role']) && $_SESSION['role'] === 0) {
    $id_user = mysqli_real_escape_string($database, $_SESSION['id']);
    $users = query("SELECT * FROM users WHERE id_user = '$id_user'");
  }else {
    $users = query("SELECT * FROM users ORDER BY created_at DESC");
  }
?>

<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12"> <!-- Kolom penuh lebar di semua ukuran layar -->
        <div class="card">
          <div class="card-header">
            <i class="fas fa-user"></i> <?= $title; ?>
          </div>
          <div class="card-body shadow-sm">
            <div class="table-responsive">
              <a href="bikin-user.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Buat User</a>
              <table id="myTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th width="20%">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($users as $user) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $user['username']; ?></td>
                      <td><?= $user['email']; ?></td>
                      <td><?= $user['role']; ?></td>
                      <td><?= $user['created_at']; ?></td>
                      <td>
                        <a href="edit-user.php?id=<?= $user['id_user']; ?>" class="badge bg-warning border-0 text-decoration-none me-2" title="Edit">
                          <i class="fas fa-edit"></i>
                        </a>
                        <?php if ($_SESSION['role'] === 1): ?>
                        <a href="hapus-user.php?id=<?= $user['id_user']; ?>" class="badge bg-danger border-0 text-decoration-none" onclick="return confirm('Yakin ingin menghapus user?')" title="Hapus">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                      <?php else: ?>
                          <span class="badge bg-secondary">Private</span>
                        <?php endif; ?>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
  require "../layout/footer.php";
?>
