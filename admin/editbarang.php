<h2>Edit Barang</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM barang WHERE id_barang='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kode Barang</label>
			<input type="text" class="form-control" name="kode_barang" value="<?php echo $pecah['kd_barang']; ?>" disabled="disabled">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Spesifikasi</label>
			<input type="text" name="spesifikasi" class="form-control" value="<?php echo $pecah['spesifikasi']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Slump</label>
			<input type="text" name="slump" class="form-control" value="<?php echo $pecah['slump']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Size</label>
			<input type="text" name="size" class="form-control" value="<?php echo $pecah['size']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Harga</label>
			<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<br>
			<button class="btn btn-primary" name="edit">Edit</button>
		</div>
</form>

<?php
if (isset($_POST['edit'])) {
	$koneksi->query("UPDATE barang SET spesifikasi='$_POST[spesifikasi]',
			slump='$_POST[slump]', size='$_POST[size]',
			harga='$_POST[harga]' WHERE id_barang='$_GET[id]'");

	echo "<script>alert('Data Barang Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=barang';</script>";
}
?>