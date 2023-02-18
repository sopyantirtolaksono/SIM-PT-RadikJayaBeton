<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Tambah Pelanggan</h2>
    </div>
    <br>
    <div class="panel-body">
        <form method="post">
            <?php
            include 'koneksi.php';
            $sql = "SELECT max(right(kd_pelanggan, 4)) AS kd_pelanggan FROM pelanggan";
            $q = $koneksi->query($sql);

            if ($q->num_rows > 0) {
                foreach ($q as $qq) {
                    $no = ((int)$qq['kd_pelanggan']) + 1;
                    $kd = sprintf("%04s", $no);
                }
            } else {
                $kd = "0001";
            }
            $huruf = "PLG-";
            $kode = $huruf . $kd;
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Pelanggan</label>
                        <input type="text" class="form-control" name="kd_pelanggan" value="<?php echo $kode; ?>" readonly required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="number" class="form-control" name="no_tlp" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>
        <?php

        if (isset($_POST['save'])) {

            $koneksi->query("INSERT INTO pelanggan (kd_pelanggan,nama_pelanggan,alamat,no_tlp)
		VALUES('" . $_POST["kd_pelanggan"] . "','" . $_POST["nama_pelanggan"] . "','" . $_POST["alamat"] . "','" . $_POST["no_tlp"] . "')");

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
        }
        ?>

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
                                <th>Kode Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>No Tlp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'koneksi.php'; ?>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
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

                xhr.open('POST', 'pelanggan_ajax.php?keyword=' + keyword.value, true);
                xhr.send();
            });
        </script>