<?php include 'koneksi.php'; ?>

<div id="print">
	<table class="table table-bordered">
		<thead>
			<tr>

				<th colspan=6>
					<center><b>
							<h3>Laporan Data Barang</h3>
					</center>
				</th>
			</tr>
			</tr>
			<tr>
				
				<th width=150><b>Kode Barang</th>
				<th width=150><b>Spesifikasi</th>
				<th width=140><b>Slump (CM)</th>
				<th width=140><b>Size (MM)</th>
				<th width=140><b>Harga/m3</th>
			</tr>
		</thead>
		</tbody>
		<?php $ambil = $koneksi->query("SELECT * FROM barang"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>

			<tr>
				
				<td><?php echo $pecah['kd_barang'] ?></td>
				<td><?php echo $pecah['spesifikasi'] ?></td>
				<td><?php echo $pecah['slump'] ?></td>
				<td><?php echo $pecah['size'] ?></td>
				<td> Rp. <?php echo number_format($pecah['harga']) ?></td>
			</tr>
		<?php } ?>

		</tbody>
	</table>

	<hr>

	<a style="margin-bottom:10px" href="cetakbarang.php" target="_blank" class="btn btn-success pull-right"><span class='glypicon glypicon-print'></span> Cetak Laporan</a>