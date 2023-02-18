<?php
header('Content-type: application/json');

include "koneksi.php";
if (isset($_POST["kd_barang"])) {
    $valid = '';
    $message = '';
    $query = "SELECT * FROM tb_siswa WHERE kd_barang = '" . $_POST["kd_barang"] . "'";
    $sql = mysqli_query($koneksi, $query);
    $row = mysqli_num_rows($sql);

    if ($row < 1) {
        $valid = true;
        $message = "success";
    } else {
        $valid = false;
        $message = "Kode Barang Sudah Ada";
    }
    echo json_encode(
        $valid ? array('valid' => $valid) : array('valid' => $valid, 'message' => $message)
    );
}
