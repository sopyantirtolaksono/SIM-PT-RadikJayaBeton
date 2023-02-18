<h2>Edit Bahan Baku</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM bahanbaku WHERE id_bhnbaku='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label>Kode Bahan Baku</label>
				<input type="text" class="form-control" name="kode_bhnbaku" value="<?php echo $pecah['kd_bhnbaku']; ?>" disabled="disabled">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Nama Bahan Baku</label>
				<input type="text" name="nama_bhnbaku" class="form-control" value="<?php echo $pecah['nama_bhnbaku']; ?>">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Jenis</label>
				<input type="text" name="jenis" class="form-control" value="<?php echo $pecah['jenis']; ?>">
			</div>
		</div>
		<div class="col-md-12">
			<button class="btn btn-primary" name="edit">Edit</button>
		</div>
</form>

<?php
if (isset($_POST['edit'])) {
	$koneksi->query("UPDATE bahan_baku SET nama_bhnbaku='$_POST[nama_bhnbaku]', jenis='$_POST[jenis]' WHERE id_bhnbaku='$_GET[id]'");

	echo "<script>alert('Data Bahan Baku Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=bahanbaku';</script>";
}
?>