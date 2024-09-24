<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
            </script>";
    exit;
}

  $title = "Detail Film";
  require "../layout/header.php";
//   $film = query("SELECT * FROM film ORDER BY created_at DESC");
// $film = query("SELECT * FROM film JOIN kategori ON film.kategori_id = kategori.id_kategori ORDER BY created_at DESC");

$id = $_GET['id'];

// $data = query("SELECT * FROM film WHERE id_film = $id");
$film = query("SELECT f.*, k.name AS kategori_nama FROM film f JOIN kategori k ON f.kategori_id = k.id_kategori WHERE f.id_film = $id")[0];

if (empty($film)) {
    echo "<script>
            alert('Film tidak ditemukan');
            document.location.href = 'film.php';
            </script>";
    exit;
}

// $film = query("SELECT f.*, k.name AS kategori_nama FROM film f JOIN kategori k ON f.kategori_id = k.id_kategori WHERE f.id_film = $id");
?>

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-film"></i> <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%;">
                                <tr>
                                    <th>Video</th>
                                    <td><iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $film['link']; ?>?si=0qnjm4Oqr2xwg1x2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td><?= $film['title']; ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $film['kategori_nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $film['kategori_nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td><?= $film['deskripsi']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Rilis</th>
                                    <td><?= $film['tanggal_rilis']; ?></td>
                                </tr>
                                <tr>
                                    <th>Studio</th>
                                    <td><?= $film['studio']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?= $film['private'] ? 'Private' : 'Public'; ?></td>
                                </tr>
                            </table>
                            <div class="float-end">
                                <a href="film.php" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
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