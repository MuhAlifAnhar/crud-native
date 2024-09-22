<?php
  $title = "Film";
  require "../layout/header.php";
//   $film = query("SELECT * FROM film ORDER BY created_at DESC");
// $film = query("SELECT * FROM film JOIN kategori ON film.kategori_id = kategori.id_kategori ORDER BY created_at DESC");
$film = query("SELECT f.id_film, f.title, f.studio, f.created_at, f.private, k.name AS kategori_nama FROM film f JOIN kategori k ON f.kategori_id = k.id_kategori WHERE f.private = 0 ORDER BY f.created_at DESC");
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
                            <a href="bikin-film.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Buat
                                Film</a>
                                <a href="download-film.php" class="btn btn-warning mb-3"><i class="fas fa-plus"></i> Download</a>
                            <table id="myTable" class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Nama</th>
                                        <th>Studio</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th width="20%">Waktu</th>
                                        <th width="20%">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($film as $films) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $films['title']; ?></td>
                                        <td><?= $films['studio']; ?></td>
                                        <td><?= $films['kategori_nama']; ?></td>
                                        <td><?= $films['private'] ? '<span class="badge bg-danger">Private</span>' : '<span class="badge bg-success">Public</span>'; ?>
                                        </td>
                                        <td><?= $films['created_at']; ?></td>
                                        <td>
                                            <a href="detail-film.php?id=<?= $films['id_film']; ?>"
                                                class="badge bg-success border-0 text-decoration-none me-2"
                                                title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="edit-film.php?id=<?= $films['id_film']; ?>"
                                                class="badge bg-warning border-0 text-decoration-none me-2"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="hapus-film.php?id=<?= $films['id_film']; ?>"
                                                class="badge bg-danger border-0 text-decoration-none"
                                                onclick="return confirm('Yakin ingin menghapus film?')"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
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