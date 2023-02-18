<?php
// Koneksi
include "koneksi.php";
$result = mysqli_query($koneksi, "select * from bahanbaku");
$jsArray = "var prdName = new Array();\n";
echo 'Kode Produk : <select name="prdId" onchange="changeValue(this.value)">';
echo '<option>-------</option>';
while ($row = mysqli_fetch_array($result)) {
    echo '<option value="' . $row['id_bhnbaku'] . '">' . $row['id_bhnbaku'] . '</option>';
    $jsArray .= "prdName['" . $row['id_bhnbaku'] . "'] = {name:'" . addslashes($row['nama_bhnbaku']) . "',desc:'" . addslashes($row['jenis']) . "'};\n";
}
echo '</select>';
?>
<br /><br />Nama Produk : <input type="text" name="prod_name" id="prd_name" />
<br /><br />Keterangan : <input type="text" name="prod_desc" id="prd_desc" />
<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(id) {
        document.getElementById('prd_name').value = prdName[id].name;
        document.getElementById('prd_desc').value = prdName[id].desc;
    };
</script>


<hr>

<br><br>
<?php
include 'koneksi.php';
$sql = "SELECT * FROM pembelian";

$query = mysqli_query($koneksi, $sql);

if (!$query) {
    die('SQL Error: ' . mysqli_error($koneksi));
}
?>
<html>

<head>
    <style type="text/css">
        body {
            font-size: 15px;
            color: #343d44;
            font-family: "segoe-ui", "open-sans", tahoma, arial;
            padding: 0;
            margin: 0;
        }

        table {
            margin: auto;
            font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
            font-size: 12px;
        }

        h1 {
            margin: 25px auto 0;
            text-align: center;
            text-transform: uppercase;
            font-size: 17px;
        }

        table td {
            transition: all .5s;
        }

        /* Table */
        .data-table {
            border-collapse: collapse;
            font-size: 14px;
            min-width: 537px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #e1edff;
            padding: 7px 17px;
        }

        .data-table caption {
            margin: 7px;
        }

        /* Table Header */
        .data-table thead th {
            background-color: #508abb;
            color: #FFFFFF;
            border-color: #6ea1cc !important;
            text-transform: uppercase;
        }

        /* Table Body */
        .data-table tbody td {
            color: #353535;
        }

        .data-table tbody td:first-child,
        .data-table tbody td:nth-child(4),
        .data-table tbody td:last-child {
            text-align: right;
        }

        .data-table tbody tr:nth-child(odd) td {
            background-color: #f4fbff;
        }

        .data-table tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f;
        }

        /* Table Footer */
        .data-table tfoot th {
            background-color: #e5f5ff;
            text-align: right;
        }

        .data-table tfoot th:first-child {
            text-align: left;
        }

        .data-table tbody td:empty {
            background-color: #ffcccc;
        }
    </style>
</head>

<body>


    <form action="" method="post">
        <input type="date" name="tgl1">
        <input type="date" name="tgl2">
        <input type="submit" name="tampilkan" value="TAMPILKAN">
        <?php
        if (isset($_POST["tampilkan"]))
        ?>
    </form>

    <h1>Tabel 1</h1>

    </select>
    <table class="data-table">
        <caption class="title">Data Pembelian</caption>
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE PEMBELIAN</th>
                <th>TANGGAL</th>
                <th>NAMA BAHAN BAKU</th>\
                <th>NAMA PEMASOK</th>
                <th>JUMLAH</th>
                <th>HARGA</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>

            <?php
        $no     = 1;
        $totalpembelian     = 0;
        $bulan    = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        while ($row = mysqli_fetch_array($query)) {
            $tgl     = explode('-', $row['tanggal']);
            $harga  = $row['harga'] == 0 ? '' : number_format($row['harga'], 0, ',', '.');
            $total  = $row['total'] == 0 ? '' : number_format($row['total'], 0, ',', '.');
            echo '<tr>
					<td>' . $no . '</td>
					<td>' . $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] . '</td>
					<td>' . $row['nama_bhnbaku'] . '</td>
                    <td>' . $row['nama_pemasok'] . '</td>
                    <td>' . $row['jumlah'] . '</td>
                    <td>'  . "Rp.  " . $harga . '</td>
                    <td>'  . "Rp.  " . $total . '</td>
				</tr>';
            $totalpembelian += $row['total'];
            $no++;
        } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7">TOTAL</th>
                <th>Rp. <?= number_format($totalpembelian, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            $.ajax({
                type: 'POST',
                url: 'pembelian_ajax.php',
                data: {
                    search: $(this).val()
                },
                cache: false,
                success: function(data) {
                    $('keyword').html(data);
                }
            });
        });
    });
</script>

</html>

<!--  pendapatan -->
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="container">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Pendapatan</th>
                    <th>Nama Pelanggan</th>
                    <th>Spesifikasi Beton</th>
                    <th>Harga</th>
                    <th>Volume</th>
                    <th>Total</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'koneksi.php'; ?>
                <?php $nomor = 1; ?>
                <?php $ambil = $koneksi->query("SELECT * FROM pendapatan"); ?>
                <!--//<?php $total //= 0; 
                        ?>-->
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <!--//<?php $total //= $pecah['harga'] * $pecah['volume']; 
                            ?>-->

                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['tanggal']; ?></td>
                        <td><?php echo $pecah['kd_pendapatan']; ?></td>
                        <td><?php echo $pecah['nama_pelanggan']; ?></td>
                        <td><?php echo $pecah['spesifikasi']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                        <td><?php echo $pecah['volume']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['total']); ?></td>
                        <!--<td>Rp. <?php //echo number_format($total) 
                                    ?></td>-->
                        <td>
                            <a href="index.php?halaman=editpendapatan&id=<?php echo $pecah['no_pendapatan']; ?>" class="btn btn-warning">Edit</a>
                            <!--<a href="index.php?halaman=ubahpelanggan&id=<?php //echo $pecah['id_pelanggan']; 
                                                                            ?>" 
                class="btn btn-warning">ubah</a>-->
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- pembelian -->


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
        <table class="table table-striped table-bordered table-hover" id="container">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Pembelian</th>
                    <th>Nama Bahan Baku</th>
                    <th>Nama Pemasok</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php include 'koneksi.php'; ?>
                <?php $nomor = 1; ?>
                <?php $ambil = $koneksi->query("SELECT * FROM pembelian"); ?>
                <?php $total = 0; ?>
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <?php $total = $pecah['harga'] * $pecah['jumlah']; ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['tanggal']; ?></td>
                        <td><?php echo $pecah['kd_pembelian']; ?></td>
                        <td><?php echo $pecah['nama_bhnbaku']; ?></td>
                        <td><?php echo $pecah['nama_pemasok']; ?></td>
                        <td><?php echo $pecah['jumlah']; ?></td>
                        <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                        <td>Rp. <?php echo number_format($total) ?></td>
                        <td>

                            <a href="index.php?halaman=editpembelian&id=<?php echo $pecah['no_pembelian']; ?>" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>




<div class="form-group">
    <label>Nama Bahan Baku</label>
    <select class="form-control" name="nama_bhnbaku">
        <option value="0">Pilih Bahan Baku</option>
        <?php
        $bahanbaku = mysqli_query($koneksi, "SELECT * FROM bahanbaku");
        while ($rbahanbaku = mysqli_fetch_assoc($bahanbaku)) {
        ?>
            <option value="<?php echo $rbahanbaku['nama_bhnbaku']; ?>"><?php echo $rbahanbaku['nama_bhnbaku']; ?></option>
        <?php } ?>
    </select>
</div>