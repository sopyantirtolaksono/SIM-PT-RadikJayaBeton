-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2023 pada 12.35
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lababersih`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `kd_akun` varchar(256) NOT NULL,
  `nama_akun` varchar(256) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bhnbaku` int(11) NOT NULL,
  `kd_bhnbaku` varchar(256) NOT NULL,
  `nama_bhnbaku` varchar(256) NOT NULL,
  `jenis` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kd_barang` varchar(256) NOT NULL,
  `spesifikasi` varchar(11) NOT NULL,
  `slump` varchar(10) NOT NULL,
  `size` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `kd_barang`, `spesifikasi`, `slump`, `size`, `harga`) VALUES
(1, 'BRG-0001', 'K-190', '10-15', '60', 1000000),
(2, 'BRG-0002', 'K-150', '8-12', '20', 500000),
(3, 'BRG-0003', 'K-150', '10-15', '10', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `beli`
--

CREATE TABLE `beli` (
  `no_beli` int(11) NOT NULL,
  `kd_pembelian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `no_keluar` int(11) NOT NULL,
  `kd_pengeluaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `no_masuk` int(11) NOT NULL,
  `kd_pendapatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`no_masuk`, `kd_pendapatan`) VALUES
(1, 'PDP-0001'),
(2, 'PDP-0002'),
(3, 'PDP-0003'),
(4, 'PDP-0004'),
(5, 'PDP-0005'),
(6, 'PDP-0006'),
(7, 'PDP-0007'),
(8, 'PDP-0008');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(25) NOT NULL,
  `kd_pelanggan` varchar(256) NOT NULL,
  `nama_pelanggan` varchar(200) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `kd_pelanggan`, `nama_pelanggan`, `alamat`, `no_tlp`) VALUES
(1, 'PLG-0001', 'Jasmine', 'Kendal', '089123332111'),
(2, 'PLG-0002', 'Agus', 'Semarang', '0876665554321'),
(3, 'PLG-0003', 'Siska', 'Semarang', '081111111333'),
(4, 'PLG-0004', 'Ferry', 'Kendal', '085432222111'),
(5, 'PLG-0005', 'Yohanes', 'Yogyakarta', '083213321111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int(25) NOT NULL,
  `kd_pemasok` varchar(256) NOT NULL,
  `nama_pemasok` varchar(200) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` int(11) NOT NULL,
  `kd_pembelian` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `kd_bhnbaku` varchar(256) NOT NULL,
  `nama_bhnbaku` varchar(25) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `kd_pemasok` varchar(256) NOT NULL,
  `nama_pemasok` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `no_pendapatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kd_pendapatan` varchar(200) NOT NULL,
  `kd_pelanggan` varchar(256) NOT NULL,
  `nama_pelanggan` varchar(200) NOT NULL,
  `proyek` varchar(250) NOT NULL,
  `kd_barang` varchar(256) NOT NULL,
  `spesifikasi` varchar(15) NOT NULL,
  `harga` int(11) NOT NULL,
  `volume` int(5) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendapatan`
--

INSERT INTO `pendapatan` (`no_pendapatan`, `tanggal`, `kd_pendapatan`, `kd_pelanggan`, `nama_pelanggan`, `proyek`, `kd_barang`, `spesifikasi`, `harga`, `volume`, `total`) VALUES
(1, '2021-09-27', 'PDP-0001', '', 'Jasmine', 'Bangun Masjid', '', 'K-190', 1000000, 100, 100000000),
(2, '2021-09-27', 'PDP-0001', '', 'Jasmine', 'Bangun Rumah', '', 'K-150', 500000, 50, 25000000),
(3, '2021-09-27', 'PDP-0002', '', 'Agus', 'Bangun Perumahan', '', 'K-190', 1000000, 100, 100000000),
(4, '2021-09-27', 'PDP-0003', '', 'Jasmine', 'Bangun Rumah', '', 'K-190', 1000000, 100, 100000000),
(5, '2021-09-27', 'PDP-0003', '', 'Jasmine', 'Bangun Jalan Tol', '', 'K-190', 1000000, 50, 50000000),
(6, '2021-09-27', 'PDP-0004', '', 'Siska', 'Bangun Kawasan Industri Kendal', '', 'K-150', 500000, 1000, 500000000),
(7, '2021-09-28', 'PDP-0005', '', 'Ferry', 'Bangun Masjid', '', 'K-190', 1000000, 1000, 1000000000),
(8, '2021-10-14', 'PDP-0006', '', 'Yohanes', 'Bangun Masjid', '', 'K-190', 1000000, 100, 100000000),
(9, '2021-10-14', 'PDP-0007', '', 'Ferry', 'Bangun Kawasan Industri Kendal', '', 'K-190', 1000000, 1000, 1000000000),
(10, '2021-11-24', 'PDP-0008', '', 'Jasmine', 'Bangun Masjid', '', 'K-150', 1000000, 1000, 1000000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `no_pengeluaran` int(11) NOT NULL,
  `kd_pengeluaran` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `kd_akun` varchar(256) NOT NULL,
  `nama_akun` varchar(256) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_panjang` varchar(200) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_panjang`, `jabatan`) VALUES
(2, 'pimpinan', 'pimpinan', 'Muhamad Reza', 'pimpinan'),
(3, 'admin', 'admin', 'Faizatul Laili', 'admin'),
(4, 'bendahara', 'bendahara', 'Novitasari', 'bendahara'),
(5, 'administrator', 'administrator', 'Idrus', 'administrator'),
(6, '@wowsia', '1234', 'sialababersih', 'pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bhnbaku`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`no_beli`);

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`no_keluar`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`no_masuk`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`no_pendapatan`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`no_pengeluaran`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bhnbaku` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `beli`
--
ALTER TABLE `beli`
  MODIFY `no_beli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `no_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `no_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `no_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `no_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `no_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
