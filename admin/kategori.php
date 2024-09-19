<?php
  $title = "Kategori";
  require "../layout/header.php";
  $kategori = query("SELECT * FROM kategori ORDER BY create_at DESC");
?>

<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12"> <!-- Kolom penuh lebar di semua ukuran layar -->
        <div class="card">
          <div class="card-header">
            <i class="fas fa-th-large"></i> <?= $title; ?>
          </div>
          <div class="card-body shadow-sm">
            <div class="table-responsive">
              <a href="bikin-kategori.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Buat Kategori</a>
              <table id="myTable" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($kategori as $kategories) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $kategories['name']; ?></td>
                      <td><?= $kategories['slug']; ?></td>
                      <td><?= $kategories['create_at']; ?></td>
                      <td>
                        <a href="edit-kategori.php?id=<?= $kategories['id_kategori']; ?>" class="badge bg-warning border-0 text-decoration-none me-2" title="Edit">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="hapus-kategori.php?id=<?= $kategories['id_kategori']; ?>" class="badge bg-danger border-0 text-decoration-none" onclick="return confirm('Yakin ingin menghapus kategori?')" title="Hapus">
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
