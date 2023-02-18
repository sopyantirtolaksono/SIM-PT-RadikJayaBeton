 <table class=" table table-striped table-bordered table-hover" id="container">
     <thead>
         <tr>
             <th>No</th>
             <th>Kode Pemasok</th>
             <th>Nama Pemasok</th>
             <th>Alamat</th>
             <th>No Tlp</th>
             <th>Aksi</th>
         </tr>
     </thead>
     <tbody>
         <?php include 'koneksi.php'; ?>
         <?php $nomor = 1; ?>
         <?php $keyword = $_GET['keyword']; ?>
         <?php $ambil = $koneksi->query("SELECT * FROM pemasok WHERE
                                        kd_pemasok LIKE '%$keyword%' OR
                                        nama_pemasok LIKE '%$keyword%' OR
                                        alamat LIKE '%$keyword%' OR
                                        no_tlp LIKE '%$keyword%'
         "); ?>
         <?php while ($pecah = $ambil->fetch_assoc()) { ?>
             <tr>
                 <td><?php echo $nomor; ?></td>
                 <td><?php echo $pecah['kd_pemasok']; ?></td>
                 <td><?php echo $pecah['nama_pemasok']; ?></td>
                 <td><?php echo $pecah['alamat']; ?></td>
                 <td><?php echo $pecah['no_tlp']; ?></td>
                 <td>
                     <a href="index.php?halaman=editpemasok&id=<?php echo $pecah['id_pemasok']; ?>" class="btn btn-warning">Ubah</a>
                     <a href="index.php?halaman=hapuspemasok&id=<?php echo $pecah['id_pemasok']; ?>" class="btn-danger btn">Hapus</a>
                 </td>
             </tr>
             <?php $nomor++; ?>
         <?php } ?>
     </tbody>
 </table>