<?php
//update.php
$connect = mysqli_connect("localhost", "root", "", "lababersih");
if (!empty($_POST)) {
    $output = '';
    $kd_barang = mysqli_real_escape_string($connect, $_POST["kd_barang"]);
    $spesifikasi = mysqli_real_escape_string($connect, $_POST["spesifikasi"]);
    $slump = mysqli_real_escape_string($connect, $_POST["slump"]);
    $size = mysqli_real_escape_string($connect, $_POST["size"]);
    $harga = mysqli_real_escape_string($connect, $_POST["harga"]);
    $query = "
    update barang set spesifikasi = '$spesifikasi', slump ='$slump', size='$size', harga='$harga' where id_barang = '$_POST[id_barang]'
    ";

    if (mysqli_query($connect, $query)) {
        $output .= '<label class="text-success">Data Berhasil Diupdate</label>';
        $select_query = "SELECT * FROM barang ORDER BY id_barang DESC";
        $result = mysqli_query($connect, $select_query);
        $output .= '
      <table class="table table-bordered">  
                    <tr>  
                         <th width="55%">Kode Barang</th>  
                         <th width="15%">Lihat</th>  
                         <th width="15%">Edit</th>  
                         <th width="15%">Hapus</th>  
                    </tr>
     ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
       <tr>  
                         <td>' . $row["kd_barang"] . '</td>  
                         <td><input type="button" name="view" value="Lihat Detail" id_barang="' . $row["id_barang"] . '" class="btn btn-info btn-xs view_data" /></td>  
                         <td><input type="button" name="edit" value="Edit" id_barang="' . $row["id_barang"] . '" class="btn btn-warning btn-xs edit_data" /></td>   
                         <td><input type="button" name="delete" value="Hapus" id_barang="' . $row["id_barang"] . '" class="btn btn-danger btn-xs hapus_data" /></td>
                      
                    </tr>
      ';
        }
        $output .= '</table>';
    } else {
        $output .= mysqli_error($connect);
    }
    echo $output;
}
