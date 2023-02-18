<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pemasok WHERE id_pemasok='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM pemasok WHERE id_pemasok='$_GET[id]'");

echo "<script>alert('Data Pemasok Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=pemasok';</script>";
