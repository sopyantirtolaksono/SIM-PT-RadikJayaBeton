<?php

	include 'koneksi.php';
	$sql = "SELECT max(right(kd_pengeluaran, 4)) AS kd_keluar FROM keluar";
	$q = $koneksi->query($sql);

	if ($q->num_rows > 0) {
		foreach ($q as $qq) {
			$no = ((int)$qq['kd_keluar']) + 1;
			$kd = sprintf("%04s", $no);
		}
	} else {
		$kd = "0001";
	}
	$huruf = "PGL-";
	$kode = $huruf . $kd;

	// jika tombol simpan ditekan
	if(isset($_POST['save'])) {

		$statusKeluar = $koneksi->query("INSERT INTO keluar (kd_pengeluaran) VALUES ('$_POST[kd_pengeluaran]')");

        $noKeluar    = $koneksi->insert_id;
        $ambilKeluar = $koneksi->query("SELECT * FROM keluar WHERE no_keluar = '$noKeluar' ");
        $pecahKeluar = $ambilKeluar->fetch_assoc();

        if($statusKeluar === true) {
            echo "<script>
                $(document).ready(function() {
                    $('button[name=save]').attr('disabled', '');
                    $('button[name=save]').text('Menunggu...');
                    $('button[name=addTransaction]').css('display', 'block');
                    $('button[name=finish]').css('display', 'block');

                    $('button[name=addTransaction]').on('click', function() {
                        $('button[name=save]').remove();
                        $('button[name=save_again]').css('display', 'block');
                        $(this).attr('disabled', '');
                    });

                    $('button[name=finish]').on('click', function() {
                        location = 'index.php?halaman=nota_pengeluaran&kode=$pecahKeluar[kd_pengeluaran]';
                    });
                });
            </script>";

            $koneksi->query("INSERT INTO pengeluaran (kd_pengeluaran,tanggal,nama_akun,jumlah,keterangan)VALUES('" . $_POST["kd_pengeluaran"] . "','" . $_POST["tanggal"] . "','" . $_POST["nama_akun"] . "','" . $_POST["jumlah"] . "','" . $_POST["keterangan"] . "')");

            $noPengeluaran    = $koneksi->insert_id;
            $ambilPengeluaran = $koneksi->query("SELECT * FROM pengeluaran WHERE no_pengeluaran = '$noPengeluaran' ");
            $pecahPengeluaran = $ambilPengeluaran->fetch_assoc();

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
            // echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";

        }

	}

	// tambah pendapatan lagi
    if(isset($_POST["save_again"])) {

        $statusPengeluaran = $koneksi->query("INSERT INTO pengeluaran (kd_pengeluaran,tanggal,nama_akun,jumlah,keterangan)VALUES('" . $_POST["kd_pengeluaran"] . "','" . $_POST["tanggal"] . "','" . $_POST["nama_akun"] . "','" . $_POST["jumlah"] . "','" . $_POST["keterangan"] . "')");

        $noPengeluaran    = $koneksi->insert_id;
        $ambilPengeluaran = $koneksi->query("SELECT * FROM pengeluaran WHERE no_pengeluaran = '$noPengeluaran' ");
        $pecahPengeluaran = $ambilPengeluaran->fetch_assoc();

        if($statusPengeluaran === true) {
            echo "<script>
                $(document).ready(function() {
                    $('button[name=save]').attr('disabled', '');
                    $('button[name=save]').text('Menunggu...');
                    $('button[name=addTransaction]').css('display', 'block');
                    $('button[name=finish]').css('display', 'block');

                    $('button[name=addTransaction]').on('click', function() {
                        $('button[name=save]').remove();
                        $('button[name=save_again]').css('display', 'block');
                        $(this).attr('disabled', '');
                    });

                    $('button[name=finish]').on('click', function() {
                        location = 'index.php?halaman=nota_pengeluaran&kode=$pecahPengeluaran[kd_pengeluaran]';
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
		<h2>Tambah Pengeluaran</h2>
	</div>
	<br>
	<div class="panel-body">
		<form method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Kode Pengeluaran</label>

						<?php if($statusKeluar === true) { ?>
                        <input type="text" class="form-control" name="kd_pengeluaran" value="<?php echo $pecahKeluar['kd_pengeluaran']; ?>" readonly required />
                        <?php } else if($statusPengeluaran === true) { ?>
                        <input type="text" class="form-control" name="kd_pengeluaran" value="<?php echo $pecahPengeluaran['kd_pengeluaran']; ?>" readonly required />
                        <?php } else { ?>
                        <input type="text" class="form-control" name="kd_pengeluaran" value="<?php echo $kode; ?>" readonly required />
                        <?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tanggal</label>

						<?php if($statusKeluar === true) { ?>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $pecahPengeluaran['tanggal']; ?>" readonly required>
                        <?php } else if($statusPengeluaran === true) { ?>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $pecahPengeluaran['tanggal']; ?>" readonly required>
                        <?php } else { ?>
                        <input type="date" class="form-control" name="tanggal" required>
                        <?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Akun</label>
						<select class="form-control" name="nama_akun" required>
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
						<input type="text" class="form-control" name="jumlah" id="jumlah" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>keterangan</label>
						<input type="text" class="form-control" name="keterangan" id="keterangan" required>
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
	                            <button class="btn btn-success btn-block" name="addTransaction" style="display: none;">Tambah Transaksi</button>
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
								<th>Kode Pengeluaran</th>
								<th>Tanggal</th>
								<th>Nama Akun</th>
								<th>Jumlah</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php include 'koneksi.php'; ?>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM pengeluaran"); ?>
							<?php $totalpengeluaran = 0 ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['kd_pengeluaran']; ?></td>
									<td><?php echo $pecah['tanggal']; ?></td>
									<td><?php echo $pecah['nama_akun']; ?></td>
									<td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
									<td><?php echo $pecah['keterangan']; ?></td>
									<td>
										<a href="index.php?halaman=nota_pengeluaran&kode=<?php echo $pecah['kd_pengeluaran']; ?>" class="btn btn-info">Cek Nota</a>
										<a href="index.php?halaman=editpengeluaran&id=<?php echo $pecah['no_pengeluaran']; ?>" class="btn btn-warning">Ubah</a>
										<a href="index.php?halaman=hapuspengeluaran&id=<?php echo $pecah['no_pengeluaran']; ?>" class="btn-danger btn">Hapus</a>
									</td>
								</tr>
								<?php $nomor++; ?>
							<?php $totalpengeluaran += $pecah['jumlah'];
							} ?>
						</tbody>
						<tfoot>
							<td colspan="4" align="right"><Strong>Total</Strong></td>
							<td colspan="2"> <strong> Rp. <?php echo number_format($totalpengeluaran) ?> </strong></td>
						</tfoot>
					</table>
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

			xhr.open('POST', 'pengeluaran_ajax.php?keyword=' + keyword.value, true);
			xhr.send();
		});
	</script>