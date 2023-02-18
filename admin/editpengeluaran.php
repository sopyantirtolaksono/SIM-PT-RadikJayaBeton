<h2>Edit Pengeluaran</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pengeluaran WHERE no_pengeluaran='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<?php
$query = mysqli_query($koneksi, "SELECT * FROM akun WHERE nama_akun='$_GET[id]'");
while ($row = mysqli_fetch_array($query))
?>


<form method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Kode Pengeluaran</label>
				<input type="text" class="form-control" name="kd_pengeluaran" required value="<?php echo $pecah['kd_pengeluaran']; ?>" readonly />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Tanggal</label>
				<input type="date" name="tanggal" class="form-control" value="<?php echo $pecah['tanggal']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Akun</label>
				<select class="form-control" name="nama_akun">
					<option value="0">Pilih Nama Akun</option>
					<?php
					$akun = mysqli_query($koneksi, "SELECT * FROM akun");
					while ($rakun = mysqli_fetch_assoc($akun)) {
					?>
						<option value="<?php echo $rakun['nama_akun']; ?>"><?php echo $rakun['nama_akun']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" name="jumlah" class="form-control" value="<?php echo $pecah['jumlah']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" name="keterangan" class="form-control" value="<?php echo $pecah['keterangan']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<button class="btn btn-primary" name="edit">Edit</button>
		</div>
	</div>
</form>

<?php
if (isset($_POST['edit'])) {
	$koneksi->query("UPDATE pengeluaran SET tanggal='$_POST[tanggal]',nama_akun='$_POST[nama_akun]',jumlah='$_POST[jumlah]',keterangan='$_POST[keterangan]' WHERE no_pengeluaran='$_GET[id]'");

	echo "<script>alert('Data Pengeluaran Telah Diedit');</script>";
	echo "<script>location='index.php?halaman=pengeluaran';</script>";
}
?>