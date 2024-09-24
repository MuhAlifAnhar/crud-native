<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login dulu');
            document.location.href = 'login.php';
            </script>";
    exit;
}

require "config/app.php";

$id_film = $_GET['id'];

if(delete_film($id_film) > 0){
    echo "<script>
                alert('Film berhasil dihapus');
                document.location.href = 'film.php';
                </script>";
}else {
    echo "<script>
                alert('Film gagal dihapus');
                document.location.href = 'film.php';
                </script>";
}
?>