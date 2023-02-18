<?php include 'koneksi.php'; ?>

<div id="print">
	<table class="table table-bordered">

		<thead>
			<tr>

				<th colspan=5>
					<center><b>
							<h3>Laporan Data Pemasok</h3>
					</center>
				</th>
			</tr>
			</tr>
			<tr>
				
				<th width=150><b>Kode Pemasok</th>
				<th width=150><b>Nama Pemasok</th>
				<th width=140><b>Alamat</th>
				<th width=140><b>No Telpon</th>
			</tr>
		</thead>
		</tbody>
		<?php $ambil = $koneksi->query("SELECT * FROM pemasok"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>

			<tr>
				
				<td><?php echo $pecah['kd_pemasok'] ?></td>
				<td><?php echo $pecah['nama_pemasok'] ?></td>
				<td><?php echo $pecah['alamat'] ?></td>
				<td><?php echo $pecah['no_tlp'] ?></td>
			</tr>
		<?php } ?>

		</tbody>
	</table>

	<hr>

	<a style="margin-bottom:10px" href="cetakpemasok.php" target="_blank" class="btn btn-success pull-right"><span class='glypicon glypicon-print'></span> Cetak Laporan</a>