<div id="container">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Bahan Baku</th>
                <th>Nama Bahan Baku</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'koneksi.php'; ?>
            <?php $nomor = 1; ?>
            <?php $keyword = $_GET['keyword']; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM bahan_baku WHERE
                                        kd_bhnbaku LIKE '%$keyword%' OR
                                        nama_bhnbaku LIKE '%$keyword%' OR
                                        jenis LIKE '%$keyword%'
            "); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['kd_bhnbaku']; ?></td>
                    <td><?php echo $pecah['nama_bhnbaku']; ?></td>
                    <td><?php echo $pecah['jenis']; ?></td>
                    <td>
                        <a href="index.php?halaman=editbhnbaku&id=<?php echo $pecah['id_bhnbaku']; ?>" class="btn btn-warning">Ubah</a>
                        <a href="index.php?halaman=hapusbhnbaku&id=<?php echo $pecah['id_bhnbaku']; ?>" class="btn-danger btn">Hapus</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>