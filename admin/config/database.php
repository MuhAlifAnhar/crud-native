<?php

$localhost = "localhost";
$id = "root";
$pass = "";
$db = "php";

$database = mysqli_connect($localhost, $id, $pass, $db);

// if(!$db){
//     die("Koneksi Gagal: " . mysqli_connect_error());
// } else {
//     echo "Koneksi Berhasil";
// }
?>