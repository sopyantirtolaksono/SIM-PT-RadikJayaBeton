<script>
    $('#update_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#enama').val() == "") {
            alert("Mohon Isi Nama ");
        } else if ($('#ealamat').val() == '') {
            alert("Mohon Isi Alamat");
        } else {
            $.ajax({
                url: "update.php",
                method: "POST",
                data: $('#update_form').serialize(),
                beforeSend: function() {
                    $('#update').val("Updating");
                },
                success: function(data) {
                    $('#update_form')[0].reset();
                    $('#editModal').modal('hide');
                    $('#employee_table').html(data);
                }
            });
        }
    });
</script>
<?php
if (isset($_POST["employee_id"])) {
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "lababersih");
    $query = "SELECT * FROM barang WHERE id_barang = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $output .= '
         <form method="post" id="update_form">
     <label>Spesifikasi</label>
     <input type="hidden" name="id_barang" id="id_barang" value="' . $_POST["employee_id"] . '" class="form-control" />
     <input type="text" name="spesifikasi" id="espesifikasi" value="' . $row['spesifikasi'] . '" class="form-control" />
     <br />
     <label>Slump</label>
     <input name="slump" id="eslump" class="form-control">' . $row['slump'] . '</input>
     <br />  
     <label>Size</label>
     <input name="size" id="esize" class="form-control">' . $row['size'] . '</input>
     <br />  
     <label>Harga</label>
     <input type="text" name="harga" id="harga" value="' . $row['harga'] . '" class="form-control" />
     <br />
     <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />
 
    </form>
     ';
    echo $output;
}
?>