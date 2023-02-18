<div id="container">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Akun</th>
                <th>Nama Akun</th>
                <th>Saldo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php include 'koneksi.php'; ?>
            <?php $keyword = $_GET['keyword']; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM akun WHERE 
                                        kd_akun LIKE '%$keyword%' OR
                                        nama_akun LIKE '%$keyword%' OR
                                        saldo LIKE '%$keyword%'
            "); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['nama_akun']; ?></td>
                    <td>Rp. <?php echo number_format($pecah['saldo']); ?></td>
                    <td>
                        <a href="index.php?halaman=editakun&id=<?php echo $pecah['id_akun']; ?>" class="btn btn-warning">Ubah</a>
                        <a href="index.php?halaman=hapusakun&id=<?php echo $pecah['id_akun']; ?>" class="btn-danger btn">Hapus</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>