
<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM bahan_baku WHERE id_bhnbaku='$_GET[id]'");
$pecah = $ambil->fetch_assoc();


$koneksi->query("DELETE FROM bahan_baku WHERE id_bhnbaku='$_GET[id]'");

echo "<script>alert('Data Bahan Baku Sudah Dihapus');</script>";
echo "<script>location='index.php?halaman=bahanbaku';</script>";

?>

