<table class="table table-striped table-bordered table-hover" id="container">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pembelian</th>
            <th>Tanggal</th>
            <th>Nama Bahan Baku</th>
            <th>Nama Pemasok</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php include 'koneksi.php'; ?>
        <?php $nomor = 1; ?>
        <?php $keyword = $_GET['keyword']; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian WHERE
                                        tanggal LIKE '%$keyword%' OR
                                        kd_pembelian LIKE '%$keyword%' OR
                                        nama_bhnbaku LIKE '%$keyword%' OR
                                        nama_pemasok LIKE '%$keyword%' OR
                                        jumlah LIKE '%$keyword%' OR
                                        harga LIKE '%$keyword%' 
         "); ?>
        <?php $total = 0; ?>
        <?php $totalpembelian = 0; ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <?php $totalpembelian += $pecah['total']; ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['kd_pembelian']; ?></td>
                <td><?php echo $pecah['tanggal']; ?></td>
                <td><?php echo $pecah['nama_bhnbaku']; ?></td>
                <td><?php echo $pecah['nama_pemasok']; ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                <td>Rp. <?php echo number_format($pecah['total']) ?></td>
                <td>
                    <a href="index.php?halaman=nota_pembelian&kode=<?php echo $pecah['kd_pembelian']; ?>" class="btn btn-info">Cek Nota</a>
                    <a href="index.php?halaman=editpembelian&id=<?php echo $pecah['no_pembelian']; ?>" class="btn btn-warning">Ubah</a>
                    <a href="index.php?halaman=hapuspembelian&id=<?php echo $pecah['no_pembelian']; ?>" class="btn-danger btn">Hapus</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php
        } ?>
    </tbody>
    <tfoot>
        <td colspan="7" align="right"><Strong>Total</Strong></td>
        <td colspan="2"> <strong> Rp. <?php echo number_format($totalpembelian) ?> </strong></td>
    </tfoot>
</table>