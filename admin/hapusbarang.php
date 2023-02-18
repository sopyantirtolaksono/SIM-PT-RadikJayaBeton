<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM barang WHERE id_barang='$_GET[id]'");

echo "<script>alert('Data Barang Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=barang';</script>";
