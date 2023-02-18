<?php

	session_start();

	//koneksi ke database
	include '../../koneksi.php';

	// cek jika belum ada user yang login
	if (!isset($_SESSION["user"])) {
	    header("Location: login.php");
	    exit();
	}

	$kode = $_GET["kode"];

	// ambil data nota sesuai kode yg dikirim di url
	$sqlNota 	= "SELECT * FROM pendapatan WHERE kd_pendapatan = '$kode' ";
	$ambilNota 	= $koneksi->query($sqlNota);
	$ambilNota2 = $koneksi->query($sqlNota);
	$pecahNota2	= $ambilNota2->fetch_assoc();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nota Transaksi Pendapatan</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!-- style css  -->
	<style type="text/css">
	    /*tampilan mobile*/
	    @media screen and (max-width: 768px) {
	        div.nota-heading img {
	            display: none !important;
	        }
	    }

	    /*tampilan desktop*/
	    div.nota-heading {
	    	display: flex;
	    	justify-content: space-between;
	    	align-items: center;
	    }
	    div.nota-heading div.nota-heading-img img {
	    	width: 50%;
	    }
	    div.metadata {
	    	display: flex;
	    }
	    div.metadata div.metadata-customer {
	    	padding-right: 100px;
	    }
	    div.metadata div.metadata-developer {
	    	padding-left: 100px;
	    }
	</style>

</head>
<body onload="window.print();">

	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="nota-heading">
				<div class="nota-heading-text">
					<h3>Nota Transaksi Pendapatan</h3>
					<small>PT. RADIK JAYA BETON</small>
				</div>
				<div class="nota-heading-img">
					<img src="../../assets/img/index.png" alt="Logo PT.RADIK JAYA BETON" align="right">
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="metadata">
				<div class="metadata-customer">
					<h5>Kode Pendapatan : <?php echo $pecahNota2["kd_pendapatan"]; ?></h5>
					<h5>Tanggal : <?php echo $pecahNota2["tanggal"]; ?></h5>
					<h5>Pelanggan : <?php echo $pecahNota2["nama_pelanggan"]; ?></h5>
				</div>
				<div class="metadata-developer">
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
		</div>
	</div>


	<!-- BOOTSTRAP SCRIPTS -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>

</body>

</html>