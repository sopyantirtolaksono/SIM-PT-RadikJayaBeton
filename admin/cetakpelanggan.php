<?php include 'koneksi.php'; ?>
<style type="text/css">
	body {
		font-size: 15px;
		font-family: "segoe-ui", "open-sans", tahoma, arial;
		padding: 0;
		margin: 0;
	}

	table {
		margin: auto;
		font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
		font-size: 12px;
	}

	h1 {
		margin: 25px auto 0;
		text-align: center;
		text-transform: uppercase;
		font-size: 17px;
	}

	table td {
		transition: all .5s;
	}

	/* Table */
	.data-table {
		border-collapse: collapse;
		font-size: 14px;
		min-width: 537px;
	}

	.data-table th,
	.data-table td {
		border: 1px solid #e1edff;
		padding: 7px 17px;
	}

	.data-table caption {
		margin: 7px;
	}

	/* Table Header */
	.data-table thead th {
		background-color: #508abb;
		color: #FFFFFF;
		border-color: #6ea1cc !important;
		text-transform: uppercase;
	}

	/* Table Body */


	.data-table tbody td:first-child,
	.data-table tbody td:nth-child(4),


	/* Table Footer */
	.data-table tfoot th {
		text-align: left;
	}

	.data-table tfoot td {
		background-color: #508abb;
		color: #FFFFFF;
	}

	.data-table tfoot th:first-child {
		text-align: left;
	}
</style>
<div id="print">
	<table class="table table-bordered">

		<thead>
			<tr>
				<center><img src="assets/img/rjbheader.jpg" width="800" height="100"></center>
				<h3 style="margin-bottom: 5px;">
					<center>Laporan Data Pelanggan</center>
				</h3>
				<br>
				<table class="data-table" border="1" style="width: 100%">
			</tr>
			<tr>
				
				<th width=150><b>Kode Pelanggan</th>
				<th width=150><b>Nama Pelanggan</th>
				<th width=140><b>Alamat</th>
				<th width=140><b>No Telpon</th>
			</tr>
		</thead>
		</tbody>
		<?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>

			<tr>
				
				<td><?php echo $pecah['kd_pelanggan'] ?></td>
				<td><?php echo $pecah['nama_pelanggan'] ?></td>
				<td><?php echo $pecah['alamat'] ?></td>
				<td><?php echo $pecah['no_tlp'] ?></td>
			</tr>
		<?php } ?>

		</tbody>
	</table>
	<br>
	<h5 style="text-align:right">Kendal, <?php echo date("d, F, Y") ?> </h5>
	<h5 style="text-align:right">Administrasi</h5><br><br>
	<h5 style="text-align:right">Faizatul Laili </h5>

	<script>
		window.print();
	</script>