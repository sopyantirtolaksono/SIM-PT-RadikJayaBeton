<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Spesifikasi</th>
            <th>Slump (CM)</th>
            <th>Size (MM)</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php include 'koneksi.php'; ?>
        <?php $keyword = $_GET['keyword']; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM barang WHERE
                                                    kd_barang LIKE '%$keyword%' OR 
                                                    spesifikasi LIKE '%$keyword%' OR
                                                    slump LIKE '%$keyword%' OR
                                                    size LIKE '%$keyword%' OR
                                                    harga LIKE '%$keyword%'
        "); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['kd_barang']; ?></td>
                <td><?php echo $pecah['spesifikasi']; ?></td>
                <td><?php echo $pecah['slump']; ?></td>
                <td><?php echo $pecah['size']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                <td>
                    <a href="index.php?halaman=editbarang&id=<?php echo $pecah['id_barang']; ?>" class="btn btn-warning">Ubah</a>
                    <a href="index.php?halaman=hapusbarang&id=<?php echo $pecah['id_barang']; ?>" class="btn-danger btn">Hapus</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>