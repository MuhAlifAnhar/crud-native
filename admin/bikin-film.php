<?php

$title = "Bikin Film";
require "../layout/header.php";
$kategori = query("SELECT * FROM kategori ORDER BY create_at DESC");


if (isset($_POST['submit'])){
    if (store_film($_POST) > 0) {
        echo "<script>
                alert('Film berhasil ditambahkan');
                document.location.href = 'film.php';
                </script>";
    }else {
        echo "<script>
                alert('Film gagal ditambahkan');
                document.location.href = 'bikin-film.php';
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
            <i class="fas fa-film"></i>  <?= $title; ?>
          </div>
          <div class="card-body shadow-sm">
            <form action="" method="POST">
                <div class="mb-3>
                        <label for="link">L;ink <small>(copy dari youtube)</small></label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="tanggal_rilis">Tanggal Rilis</label>
                        <input type="date" class="form-control" id="tanggal_rilis" name="tanggal_rilis" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="studio">Studio</label>
                        <input type="text" class="form-control" id="studio" name="studio" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="private">Status</label>
                        <select name="private" id="private" class="form-select" required>
                            <option value="" hidden>--Silahkan Pilih--</option>
                            <option value="0">Public</option>
                            <option value="1">Private</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select" required>
                            <option value="" hidden>--Silahkan Pilih--</option>
                            <?php foreach ($kategori as $kategories) : ?>
                            <option value="<?= $kategories['id_kategori']; ?>"><?= $kategories['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" row="3" required></textarea>
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

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

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