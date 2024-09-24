<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
            </script>";
    exit;
}

$title = "Edit User";
require "../layout/header.php";
// $kategori = query("SELECT * FROM kategori ORDER BY create_at DESC");

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID user tidak tersedia');
            document.location.href = 'user.php';
            </script>";
    exit;
}

$id = $_GET['id'];

$data = query("SELECT * FROM users WHERE id_user = $id");
if (empty($data)) {
    echo "<script>
            alert('User tidak ditemukan');
            document.location.href = 'user.php';
            </script>";
    exit;
}

$user = $data[0];

if (isset($_POST['submit'])) {
    if (edit_user($id, $_POST) > 0) {
        echo "<script>
                alert('User berhasil diperbarui');
                document.location.href = 'user.php';
                </script>";
    } else {
        echo "<script>
                alert('User gagal diperbarui');
                document.location.href = 'edit-user.php?id=$id';
                </script>";

        echo mysqli_error($database);
    }
}

?>

<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-th-large"></i> <?= $title; ?>
          </div>
          <div class="card-body shadow-sm">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 col-md-6">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="" hidden>--Silahkan Pilih--</option>
                            <option value="0" <?= $user['role'] == 0 ? 'selected' : ''; ?>>Operator</option>
                            <option value="1" <?= $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fas fa-save"></i> Simpan
                </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="assets/js/helper.js"></script>

<script>
    $(document).ready(function(){
        $('#title').on('input', function(){
            $('#slug').val(slugify($(this).val()));
        });
    });
</script>

<?php

require "../layout/footer.php";

?>
