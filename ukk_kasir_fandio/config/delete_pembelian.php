<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: ../login.php");
}

$id_penjualan = $_GET['id_penjualan'];
$query = mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan = '$id_penjualan'");
$query = mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE id_penjualan = '$id_penjualan'");
echo '<script>alert("Edit Data Berhasil");</script>';
header("location: ../pembelian.php");
exit;
?>