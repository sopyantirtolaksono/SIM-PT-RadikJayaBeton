<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pendapatan WHERE no_pendapatan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM pendapatan WHERE no_pendapatan='$_GET[id]'");

echo "<script>alert('Data Pendapatan Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=pendapatan';</script>";
