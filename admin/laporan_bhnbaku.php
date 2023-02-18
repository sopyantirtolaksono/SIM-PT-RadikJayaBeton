
<?php include 'koneksi.php'; ?>

<div id="print">
	<table class="table table-bordered">

		<thead>
			<tr>

				<th colspan=5>
					<center><b>
							<h3>Laporan Data Bahan Baku</h3>
					</center>
				</th>
			</tr>
			</tr>
			<tr>
				<th width=150><b>Kode Bahan Baku</th>
				<th width=150><b>Nama Bahan Baku</th>
				<th width=150><b>Jenis Bahan Baku</th>
			</tr>
		</thead>
		</tbody>
		<?php $ambil = $koneksi->query("SELECT * FROM bahan_baku"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>

			<tr>
				<td><?php echo $pecah['kd_bhnbaku'] ?></td>
				<td><?php echo $pecah['nama_bhnbaku'] ?></td>
				<td><?php echo $pecah['jenis'] ?></td>
			</tr>
		<?php } ?>

		</tbody>
	</table>

	<hr>

	<a style="margin-bottom:10px" href="cetakbhnbaku.php" target="_blank" class="btn btn-success pull-right"><span class='glypicon glypicon-print'></span> Cetak Laporan</a>