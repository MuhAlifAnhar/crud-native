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

$id_user = $_GET['id'];

if(delete_user($id_user) > 0){
    echo "<script>
                alert('User berhasil dihapus');
                document.location.href = 'user.php';
                </script>";
}else {
    echo "<script>
                alert('User gagal dihapus');
                document.location.href = 'user.php';
                </script>";
}
?>