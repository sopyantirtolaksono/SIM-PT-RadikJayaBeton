 <table class=" table table-striped table-bordered table-hover" id="container">
     <thead>
         <tr>
             <th>No</th>
             <th>Kode Pelanggan</th>
             <th>Nama Pelanggan</th>
             <th>Alamat</th>
             <th>No Tlp</th>
             <th>Aksi</th>
         </tr>
     </thead>
     <tbody>
         <?php $nomor = 1; ?>
         <?php include 'koneksi.php'; ?>
         <?php $keyword = $_GET['keyword']; ?>
         <?php $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE
                                        kd_pelanggan LIKE '%$keyword%' OR
                                        nama_pelanggan LIKE '%$keyword%' OR
                                        alamat LIKE '%$keyword%' OR
                                        no_tlp LIKE '%$keyword%'
         "); ?>
         <?php while ($pecah = $ambil->fetch_assoc()) { ?>
             <tr>
                 <td><?php echo $nomor; ?></td>
                 <td><?php echo $pecah['kd_pelanggan']; ?></td>
                 <td><?php echo $pecah['nama_pelanggan']; ?></td>
                 <td><?php echo $pecah['alamat']; ?></td>
                 <td><?php echo $pecah['no_tlp']; ?></td>
                 <td>
                    <a href="index.php?halaman=editpelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-warning">Ubah</a>
                     <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn-danger btn">Hapus</a>
                 </td>
             </tr>
             <?php $nomor++; ?>
         <?php } ?>
     </tbody>
 </table>