<h2>Edit Transaksi Pendapatan</h2>

<?php
include 'koneksi.php';
$ambil = $koneksi->query("SELECT * FROM pendapatan WHERE no_pendapatan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post">
     <div class="col-md-6">
          <div class="form-group">
               <label>Kode Pendapatan</label>
               <input type="text" class="form-control" name="kd_pendapatan" required value="<?php echo $pecah['kd_pendapatan']; ?>" readonly />
          </div>
          <div class="form-group">
               <label>Tanggal</label>
               <input type="date" class="form-control" name="tanggal" required value="<?php echo $pecah['tanggal']; ?>" />
          </div>
          <div class="form-group">
               <label>Nama pelanggan</label>
               <select class="form-control" name="nama_pelanggan">
                    <option value="0">Pilih Nama Pelanggan</option>
                    <?php
                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    while ($rpelanggan = mysqli_fetch_assoc($pelanggan)) {
                    ?>
                         <option value="<?php echo $rpelanggan['nama_pelanggan']; ?>"><?php echo $rpelanggan['nama_pelanggan']; ?></option>
                    <?php } ?>
               </select>
          </div>
          <div class=" form-group">
               <label>Proyek</label>
               <input type="text" class="form-control" name="proyek" required />
          </div>
     </div>

     <div class="col-md-6">
          <?php
          $result = mysqli_query($koneksi, "SELECT * from barang");
          $jsArrbarang = "var barang = new Array();\n";
          echo '
	<div class="form-group">
		<label>Spesifikasi</label>
		<select  class="form-control" name="spesifikasi" onchange="document.getElementById(\'harga\').value = barang[this.value]">';
          echo '<option>Pilih Spesifikasi</option>';
          while ($row = mysqli_fetch_array($result)) {
               echo '<option value="' . $row['spesifikasi'] . '">' . $row['spesifikasi'] . '</option>';
               $jsArrbarang .= "barang['" . $row['spesifikasi'] . "'] = '" . addslashes($row['harga']) . "';\n";
          }
          echo '</select>';
          ?>
     </div>
     <script type="text/javascript">
          <?php echo $jsArrbarang; ?>
     </script>
     <div class=" form-group">
          <label>Harga</label>
          <input type="text" class="form-control" name="harga" id="harga" onkeyup="sum();" required value="<?php echo $pecah['harga']; ?>" />
     </div>
     <div class=" form-group">
          <label>Volume</label>
          <input type="text" class="form-control" name="volume" id="volume" onkeyup="sum();" required value="<?php echo $pecah['volume']; ?>" />
     </div>
     <div class=" form-group">
          <label>Total</label>
          <input type="text" class="form-control" name="total" id="total" required />
     </div>


     <br>
     <button class="btn btn-primary" name="edit">Edit</button>
     </div>
     <!--<a href="index.php?halaman=datapendapatan" class="btn btn-success" name="datapendapatan">Data Pendapatan</a>-->
</form>


</div>
</div>
</div>

<?php
if (isset($_POST['edit'])) {

     $koneksi->query("UPDATE pendapatan SET tanggal='$_POST[tanggal]', nama_pelanggan='$_POST[nama_pelanggan]', spesifikasi='$_POST[spesifikasi]', harga='$_POST[harga]', volume='$_POST[volume]', total='$_POST[total]' WHERE no_pendapatan='$_GET[id]'");

     echo "<script>alert('Transaksi Telah Diedit');</script>";
     echo "<script>location='index.php?halaman=pendapatan';</script>";
}
?>

<script>
     function sum() {
          var a = document.getElementById('volume').value;
          var b = document.getElementById('harga').value;
          var result = parseInt(a) * parseInt(b);
          if (!isNaN(result)) {
               document.getElementById('total').value = result;
          }
     }
</script>