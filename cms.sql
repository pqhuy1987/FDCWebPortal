-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2017 at 05:53 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 7.1.12-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhchon`
--

CREATE TABLE IF NOT EXISTS `binhchon` (
  `idBC` int(11) NOT NULL AUTO_INCREMENT,
  `MoTa` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idBC`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `binhchon`
--

INSERT INTO `binhchon` (`idBC`, `MoTa`) VALUES
(1, 'Bạn nghĩ sao về đội tuyển VN dưới thời HLV Calisto?'),
(2, 'Bạn dự đoán đội nào vô địch giải Ngoại hạng Anh mùa này?'),
(3, 'Bạn thích làm gì trong các nghề dưới đây?'),
(4, 'Bạn sẽ cho con làm gì trong kỳ nghỉ hè này?');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoten` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `noidung` text NOT NULL,
  `idTin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block',
  `group_general` int(11) NOT NULL,
  `group_small` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE IF NOT EXISTS `lienhe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(120) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `NoiDung` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`id`, `HoTen`, `Email`, `NoiDung`) VALUES
(1, 'hứa chí phước', 'huachiphuoc@gmail.com', 'whdiwdlkj'),
(2, 'Bành Thị Bũm', 'banhbum@yahoo.com', '298790173\r\nlwidjqopwd\r\nwdqpowud');

-- --------------------------------------------------------

--
-- Table structure for table `lienket`
--

CREATE TABLE IF NOT EXISTS `lienket` (
  `idWebLink` int(11) NOT NULL AUTO_INCREMENT,
  `Ten` varchar(255) NOT NULL DEFAULT '',
  `Url` varchar(255) NOT NULL DEFAULT '',
  `ThuTu` int(11) DEFAULT '0',
  PRIMARY KEY (`idWebLink`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lienket`
--

INSERT INTO `lienket` (`idWebLink`, `Ten`, `Url`, `ThuTu`) VALUES
(1, 'Nhất Nghệ', 'http://nhatnghe.com', 0),
(2, 'Vnexpress', 'http://vnexpress.net', 0),
(3, 'Dân Trí', 'http://dantri.com.vn', 0),
(4, 'Tài liệu thiết kế web', 'http://khoapham.vn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loaitin`
--

CREATE TABLE IF NOT EXISTS `loaitin` (
  `idLT` int(11) NOT NULL AUTO_INCREMENT,
  `Ten` varchar(100) NOT NULL DEFAULT '',
  `Ten_KhongDau` varchar(255) NOT NULL,
  `ThuTu` tinyint(11) NOT NULL DEFAULT '0',
  `AnHien` tinyint(1) NOT NULL DEFAULT '1',
  `idTL` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idLT`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `loaitin`
--

INSERT INTO `loaitin` (`idLT`, `Ten`, `Ten_KhongDau`, `ThuTu`, `AnHien`, `idTL`) VALUES
(3, 'BAN GIÁM ĐỐC', 'Ban-Giam-Doc', 0, 0, 5),
(4, 'GIÁM ĐỐC DỰ ÁN', 'Giam-Doc-Du-An', 0, 0, 5),
(5, 'BAN ĐẤU THẦU', 'Ban-Dau-Thau', 0, 0, 6),
(6, 'BAN KSCP & HD', 'Ban-Kscp-&-Hd', 0, 0, 6),
(12, 'BỘ PHẬN QUẢN LÝ THI CÔNG', 'Bo-Phan-Quan-Ly-Thi-Cong', 0, 0, 8),
(13, 'BỘ PHẬN LỰC LƯỢNG THI CÔNG', 'Bo-Phan-Luc-Luong-Thi-Cong', 0, 0, 8),
(20, 'Ban Thi Công 1', 'Ban-Thi-Cong-1', 0, 0, 10),
(21, 'Ban Thi Công 2', 'Ban-Thi-Cong-2', 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `phuongan`
--

CREATE TABLE IF NOT EXISTS `phuongan` (
  `idPA` int(11) NOT NULL AUTO_INCREMENT,
  `Mota` varchar(255) NOT NULL DEFAULT '',
  `SoLanChon` int(11) DEFAULT '0',
  `idBC` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPA`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `phuongan`
--

INSERT INTO `phuongan` (`idPA`, `Mota`, `SoLanChon`, `idBC`) VALUES
(1, 'Thành công', 0, 1),
(2, 'Thất  bại', 0, 1),
(3, 'Làm công chức nhà nước', 0, 3),
(4, 'Làm cho các công ty', 0, 3),
(5, 'Làm trong các cơ quan nghiên cứu', 0, 3),
(6, 'Các lĩnh vực khác', 0, 3),
(7, 'Còn tuỳ thuộc VFF', 0, 1),
(8, 'MU', 0, 2),
(9, 'Chelsea', 0, 2),
(10, 'Đi học thêm', 0, 4),
(11, 'Chơi ở nhà', 0, 4),
(12, 'Đi du lịch', 0, 4),
(13, 'Đến các câu lạc bộ thiếu nhi', 0, 4),
(14, 'Xanh', 0, 5),
(15, 'Đỏ', 0, 5),
(16, 'Vàng', 0, 5),
(17, 'Hồng', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `quangcao`
--

CREATE TABLE IF NOT EXISTS `quangcao` (
  `idQC` int(11) NOT NULL AUTO_INCREMENT,
  `vitri` int(11) NOT NULL,
  `MoTa` varchar(255) NOT NULL DEFAULT '',
  `Url` varchar(255) NOT NULL DEFAULT '',
  `urlHinh` varchar(255) NOT NULL DEFAULT '',
  `SoLanClick` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idQC`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `quangcao`
--

INSERT INTO `quangcao` (`idQC`, `vitri`, `MoTa`, `Url`, `urlHinh`, `SoLanClick`) VALUES
(25, 1, 'Thế giới di động', 'http://khoapham.vn', '1.png', 1),
(26, 1, 'Bán laptop', 'http://khoapham.vn', '2.png', 0),
(27, 1, 'Viettel Telecom', 'http://khoapham.vn', '3.png', 0),
(28, 2, 'Lập trình iOS', 'http://khoapham.vn', 'ios.jpg', 0),
(29, 2, 'Lập trình Facebook Application', 'http://khoapham.vn', 'laptrinhfacebook.png', 0),
(30, 2, 'Lập trình PHP&MySQL', 'http://khoapham.vn', 'php_mysql.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sukien`
--

CREATE TABLE IF NOT EXISTS `sukien` (
  `idSK` int(11) NOT NULL AUTO_INCREMENT,
  `MoTa` varchar(50) NOT NULL,
  PRIMARY KEY (`idSK`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sukien`
--

INSERT INTO `sukien` (`idSK`, `MoTa`) VALUES
(0, 'Không có sự kiện'),
(2, 'Valentine'),
(3, 'Huấn luyện viên Mourinho'),
(4, 'Du Học');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE IF NOT EXISTS `theloai` (
  `idTL` int(11) NOT NULL AUTO_INCREMENT,
  `TenTL` varchar(255) NOT NULL DEFAULT '',
  `TenTL_KhongDau` varchar(255) NOT NULL,
  `ThuTu` int(11) DEFAULT '0',
  `AnHien` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idTL`),
  UNIQUE KEY `TenTL` (`TenTL`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `tin`
--

CREATE TABLE IF NOT EXISTS `tin` (
  `idTin` int(11) NOT NULL AUTO_INCREMENT,
  `TieuDe` varchar(255) NOT NULL DEFAULT '',
  `TieuDe_KhongDau` varchar(255) NOT NULL,
  `TomTat` varchar(1000) DEFAULT NULL,
  `urlHinh` varchar(255) DEFAULT NULL,
  `Ngay` date DEFAULT '0000-00-00',
  `idUser` int(11) NOT NULL DEFAULT '0',
  `Content` text,
  `idLT` int(11) NOT NULL DEFAULT '0',
  `idTL` int(11) DEFAULT '1',
  `SoLanXem` int(11) DEFAULT '0',
  `TinNoiBat` tinyint(1) DEFAULT '0',
  `AnHien` tinyint(1) DEFAULT '1',
  `urlFile` varchar(255) NOT NULL,
  `urlFile2` varchar(255) NOT NULL,
  `urlFile3` varchar(255) NOT NULL,
  `urlFile4` varchar(255) NOT NULL,
  `urlFile5` varchar(255) NOT NULL,
  PRIMARY KEY (`idTin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(100) NOT NULL DEFAULT '',
  `Username` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(50) NOT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Dienthoai` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `NgayDangKy` date NOT NULL DEFAULT '0000-00-00',
  `idGroup` int(11) NOT NULL DEFAULT '0',
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` tinyint(1) DEFAULT NULL,
  `Active` int(11) DEFAULT NULL,
  `RandomKey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `HoTen`, `Username`, `Password`, `DiaChi`, `Dienthoai`, `Email`, `NgayDangKy`, `idGroup`, `NgaySinh`, `GioiTinh`, `Active`, `RandomKey`) VALUES
(1, 'Gia Hu', 'giahu', 'c4ca4238a0b923820dcc509a6f75849b', '123 meo meo chấm cơm', '0912345678', 'giahu@localhost.com', '2009-01-22', 0, '1972-01-01', 0, 1, 'f29c0f1c5f3cc955ceed26b4a4d6e1d9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
