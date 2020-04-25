-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 02:53 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipasis`
--

-- --------------------------------------------------------

--
-- Table structure for table `rekammedis`
--

CREATE TABLE `rekammedis` (
  `kode_rekammedis` int(5) NOT NULL,
  `kode_pengunjung` int(5) NOT NULL,
  `kode_penyakit` varchar(5) NOT NULL,
  `tgl_rekammedis` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekammedis`
--

INSERT INTO `rekammedis` (`kode_rekammedis`, `kode_pengunjung`, `kode_penyakit`, `tgl_rekammedis`) VALUES
(107, 35, 'P0009', '2019-03-08 07:42:38'),
(200, 92, 'P0001', '2019-03-16 06:54:54'),
(201, 94, 'P0001', '2019-03-16 06:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `kode_penyakit` varchar(5) NOT NULL,
  `kode_gejala` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`kode_penyakit`, `kode_gejala`) VALUES
('P0001', 'G0001'),
('P0001', 'G0002'),
('P0001', 'G0003'),
('P0001', 'G0004'),
('P0001', 'G0006'),
('P0001', 'G0008'),
('P0001', 'G0010'),
('P0002', 'G0001'),
('P0002', 'G0002'),
('P0002', 'G0005'),
('P0002', 'G0019'),
('P0003', 'G0001'),
('P0003', 'G0002'),
('P0003', 'G0003'),
('P0003', 'G0004'),
('P0003', 'G0006'),
('P0003', 'G0011'),
('P0003', 'G0014'),
('P0003', 'G0016'),
('P0004', 'G0001'),
('P0004', 'G0002'),
('P0004', 'G0003'),
('P0004', 'G0004'),
('P0004', 'G0006'),
('P0004', 'G0008'),
('P0004', 'G0012'),
('P0005', 'G0001'),
('P0005', 'G0002'),
('P0005', 'G0003'),
('P0005', 'G0004'),
('P0005', 'G0006'),
('P0005', 'G0015'),
('P0005', 'G0017'),
('P0005', 'G0018'),
('P0006', 'G0001'),
('P0006', 'G0002'),
('P0006', 'G0003'),
('P0006', 'G0004'),
('P0006', 'G0006'),
('P0006', 'G0008'),
('P0006', 'G0013'),
('P0007', 'G0001'),
('P0007', 'G0002'),
('P0007', 'G0003'),
('P0007', 'G0007'),
('P0008', 'G0001'),
('P0008', 'G0002'),
('P0008', 'G0003'),
('P0008', 'G0004'),
('P0008', 'G0009'),
('P0009', 'G0001'),
('P0009', 'G0002'),
('P0009', 'G0005'),
('P0009', 'G0020');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin`
--

CREATE TABLE `tabel_admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_admin`
--

INSERT INTO `tabel_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_gejala`
--

CREATE TABLE `tabel_gejala` (
  `kode_gejala` varchar(5) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL,
  `kode_induk_ya` varchar(5) NOT NULL,
  `kode_induk_tidak` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_gejala`
--

INSERT INTO `tabel_gejala` (`kode_gejala`, `nama_gejala`, `kode_induk_ya`, `kode_induk_tidak`) VALUES
('G0001', 'Diawali/ditandai dengan bitik merah', '', ''),
('G0002', 'Bintik/kulit merah tersebut kadang terasa gatal/perih', 'G0001', ''),
('G0003', 'Timbulnya lesi (bercak) merah/ merah muda yang melebar', 'G0002', ''),
('G0004', 'Lesi (bercak) merah ditumbuhi sisik', 'G0003', ''),
('G0005', 'Timbul benjolan kecil yang menyebar', '', 'G0003'),
('G0006', 'Lesi (bercak) merah ditutupi lapisan-lapisan putih keperakan', 'G0004', ''),
('G0007', 'Gatal berat / gatal-gatal memuncak di malam hari', '', 'G0004'),
('G0008', 'Kulit yang terkena lesi (bercak) merah sering mengelupas', 'G0006', ''),
('G0009', 'Lesi (bercak) merah berbentuk oval dan lebih dominan timbul di punggung dan perut', '', 'G0006'),
('G0010', 'Lesi (bercak) merah timbul disekitar alis, lutut, kepala, siku dan bagian belakang punggung', 'G0008', ''),
('G0011', 'Kulit yang terkena lesi tebal dan keras', '', 'G0008'),
('G0012', 'Lesi (bercak) merah timbul pada bagian tangan dan kaki', '', 'G0010'),
('G0013', 'Gatal terasa di kulit kepala dan di tempat yang berminyak/berkeringat', '', 'G0012'),
('G0014', 'Nyeri pada sendi', 'G0011', ''),
('G0015', 'Kulit yang terkena lesi (bercak) merah berwarna sangat merah', '', 'G0011'),
('G0016', 'Sendi terasa bengkak dan kaku', 'G0014', ''),
('G0017', 'Lesi (bercak) merah tampak licin dan bersinar', 'G0015', ''),
('G0018', 'Lesi (bercak) merah timbul pada lipatan-lipatan kulit', 'G0017', ''),
('G0019', 'Lepuhan/bintik berwarna putih seperti bernanah', 'G0005', ''),
('G0020', 'Jika diraba pada bagian leher, terasa ada pembesaran kelenjar getah bening di bagian kanan', '', 'G0019');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengunjung`
--

CREATE TABLE `tabel_pengunjung` (
  `kode_pengunjung` int(5) NOT NULL,
  `nama_pengunjung` varchar(50) NOT NULL,
  `nohp_pengunjung` varchar(12) NOT NULL,
  `ttl_pengunjung` date NOT NULL,
  `alamat_pengunjung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_pengunjung`
--

INSERT INTO `tabel_pengunjung` (`kode_pengunjung`, `nama_pengunjung`, `nohp_pengunjung`, `ttl_pengunjung`, `alamat_pengunjung`) VALUES
(35, 'pengunjung', '0000010001', '2001-02-12', 'alamat'),
(83, 'pp', '78676', '2019-03-08', 'iya iya'),
(92, 'dr Diani', '0274561771', '2019-03-11', 'Gejayan'),
(94, 'Percobaan Diagnosa', '00000111', '2019-03-11', 'Yogyakarta'),
(112, 'Firman', '0958583941', '2019-03-13', 'magelang\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_penyakit`
--

CREATE TABLE `tabel_penyakit` (
  `kode_penyakit` varchar(5) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `definisi` varchar(200) NOT NULL,
  `pengobatan` varchar(500) NOT NULL,
  `pencegahan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_penyakit`
--

INSERT INTO `tabel_penyakit` (`kode_penyakit`, `nama_penyakit`, `definisi`, `pengobatan`, `pencegahan`) VALUES
('P0001', 'Psoriasis Vulgaris', 'Psoriasis adalah penyakit yang mengenai kulit, ditandai dengan sisik yang berlapis berwarna keperakan,  dan kadang disertai dengan rasa gatal atau perih. Bila sisik ini digaruk atau mengeluarkan darah', 'Pilihan pengobatan meliput terapi sinar ultraviolet (UV) atau krim dan salep, untuk memperlambat pertumbuhan kulit. ', '1. Jaga emosi,jangan sampai stress.\r\n2. Makan makanan seimbang, jangan lupa sayur dan buah-buahan.\r\n3. Jagalah berat badan ideal.\r\n4. Tidak merokok dan minum alkohol.\r\n5. Cukup tidur dan luangkan waktu untuk beristirahat.\r\n6. Hindari faktor pemicu obat.\r\n7. Segera konsultasi dengan dokter.\r\n8. Patuhi pemakaian obat.'),
('P0002', 'Psoriasis Pustular', 'Psoriasis Pustular dapat muncul secara tiba-tiba sebagai tanda awal dari psoriasis, atau psoriasis vulgaris dapat berubah menjadi Psoriasis Pustular', 'Pengobatan ke dokter secara intensif kemungkinan dapat menjadi pengobatan yang efektif untuk merawat penderita psoriasis pustular', '1. Jaga emosi,jangan sampai stress.\r\n2. Makan makanan seimbang, jangan lupa sayur dan buah-buahan.\r\n3. Jagalah berat badan ideal.\r\n4. Tidak merokok dan minum alkohol.\r\n5. Cukup tidur dan luangkan waktu untuk beristirahat.\r\n6. Hindari faktor pemicu obat.\r\n7. Mengggunakan pakaian pelindung apabila keluar rumah pada siang hari.\r\n8. Menghentikan penggunaan obat steroid\r\n9. Segera konsultasi dengan dokter.\r\n10. Patuhi pemakaian obat.'),
('P0003', 'Psoriasis Arthritis', 'Psoriasis Arthritis adalah bentuk arthritis yang dialami oleh sejumlah penderita psoriasis. Arthritis sendiri merupakan peradangan pada salah satu atau beberapa persendian tubuh.', 'Terapi panas dan dingin. Injeksi steroid, untuk mengurangi peradangan secara cepat. Beberapa obat baru seperti apremilast, ustekinumab, dan secukinumab dapat meredakan gejala-gejala psoriasis arthritis', '1. Jaga emosi,jangan sampai stress.\r\n2. Makan makanan seimbang, jangan lupa sayur dan buah-buahan.\r\n3. Jagalah berat badan ideal.\r\n4. Tidak merokok dan minum alkohol.\r\n5. Cukup tidur dan luangkan waktu untuk beristirahat.\r\n6. Hindari faktor pemicu obat.\r\n7. Segera konsultasi dengan dokter.\r\n8. Patuhi pemakaian obat.'),
('P0004', 'Psoriasis Guttate', 'Psoriasis Guttate kadang-kadang timbul secara tiba-tiba, bentuk psoriasis ini biasanya timbul pada badan dan kaki', 'Dapat diobati dengan moisturizer ( lotion pelembab) atau obat oles yang lebih kuat. Lotion pelembab seperti Eucerin, Cetaphil atau petroleum jelly merupakan bentuk pengobatan yang dianjurkan pada awal', '1. Jaga emosi,jangan sampai stress.\r\n2. Makan makanan seimbang, jangan lupa sayur dan buah-buahan.\r\n3. Jagalah berat badan ideal.\r\n4. Tidak merokok dan minum alkohol.\r\n5. Cukup tidur dan luangkan waktu untuk beristirahat.\r\n6. Hindari faktor pemicu obat.\r\n7. Segera konsultasi dengan dokter.\r\n8. Patuhi pemakaian obat.'),
('P0005', 'Psoriasis Inverse', 'Psoriasis inverse paling sering ditemukan di lipatan kulit, seperti di ketiak dan pangkal paha. Orang dengan psoriasis inverse sering memiliki bentuk psoriasis lain di tempat lain pada tubuh mereka.', 'Pengobatan bisa sukar, karena kulit peka pada daerah lipatan-lipatan Krim steroid dan salep merupakan pengobatan yang efektif, namun risiko efek samping yang ditimbulkan akan lebih tinggi karena ketipisan pada kulit.', '1. Jaga emosi,jangan sampai stress.\r\n2. Makan makanan seimbang, jangan lupa sayur dan buah-buahan.\r\n3. Jagalah berat badan ideal.\r\n4. Tidak merokok dan minum alkohol.\r\n5. Cukup tidur dan luangkan waktu untuk beristirahat.\r\n6. Hindari faktor pemicu obat.\r\n7. Gunakan pakaian yang menghisap keringat.\r\n8. Segera konsultasi dengan dokter.\r\n9. Patuhi pemakaian obat.'),
('P0006', 'Dermatitis Seboroik', 'Jenis penyakit ini bukan penyakit Psoriasis.\r\nDermatitis Seboroik adalah penyakit kulit yang biasanya mengenai kulit kepala dan area tubuh yang berminyak.', 'Konsultasi dengan dokter, pengobatan harus ke tempat dokter', '1. Segera Konsultasi dengan dokter\r\n2. Patuhi pemakainan obat'),
('P0007', 'Dermatitis Atopik', 'Jenis penyakit ini bukan penyakit Psoriasis.\r\nDermatitis Atopik adalah kondisi kulit kronis yang menyebabkan serangan gatal-gatal dan kemudian menghilang untuk beberapa waktu', 'Konsultasi dengan dokter, pengobatan harus ke tempat dokter', '1. Segera Konsultasi dengan dokter\r\n2. Patuhi pemakainan obat'),
('P0008', 'Pitiriasis Rosea', 'Jenis penyakit ini bukan penyakit Psoriasis.\r\nPitiriasis Rosea adalah ruam gatal-gatal yang berbentuk lingkaran atau oval, berukuran sekitar 2,5-5 cm, dan umumnya muncul di dada, perut, atau punggung', 'Konsultasi dengan dokter, pengobatan harus ke tempat dokter', '1. Segera Konsultasi dengan dokter\r\n2. Patuhi pemakainan obat'),
('P0009', 'Mikosis Fungiodes', 'Jenis penyakit ini bukan penyakit Psoriasis.\r\nMikosis Fungiodes merupakan penyakit kulit yang jarang terjadi namun mempunyai gambaran plak (lapisan kulit) identik dengan psoriasis.', 'Konsultasi dengan dokter, pengobatan harus ke tempat dokter', '1. Segera Konsultasi dengan dokter\r\n2. Patuhi pemakainan obat');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_gejala`
--

CREATE TABLE `tmp_gejala` (
  `kode_pengunjung` varchar(5) NOT NULL,
  `kode_gejala` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_gejala`
--

INSERT INTO `tmp_gejala` (`kode_pengunjung`, `kode_gejala`) VALUES
('112', 'G0001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD PRIMARY KEY (`kode_rekammedis`),
  ADD KEY `kode_pengunjung` (`kode_pengunjung`) USING BTREE,
  ADD KEY `kode_penyakit` (`kode_penyakit`) USING BTREE;

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD KEY `kode_penyakit` (`kode_penyakit`),
  ADD KEY `kode_gejala` (`kode_gejala`);

--
-- Indexes for table `tabel_admin`
--
ALTER TABLE `tabel_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tabel_gejala`
--
ALTER TABLE `tabel_gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indexes for table `tabel_pengunjung`
--
ALTER TABLE `tabel_pengunjung`
  ADD PRIMARY KEY (`kode_pengunjung`);

--
-- Indexes for table `tabel_penyakit`
--
ALTER TABLE `tabel_penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rekammedis`
--
ALTER TABLE `rekammedis`
  MODIFY `kode_rekammedis` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `tabel_admin`
--
ALTER TABLE `tabel_admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_pengunjung`
--
ALTER TABLE `tabel_pengunjung`
  MODIFY `kode_pengunjung` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD CONSTRAINT `rekammedis_kd_penyakit` FOREIGN KEY (`kode_penyakit`) REFERENCES `tabel_penyakit` (`kode_penyakit`),
  ADD CONSTRAINT `rekammedis_pengunjung` FOREIGN KEY (`kode_pengunjung`) REFERENCES `tabel_pengunjung` (`kode_pengunjung`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_kd_gejala` FOREIGN KEY (`kode_gejala`) REFERENCES `tabel_gejala` (`kode_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_kd_penyakit` FOREIGN KEY (`kode_penyakit`) REFERENCES `tabel_penyakit` (`kode_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
