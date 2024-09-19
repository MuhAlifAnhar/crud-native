<?php

$title = "Edit Kategori";
require "../layout/header.php";

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID kategori tidak tersedia');
            document.location.href = 'kategori.php';
            </script>";
    exit;
}

$id = $_GET['id'];

$data = query("SELECT * FROM kategori WHERE id_kategori = $id");
if (empty($data)) {
    echo "<script>
            alert('Kategori tidak ditemukan');
            document.location.href = 'kategori.php';
            </script>";
    exit;
}

$category = $data[0];

if (isset($_POST['submit'])) {
    if (edit_kategori($id, $_POST) > 0) {
        echo "<script>
                alert('Kategori berhasil diperbarui');
                document.location.href = 'kategori.php';
                </script>";
    } else {
        echo "<script>
                alert('Kategori gagal diperbarui');
                document.location.href = 'edit-kategori.php?id=$id';
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
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($category['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= htmlspecialchars($category['slug']); ?>" readonly>
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
