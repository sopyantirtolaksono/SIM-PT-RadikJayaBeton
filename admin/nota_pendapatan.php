<?php

	$kode = $_GET["kode"];

	// ambil data nota sesuai kode yg dikirim di url
	$sqlNota 	= "SELECT * FROM pendapatan WHERE kd_pendapatan = '$kode' ";
	$ambilNota 	= $koneksi->query($sqlNota);
	$ambilNota2 = $koneksi->query($sqlNota);
	$pecahNota2	= $ambilNota2->fetch_assoc();

?>

<!-- style css  -->
<style type="text/css">
    /*tampilan mobile*/
    @media screen and (max-width: 768px) {
        div.nota-heading img {
            display: none !important;
        }
    }
</style>

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row nota-heading">
			<div class="col-md-6">
				<h3>Nota Transaksi Pendapatan</h3>
				<small>PT. RADIK JAYA BETON</small>
			</div>
			<div class="col-md-6">
				<img src="assets/img/index.png" alt="Logo PT.RADIK JAYA BETON" align="right" width="20%">
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-xl-6">
				<h5>Kode Pendapatan : <?php echo $pecahNota2["kd_pendapatan"]; ?></h5>
				<h5>Tanggal : <?php echo $pecahNota2["tanggal"]; ?></h5>
				<h5>Pelanggan : <?php echo $pecahNota2["nama_pelanggan"]; ?></h5>
			</div>
			<div class="col-md-6 col-xl-6">
				<h5>Pengembang : PT. Radik Jaya Beton</h5>
				<h5>Status 	: <span class="label label-success">SUKSES</span></h5>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Pendapatan</th>
						<th>Tanggal</th>
						<th>Nama Pelanggan</th>
						<th>Proyek</th>
						<th>Spesifikasi</th>
						<th>Harga (Rp)</th>
						<th>Volume</th>
						<th>Total (Rp)</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$totalBiaya = 0;
						while($pecahNota = $ambilNota->fetch_assoc()) {
							$totalBiaya += $pecahNota["total"];
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $pecahNota["kd_pendapatan"]; ?></td>
						<td><?php echo $pecahNota["tanggal"]; ?></td>
						<td><?php echo $pecahNota["nama_pelanggan"]; ?></td>
						<td><?php echo $pecahNota["proyek"]; ?></td>
						<td><?php echo $pecahNota["spesifikasi"]; ?></td>
						<td><?php echo number_format($pecahNota["harga"]); ?></td>
						<td><?php echo $pecahNota["volume"]; ?></td>
						<td><?php echo number_format($pecahNota["total"]); ?></td>
					</tr>
					<?php
						$no++;
						}
					?>

					<tr>
						<td colspan="8" align="right"><strong>Total Biaya: </strong></td>
						<td><strong>Rp. <?php echo number_format($totalBiaya); ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- action button -->
		<div class="row">
			<div class="col-md-6">
				<a href="components/export_pages/cetaknotapendapatan.php?kode=<?php echo $kode; ?>" class="btn btn-primary" target="_blank">Cetak</a>
				<a href="index.php?halaman=pendapatan" class="btn btn-default">Kembali</a>
			</div>
		</div>
	</div>
</div>