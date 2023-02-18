<?php ob_start(); ?>

<?php
// Load file koneksi.php  
include "koneksi.php";

$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)  
$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)  

if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :    
	// Buat query untuk menampilkan semua data transaksi    
	$query = "SELECT * FROM pendapatan";

	$label = "Semua Data Transaksi";
} else { // Jika terisi    
	// Buat query untuk menampilkan data transaksi sesuai periode tanggal    
	$query = "SELECT * FROM pendapatan WHERE (tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";

	$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy    
	$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy    
	$label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
}
?>
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
<center><img src="assets/img/rjbheader.jpg" width="800" height="100"></center>
<h4 style="margin-bottom: 5px;">
	<center>Laporan Pajak</center>
</h4>
<center><?php echo $label ?> </center>
<br>
<br>
<center>
	<table class="data-table" border="1" style="width: 100% ">
</center>
<tr>
	<th>Tanggal</th>
	<th>Pendapatan</th>
	<th>Total</th>
</tr>
 <?php
          $total = 0;
          $pajak = 0;
          $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query        
          $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
          if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
            while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql 
              $total += ($data['total']);
              $pajak = $total * 0.5 / 100;
              echo "<tr>";
              echo "<td>" . $data['tanggal'] . "</td>";
              echo "<td>" . "Rp.   " . number_format($data['total']) . "</td>";
			  echo "<td>" ."". "</td>";
              echo "</tr>";
            }
          } else { // Jika data tidak ada                        
            echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
          }
          ?>
	<tr>
            <td colspan="2">Total Pendapatan</td>
           
            <td>Rp. <?php echo number_format($total); ?></td>
           
          </tr>
          <tr>
            <td colspan="2">Potongan Pajak</td>
           
            <td>0,5%</td>
           
          </tr>
          <tr>
            <td colspan="2">Total Pajak</td>
           
            <td>Rp. <?php echo number_format($pajak); ?></td>
           
          </tr>
</table>
<br>
<h5 style="text-align:right">Kendal, <?php echo date("d, F, Y") ?> </h5>
<h5 style="text-align:right">Administrasi</h5><br><br>
<h5 style="text-align:right">Faizatul Laili </h5>

<script>
	window.print();
</script>