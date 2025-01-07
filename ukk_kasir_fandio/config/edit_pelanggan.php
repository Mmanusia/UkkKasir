<?
// Cek sesi Login
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: login.php");
}
?>

<?php
include "koneksi.php";
$id_pelanggan = $_GET['id_pelanggan'];
if(isset($_POST['nama_pelanggan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    
    $query = mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', alamat = '$alamat', nomor_telepon = '$nomor_telepon' WHERE id_pelanggan = '$id_pelanggan'");
    if($query){
        echo '<script>alert("Edit Data Berhasil");</script>';
        header("location: ../pelanggan.php");
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
        <title>Edit Pelanggan</title>
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
                        <h1 class="mt-4">Tabel Pelanggan</h1>
                        <a class="btn btn-danger" href="../pelanggan.php">Kembali</a>
                        <form method="POST">
                        <?php
                        include "koneksi.php";
                        $id_pelanggan = $_GET['id_pelanggan'];
                        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan where id_pelanggan='$id_pelanggan'");
                        while ($d = mysqli_fetch_array($data)){
                        ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama pelanggan:</td>
                                    <td><input class="form-control" type="text" name="nama_pelanggan" value="<?php echo $d['nama_pelanggan'];?>" required></td>
                                </tr>
                                <tr>
                                    <td>Alamat:</td>
                                    <td><textarea name="alamat" rows="5" class="form-control"required><?php echo $d['alamat'];?></textarea></td>
                                </tr>
                                <tr>
                                    <td>No. Telepon:</td>
                                    <td><input class="form-control" type="number" name="nomor_telepon" value="<?php echo $d['nomor_telepon'];?>" required></td>
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
