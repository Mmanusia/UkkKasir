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

if(isset($_POST['id_pelanggan'])) {

    $id_pelanggan = $_POST['id_pelanggan'];
    $produk = $_POST['produk'];
    $total_harga = 0;
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    
    $query = mysqli_query($koneksi, "INSERT INTO penjualan(tanggal_penjualan,id_pelanggan) VALUES('$tanggal_penjualan', '$id_pelanggan')");

    $idTerakhir = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM penjualan ORDER BY id_penjualan DESC"));
    $id_penjualan = $idTerakhir['id_penjualan'];

    foreach($produk as $key=>$val){
        $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk where id_produk = $key"));

        if ($val > 0) {
        $sub = $val * $pr['harga'];
        $total_harga += $sub;
        $query = mysqli_query($koneksi, "INSERT INTO detailpenjualan(id_penjualan,id_produk,jumlah_produk,sub_total) VALUES('$id_penjualan', '$key', '$val', '$sub')");
        
        $updateProduk = mysqli_query($koneksi, "UPDATE produk set stock=stock-$val WHERE id_produk=$key");
        }
    }

    $query = mysqli_query($koneksi, "UPDATE penjualan SET total_harga = $total_harga WHERE id_penjualan=$id_penjualan");


    if($query){
        echo '<script>alert("Tambah Data Berhasil");</script>';
        header("location: ../pembelian.php");
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
        <title>Tambah Pembelian</title>
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
                        <h1 class="mt-4">Tambah Pembelian</h1>
                        <a class="btn btn-danger" href="../pembelian.php">Kembali</a>
                        <form method="POST">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama pelanggan:</td>
                                    <td>
                                        <select name="id_pelanggan" class="form-control form-select">
                                            <?php
                                            $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                                            while($pel = mysqli_fetch_array($p)){
                                                ?>
                                                <option value="<?php echo $pel['id_pelanggan']; ?>"><?php echo $pel['nama_pelanggan']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal:</td>
                                    <td><input class="form-control" type="date" name="tanggal_penjualan"></td>
                                </tr>
                                    <?php
                                        $pro = mysqli_query($koneksi, "SELECT * FROM produk");
                                        while($produk = mysqli_fetch_array($pro)){
                                    ?>
                                <tr>
                                        <td><?php echo $produk['nama_produk'] . ' (Stock : '.$produk['stock'].')';?></td>
                                        <td>
                                            <input class="form-control" type="number" 
                                            stage="0" value="0" min="0" max="<?php echo $produk['stock'];?>" name="produk[<?php echo $produk['id_produk'];?>]">
                                        </td>
                                </tr>
                                <?php
                                }
                                ?>
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
