<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
            </script>";
    exit;
}

$title = "Bikin User";
require "../layout/header.php";

if (isset($_POST['submit'])){
    if (store_user($_POST) > 0) {
        echo "<script>
                alert('User berhasil ditambahkan');
                document.location.href = 'user.php';
                </script>";
    }else {
        echo "<script>
                alert('User gagal ditambahkan');
                document.location.href = 'bikin-user.php';
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
            <i class="fas fa-user"></i> <?= $title; ?>
          </div>
          <div class="card-body shadow-sm">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                </div>
                <div class="mb-3 col-md-6">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="" hidden>--Silahkan Pilih--</option>
                            <option value="0">Operator</option>
                            <option value="1">Admin</option>
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

<?php

require "../layout/footer.php";

?>