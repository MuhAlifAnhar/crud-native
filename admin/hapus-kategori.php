<?php

require "config/app.php";

$id_kategori = $_GET['id'];

if(delete_kategori($id_kategori) > 0){
    echo "<script>
                alert('Kategori berhasil dihapus');
                document.location.href = 'kategori.php';
                </script>";
}else {
    echo "<script>
                alert('Kategori gagal dihapus');
                document.location.href = 'kategori.php';
                </script>";
}
?>