<?php

// mulai session
session_start();

// cek jika sudah ada user yang login
if (isset($_SESSION["user"])) {
  header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sialababersih</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<body>
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        <h2><strong>LOGIN</strong></h2>

        <h5><strong>( PT. RADIK JAYA BETON )</strong></h5>
        <br />
      </div>
    </div>

    <div class="row ">

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong> Silahkan Masukan Username dan Password Anda </strong>
          </div>
          <div class="panel-body">

            <form action="" method="post">
              <br />

              <!-- script login -->
              <?php
              if (isset($_POST['login'])) {

                // koneksi ke database
                include 'koneksi.php';

                // ambil data user yg login dari form login
                $username  = $_POST['username'];
                //$jabatan   = $_POST['jabatan'];
                $password  = $_POST['password'];

                // ambil data user dari tabel user
                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'  AND password = '$password' ");
                // cek ada akun user yg cocok tidak
                if (mysqli_num_rows($query) == 0) {

                  echo '<div class="alert alert-danger">Login gagal. Akun tidak dapat ditemukan, coba periksa kembali username dan password anda!</div>';
                } else if (mysqli_num_rows($query) == 1) {

                  // ambil data user, jadikan sebagai array assosiatif
                  $row = mysqli_fetch_assoc($query);

                  // buat session user
                  $_SESSION["user"] = $row;

                  // alihkan ke halaman index
                  header("Location: index.php");
                  exit();
                } else {

                  echo '<div class="alert alert-danger">Login gagal!</div>';
                }
              }
              ?>
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" required />
              </div>
              <!--<div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select name="jabatan" class="form-control" required>
                  <option disabled>Pilih Jabatan:</option>
                  <option value="administrator">Administrator</option>
                  <option value="bendahara">Bendahara</option>
                  <option value="admin">Admin</option>
                  <option value="pimpinan">Pimpinan</option>
                </select>
              </div>-->
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required />
              </div>
              <!--<div class="form-group">
                <label class="checkbox-inline">
                  <input type="checkbox" id="lihatPassword" onclick="showHidePass()">
                  Lihat password
                </label>
              </div>-->

              <button class="btn btn-primary" type="submit" name="login">Login</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>

  <!-- SCRIPT FUNCTION SHOW HIDE PASSWORD -->
  <script src="components/js/scriptshowhidepassword.js"></script>

</body>

</html>