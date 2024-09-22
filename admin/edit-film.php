<?php

$title = "Edit Film";
require "../layout/header.php";
$kategori = query("SELECT * FROM kategori ORDER BY create_at DESC");

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID film tidak tersedia');
            document.location.href = 'film.php';
            </script>";
    exit;
}

$id = $_GET['id'];

$data = query("SELECT * FROM film WHERE id_film = $id");
if (empty($data)) {
    echo "<script>
            alert('Film tidak ditemukan');
            document.location.href = 'film.php';
            </script>";
    exit;
}

$film = $data[0];

if (isset($_POST['submit'])) {
    if (edit_film($id, $_POST) > 0) {
        echo "<script>
                alert('Film berhasil diperbarui');
                document.location.href = 'film.php';
                </script>";
    } else {
        echo "<script>
                alert('Film gagal diperbarui');
                document.location.href = 'edit-film.php?id=$id';
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
                        <label for="link">Link <small>(copy dari youtube)</small></label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= htmlspecialchars($film['link']); ?>" required>
                    </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($film['title']); ?>" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="<?= htmlspecialchars($film['slug']); ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="tanggal_rilis">Tanggal Rilis</label>
                        <input type="date" class="form-control" id="tanggal_rilis" name="tanggal_rilis" value="<?= htmlspecialchars($film['tanggal_rilis']); ?>" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="studio">Studio</label>
                        <input type="text" class="form-control" id="studio" name="studio" value="<?= htmlspecialchars($film['studio']); ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="private">Status</label>
                        <select name="private" id="private" class="form-select" required>
                            <option value="" hidden>--Silahkan Pilih--</option>
                            <option value="0" <?= $film['private'] == 0 ? 'selected' : ''; ?>>Public</option>
                            <option value="1" <?= $film['private'] == 1 ? 'selected' : ''; ?>>Private</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select" required>
                            <option value="" hidden>--Silahkan Pilih--</option>
                            <?php foreach ($kategori as $kategories) : ?>
                                <option value="<?= $kategories['id_kategori']; ?>" <?= $kategories['id_kategori'] == $film['kategori_id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($kategories['name']); ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= htmlspecialchars($film['deskripsi']); ?></textarea>
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
