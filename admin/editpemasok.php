<h2>Edit Pemasok</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pemasok WHERE id_pemasok='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kode Pemasok</label>
			<input type="text" class="form-control" name="kode_pemasok" value="<?php echo $pecah['kd_pemasok']; ?>" disabled="disabled">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Pemasok</label>
			<input type="text" name="nama_pemasok" class="form-control" value="<?php echo $pecah['nama_pemasok']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Alamat</label>
			<input type="text" name="alamat" class="form-control" value="<?php echo $pecah['alamat']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>No. Tlp</label>
			<input type="number" class="form-control" name="no_tlp" value="<?php echo $pecah['no_tlp']; ?>">
		</div>
	</div>
	<div class="col-md-12">
		<button class="btn btn-primary" name="edit">Edit</button>
	</div>
</form>

<?php
if (isset($_POST['edit'])) {
	$koneksi->query("UPDATE pemasok SET nama_pemasok='$_POST[nama_pemasok]',
			alamat='$_POST[alamat]', no_tlp='$_POST[no_tlp]' WHERE id_pemasok='$_GET[id]'");

	echo "<script>alert('Data Pemasok Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=pemasok';</script>";
}
?>