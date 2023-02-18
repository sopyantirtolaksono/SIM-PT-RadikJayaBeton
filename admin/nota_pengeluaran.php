<?php

	$kode = $_GET["kode"];

	// ambil data nota sesuai kode yg dikirim di url
	$sqlNota 	= "SELECT * FROM pengeluaran WHERE kd_pengeluaran = '$kode' ";
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
				<h3>Nota Transaksi Pengeluaran</h3>
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
				<h5>Kode Pengeluaran : <?php echo $pecahNota2["kd_pengeluaran"]; ?></h5>
				<h5>Tanggal : <?php echo $pecahNota2["tanggal"]; ?></h5>
			</div>
			<div class="col-md-6 col-xl-6">
				<h5>Pengeluar : PT. Radik Jaya Beton</h5>
				<h5>Status 	: <span class="label label-success">SUKSES</span></h5>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Pengeluaran</th>
						<th>Tanggal</th>
						<th>Nama Akun</th>
						<th>Keterangan</th>
						<th>Jumlah (Rp)</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$totalBiaya = 0;
						while($pecahNota = $ambilNota->fetch_assoc()) {
							$totalBiaya += $pecahNota["jumlah"];
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $pecahNota["kd_pengeluaran"]; ?></td>
						<td><?php echo $pecahNota["tanggal"]; ?></td>
						<td><?php echo $pecahNota["nama_akun"]; ?></td>
						<td><?php echo $pecahNota["keterangan"]; ?></td>
						<td><?php echo number_format($pecahNota["jumlah"]); ?></td>
					</tr>
					<?php
						$no++;
						}
					?>

					<tr>
						<td colspan="5" align="right"><strong>Total Biaya: </strong></td>
						<td><strong>Rp. <?php echo number_format($totalBiaya); ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- action button -->
		<div class="row">
			<div class="col-md-6">
				<a href="components/export_pages/cetaknotapengeluaran.php?kode=<?php echo $kode; ?>" class="btn btn-primary" target="_blank">Cetak</a>
				<a href="index.php?halaman=pengeluaran" class="btn btn-default">Kembali</a>
			</div>
		</div>
	</div>
</div>