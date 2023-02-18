<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Tambah Bahan Baku</h2>
    </div>
    <br>
    <div class="panel-body">
        <form method="post">
            <?php
            include 'koneksi.php';
            $sql = "SELECT max(right(kd_bhnbaku, 4)) AS kd_bhnbaku FROM bahan_baku";
            $q = $koneksi->query($sql);

            if ($q->num_rows > 0) {
                foreach ($q as $qq) {
                    $no = ((int)$qq['kd_bhnbaku']) + 1;
                    $kd = sprintf("%04s", $no);
                }
            } else {
                $kd = "0001";
            }
            $huruf = "BBK-";
            $kode = $huruf . $kd;
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kode Bahan Baku</label>
                        <input type="text" class="form-control" name="kd_bhnbaku" value="<?php echo $kode; ?>" readonly required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Bahan Baku</label>
                        <input type="text" class="form-control" name="nama_bhnbaku" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" class="form-control" name="jenis" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-primary" name="save">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <?php

        if (isset($_POST['save'])) {

            $koneksi->query("INSERT INTO bahan_baku (kd_bhnbaku,nama_bhnbaku,jenis)
		VALUES('" . $_POST["kd_bhnbaku"] . "','" . $_POST["nama_bhnbaku"] . "','" . $_POST["jenis"] . "')");

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=bahanbaku'>";
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
                                <th>Kode Bahan Baku</th>
                                <th>Nama Bahan Baku</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'koneksi.php'; ?>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM bahan_baku"); ?>
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

                xhr.open('POST', 'bahanbaku_ajax.php?keyword=' + keyword.value, true);
                xhr.send();
            });
        </script>