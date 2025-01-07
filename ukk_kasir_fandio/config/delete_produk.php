<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: ../login.php");
}

$id_produk = $_GET['id_produk'];
$query = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id_produk'");
echo '<script>alert("Edit Data Berhasil");</script>';
header("location: ../produk.php");
exit;
?>