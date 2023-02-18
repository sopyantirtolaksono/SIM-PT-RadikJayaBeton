<?php
//index.php
$connect = mysqli_connect("localhost", "root", "", "lababersih");
$query = "SELECT * FROM barang ORDER BY id_barang DESC";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tutorial Popup Input Data Dengan PHP | www.sistemit.com </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container" style="width:700px;">
        <h3 align="center">Input Data Dengan Menggunakan Popup Modal Bootstrap</h3>
        <br />
        <div class="table-responsive">
            <div align="right">
                <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Tambah Data Karyawan</button>
            </div>
            <br />
            <div id="employee_table">
                <table class="table table-bordered">
                    <tr>
                        <th width="55%">Nama Karyawan</th>
                        <th width="15%">Lihat Detail</th>
                        <th width="15%">Edit</th>
                        <th width="15%">Hapus</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["nama"]; ?></td>
                            <td><input type="button" name="view" value="Lihat Detail" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                            <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_data" /></td>
                            <td><input type="button" name="delete" value="Hapus" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs hapus_data" /></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Input Data Dengan Menggunakan Modal Bootstrap</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama" id="nama" class="form-control" />
                    <br />
                    <label>Alamat Karyawan</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    <br />
                    <label>Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <br />
                    <label>Umur</label>
                    <input type="text" name="umur" id="umur" class="form-control" />
                    <br />
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Data Karyawan</h4>
            </div>
            <div class="modal-body" id="detail_karyawan">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="editModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Karyawan</h4>
            </div>
            <div class="modal-body" id="form_edit">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Begin Aksi Insert
        $('#insert_form').on("submit", function(event) {
            event.preventDefault();
            if ($('#nama').val() == "") {
                alert("Mohon Isi Nama ");
            } else if ($('#alamat').val() == '') {
                alert("Mohon Isi Alamat");
            } else {
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: $('#insert_form').serialize(),
                    beforeSend: function() {
                        $('#insert').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide');
                        $('#employee_table').html(data);
                    }
                });
            }
        });
        //END Aksi Insert

        //Begin Tampil Detail Karyawan
        $(document).on('click', '.view_data', function() {
            var employee_id = $(this).attr("id");
            $.ajax({
                url: "select.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                success: function(data) {
                    $('#detail_karyawan').html(data);
                    $('#dataModal').modal('show');
                }
            });
        });
        //End Tampil Detail Karyawan

        //Begin Tampil Form Edit
        $(document).on('click', '.edit_data', function() {
            var employee_id = $(this).attr("id");
            $.ajax({
                url: "edit.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                success: function(data) {
                    $('#form_edit').html(data);
                    $('#editModal').modal('show');
                }
            });
        });
        //End Tampil Form Edit

        //Begin Aksi Delete Data
        $(document).on('click', '.hapus_data', function() {
            var employee_id = $(this).attr("id");
            $.ajax({
                url: "delete.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                success: function(data) {
                    $('#employee_table').html(data);
                }
            });
        });
    });
    //End Aksi Delete Data
</script>









<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <?php
        if (isset($_GET['halaman'])) {
            if ($_GET['halaman'] == "barang") {
                include 'barang.php';
            } elseif ($_GET['halaman'] == "pemasok") {
                include 'pemasok.php';
            } elseif ($_GET['halaman'] == "pelanggan") {
                include 'pelanggan.php';
            } elseif ($_GET['halaman'] == "bahanbaku") {
                include 'bahanbaku.php';
            } elseif ($_GET['halaman'] == "pendapatan") {
                include 'pendapatan.php';
            } elseif ($_GET['halaman'] == "produksi") {
                include 'produksi.php';
            } elseif ($_GET['halaman'] == "pembelian") {
                include 'pembelian.php';
            } elseif ($_GET['halaman'] == "pengeluaran") {
                include 'pengeluaran.php';
            } elseif ($_GET['halaman'] == "akun") {
                include 'akun.php';
            } elseif ($_GET['halaman'] == "hapusbarang") {
                include 'hapusbarang.php';
            } elseif ($_GET['halaman'] == "editbarang") {
                include 'editbarang.php';
            } elseif ($_GET['halaman'] == "tambahbarang") {
                include 'tambahbarang.php';
            } elseif ($_GET['halaman'] == "tambahakun") {
                include 'tambahakun.php';
            } elseif ($_GET['halaman'] == "hapuspemasok") {
                include 'hapuspemasok.php';
            } elseif ($_GET['halaman'] == "hapusakun") {
                include 'hapusakun.php';
            } elseif ($_GET['halaman'] == "editpemasok") {
                include 'editpemasok.php';
            } elseif ($_GET['halaman'] == "editakun") {
                include 'editakun.php';
            } elseif ($_GET['halaman'] == "tambahpemasok") {
                include 'tambahpemasok.php';
            } elseif ($_GET['halaman'] == "hapuspelanggan") {
                include 'hapuspelanggan.php';
            } elseif ($_GET['halaman'] == "editpelanggan") {
                include 'editpelanggan.php';
            } elseif ($_GET['halaman'] == "tambahpelanggan") {
                include 'tambahpelanggan.php';
            } elseif ($_GET['halaman'] == "hapusbhnbaku") {
                include 'hapusbhnbaku.php';
            } elseif ($_GET['halaman'] == "editbhnbaku") {
                include 'editbhnbaku.php';
            } elseif ($_GET['halaman'] == "tambahbhnbaku") {
                include 'tambahbhnbaku.php';
            } elseif ($_GET['halaman'] == "tambahpendapatan") {
                include 'tambahpendapatan.php';
            } elseif ($_GET['halaman'] == "editpendapatan") {
                include 'editpendapatan.php';
            } elseif ($_GET['halaman'] == "tambahproduksi") {
                include 'tambahproduksi.php';
            } elseif ($_GET['halaman'] == "editproduksi") {
                include 'editproduksi.php';
            } elseif ($_GET['halaman'] == "tambahpembelian") {
                include 'tambahpembelian.php';
            } elseif ($_GET['halaman'] == "editpembelian") {
                include 'editpembelian.php';
            } elseif ($_GET['halaman'] == "tambahpengeluaran") {
                include 'tambahpengeluaran.php';
            } elseif ($_GET['halaman'] == "editpengeluaran") {
                include 'editpengeluaran.php';
            } elseif ($_GET['halaman'] == "laporan_barang") {
                include 'laporan_barang.php';
            } elseif ($_GET['halaman'] == "laporan_bhnbaku") {
                include 'laporan_bhnbaku.php';
            } elseif ($_GET['halaman'] == "laporan_pelanggan") {
                include 'laporan_pelanggan.php';
            } elseif ($_GET['halaman'] == "laporan_pemasok") {
                include 'laporan_pemasok.php';
            } elseif ($_GET['halaman'] == "laporan_pendapatan") {
                include 'laporan_pendapatan.php';
            } elseif ($_GET['halaman'] == "laporan_produksi") {
                include 'laporan_produksi.php';
            } elseif ($_GET['halaman'] == "laporan_pembelian") {
                include 'laporan_pembelian.php';
            } elseif ($_GET['halaman'] == "laporan_pengeluaran") {
                include 'laporan_pengeluaran.php';
            } elseif ($_GET['halaman'] == "laporan_akun") {
                include 'laporan_akun.php';
            } elseif ($_GET['halaman'] == "laporan_labarugi") {
                include 'laporan_labarugi.php';
            } elseif ($_GET['halaman'] == "cetakbarang") {
                include 'cetakbarang.php';
            } elseif ($_GET['halaman'] == "cetakbhnbaku") {
                include 'cetakbhnbaku.php';
            } elseif ($_GET['halaman'] == "cetakpelanggan") {
                include 'cetakpelanggan.php';
            } elseif ($_GET['halaman'] == "cetakpemasok") {
                include 'cetakpemasok.php';
            } elseif ($_GET['halaman'] == "cetakpendapatan") {
                include 'cetakpendapatan.php';
            } elseif ($_GET['halaman'] == "cetakproduksi") {
                include 'cetakproduksi.php';
            } elseif ($_GET['halaman'] == "cetakpembelian") {
                include 'cetakpembelian.php';
            } elseif ($_GET['halaman'] == "cetakpengeluaran") {
                include 'cetakpengeluaran.php';
            } elseif ($_GET['halaman'] == "cetaklabarugi") {
                include 'cetaklabarugi.php';
            } elseif ($_GET['halaman'] == "user") {
                include 'user.php';
            } elseif ($_GET['halaman'] == "tambahuser") {
                include 'tambahuser.php';
            } elseif ($_GET['halaman'] == "hapususer") {
                include 'hapususer.php';
            } elseif ($_GET['halaman'] == "edituser") {
                include 'edituser.php';
            } elseif ($_GET['halaman'] == "laporan_pajak") {
                include 'laporan_pajak.php';
            } elseif ($_GET['halaman'] == "cetakpajak") {
                include 'cetakpajak.php';
            }
        } else {
            include 'home.php';
        }
        ?>
    </div>
    <!-- /. PAGE INNER  -->
</div>