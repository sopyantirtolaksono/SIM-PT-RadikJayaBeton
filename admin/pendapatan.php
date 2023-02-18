<?php

    include 'koneksi.php';
    $sql = "SELECT max(right(kd_pendapatan, 4)) AS kd_masuk FROM masuk";
    $q = $koneksi->query($sql);

    if ($q->num_rows > 0) {
        foreach ($q as $qq) {
            $no = ((int)$qq['kd_masuk']) + 1;
            $kd = sprintf("%04s", $no);
        }
    } else {
        $kd = "0001";
    }
    $huruf = "PDP-";
    $kode = $huruf . $kd;


    // jika tombol simpan ditekan
    if(isset($_POST['save'])) {

        $statusMasuk = $koneksi->query("INSERT INTO masuk (kd_pendapatan) VALUES ('$_POST[kd_pendapatan]')");

        $noMasuk    = $koneksi->insert_id;
        $ambilMasuk = $koneksi->query("SELECT * FROM masuk WHERE no_masuk = '$noMasuk' ");
        $pecahMasuk = $ambilMasuk->fetch_assoc();

        if($statusMasuk === true) {
            echo "<script>
                $(document).ready(function() {
                    $('button[name=save]').attr('disabled', '');
                    $('button[name=save]').text('Menunggu...');
                    $('button[name=addTransaction]').css('display', 'block');
                    $('button[name=finish]').css('display', 'block');

                    $('button[name=addTransaction]').on('click', function() {
                        $('button[name=save]').remove();
                        $('button[name=save_again]').css('display', 'block');
                        $(this).attr('disabled', '');
                    });

                    $('button[name=finish]').on('click', function() {
                        location = 'index.php?halaman=nota_pendapatan&kode=$pecahMasuk[kd_pendapatan]';
                    });
                });
            </script>";

            $koneksi->query("INSERT INTO pendapatan (tanggal,kd_pendapatan,nama_pelanggan,proyek,spesifikasi,harga,volume,total)VALUES('" . $_POST["tanggal"] . "','" . $_POST["kd_pendapatan"] . "','" . $_POST["nama_pelanggan"] . "','" . $_POST["proyek"] . "','" . $_POST["spesifikasi"] . "','" . $_POST["harga"] . "','" . $_POST["volume"] . "','" . $_POST["total"] . "')");

            $noPendapatan    = $koneksi->insert_id;
            $ambilPendapatan = $koneksi->query("SELECT * FROM pendapatan WHERE no_pendapatan = '$noPendapatan' ");
            $pecahPendapatan = $ambilPendapatan->fetch_assoc();

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
            // echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pembelian'>";

        }

    }

    // tambah pendapatan lagi
    if(isset($_POST["save_again"])) {

        $statusPendapatan = $koneksi->query("INSERT INTO pendapatan (tanggal,kd_pendapatan,nama_pelanggan,proyek,spesifikasi,harga,volume,total)VALUES('" . $_POST["tanggal"] . "','" . $_POST["kd_pendapatan"] . "','" . $_POST["nama_pelanggan"] . "','" . $_POST["proyek"] . "','" . $_POST["spesifikasi"] . "','" . $_POST["harga"] . "','" . $_POST["volume"] . "','" . $_POST["total"] . "')");

        $noPendapatan    = $koneksi->insert_id;
        $ambilPendapatan = $koneksi->query("SELECT * FROM pendapatan WHERE no_pendapatan = '$noPendapatan' ");
        $pecahPendapatan = $ambilPendapatan->fetch_assoc();

        if($statusPendapatan === true) {
            echo "<script>
                $(document).ready(function() {
                    $('button[name=save]').attr('disabled', '');
                    $('button[name=save]').text('Menunggu...');
                    $('button[name=addTransaction]').css('display', 'block');
                    $('button[name=finish]').css('display', 'block');

                    $('button[name=addTransaction]').on('click', function() {
                        $('button[name=save]').remove();
                        $('button[name=save_again]').css('display', 'block');
                        $(this).attr('disabled', '');
                    });

                    $('button[name=finish]').on('click', function() {
                        location = 'index.php?halaman=nota_pendapatan&kode=$pecahPendapatan[kd_pendapatan]';
                    });
                });
            </script>";

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
        }

    }

?>

<!-- style css action button -->
<style type="text/css">
    /*tampilan mobile*/
    @media screen and (max-width: 768px) {
        div.action-button div.col-md-4 {
            padding: 0 15px 0 15px !important;
        }
    }
</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Tambah Pendapatan</h2>
    </div>
    <br>
    <div class="panel-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Pendapatan</label>

                        <?php if($statusMasuk === true) { ?>
                        <input type="text" class="form-control" name="kd_pendapatan" value="<?php echo $pecahMasuk['kd_pendapatan']; ?>" readonly required />
                        <?php } else if($statusPendapatan === true) { ?>
                        <input type="text" class="form-control" name="kd_pendapatan" value="<?php echo $pecahPendapatan['kd_pendapatan']; ?>" readonly required />
                        <?php } else { ?>
                        <input type="text" class="form-control" name="kd_pendapatan" value="<?php echo $kode; ?>" readonly required />
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal</label>

                        <?php if($statusMasuk === true) { ?>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $pecahPendapatan['tanggal']; ?>" readonly required>
                        <?php } else if($statusPendapatan === true) { ?>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $pecahPendapatan['tanggal']; ?>" readonly required>
                        <?php } else { ?>
                        <input type="date" class="form-control" name="tanggal" required>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama pelanggan</label>

                        <?php if($statusMasuk === true) { ?>
                        <select class="form-control" name="nama_pelanggan" required>
                            <option value="<?php echo $pecahPendapatan['nama_pelanggan']; ?>"><?php echo $pecahPendapatan["nama_pelanggan"]; ?></option>
                        </select>
                        <?php } else if($statusPendapatan === true) { ?>
                        <select class="form-control" name="nama_pelanggan" required>
                            <option value="<?php echo $pecahPendapatan['nama_pelanggan']; ?>"><?php echo $pecahPendapatan["nama_pelanggan"]; ?></option>
                        </select>
                        <?php } else { ?>
                        <select class="form-control" name="nama_pelanggan">
                            <option value="0">Pilih Nama pelanggan</option>
                            <?php
                            $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                            while ($rpelanggan = mysqli_fetch_assoc($pelanggan)) {
                            ?>
                                <option value="<?php echo $rpelanggan['nama_pelanggan']; ?>"><?php echo $rpelanggan['nama_pelanggan']; ?></option>
                            <?php } ?>
                        </select>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" form-group">
                        <label>Proyek</label>
                        <input type="text" class="form-control" name="proyek" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    $result = mysqli_query($koneksi, "select * from barang");
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
            </div>
            <script type="text/javascript">
                <?php echo $jsArrbarang; ?>
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" onkeyup="sum()">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Volume</label>
                    <input type="text" class="form-control" name="volume" id="volume" onkeyup="sum()">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" class="form-control" id="total" name="total" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div class="row action-button">
                        <div class="col-md-4" style="padding: 0 5px 0 15px">
                            <button class="btn btn-primary btn-block" name="save">Simpan</button>
                            <button class="btn btn-primary btn-block" name="save_again" style="display: none;">Simpan</button>
                        </div>
                        <div class="col-md-4" style="padding: 0 5px 0 5px">
                            <button class="btn btn-success btn-block" name="addTransaction" style="display: none;">Tambah Transaksi</button>
                        </div>
                        <div class="col-md-4" style="padding: 0 15px 0 5px">
                            <button class="btn btn-default btn-block" name="finish" style="display: none;">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>

    <br>
    <div class="panel panel-default">
        <br>
        <div class="input-group">
            <div class="col-md-10">
                <!-- Buat sebuah textbox dan beri id keyword -->
                <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
            </div>
            <div class="col-md-2">
                <span class="input-group-btn">
                    <a href="" class="btn btn-warning">RESET</a>
                </span>
            </div>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class=" table table-striped table-bordered table-hover" id="container">
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
                        <?php $ambil = $koneksi->query("SELECT * FROM pendapatan"); ?>
                        <?php $totalpendapatan = 0 ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['kd_pendapatan']; ?></td>
                                <td><?php echo $pecah['tanggal']; ?></td>
                                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                                <td><?php echo $pecah['proyek']; ?></td>
                                <td><?php echo $pecah['spesifikasi']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                                <td><?php echo $pecah['volume']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['total']);  ?></td>
                                <td>
                                    <a href="index.php?halaman=nota_pendapatan&kode=<?php echo $pecah['kd_pendapatan']; ?>" class="btn btn-info">Cek Nota</a>
                                    <a href="index.php?halaman=editpendapatan&id=<?php echo $pecah['no_pendapatan']; ?>" class="btn btn-warning">Ubah</a>
                                    <a href="index.php?halaman=hapuspendapatan&id=<?php echo $pecah['no_pendapatan']; ?>" class="btn-danger btn">Hapus</a>
                                </td>
                            </tr>
                            <?php $nomor++; ?>
                        <?php $totalpendapatan += $pecah['total'];
                        } ?>
                    </tbody>
                    <tfoot>
                        <td colspan="8" align="right"><Strong>Total</Strong></td>
                        <td colspan="2"> <strong> Rp. <?php echo number_format($totalpendapatan) ?> </strong></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var keyword = document.getElementById('keyword');
    var container = document.getElementById('container');

    keyword.addEventListener('keyup', function() {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                container.innerHTML = xhr.responseText;
            }
        }

        xhr.open('POST', 'pendapatan_ajax.php?keyword=' + keyword.value, true);
        xhr.send();
    });
</script>

<script>
    function sum() {
        var a = document.getElementById('harga').value;
        var b = document.getElementById('volume').value;
        var result = parseInt(a) * parseInt(b);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
</script>