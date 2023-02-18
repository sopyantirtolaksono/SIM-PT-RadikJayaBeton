<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM akun WHERE id_akun='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM akun WHERE id_akun='$_GET[id]'");

echo "<script>alert('Data akun Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=akun';</script>";
