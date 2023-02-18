<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
$masuk = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($masuk);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

	$data = mysqli_fetch_assoc($masuk);

	// cek jika user login sebagai admin
	if ($data['jabatan'] == "administrator") {

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['jabatan'] = "administrator";
		$_SESSION['login'] = true;
		// alihkan ke halaman dashboard admin
		header("location:index.php");
		// cek jika user login sebagai pegawai
	} else if ($data['jabatan'] == "pimpinan") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['jabatan'] = "pimpinan";
		$_SESSION['login1'] = true;
		// alihkan ke halaman dashboard pimpinan
		header("location:index1.php");
	} else if ($data['jabatan'] == "bendahara") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['jabatan'] = "bendahara";
		$_SESSION['login2'] = true;
		// alihkan ke halaman dashboard pimpinan
		header("location:index2.php");
	} else if ($data['jabatan'] == "user") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['jabatan'] = "user";
		$_SESSION['login3'] = true;
		// alihkan ke halaman dashboard pimpinan
		header("location:index3.php");
	} else {
		header("
    <script>
        alert('Anda Tidak Bisa Menambah Lewat URL');
        document.location.href = 'login.php';
    </script>");