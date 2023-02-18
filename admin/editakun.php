<h2>Edit Akun</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM akun WHERE id_akun='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Kode Akun</label>
				<input type="text" class="form-control" name="kode_akun" value="<?php echo $pecah['kd_akun']; ?>" disabled="disabled">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Akun</label>
				<input type="text" name="nama_akun" class="form-control" value="<?php echo $pecah['nama_akun']; ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Saldo</label>
				<input type="text" name="saldo" class="form-control" value="<?php echo $pecah['saldo']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<br>
				<button class="btn btn-primary" name="edit">Edit</button>
			</div>
		</div>
	</div>
</form>

<?php
if (isset($_POST['edit'])) {
	$koneksi->query("UPDATE akun 
						SET 
			nama_akun='$_POST[nama_akun]',
			saldo='$_POST[saldo]'
			WHERE id_akun='$_GET[id]'");

	echo "<script>alert('Data akun Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=akun';</script>";
}
?>