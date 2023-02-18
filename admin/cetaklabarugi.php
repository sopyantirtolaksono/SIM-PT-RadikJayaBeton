<?php ob_start(); ?>
<?php
include "koneksi.php";
$tgl_awal = @$_POST['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
$tgl_akhir = @$_POST['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
$date = date('m', strtotime("-1 month"));
$akun = "SELECT * FROM akun WHERE nama_akun LIKE '%semen%' OR nama_akun LIKE'%split%' OR nama_akun LIKE '%pasir%' OR nama_akun LIKE '%obat%' ";
$pembelian1 = "SELECT * FROM Pembelian WHERE month(tanggal)='$date' ";
if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
    // Buat query untuk menampilkan semua data transaksi
    $query = " SELECT * FROM pendapatan";
    $pembelian = "SELECT * FROM pembelian";
    // $pengeluaran = "SELECT * FROM pengeluaran WHERE keterangan LIKE '%Biaya Bahan Baku'";
    $pengeluaran = "SELECT * FROM pengeluaran WHERE keterangan LIKE '%Biaya Operasional' ";
    $label = "Semua Data Transaksi";
    $url_cetak = "cetaklabarugi.php";
} else { // Jika terisi
    // Buat query untuk menampilkan data transaksi sesuai periode tanggal
    $query = " SELECT * FROM pendapatan WHERE (tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
    $pembelian = "SELECT * FROM pembelian WHERE (tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
    // $pengeluaran = "SELECT * FROM pengeluaran WHERE keterangan LIKE '%Biaya Bahan Baku' (tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
    $pengeluaran = "SELECT * FROM pengeluaran WHERE keterangan LIKE'%Biaya Operasional' AND (tanggal BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
    $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
    $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
    $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
    $url_cetak = "cetaklabarugi.php?tgl_awal=" . $tgl_awal . "&tgl_akhir=" . $tgl_akhir . "&filter=true";
}
?>

<style type="text/css">
    body {
        font-size: 15px;
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


    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),


    /* Table Footer */
    .data-table tfoot th {
        text-align: left;
    }

    .data-table tfoot td {
        background-color: #508abb;
        color: #FFFFFF;
    }

    .data-table tfoot th:first-child {
        text-align: left;
    }
</style>


<div class="table-responsive" style="margin-top: 10px;">
    <table class="data-table">
        <thead>
            <center><img src="assets/img/rjbheader.jpg" width="800" height="100"></center>
            <h4 style="margin-bottom: 5px;">
                <center>Laporan Laba/Rugi</center>
            </h4>
            <h4 style="margin-bottom: 5px;">
                <center><?php echo $label ?> </center>
            </h4>
            <br>

            <hr>
            <h4 style="margin-bottom: 5px;"><b>Data Transaksi</b></h4>

        </thead>
        <tbody>
            <tr>
                <td colspan="5"><b>Penjualan</b></td>
            </tr>
            <?php
            $totpenjualan = 0;
            $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query        
            $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
            if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql                   

                    $totpenjualan += $data['total'];
                    echo "<tr>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . $data['spesifikasi'] . "</td>";
                    echo "<td>" . "Rp. " . number_format($data['total']) . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
            } else { // Jika data tidak ada                        
                echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2">Penjualan</td>
                <td></td>
                <td></td>
                <td>Rp. <?php echo number_format($totpenjualan); ?></td>
            </tr>
            <tr>
                <td colspan="5"><b>Harga Pokok Penjualan</b></td>
            </tr>
            <tr>
                <td colspan="5">Persediaan Bahan Baku (Awal)</td>
            </tr>
            <?php
            $bhnbakuawal = 0;
            $sql = mysqli_query($koneksi, $akun); // Eksekusi/Jalankan query dari variabel $query        
            $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
            if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql 
                    $bhnbakuawal += $data['saldo'];
                    echo "<tr>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . $data['nama_akun'] . "</td>";
                    echo "<td>" . "Rp.   " . number_format($data['saldo']) . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
            } else { // Jika data tidak ada                        
                echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2">Total Persediaan Bahan Baku (Awal)</td>
                <td></td>
                <td>Rp. <?php echo number_format($bhnbakuawal); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">Pembelian Bahan Baku</td>
            </tr>
            <?php
            $pembhnbaku = 0;
            $sql = mysqli_query($koneksi, $pembelian); // Eksekusi/Jalankan query dari variabel $query        
            $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
            if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql 
                    $pembhnbaku += $data['total'];
                    echo "<tr>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . $data['nama_bhnbaku'] . " " . $data['jenis'] . "</td>";
                    echo "<td>" . "Rp.   " . number_format($data['total']) . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
            } else { // Jika data tidak ada                        
                echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2">Total Pembelian Bahan Baku</td>
                <td></td>
                <td><u> Rp. <?php echo number_format($pembhnbaku); ?></u></td>
                <td></td>
            </tr>
            <?php
            $btud = 0;
            $btud = $bhnbakuawal + $pembhnbaku;
            ?>
            <tr>
                <td></td>
                <td>Bahan Baku Tersedia Untuk Dijual (BTUD)</td>
                <td></td>
                <td>Rp. <?php echo number_format($btud); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">Persediaan Bahan Baku (Akhir)</td>

            </tr>
            <?php
            $bhnbakuakhir = 0;
            $sql = mysqli_query($koneksi, $pembelian1); // Eksekusi/Jalankan query dari variabel $query        
            $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
            if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql 
                    $bhnbakuakhir += $data['total'];
                    echo "<tr>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . $data['nama_bhnbaku'] . ' ' . $data['jenis'] . "</td>";
                    echo "<td>" . "Rp.   " . number_format($data['total']) . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
            } else { // Jika data tidak ada                        
                echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2">Total Persediaan Bahan Baku (Akhir)</td>
                <td></td>
                <td>Rp. <?php echo number_format($bhnbakuakhir); ?></td>
                <td></td>
            </tr>
            <tr>
                <?php
                $hpp = $btud - $bhnbakuakhir;
                ?>
                <td colspan="2">Harga Pokok Penjualan</td>
                <td></td>
                <td></td>
                <td>Rp. <?php echo number_format($hpp); ?></td>
            </tr>
            <tr>
                <?php
                $labakotor = $totpenjualan - $hpp;
                ?>
                <td colspan="2">Laba Kotor Usaha</td>
                <td></td>
                <td></td>
                <td>Rp. <?php echo number_format($labakotor); ?></td>
            </tr>
            <tr>
                <td colspan="5"><b>Biaya - Biaya Operasional :</b></td>
            </tr>
            <?php
            $i = 0;
            $bop = 0;
            $sql = mysqli_query($koneksi, $pengeluaran); // Eksekusi/Jalankan pen$pengeluaran dari variabel $pengeluaran        
            $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
            if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql                   
                    $i++;
                    $jumlah[$i] = $data['jumlah'];
                    $bop  = array_sum($jumlah);
                    echo "<tr>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . $data['nama_akun'] . "</td>";
                    echo "<td>" . "Rp. " . number_format($data['jumlah']) . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
            } else { // Jika data tidak ada                        
                echo "<tr><td colspan='5'>Tidak Ada Transaksi</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2">Total Biaya-biaya Operasional</td>
                <td></td>
                <td></td>
                <td> (<u> Rp. <?php echo number_format($bop); ?></u>)</td>
            </tr>
            <tr>
                <?php
                $lrop = 0;
                $lrop = $labakotor - $bop;
                ?>
                <td colspan="2">Laba/(-)Rugi Operasi</td>
                <td></td>
                <td></td>
                <td>Rp. <?php echo number_format($lrop); ?></td>
            </tr>
            <tr>
                <?php
                $lrsp = 0;
                ?>
                <td colspan="2">Laba/(-) Rugi Sebelum Pajak</td>
                <td></td>
                <td></td>
                <td>Rp. <?php echo number_format($lrop); ?></td>
            </tr>
            <tr>
                <?php
                $pph25 = 0;
                $pph25 = "SELECT * FROM akun WHERE nama_akun LIKE 'PPH 25'";
                $sql = mysqli_query($koneksi, $pph25); // Eksekusi/Jalankan query dari variabel $query        
                $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql                    
                if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)                 
                    while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql 
                        $pph25 = $data['saldo'];
                        echo "<tr>";
                        echo "<td colspan='2'>" . "PPH 25" . "</td>";
                        echo "<td>" . "Rp.   " . number_format($pph25) . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "</tr>";
                    }
                } else { // Jika data tidak ada                        
                    echo "<tr>";
                    echo "<td colspan='2'>PPH 25</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "Rp. " . "0" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
                ?>
            <tr>
                <?php
                $pph21 = 0;
                $pph21 = "SELECT * FROM akun WHERE nama_akun LIKE 'PPH 21'";
                $sql = mysqli_query($koneksi, $pph21); // Eksekusi/Jalankan query dari variabel $query
                $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
                if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                    while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                        $pph21 = $data['saldo'];
                        $totphp = $pph21 + $pph25;
                        $lrstp = $lrop - $totphp;
                        echo "<tr>";
                        echo "<td colspan='2'>" . "PPH 21" . "</td>";
                        echo "<td>" . "Rp.   " . number_format($pph21) . "</td>";
                        echo "<td>" . "" . "</td>";
                        echo "</tr>";
                    }
                } else { // Jika data tidak ada                        
                    echo "<tr>";
                    echo "<td colspan='2'>PPH 21</td>";
                    echo "<td>" . "" . "</td>";
                    echo "<td>" . "Rp. " . "0" . "</td>";
                    echo "<td>" . "" . "</td>";
                    echo "</tr>";
                }
                ?>
            </tr>
            <tr>
                <td colspan="2"><u><b>Laba/(-) Rugi Setelah Pajak</b></u></td>
                <td></td>
                <td></td>
                <td><b>Rp. <?php echo number_format($lrstp); ?></b></td>
            </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>

</div>
<br>
<h5 style="text-align:right">Kendal, <?php echo date("d F Y") ?> </h5>
<h5 style="text-align:right">Administrasi</h5><br><br>
<h5 style="text-align:right">Faizatul Laili </h5>

<script>
    window.onload = window.print;
</script>