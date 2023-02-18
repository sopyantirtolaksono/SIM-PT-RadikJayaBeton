<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Tambah Pemasok</h2>
    </div>
    <br>
    <div class="panel-body">
        <form method="post">
            <?php
            include 'koneksi.php';
            $sql = "SELECT max(right(kd_pemasok, 4)) AS kd_pemasok FROM pemasok";
            $q = $koneksi->query($sql);

            if ($q->num_rows > 0) {
                foreach ($q as $qq) {
                    $no = ((int)$qq['kd_pemasok']) + 1;
                    $kd = sprintf("%04s", $no);
                }
            } else {
                $kd = "0001";
            }
            $huruf = "PMK-";
            $kode = $huruf . $kd;
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Pemasok</label>
                        <input type="text" class="form-control" name="kd_pemasok" value="<?php echo $kode; ?>" readonly required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pemasok</label>
                        <input type="text" class="form-control" name="nama_pemasok" required>
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

            $koneksi->query("INSERT INTO pemasok (kd_pemasok,nama_pemasok,alamat,no_tlp)
		VALUES('" . $_POST["kd_pemasok"] . "','" . $_POST["nama_pemasok"] . "','" . $_POST["alamat"] . "','" . $_POST["no_tlp"] . "')");

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pemasok'>";
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
                                <th>Kode Pemasok</th>
                                <th>Nama Pemasok</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'koneksi.php'; ?>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM pemasok"); ?>
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
                </div>
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

        xhr.open('POST', 'pemasok_ajax.php?keyword=' + keyword.value, true);
        xhr.send();
    });
</script>