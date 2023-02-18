<h2>Edit User</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM user WHERE id_admin='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control" value="<?php echo $pecah['username']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Password</label>
			<input type="text" name="password" class="form-control" value="<?php echo $pecah['password']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Panjang</label>
			<input type="text" name="nama_panjang" class="form-control" value="<?php echo $pecah['nama_panjang']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Jabatan</label>
			<select name="jabatan" class="form-control" value="<?php echo $pecah['jabatan']; ?>">
				<option value="">Pilih Status</option>
				<option value="administrasi">administrasi</option>
				<option value="admin">admin</option>
				<option value="bendahara">bendahara</option>
				<option value="pimpinan">pimpinan</option>
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<button class="btn btn-primary pull-right" name="edit">Edit</button>
	</div>
</form>

<?php
if (isset($_POST['edit'])) {
	$koneksi->query("UPDATE user SET username='$_POST[username]', password='$_POST[password]', nama_panjang='$_POST[nama_panjang]', jabatan='$_POST[jabatan]' WHERE id_admin='$_GET[id]'");

	echo "<script>alert('Data User Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=user';</script>";
}
?>