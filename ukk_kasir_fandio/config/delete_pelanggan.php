<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: ../login.php");
}

$id_pelanggan = $_GET['id_pelanggan'];
$query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
echo '<script>alert("Edit Data Berhasil");</script>';
header("location: ../pelanggan.php");
exit;
?>