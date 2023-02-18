   <table class=" table table-striped table-bordered table-hover" id="container">
       <thead>
           <tr>
               <th>No</th>
               <th>Username</th>
               <th>Password</th>
               <th>Nama Panjang</th>
               <th>Jabatan</th>
               <th>Aksi</th>
           </tr>
       </thead>
       <tbody>
           <?php include 'koneksi.php'; ?>
           <?php $nomor = 1; ?>
           <?php $keyword = $_GET['keyword']; ?>
           <?php $ambil = $koneksi->query("SELECT * FROM user WHERE 
                                                    username LIKE '%$keyword%' OR
                                                    password LIKE '%$keyword%' OR
                                                    nama_panjang LIKE '%$keyword%' OR
                                                    jabatan LIKE '%$keyword%' 
        "); ?>
           <?php while ($pecah = $ambil->fetch_assoc()) { ?>
               <tr>
                   <td><?php echo $nomor; ?></td>
                   <td><?php echo $pecah['username']; ?></td>
                   <td><?php echo $pecah['password']; ?></td>
                   <td><?php echo $pecah['nama_panjang']; ?></td>
                   <td><?php echo $pecah['jabatan']; ?></td>
                   <td>
                       <a href="index.php?halaman=hapususer&id=<?php echo $pecah['id_user']; ?>" class="btn-danger btn">Hapus</a>
                       <a href="index.php?halaman=edituser&id=<?php echo $pecah['id_user']; ?>" class="btn btn-warning">Edit</a>
                   </td>
               </tr>
               <?php $nomor++; ?>
           <?php } ?>
       </tbody>
   </table>