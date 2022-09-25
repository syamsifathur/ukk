-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2021 pada 14.33
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email`, `password`, `nama_lengkap`, `no_hp`) VALUES
(1, 'fathur.rachmad45@gmail.com', 'fathur', 'Syamsi Fathur', '081242625905'),
(2, 'fathur.rachmad35@gmail.com', 'syamsi', 'fathur rachmad', '081242134315'),
(3, 'ilham@gmail.com', 'ilham', 'Ilham God', '081415239857'),
(4, 'ukk@gmail.com', 'ukk', 'Test Ukk', '081267849872');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 1, 'fathur rachmad', 'BCA', 90000, '2021-04-07', '20210407172337Untitled.png'),
(2, 2, 'Syamsi Fathur', 'BCA', 35000, '2021-04-08', '20210408022450Untitled.png'),
(3, 3, 'Syamsi Fathur', 'BCA', 25000, '2021-04-08', '20210408053233Untitled.png'),
(4, 4, 'Syamsi Fathur', 'BCA', 25000, '2021-04-08', '20210408062854Untitled.png'),
(5, 5, 'Syamsi Fathur', 'BCA', 35000, '2021-04-08', '20210408063423Untitled.png'),
(6, 7, 'Syamsi Fathur', 'BCA', 35000, '2021-04-08', '20210408085210Untitled.png'),
(7, 9, 'Test Ukk', 'BCA', 40000, '2021-04-08', '20210408090049Untitled.png'),
(8, 6, 'Syamsi Fathur', 'BCA', 20000, '2021-04-08', '20210408095439Untitled.png'),
(9, 11, 'Syamsi Fathur', 'BCA', 25000, '2021-04-08', '20210408135527Untitled.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending',
  `username_akun` varchar(255) NOT NULL,
  `password_akun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal`, `total`, `status_pembelian`, `username_akun`, `password_akun`) VALUES
(1, 2, '2021-04-07', 90000, 'Barang Telah Diterima', '', ''),
(2, 1, '2021-04-08', 35000, 'Barang Telah Diterima', '', ''),
(3, 1, '2021-04-08', 25000, 'Barang Telah Diterima', '', ''),
(4, 1, '2021-04-08', 25000, 'Barang Telah Diterima', '', ''),
(5, 1, '2021-04-08', 35000, 'Barang Telah Diterima', '', ''),
(6, 1, '2021-04-08', 20000, 'Barang Telah Diterima', 'test@gmail.com', '12345'),
(7, 1, '2021-04-08', 35000, 'Barang Telah Diterima', '', ''),
(8, 4, '2021-04-08', 25000, 'Pending', '', ''),
(9, 4, '2021-04-08', 45000, 'Sudah Dikirim', '', ''),
(10, 4, '2021-04-08', 25000, 'Pending', '', ''),
(11, 1, '2021-04-08', 25000, 'Barang Telah Diterima', 'test1@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 3, 1),
(4, 4, 2, 1),
(5, 5, 1, 1),
(6, 6, 4, 1),
(7, 7, 1, 1),
(8, 8, 2, 1),
(9, 9, 3, 1),
(10, 9, 4, 1),
(11, 10, 2, 1),
(12, 11, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `stock`, `harga`, `foto_produk`, `deskripsi_produk`) VALUES
(1, 'Netflix', 16, 35000, 'netflix.png', 'Netflix premium 1 bulan garansi 100% uang kembali jika ada problem'),
(2, 'Spotify', 10, 25000, 'spotifylogo.png', 'Spotify premium 1 bulan garansi 100% uang kembali jika ada problem'),
(3, 'Disney +', 16, 25000, 'disney.jpg', 'Disney+ premium 1 bulan garansi 100% uang kembali jika ada problem'),
(4, 'Iqiyii', 16, 20000, '6f64c571ccd9948a18f354f9daef8232.jpg', 'Iqiyii premium 1 bulan garansi 100% uang kembali'),
(5, 'Joox', 25, 35000, 'download (1).png', 'Joox premium 1 bulan garansi 100% uang kembali'),
(6, 'Viu', 25, 20000, 'viu.jpg', 'Viu premium 1 bulan garansi 100% uang kembali'),
(7, 'Youtube', 25, 20000, 'download.png', 'Youtube premium 1 bulan garansi 100% uang kembali'),
(8, 'Iflix', 25, 20000, 'download.jpg', 'Iflix premium 1 bulan garansi 100% uang kembali');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
