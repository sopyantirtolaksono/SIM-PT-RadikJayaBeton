<?php

	include 'koneksi.php';
	$sql = "SELECT max(right(kd_pembelian, 4)) AS kd_beli FROM beli";
	$q = $koneksi->query($sql);

	if ($q->num_rows > 0) {
		foreach ($q as $qq) {
			$no = ((int)$qq['kd_beli']) + 1;
			$kd = sprintf("%04s", $no);
		}
	} else {
		$kd = "0001";
	}
	$huruf = "PMB-";
	$kode = $huruf . $kd;

	// jika tombol simpan ditekan
	if(isset($_POST['save'])) {

		$statusBeli = $koneksi->query("INSERT INTO beli (kd_pembelian) VALUES ('$_POST[kd_pembelian]')");

		$noBeli = $koneksi->insert_id;
		$ambilBeli = $koneksi->query("SELECT * FROM beli WHERE no_beli = '$noBeli' ");
		$pecahBeli = $ambilBeli->fetch_assoc();

		if($statusBeli === true) {
			echo "<script>
				$(document).ready(function() {
					$('button[name=save]').attr('disabled', '');
					$('button[name=save]').text('Menunggu...');
					$('button[name=buyagain]').css('display', 'block');
					$('button[name=finish]').css('display', 'block');

					$('button[name=buyagain]').on('click', function() {
						$('button[name=save]').remove();
						$('button[name=save_again]').css('display', 'block');
						$(this).attr('disabled', '');
					});

					$('button[name=finish]').on('click', function() {
						location = 'index.php?halaman=nota_pembelian&kode=$pecahBeli[kd_pembelian]';
					});
				});
			</script>";

			$koneksi->query("INSERT INTO pembelian (kd_pembelian,tanggal,nama_bhnbaku,nama_pemasok,jumlah,harga,total) VALUES ('" . $_POST["kd_pembelian"] . "','" . $_POST["tanggal"] . "','" . $_POST["nama_bhnbaku"] . "','" . $_POST["nama_pemasok"] . "','" . $_POST["jumlah"] . "','" . $_POST["harga"] . "','" . $_POST["total"] . "')");

			$noPembelian 	= $koneksi->insert_id;
			$ambilPembelian = $koneksi->query("SELECT * FROM pembelian WHERE no_pembelian = '$noPembelian' ");
			$pecahPembelian = $ambilPembelian->fetch_assoc();

			echo "<div class='alert alert-info'> Data Tersimpan </div>";
			// echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";
		}

	}

	// beli lagi
	if(isset($_POST["save_again"])) {

		$statusPembelian = $koneksi->query("INSERT INTO pembelian (kd_pembelian,tanggal,nama_bhnbaku,nama_pemasok,jumlah,harga,total) VALUES ('" . $_POST["kd_pembelian"] . "','" . $_POST["tanggal"] . "','" . $_POST["nama_bhnbaku"] . "','" . $_POST["nama_pemasok"] . "','" . $_POST["jumlah"] . "','" . $_POST["harga"] . "','" . $_POST["total"] . "')");

		$noPembelian = $koneksi->insert_id;
		$ambilPembelian = $koneksi->query("SELECT * FROM pembelian WHERE no_pembelian = '$noPembelian' ");
		$pecahPembelian = $ambilPembelian->fetch_assoc();

		if($statusPembelian === true) {
			echo "<script>
				$(document).ready(function() {
					$('button[name=save]').attr('disabled', '');
					$('button[name=save]').text('Menunggu...');
					$('button[name=buyagain]').css('display', 'block');
					$('button[name=finish]').css('display', 'block');

					$('button[name=buyagain]').on('click', function() {
						$('button[name=save]').remove();
						$('button[name=save_again]').css('display', 'block');
						$(this).attr('disabled', '');
					});

					$('button[name=finish]').on('click', function() {
						location = 'index.php?halaman=nota_pembelian&kode=$pecahPembelian[kd_pembelian]';
					});
				});
			</script>";

			echo "<div class='alert alert-info'> Data Tersimpan </div>";
		}

	}

?>

<!-- style css action button -->
<style type="text/css">
    /*tampilan mobile*/
    @media screen and (max-width: 768px) {
        div.action-button div.col-md-4 {
            padding: 0 15px 0 15px !important;
        }
    }
</style>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Tambah Pembelian</h2>
	</div>
	<br>
	<div class="panel-body">
		<form method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Kode Pembelian</label>

						<?php if($statusBeli === true) { ?>
						<input type="text" class="form-control" name="kd_pembelian" value="<?php echo $pecahBeli['kd_pembelian']; ?>" readonly required />
						<?php } else if($statusPembelian === true) { ?>
						<input type="text" class="form-control" name="kd_pembelian" value="<?php echo $pecahPembelian['kd_pembelian']; ?>" readonly required />
						<?php } else { ?>
						<input type="text" class="form-control" name="kd_pembelian" value="<?php echo $kode; ?>" readonly required />
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tanggal</label>

						<?php if($statusBeli === true) { ?>
						<input type="date" class="form-control" name="tanggal" value="<?php echo $pecahPembelian['tanggal']; ?>" readonly required>
						<?php } else if($statusPembelian === true) { ?>
						<input type="date" class="form-control" name="tanggal" value="<?php echo $pecahPembelian['tanggal']; ?>" readonly required>
						<?php } else { ?>
						<input type="date" class="form-control" name="tanggal" required>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Bahan Baku</label>
						<select class="form-control" name="nama_bhnbaku" required>
							<option value="0">Pilih Bahan Baku</option>
							<?php
							$bahan_baku = mysqli_query($koneksi, "SELECT * FROM bahan_baku");
							while ($rbahan_baku = mysqli_fetch_assoc($bahan_baku)) {
							?>
								<option value="<?php echo $rbahan_baku['nama_bhnbaku']; ?>"><?php echo $rbahan_baku['nama_bhnbaku']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Pemasok</label>

						<?php if($statusBeli === true) { ?>
						<select class="form-control" name="nama_pemasok" required>
							<option value="<?php echo $pecahPembelian['nama_pemasok']; ?>"><?php echo $pecahPembelian["nama_pemasok"]; ?></option>
						</select>
						<?php } else if($statusPembelian === true) { ?>
						<select class="form-control" name="nama_pemasok" required>
							<option value="<?php echo $pecahPembelian['nama_pemasok']; ?>"><?php echo $pecahPembelian["nama_pemasok"]; ?></option>
						</select>
						<?php } else { ?>
						<select class="form-control" name="nama_pemasok" required>
							<option value="0">Pilih Nama Pemasok</option>
							<?php
							$pemasok = mysqli_query($koneksi, "SELECT * FROM pemasok");
							while ($rpemasok = mysqli_fetch_assoc($pemasok)) {
							?>
								<option value="<?php echo $rpemasok['nama_pemasok']; ?>"><?php echo $rpemasok['nama_pemasok']; ?></option>
							<?php } ?>
						</select>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Jumlah</label>
						<input type="text" class="form-control" id="jumlah" name="jumlah" required onkeyup="sum();">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Harga</label>
						<input type="text" class="form-control" id="harga" name="harga" required onkeyup="sum();">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Total</label>
						<input type="text" class="form-control" id="total" name="total" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>&nbsp;</label>
						<div class="row action-button">
							<div class="col-md-4" style="padding: 0 5px 0 15px">
								<button class="btn btn-primary btn-block" name="save">Simpan</button>
								<button class="btn btn-primary btn-block" name="save_again" style="display: none;">Simpan</button>
							</div>
							<div class="col-md-4" style="padding: 0 5px 0 5px">
								<button class="btn btn-success btn-block" name="buyagain" style="display: none;">Beli Lagi</button>
							</div>
							<div class="col-md-4" style="padding: 0 15px 0 5px">
								<button class="btn btn-default btn-block" name="finish" style="display: none;">Selesai</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

		<br>
		<div class="panel panel-default">
			<br>
			<div class="input-group">
				<div class="col-md-10">
					<!-- Buat sebuah textbox dan beri id keyword -->
					<input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
				</div>
				<div class="col-md-2">
					<span class="input-group-btn">
						<a href="" class="btn btn-warning">RESET</a>
					</span>
				</div>
			</div>

			<div class="panel-body">
				<div class="table-responsive">
					<table class=" table table-striped table-bordered table-hover" id="container">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Pembelian</th>
								<th>Tanggal</th>
								<th>Nama Bahan Baku</th>
								<th>Nama Pemasok</th>
								<th>Jumlah</th>
								<th>Harga</th>
								<th>Total</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php include 'koneksi.php'; ?>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM pembelian"); ?>
							<?php $totalpembelian = 0 ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['kd_pembelian']; ?></td>
									<td><?php echo $pecah['tanggal']; ?></td>
									<td><?php echo $pecah['nama_bhnbaku']; ?></td>
									<td><?php echo $pecah['nama_pemasok']; ?></td>
									<td><?php echo $pecah['jumlah']; ?></td>
									<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
									<td>Rp. <?php echo number_format($pecah['total']);  ?></td>
									<td>
										<a href="index.php?halaman=nota_pembelian&kode=<?php echo $pecah['kd_pembelian']; ?>" class="btn btn-info">Cek Nota</a>
										<a href="index.php?halaman=editpembelian&id=<?php echo $pecah['no_pembelian']; ?>" class="btn btn-warning">Ubah</a>
										<a href="index.php?halaman=hapuspembelian&id=<?php echo $pecah['no_pembelian']; ?>" class="btn-danger btn">Hapus</a>
									</td>
								</tr>
								<?php $nomor++; ?>
							<?php $totalpembelian += ($pecah['total']);
							} ?>
						</tbody>
						<tfoot>
							<td colspan="7" align="right"><Strong>Total</Strong></td>
							<td colspan="2"> <strong> Rp. <?php echo number_format($totalpembelian) ?> </strong></td>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var keyword = document.getElementById('keyword');
	var container = document.getElementById('container');

	keyword.addEventListener('keyup', function() {
		var xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				container.innerHTML = xhr.responseText;
			}
		}

		xhr.open('POST', 'pembelian_ajax.php?keyword=' + keyword.value, true);
		xhr.send();
	});
</script>

<script>
	function sum() {
		var a = document.getElementById('jumlah').value;
		var b = document.getElementById('harga').value;
		var result = parseInt(a) * parseInt(b);
		if (!isNaN(result)) {
			document.getElementById('total').value = result;
		}
	}
</script>