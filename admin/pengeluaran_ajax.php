<table class="table table-striped table-bordered table-hover" id="container">
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
		<?php $keyword = $_GET['keyword']; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM pengeluaran WHERE
										kd_pengeluaran LIKE '%$keyword%' OR
                                        tanggal LIKE '%$keyword%' OR
                                        nama_akun LIKE '%$keyword%' OR
										jumlah LIKE '%$keyword%' OR
                                        keterangan LIKE '%$keyword%' 
         "); ?>
		<?php $totaljumlah = 0; ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
			<?php $totaljumlah += ($pecah['jumlah']); ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['kd_pengeluaran']; ?></td>
				<td><?php echo $pecah['tanggal']; ?></td>
				<td><?php echo $pecah['nama_akun']; ?></td>
				<td>Rp. <?php echo number_format($pecah['jumlah']) ?></td>
				<td><?php echo $pecah['keterangan']; ?></td>
				<td>
					<a href="index.php?halaman=nota_pengeluaran&kode=<?php echo $pecah['kd_pengeluaran']; ?>" class="btn btn-info">Cek Nota</a>
					<a href="index.php?halaman=editpengeluaran&id=<?php echo $pecah['no_pengeluaran']; ?>" class="btn btn-warning">Ubah</a>
					<a href="index.php?halaman=hapuspengeluaran&id=<?php echo $pecah['no_pengeluaran']; ?>" class="btn-danger btn">Hapus</a>
				</td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<td colspan="4" align="right"><Strong>Total</Strong></td>
		<td colspan="2"> <strong> Rp. <?php echo number_format($totaljumlah) ?> </strong></td>
	</tfoot>
</table>