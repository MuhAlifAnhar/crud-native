<?php
  $title = "Dashboard";
  session_start(); // Memulai sesi
  if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
            </script>";
    exit;
}

  require "../layout/header.php";

  // Cek apakah pengguna sudah login
  if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
          </script>";
    exit;
  }

  // Ambil username dari sesi atau set default menjadi 'Guest'
  $username = isset($_SESSION["username"]) ? $_SESSION["username"] : 'Guest';
?>

<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12"> <!-- Memperbaiki ukuran kolom untuk layout yang lebih baik -->
        <div class="card">
          <div class="card-header">
            <i class="fas fa-tachometer-alt"></i> <?= $title; ?> - Welcome, <?= htmlspecialchars($username); ?>
          </div>
          <div class="card-body shadow-sm">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore vel modi, molestias saepe odio quisquam debitis vitae dolores!
          </div>
          <div class="card-footer">Tes</div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
  require "../layout/footer.php";
?>
