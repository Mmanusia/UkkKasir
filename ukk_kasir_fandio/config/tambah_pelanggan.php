<?php
session_start();
//// Cek sesi Login
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: ../login.php");
}
?>

<?php
include "koneksi.php";

if(isset($_POST['nama_pelanggan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    
    $query = mysqli_query($koneksi, "INSERT INTO pelanggan VALUES ('', '$nama_pelanggan', '$alamat', '$nomor_telepon')");
    if($query){
        echo '<script>alert("Tambah Data Berhasil");</script>';
        header("location: ../pelanggan.php");
        exit;
    } else {
        echo '<script>alert("Tambah Data Gagal");</script>';
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
        <title>Tambah Pelanggan</title>
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
                        <h1 class="mt-4">Tambah Pelanggan</h1>
                        <a class="btn btn-danger" href="../pelanggan.php">Kembali</a>
                        <form method="POST">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama pelanggan:</td>
                                    <td><input class="form-control" type="text" name="nama_pelanggan" required></td>
                                </tr>
                                <tr>
                                    <td>Alamat:</td>
                                    <td><textarea name="alamat" rows="5" class="form-control" required></textarea></td>
                                </tr>
                                <tr>
                                    <td>No. Telepon:</td>
                                    <td><input class="form-control" type="number" name="nomor_telepon" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </table>
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
