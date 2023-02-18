<?php
error_reporting(0);
include "koneksi.php";

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    header('HTTP/1.1 500 Error!');
    exit();
}
if (isset($_POST)) {

    $output = '';
    $message = '';
    $kd_barang = mysqli_real_escape_string($_POST["kd_barang"]);
    $spesifikasi = mysqli_real_escape_string($_POST["spesifikasi"]);
    $slump = mysqli_real_escape_string($_POST["slump"]);
    $size = mysqli_real_escape_string($_POST["size"]);
    $harga = mysqli_real_escape_string($_POST["harga"]);

    $message = '<div class="alert alert-success alert-dismissible">
 
 <button type="button" class="close" data-dismiss="alert" 
aria-label="Close"><span 
aria-hidden="true">&times;</span></button>
  <strong>Input Berhasil !</strong> Data Berhasil disimpan ke database.
  </div>';

    $query = "INSERT INTO 
barang(kd_barang,spesifikasi,slump,size,harga) VALUES 
('$kd_barang','$spesifikasi','$slump','$size','$harga');";

    if (mysqli_query($query)) {
        $output .= '<span id="success_message">' . $message . '</span>';
        $output .= '<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>NIS</th>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Gender</th>
            <th>Foto</th>
            <th>Action</th>
        </tr>';
        $query = "SELECT * FROM tb_siswa order by id_siswa desc";
        $result = mysqli_query($query);
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
        <tr>
            <td><strong>' . $row["id_siswa"] . '</strong></td>
            <td>' . $row["nisn"] . '</td>
            <td>' . $row["nama_siswa"] . '</td>
            <td>' . $row["gender_siswa"] . '</td>
           
 <td><img src="images/' . $row['foto_siswa'] . '" 
class="img-thumbnail" style="width:100px; height:100px;"></td>

           
 <td><a class="edit_data" id="' . $row['id_siswa'] . '" 
href="javascript:void(0);" data-toggle="modal" 
data-target="#edit_data_Modal" data-backdrop="static">Edit</a>
            </td>
        </tr>
        ';
        }
        $output .= '
    </table>
</div>';
    } else {
        echo 'Error';
    }
    echo $output;
}
