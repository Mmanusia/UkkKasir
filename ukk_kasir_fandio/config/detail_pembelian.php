<?php
session_start();
//// Cek sesi Login
include "koneksi.php";
if(!isset($_SESSION['user'])) {
    header("location: login.php");
}
?>

<?php
include "koneksi.php";

$id_penjualan = $_GET['id_penjualan'];
$query = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE id_penjualan = $id_penjualan");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Pembelian</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Applikasi Kasir</a>
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
                        <h1 class="mt-4">Detail Pembelian</h1>
                        <a class="btn btn-danger" href="../pembelian.php">Kembali</a>
                        <form method="POST">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama pelanggan:</td>
                                    <td>
                                        <?php echo $data['nama_pelanggan']; ?>
                                    </td>
                                </tr>
                                <?php
                                    $pro = mysqli_query($koneksi, "SELECT * FROM detailpenjualan LEFT JOIN produk ON produk.id_produk = detailpenjualan.id_produk WHERE id_penjualan = $id_penjualan");
                                    while($produk = mysqli_fetch_array($pro)){
                                ?>
                                <tr>
                                    <td><?php echo $produk['nama_produk']; ?></td>
                                    <td>
                                        Harga Satuan: <?php echo $produk['harga'];?><br>
                                        Jumlah: <?php echo $produk['jumlah_produk'];?><br>
                                        Sub Total: <?php echo $produk['sub_total'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="font-weight: bold;">Total Harga: <?php echo $data['total_harga'];?></td>
                                </tr>
                                <?php
                                    }
                                ?>
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
