<?php
//select.php  
if (isset($_POST["employee_id"])) {
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "lababersih");
    $query = "SELECT * FROM barang WHERE id_barang = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($connect, $query);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
     <tr>  
            <td width="30%"><label>Spesifikai</label></td>  
            <td width="70%">' . $row["spesifikasi"] . '</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Slump</label></td>  
            <td width="70%">' . $row["slump"] . '</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Size</label></td>  
            <td width="70%">' . $row["size"] . '</td>  
        </tr>
       
        <tr>  
            <td width="30%"><label>Harga</label></td>  
            <td width="70%">' . $row["harga"] . '</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
