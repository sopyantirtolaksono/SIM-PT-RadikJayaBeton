<!DOCTYPE html>
<html>

<head>
    <title>Develindo | Ajax PHP - Insert Edit Record Menggunakan Ajax php</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/bootstrapValidator.css" />

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- validator -->
    <script type="text/javascript" src="dist/js/bootstrapValidator.js"></script>
</head>

<body>
    <br /><br />
    <div class="container" style="width:800px;">
        <h2 align="center">Insert Edit Record Menggunakan Ajax PHP Modal Bootstrap Validator</h2>
        <br>
        <div>

            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" data-backdrop="static" class="btn 
btn-success">Tambah Data</button>
        </div><br>
        <div id="tabel_barang">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Spesifikasi</th>
                        <th>Slump</th>
                        <th>Size</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    //panggil fungsi koneksi.php
                    include "koneksi.php";
                    //ambil data dari tb_siswa dan lakukan perulangan dengan while
                    $ambildata = $koneksi->query("SELECT * FROM barang order by id_barang desc");
                    while ($a = mysqli_fetch_array($ambildata)) {
                    ?>
                        <tr>
                            <td><?php echo $a['kd_barang']; ?></td>
                            <td><?php echo $a['spesifikasi']; ?></td>
                            <td><?php echo $a['slump']; ?></td>
                            <td><?php echo $a['size']; ?></td>
                            <td><?php echo $a['harga']; ?></td>

                            <td><a class="btn btn-primary edit_data" id="<?php echo
                                                                            $a['id_barang']; ?>" href="javascript:void(0);" data-toggle="modal" data-target="#edit_data_Modal" data-backdrop="static">Edit</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal Popup untuk Input-->
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Input Data Siswa </h4>
                </div>
                <div class="modal-body">
                    <form id="defaultForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <?php
                        include 'koneksi.php';
                        $sql = "SELECT max(right(id_barang, 4)) AS id_barang FROM barang";
                        $q = $koneksi->query($sql);

                        if ($q->num_rows > 0) {
                            foreach ($q as $qq) {
                                $no = ((int)$qq['id_barang']) + 1;
                                $kd = sprintf("%04s", $no);
                            }
                        } else {
                            $kd = "0001";
                        }
                        $huruf = "BRG-";
                        $kode = $huruf . $kd;
                        ?>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kode Barang</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="kd_barang" id="kd_barang" placeholder="Kode Barang" maxlength="30" autocomplete="off" value="<?php echo $kode; ?> " />
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="col-lg-3 control-label">Spesifikasi</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi" maxlength="30" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Slump</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="slump" id="slump" placeholder="Slump" maxlength="8" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Size</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="size" id="size" placeholder="Size" maxlength="10" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Harga</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" maxlength="10" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <input type="submit" name="submit" class="btn btn-primary" id="insert" value="Simpan">

                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup untuk Edit-->
    <div id="edit_data_Modal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Edit Data Siswa</h4>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Spesifikasi</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="espesifikasi" id="espesifikasi" placeholder="spesifikasi" maxlength="30" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Slump</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="eslump" id="eslump" placeholder="Slump" maxlength="8" autocomplete="off" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Size</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="esize" id="esize" placeholder="Size" maxlength="10" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Harga</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control" name="eharga" id="eharga" placeholder="Harga" maxlength="10" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <input type="hidden" class="form-control" name="lama" id="lama" />
                                <input type="hidden" class="form-control" name="id" id="id" />

                                <input type="submit" name="submit" class="btn btn-primary" id="update" value="Update Data">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    /*insert form*/

    $(document).ready(function() {
        $('#defaultForm')
            .bootstrapValidator({
                fields: {
                    spesifikasi: {
                        validators: {
                            notEmpty: {
                                message: 'Spesifikasi Tidak Boleh Kosong !'
                            },
                        }
                    },
                    slump: {
                        validators: {
                            notEmpty: {
                                message: 'Slump Tidak Boleh Kosong !'
                            },

                            digits: {
                                message: 'Gunakan Angka !'
                            },
                        }
                    },
                    size: {
                        validators: {
                            notEmpty: {
                                message: 'Size Tidak Boleh Kosong !'
                            },
                            digits: {
                                message: 'Gunakan Angka !'
                            }
                        }
                    },
                    harga: {
                        validators: {
                            notEmpty: {
                                message: 'Harga Tidak Boleh Kosong'
                            },
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                // Prevent form submission
                e.preventDefault();

                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#insert').val("sedang menyimpan...");

                    },
                    success: function(data) {
                        $('#defaultForm')[0].reset();
                        $('#defaultForm').bootstrapValidator('resetForm', true);
                        $('#add_data_Modal').modal('hide');
                        $('#tabel_barang').html(data);
                        $('#insert').val("Simpan Data");
                        setTimeout(function() {
                            $('#success_message').fadeOut("Slow");

                        }, 2000);
                    }
                });

            });
    });

    /*edit data*/

    $(document).ready(function() {
        $(document).on('click', '.edit_data', function() {
            var id = $(this).prop("id");
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    $('#espesifikasi').val(data.spesifiaksi);
                    $('#eslump').val(data.slump);
                    $('#esize').val(data.size);
                    $('#harga').val(data.harga);
                    $('#update').val("Simpan Perubahan");
                    $('#edit_data_Modal').modal('show');
                }
            });
        });
    });

    /*edit form*/

    $(document).ready(function() {
        $('#editForm')
            .bootstrapValidator({
                fields: {
                    espesifikasi: {
                        validators: {
                            notEmpty: {
                                message: 'Spesifikasi Tidak Boleh Kosong !'
                            },
                        }
                    },
                    eslump: {
                        validators: {
                            notEmpty: {
                                message: 'Slump Tidak Boleh Kosong !'
                            },
                            digits: {
                                message: 'Gunakan Angka !'
                            }
                        }
                    },
                    esize: {
                        validators: {
                            notEmpty: {
                                message: 'Slump Tidak Boleh Kosong !'
                            },
                            digits: {
                                message: 'Gunakan Angka !'
                            }
                        }
                    },
                    eharga: {
                        validators: {
                            notEmpty: {
                                message: 'Harga Tidak Boleh Kosong !'
                            },
                            digits: {
                                message: 'Gunakan Angka !'
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                // Prevent form submission
                e.preventDefault();

                $.ajax({
                    url: "update.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#update').val("sedang mengupdate...");
                    },
                    success: function(data) {
                        $('#editForm')[0].reset();
                        $('#editForm').bootstrapValidator('resetForm', true);
                        $('#edit_data_Modal').modal('hide');
                        $('#tabel_barang').html(data);
                        $('#update').val("Simpan Perubahan");
                        setTimeout(function() {
                            $('#success_message').fadeOut("Slow");

                        }, 2000);
                    }
                });

            });
    });
</script>