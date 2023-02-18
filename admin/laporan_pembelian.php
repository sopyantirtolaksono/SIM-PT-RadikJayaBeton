<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>SIA LABA BERSIH</title>

   <!-- Include file CSS Bootstrap -->
   <link href="css/bootstrap.min.css" rel="stylesheet">

   <!-- Include library Bootstrap Datepicker -->
   <link href="libraries/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

   <!-- Include File jQuery -->
   <script src="js/jquery.min.js"></script>
</head>

<body>
   <div style="padding: 15px;">
      <h3 style="margin-top: 0;"><b>Laporan Pembelian</b></h3>
      <hr />

      <form method="post" action="">
         <div class="row">
            <div class="col-sm-6 col-md-4">
               <div class="form-group">
                  <label>Filter Tanggal</label>
                  <div class="input-group">
                     <input type="date" name="tgl_awal" value="<?= @$_POST['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal">
                     <span class="input-group-addon">s/d</span>
                     <input type="date" name="tgl_akhir" value="<?= @$_POST['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir">
                  </div>
               </div>
            </div>
         </div>

         <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

         <?php
         if (isset($_POST['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter 

         ?>
      </form>
      <?php
   // Load file koneksi.php   
   include "koneksi.php";
   $tgl_awal = @$_POST['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)        
   $tgl_akhir = @$_POST['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)        

   if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :            
      // Buat query untuk menampilkan semua data transaksi            
      $query = "SELECT * FROM pembelian";
      $url_cetak = "cetakpembelian.php";
      $label = "Semua Data Transaksi";
   } else { // Jika terisi            
      // Buat query untuk menampilkan data transaksi sesuai periode tanggal            
      $query = "SELECT * FROM pembelian WHERE (tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
      $url_cetak = "cetakpembelian.php?tgl_awal=" . $tgl_awal . "&tgl_akhir=" . $tgl_akhir . "&filter=true";
      $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy            
      $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy            
      $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
   }
      ?>
      <hr />
      <h4 style="margin-bottom: 5px;"><b>Data Transaksi</b></h4>
      <?php echo $label ?><br />

      <div class="table-responsive" style="margin-top: 10px;">
         <table class="table table-bordered">
            <thead>
               <tr>
                  
                  <th>Tanggal</th>
                  <th>Kode Pembelian</th>
                  <th>Nama Bahan Baku</th>
                  <th>Nama Pemasok</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query        
               $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
               if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                  while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql                   
                     $tanggal = date('d-m-Y', strtotime($data['tanggal'])); // Ubah format tanggal jadi dd-mm-yyyy                           
                     echo "<tr>";
                     //echo "<td>".$tanggal."</td>"; 
                     echo "<td>" . $data['tanggal'] . "</td>";
                     echo "<td>" . $data['kd_pembelian'] . "</td>";
                     echo "<td>" . $data['nama_bhnbaku'] . "</td>";
                     echo "<td>" . $data['nama_pemasok'] . "</td>";
                     echo "<td>" . $data['jumlah'] . "</td>";
                     echo "<td>" . "Rp.  " . number_format($data['harga']) . "</td>";
                     echo "<td>" . "Rp.  " . number_format($data['total']) . "</td>";
                     echo "</tr>";
                  }
               } else { // Jika data tidak ada                        
                  echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
               }
               ?>

            </tbody>
         </table>
      </div>
          <br>
    <a style="margin-bottom:10px" href="<?php echo $url_cetak ?>" target="_blank" class="btn btn-success pull-right">CETAK LAPORAN</a>
   </div>

   <!-- Include File JS Bootstrap -->
   <script src="js/bootstrap.min.js"></script>

   <!-- Include library Bootstrap Datepicker -->
   <script src="libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

   <!-- Include File JS Custom (untuk fungsi Datepicker) -->
   <script src="js/custom.js"></script>

   <script>
      $(document).ready(function() {
         setDateRangePicker(".tgl_awal", ".tgl_akhir")
      })
   </script>
</body>

</html>