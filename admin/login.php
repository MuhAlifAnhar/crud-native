<?php
session_start();
if (isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus logout dulu');
            document.location.href = 'index.php';
            </script>";
    exit;
}
$title = "Halaman Login";

require "config/database.php";

$error = false; // Inisialisasi variabel error

if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($database, $_POST["email"]);
    $password = mysqli_real_escape_string($database, $_POST["password"]);

    // Query untuk mencari pengguna berdasarkan email
    // $result = mysqli_query($database, "SELECT * FROM users WHERE email = '$email'");

    $stmt = $database->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah ada pengguna dengan email tersebut
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result); // Ambil data pengguna

        // Verifikasi password
        if (password_verify($password, $user["password"])) {
            // Set session jika login berhasil
            $_SESSION["login"] = true;    
            $_SESSION["id"] = $user["id_user"];      
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            header("Location: index.php");
            exit();
        } else {
            $error = true; // Password salah
        }
    } else {
        $error = true; // Pengguna tidak ditemukan
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%; 
        }
        .full-height {
            height: 100vh;
        }
    </style>
</head>
<body>

<main class="py-5 full-height d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header text-center">
            <h5>Login</h5>
          </div>

          <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error:</strong> Email atau Password salah.
            </div>
          <?php endif; ?>

          <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Masuk</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
