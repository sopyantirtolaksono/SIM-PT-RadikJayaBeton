<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pengeluaran WHERE no_pengeluaran='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM pengeluaran WHERE no_pengeluaran='$_GET[id]'");

echo "<script>alert('Data Pengeluaran Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=pengeluaran';</script>";
