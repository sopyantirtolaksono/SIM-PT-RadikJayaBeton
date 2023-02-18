<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Tambah User</h2>
    </div>
    <br>
    <div class="panel-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Panjang</label>
                        <input type="text" class="form-control" name="nama_panjang" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" required>
                            <option value="">Pilih Status</option>
                            <option value="administrator">administrator</option>
                            <option value="admin">admin</option>
                            <option value="bendahara">bendahara</option>
                            <option value="pimpinan">pimpinan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['save'])) {

            $koneksi->query("INSERT INTO user (username,password,nama_panjang,jabatan)
		VALUES('$_POST[username]','$_POST[password]','$_POST[nama_panjang]','$_POST[jabatan]')");

            echo "<div class='alert alert-info'> Data Tersimpan </div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=user'>";
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
                            <?php $ambil = $koneksi->query("SELECT * FROM user"); ?>
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

                xhr.open('POST', 'user_ajax.php?keyword=' + keyword.value, true);
                xhr.send();
            });
        </script>