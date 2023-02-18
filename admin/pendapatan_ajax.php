<table class="table table-striped table-bordered table-hover" id="container">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pendapatan</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Proyek</th>
            <th>Spesifikasi</th>
            <th>Harga</th>
            <th>Volume</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php include 'koneksi.php'; ?>
        <?php $nomor = 1; ?>
        <?php $keyword = $_GET['keyword']; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pendapatan WHERE
                                        kd_pendapatan LIKE '%$keyword%' OR
                                        tanggal LIKE '%$keyword%' OR
                                        nama_pelanggan LIKE '%$keyword%' OR
                                        proyek LIKE '%$keyword%' OR
                                        spesifikasi LIKE '%$keyword%' OR
                                        harga LIKE '%$keyword%' OR
                                        volume LIKE '%$keyword%' OR
                                        total LIKE '%$keyword%'
                                        
         "); ?>
        <?php $total = 0; ?>
        <?php $totalpendapatan = 0; ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <?php $totalpendapatan += $pecah['total']; ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['kd_pendapatan']; ?></td>
                <td><?php echo $pecah['tanggal']; ?></td>
                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                <td><?php echo $pecah['proyek']; ?></td>
                <td><?php echo $pecah['spesifikasi']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                <td><?php echo $pecah['volume']; ?></td>
                <td>Rp. <?php echo number_format($pecah['total']) ?></td>
                <td>
                    <a href="index.php?halaman=nota_pendapatan&kode=<?php echo $pecah['kd_pendapatan']; ?>" class="btn btn-info">Cek Nota</a>
                    <a href="index.php?halaman=editpendapatan&id=<?php echo $pecah['no_pendapatan']; ?>" class="btn btn-warning">Ubah</a>
                    <a href="index.php?halaman=hapuspendapatan&id=<?php echo $pecah['no_pendapatan']; ?>" class="btn-danger btn">Hapus</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php
        } ?>
    </tbody>
    <tfoot>
        <td colspan="8" align="right"><Strong>Total</Strong></td>
        <td colspan="2"> <strong> Rp. <?php echo number_format($totalpendapatan) ?> </strong></td>
    </tfoot>
</table>