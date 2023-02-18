<?php

// menghilangkan notice/warning
error_reporting(0);

// mulai session
session_start();

//koneksi ke database
include 'koneksi.php';

// cek jika belum ada user yang login
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIA LABA BERSIH</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <!-- <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" /> -->
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><small>PT. RADIK JAYA BETON</small></a>
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> Last Access: <?= date("d, F, Y"); ?> &nbsp;
                <a href="logout.php" class="btn btn-danger square-btn-adjust" onclick="return confirm('Anda Ingin Keluar?')">Logout</a>
            </div>
        </nav>

        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/index.png" class="user-image img-responsive" />
                    </li>
                    <!-- untuk user admin -->
                    <?php if ($_SESSION["user"]["jabatan"] === "admin") { ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li>
                            <a href="#"><i class="fa fa-edit"></i>Pendataan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">                                
                                <li>
                                    <a href="index.php?halaman=barang">Barang</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pelanggan">Pelanggan</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=bahanbaku">Bahan Baku</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pemasok">Pemasok</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=akun">Akun</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file"></i>Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=laporan_barang">Laporan Barang</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pelanggan">Laporan Pelanggan</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_bhnbaku">Laporan Bahan Baku</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pemasok">Laporan Pemasok</a>
                                </li>
                          <li>
                            <a href="index.php?halaman=laporan_pajak">Laporan Pajak</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=laporan_labarugi">Laporan Laba Rugi</a>
                        </li>
                    </ul>
                    <?php } ?>
                    <!-- untuk user bendahara -->
                    <?php if ($_SESSION["user"]["jabatan"] === "bendahara") { ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li>
                            <a href="#"><i class="fa fa-desktop"></i>Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=pendapatan">Pendapatan</a>
                                </li>
                                 <li>
                                    <a href="index.php?halaman=pembelian">Pembelian</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pengeluaran">Pengeluaran</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file"></i>Laporan Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=laporan_pendapatan">Pendapatan</a>
                                </li>
                                 <li>
                                    <a href="index.php?halaman=laporan_pembelian">Pembelian</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pengeluaran">Pengeluaran</a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <!-- untuk user pimpinan -->
                    <?php if ($_SESSION["user"]["jabatan"] === "pimpinan") { ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li>
                            <a href="#"><i class="fa fa-file"></i>Laporan <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=laporan_barang">Laporan Barang</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pelanggan">Laporan Pelanggan</a>
                                 </li>
                                <li>
                                    <a href="index.php?halaman=laporan_bhnbaku">Laporan Bahan Baku</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pemasok">Lapoaran Pemasok</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pendapatan">Laporan Pendapatan</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pembelian">Laporan Pembelian</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pengeluaran">Laporan Pengeluaran</a>
                                </li>
                        <li>
                            <a href="index.php?halaman=laporan_pajak">Laporan Pajak</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=laporan_labarugi">Laporan Laba Rugi</a>
                        </li>
                                                    </ul>
                        </li>
                        <li>
                            <a href="index.php?halaman=user"><i class="fa fa-user"></i>User</a>
                        </li>
                    <?php } ?>
                    <!-- untuk user administrator -->
                    <?php if ($_SESSION["user"]["jabatan"] === "administrator") { ?>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li>
                            <a href="#"><i class="fa fa-edit"></i>Pendataan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=barang">Barang</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pelanggan">Pelanggan</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=bahanbaku">Bahan Baku</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pemasok">Pemasok</a>
                                </li>
                                 <li>
                                    <a href="index.php?halaman=akun">Akun</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-desktop"></i>Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=pendapatan">Pendapatan</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pembelian">Pembelian</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=pengeluaran">Pengeluaran</a>
                                </li>
                            </ul>
                        </li>
                            
                                <li>
                            <a href="#"><i class="fa fa-file"></i>Laporan <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?halaman=laporan_barang">Laporan Barang</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pelanggan">Laporan Pelanggan</a>
                                 </li>
                                <li>
                                    <a href="index.php?halaman=laporan_bhnbaku">Laporan Bahan Baku</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pemasok">Lapoaran Pemasok</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pendapatan">Laporan Pendapatan</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pembelian">Laporan Pembelian</a>
                                </li>
                                <li>
                                    <a href="index.php?halaman=laporan_pengeluaran">Laporan Pengeluaran</a>
                                </li>
                        <li>
                            <a href="index.php?halaman=laporan_pajak">Laporan Pajak</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=laporan_labarugi">Laporan Laba Rugi</a>
                        </li>
                        </ul>
                        </li>
                        
                        <li>
                            <a href="index.php?halaman=user"><i class="fa fa-user"></i>User</a>
                        </li>
                    <?php } ?>


                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman'])) {
                    if ($_GET['halaman'] == "barang") {
                        include 'barang.php';
                    } elseif ($_GET['halaman'] == "pemasok") {
                        include 'pemasok.php';
                    } elseif ($_GET['halaman'] == "pelanggan") {
                        include 'pelanggan.php';
                    } elseif ($_GET['halaman'] == "bahanbaku") {
                        include 'bahanbaku.php';
                    } elseif ($_GET['halaman'] == "pendapatan") {
                        include 'pendapatan.php';
                    } elseif ($_GET['halaman'] == "pembelian") {
                        include 'pembelian.php';
                    } elseif ($_GET['halaman'] == "pengeluaran") {
                        include 'pengeluaran.php';
                    } elseif ($_GET['halaman'] == "nota_pendapatan") {
                        include 'nota_pendapatan.php';
                    } elseif ($_GET['halaman'] == "nota_pembelian") {
                        include 'nota_pembelian.php';
                    } elseif ($_GET['halaman'] == "nota_pengeluaran") {
                        include 'nota_pengeluaran.php';
                    } elseif ($_GET['halaman'] == "akun") {
                        include 'akun.php';
                    } elseif ($_GET['halaman'] == "hapusbarang") {
                        include 'hapusbarang.php';
                    } elseif ($_GET['halaman'] == "editbarang") {
                        include 'editbarang.php';
                    } elseif ($_GET['halaman'] == "tambahbarang") {
                        include 'tambahbarang.php';
                    } elseif ($_GET['halaman'] == "tambahakun") {
                        include 'tambahakun.php';
                    } elseif ($_GET['halaman'] == "hapuspemasok") {
                        include 'hapuspemasok.php';
                    } elseif ($_GET['halaman'] == "hapusakun") {
                        include 'hapusakun.php';
                    } elseif ($_GET['halaman'] == "editpemasok") {
                        include 'editpemasok.php';
                    } elseif ($_GET['halaman'] == "editakun") {
                        include 'editakun.php';
                    } elseif ($_GET['halaman'] == "tambahpemasok") {
                        include 'tambahpemasok.php';
                    } elseif ($_GET['halaman'] == "hapuspelanggan") {
                        include 'hapuspelanggan.php';
                    } elseif ($_GET['halaman'] == "editpelanggan") {
                        include 'editpelanggan.php';
                    } elseif ($_GET['halaman'] == "tambahpelanggan") {
                        include 'tambahpelanggan.php';
                    } elseif ($_GET['halaman'] == "hapusbhnbaku") {
                        include 'hapusbhnbaku.php';
                    } elseif ($_GET['halaman'] == "editbhnbaku") {
                        include 'editbhnbaku.php';
                    } elseif ($_GET['halaman'] == "tambahbhnbaku") {
                        include 'tambahbhnbaku.php';
                    } elseif ($_GET['halaman'] == "tambahpendapatan") {
                        include 'tambahpendapatan.php';
                    } elseif ($_GET['halaman'] == "editpendapatan") {
                        include 'editpendapatan.php';
                    } elseif ($_GET['halaman'] == "tambahpembelian") {
                        include 'tambahpembelian.php';
                    } elseif ($_GET['halaman'] == "editpembelian") {
                        include 'editpembelian.php';
                    } elseif ($_GET['halaman'] == "tambahpengeluaran") {
                        include 'tambahpengeluaran.php';
                    } elseif ($_GET['halaman'] == "editpengeluaran") {
                        include 'editpengeluaran.php';
                    } elseif ($_GET['halaman'] == "laporan_barang") {
                        include 'laporan_barang.php';
                    } elseif ($_GET['halaman'] == "laporan_bhnbaku") {
                        include 'laporan_bhnbaku.php';
                    } elseif ($_GET['halaman'] == "laporan_pelanggan") {
                        include 'laporan_pelanggan.php';
                    } elseif ($_GET['halaman'] == "laporan_pemasok") {
                        include 'laporan_pemasok.php';
                    } elseif ($_GET['halaman'] == "laporan_pendapatan") {
                        include 'laporan_pendapatan.php';
                    } elseif ($_GET['halaman'] == "laporan_pembelian") {
                        include 'laporan_pembelian.php';
                    } elseif ($_GET['halaman'] == "laporan_pengeluaran") {
                        include 'laporan_pengeluaran.php';
                    } elseif ($_GET['halaman'] == "laporan_labarugi") {
                        include 'laporan_labarugi.php';
                    } elseif ($_GET['halaman'] == "cetakbarang") {
                        include 'cetakbarang.php';
                    } elseif ($_GET['halaman'] == "cetakbhnbaku") {
                        include 'cetakbhnbaku.php';
                    } elseif ($_GET['halaman'] == "cetakpelanggan") {
                        include 'cetakpelanggan.php';
                    } elseif ($_GET['halaman'] == "cetakpemasok") {
                        include 'cetakpemasok.php';
                    } elseif ($_GET['halaman'] == "cetakpendapatan") {
                        include 'cetakpendapatan.php';
                    } elseif ($_GET['halaman'] == "cetakpembelian") {
                        include 'cetakpembelian.php';
                    } elseif ($_GET['halaman'] == "cetakpengeluaran") {
                        include 'cetakpengeluaran.php';
                    } elseif ($_GET['halaman'] == "cetaklabarugi") {
                        include 'cetaklabarugi.php';
                    } elseif ($_GET['halaman'] == "user") {
                        include 'user.php';
                    } elseif ($_GET['halaman'] == "tambahuser") {
                        include 'tambahuser.php';
                    } elseif ($_GET['halaman'] == "hapususer") {
                        include 'hapususer.php';
                    } elseif ($_GET['halaman'] == "edituser") {
                        include 'edituser.php';
                    } elseif ($_GET['halaman'] == "laporan_pajak") {
                        include 'laporan_pajak.php';
                    } elseif ($_GET['halaman'] == "cetakpajak") {
                        include 'cetakpajak.php';
                    } elseif ($_GET['halaman'] == "hapuspendapatan") {
                        include 'hapuspendapatan.php';
                    } elseif ($_GET['halaman'] == "hapuspembelian") {
                        include 'hapuspembelian.php';
                    } elseif ($_GET['halaman'] == "hapuspengeluaran") {
                        include 'hapuspengeluaran.php';
                    }
                } else {
                    include 'home.php';
                }
                ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>

    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <!-- <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script> -->
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>

</body>

</html>