<h2>Edit Pembelian</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE no_pembelian='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>
<div class="panel-body">

	<form method="post">
		<div class="col-md-6">
			<div class="form-group">
				<label>Kode Pembelian</label>
				<input type="text" class="form-control" name="kd_pembelian" value="<?php echo $pecah['kd_pembelian']; ?>" readonly required />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Tanggal</label>
				<input type="date" class="form-control" name="tanggal" required value="<?php echo $pecah['tanggal']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Bahan Baku</label>
				<select class="form-control" name="nama_bhnbaku">
					<option value="0">Pilih Bahan Baku</option>
					<?php
					$bahanbaku = mysqli_query($koneksi, "SELECT * FROM bahanbaku");
					while ($rbahanbaku = mysqli_fetch_assoc($bahanbaku)) {
					?>
						<option value="<?php echo $rbahanbaku['nama_bhnbaku']; ?>"><?php echo $rbahanbaku['nama_bhnbaku']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Nama Pemasok</label>
				<select class="form-control" name="nama_pemasok">
					<option value="0">Pilih Nama Pemasok</option>
					<?php
					$pemasok = mysqli_query($koneksi, "SELECT * FROM pemasok");
					while ($rpemasok = mysqli_fetch_assoc($pemasok)) {
					?>
						<option value="<?php echo $rpemasok['nama_pemasok']; ?>"><?php echo $rpemasok['nama_pemasok']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" id="jumlah" name="jumlah" onkeyup="sum();" required value="<?php echo $pecah['jumlah']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class=" form-group">
				<label>Harga</label>
				<input type="number" class="form-control" id="harga" name="harga" onkeyup="sum();" required value="<?php echo $pecah['harga']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Total</label>
				<input type="number" class="form-control" id="total" name="total" required value="<?php echo $pecah['total']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<br>
			<button class="btn btn-primary" name="edit" id="edit">Edit</button>
	</form>

	<?php
	if (isset($_POST['edit'])) {
		$koneksi->query("UPDATE pembelian SET tanggal='$_POST[tanggal]',nama_bhnbaku='$_POST[nama_bhnbaku]',nama_pemasok='$_POST[nama_pemasok]',jumlah='$_POST[jumlah]',harga='$_POST[harga]',total='$_POST[total]' WHERE no_pembelian='$_GET[id]'");

		echo "<script>alert('Data Pembelian Telah Diedit');</script>";
		echo "<script>location='index.php?halaman=pembelian';</script>";
	}
	?>

	<script>
		function sum() {
			var jumlah = document.getElementById('jumlah').value;
			var harga = document.getElementById('harga').value;
			var result = parseInt(jumlah) * parseInt(harga);
			if (!isNaN(result)) {
				document.getElementById('total').value = result;

			}
		}
	</script>