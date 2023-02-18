<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Tambah Barang</h2>
	</div>
	<br>
	<div class="panel-body">
		<div class="row">
			<form method="post">
				<?php
				include 'koneksi.php';
				$sql = "SELECT max(right(kd_barang, 4)) AS kd_barang FROM barang";
				$q = $koneksi->query($sql);

				if ($q->num_rows > 0) {
					foreach ($q as $qq) {
						$no = ((int)$qq['kd_barang']) + 1;
						$kd = sprintf("%04s", $no);
					}
				} else {
					$kd = "0001";
				}
				$huruf = "BRG-";
				$kode = $huruf . $kd;
				?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Kode barang</label>
						<input type="text" class="form-control" name="kd_barang" value="<?php echo $kode; ?>" readonly required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Spesifikasi</label>
						<input type="text" class="form-control" name="spesifikasi" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Slump (CM)</label>
						<input type="text" class="form-control" name="slump" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Size (MM)</label>
						<input type="number" class="form-control" name="size" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Harga</label>
						<input type="number" class="form-control" name="harga" required>
					</div>
				</div>
				<div class="col-md-6">
					<br>
					<div class="form-group">
						<button class="btn btn-primary" name="save">Simpan</button>
					</div>
				</div>
		</div>
		</form>
		<?php

		if (isset($_POST['save'])) {

			$koneksi->query("INSERT INTO barang (kd_barang,spesifikasi,slump,size,harga)
		VALUES('" . $_POST["kd_barang"] . "','" . $_POST["spesifikasi"] . "','" . $_POST["slump"] . "','" . $_POST["size"] . "','" . $_POST["harga"] . "')");

			echo "<div class='alert alert-info'> Data Tersimpan </div>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=barang'>";
		}
		?>

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
								<th>Kode Barang</th>
								<th>Spesifikasi</th>
								<th>Slump (CM)</th>
								<th>Size (MM)</th>
								<th>Harga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php include 'koneksi.php'; ?>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM barang"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['kd_barang']; ?></td>
									<td><?php echo $pecah['spesifikasi']; ?></td>
									<td><?php echo $pecah['slump']; ?></td>
									<td><?php echo $pecah['size']; ?></td>
									<td>Rp. <?php echo number_format($pecah['harga']); ?></td>

									<td>
										<a href="index.php?halaman=editbarang&id=<?php echo $pecah['id_barang']; ?>" class="btn btn-warning">Ubah</a>
										<a href="index.php?halaman=hapusbarang&id=<?php echo $pecah['id_barang']; ?>" class="btn-danger btn">Hapus</a>
									</td>
								</tr>
								<?php $nomor++; ?>
							<?php } ?>
						</tbody>
					</table>
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

				xhr.open('POST', 'barang_ajax.php?keyword=' + keyword.value, true);
				xhr.send();
			});
		</script>