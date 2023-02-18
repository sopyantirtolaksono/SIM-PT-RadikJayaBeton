<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE no_pembelian='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM pembelian WHERE no_pembelian='$_GET[id]'");

echo "<script>alert('Data Pembelian Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=pembelian';</script>";
