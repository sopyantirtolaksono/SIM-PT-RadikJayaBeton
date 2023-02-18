<h2>Edit Pelanggan</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kode Pelanggan</label>
			<input type="text" class="form-control" name="kode_pelanggan" value="<?php echo $pecah['kd_pelanggan']; ?>" disabled="disabled">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Pelanggan</label>
			<input type="text" name="nama_pelanggan" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>">
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
	$koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[nama_pelanggan]', alamat='$_POST[alamat]', no_tlp='$_POST[no_tlp]' WHERE id_pelanggan='$_GET[id]'");

	echo "<script>alert('Data Pelanggan Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=pelanggan';</script>";
}
?>