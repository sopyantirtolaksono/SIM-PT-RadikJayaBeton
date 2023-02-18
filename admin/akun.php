<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Tambah Akun</h2>
	</div>
	<br>
	<div class="panel-body">
		<form method="post">
			<?php
			include 'koneksi.php';
			$sql = "SELECT max(right(kd_akun, 4)) AS kd_akun FROM akun";
			$q = $koneksi->query($sql);

			if ($q->num_rows > 0) {
				foreach ($q as $qq) {
					$no = ((int)$qq['kd_akun']) + 1;
					$kd = sprintf("%04s", $no);
				}
			} else {
				$kd = "0001";
			}
			$huruf = "AKN-";
			$kode = $huruf . $kd;
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Kode akun</label>
						<input type="text" class="form-control" name="kd_akun" value="<?php echo $kode; ?>" readonly required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama akun</label>
						<input type="text" class="form-control" name="nama_akun" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Saldo</label>
						<input type="text" class="form-control" name="saldo" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<br>
						<button class="btn btn-primary" name="save">Simpan</button>
					</div>
				</div>
			</div>
		</form>
		<?php

		if (isset($_POST['save'])) {

			$koneksi->query("INSERT INTO akun (kd_akun,nama_akun,saldo)
		VALUES('" . $_POST["kd_akun"] . "','" . $_POST["nama_akun"] . "','" . $_POST["saldo"] . "')");

			echo "<div class='alert alert-info'> Data Tersimpan </div>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=akun'>";
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
								<th>Kode Akun</th>
								<th>Nama Akun</th>
								<th>Saldo</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php include 'koneksi.php'; ?>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM akun"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['kd_akun']; ?></td>
									<td><?php echo $pecah['nama_akun']; ?></td>
									<td>Rp. <?php echo number_format($pecah['saldo']); ?></td>

									<td>
										<a href="index.php?halaman=editakun&id=<?php echo $pecah['id_akun']; ?>" class="btn btn-warning">Ubah</a>
										<a href="index.php?halaman=hapusakun&id=<?php echo $pecah['id_akun']; ?>" class="btn-danger btn">Hapus</a>
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

				xhr.open('POST', 'akun_ajax.php?keyword=' + keyword.value, true);
				xhr.send();
			});
		</script>