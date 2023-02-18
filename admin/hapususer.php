<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM user WHERE id_admin='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM user WHERE id_admin='$_GET[id]'");

echo "<script>alert('Data User Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=user';</script>";
