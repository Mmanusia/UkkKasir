<?
// Cek sesi Login
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
?>

<?php
include "koneksi.php";
$id_produk = $_GET['id_produk'];
if(isset($_POST['nama_produk'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    
    $query = mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga', stock = '$stock' WHERE id_produk = '$id_produk'");
    if($query){
        echo '<script>alert("Edit Data Berhasil");</script>';
        header("location: ../produk.php");
    } else {
        echo '<script>alert("Edit Data Gagal");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Produk</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="../index.php">
                                Dashboard
                            </a>
                            <a class="nav-link" href="../pelanggan.php">
                                Pelanggan
                            </a>
                            <a class="nav-link" href="../produk.php">
                                Produk / Barang
                            </a>
                            <a class="nav-link" href="../pembelian.php">
                                Pembelian
                            </a>
                            <a class="nav-link" href="../logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tabel Produk</h1>
                        <a class="btn btn-danger" href="../produk.php">Kembali</a>
                        <form method="POST">
                        <?php
                        include "koneksi.php";
                        $id_produk = $_GET['id_produk'];
                        $data = mysqli_query($koneksi, "SELECT * FROM produk where id_produk='$id_produk'");
                        while ($d = mysqli_fetch_array($data)){
                        ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama Produk:</td>
                                    <td><input class="form-control" type="text" name="nama_produk" value="<?php echo $d['nama_produk'];?>" required></td>
                                </tr>
                                <tr>
                                    <td>Harga:</td>
                                    <td><input name="harga" type="number" class="form-control" value="<?php echo $d['harga'];?>" required></td>
                                </tr>
                                <tr>
                                    <td>Stock:</td>
                                    <td><input class="form-control" type="number" name="stock" value="<?php echo $d['stock'];?>" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </table>
                            <?php 
                        }
                            ?>
                        </form>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Ahmad Fandio Fakhrudin</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
