-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 11, 2023 lúc 05:01 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `de_1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `ID` int(11) NOT NULL,
  `donhang_ID` varchar(32) NOT NULL,
  `hanghoa_ID` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` decimal(10,0) NOT NULL,
  `giamtru` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ID`, `donhang_ID`, `hanghoa_ID`, `soluong`, `dongia`, `giamtru`) VALUES
(1, 'A01', 1, 20, '100000', '10'),
(2, 'B02', 2, 50, '200000', '15'),
(3, 'C03', 3, 40, '150000', '5'),
(44444444, 'A02', 1, 2000, '150000000', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `ID` varchar(32) NOT NULL,
  `khachhang_ID` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `khuyenmai` int(11) NOT NULL,
  `ngayban` datetime NOT NULL,
  `ngaygiaohang` datetime NOT NULL,
  `ghichu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`ID`, `khachhang_ID`, `trangthai`, `khuyenmai`, `ngayban`, `ngaygiaohang`, `ghichu`) VALUES
('11111', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
('A01', 1, 1, 0, '2023-06-07 09:32:49', '2023-06-09 09:32:49', 'ghi chú 1'),
('A02', 2, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
('B02', 2, 0, 1, '2023-06-04 09:33:09', '2023-06-11 09:33:09', 'ghi chú 2'),
('C03', 3, 1, 1, '2023-06-08 09:33:23', '2023-06-09 09:33:23', 'ghi chú 3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `ID` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `loaihang_ID` int(11) NOT NULL,
  `quycach` varchar(255) NOT NULL,
  `gianiemyet` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`ID`, `ten`, `loaihang_ID`, `quycach`, `gianiemyet`) VALUES
(1, 'Iphone 15 promax', 1, 'Quy cách 1', '150'),
(2, 'Asus vivobook 15.0', 2, 'Quy cách 2', '200'),
(3, 'Chuột gaming', 3, 'Quy cách 3', '250');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hienthi`
-- (See below for the actual view)
--
CREATE TABLE `hienthi` (
`ID` varchar(32)
,`hovaten` varchar(255)
,`ten` varchar(255)
,`soluong` int(11)
,`dongia` decimal(10,0)
,`giamtru` decimal(10,0)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ID` int(11) NOT NULL,
  `hovaten` varchar(255) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `diachi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ID`, `hovaten`, `dienthoai`, `email`, `diachi`) VALUES
(1, 'Nguyễn Duy Chiến', '0123456789', 'chien@gmail.com', 'Quán Trữ'),
(2, 'Nguyễn Quốc Trường', '0321654987', 'truong@gmail.com', 'Lê Chân'),
(3, 'Hoàng Anh Dũng', '0987654321', 'dung@gmail.com', 'Lê Lợi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihang`
--

CREATE TABLE `loaihang` (
  `ID` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihang`
--

INSERT INTO `loaihang` (`ID`, `ten`, `mota`) VALUES
(1, 'Iphone', 'đen'),
(2, 'Laptop', 'bạc'),
(3, 'Chuột máy tính', 'bluetooth');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `tendaydu` varchar(255) NOT NULL,
  `quyenhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `username`, `matkhau`, `tendaydu`, `quyenhan`) VALUES
(1, 'dung', '123', 'Hoang Anh Dung', 1);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `hienthi`
--
DROP TABLE IF EXISTS `hienthi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hienthi`  AS SELECT `donhang`.`ID` AS `ID`, `khachhang`.`hovaten` AS `hovaten`, `hanghoa`.`ten` AS `ten`, `chitietdonhang`.`soluong` AS `soluong`, `chitietdonhang`.`dongia` AS `dongia`, `chitietdonhang`.`giamtru` AS `giamtru` FROM (((`donhang` join `khachhang`) join `hanghoa`) join `chitietdonhang`) WHERE `khachhang`.`ID` = `donhang`.`khachhang_ID` AND `donhang`.`ID` = `chitietdonhang`.`donhang_ID` AND `hanghoa`.`ID` = `chitietdonhang`.`hanghoa_ID``hanghoa_ID`  ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `donhang_ID` (`donhang_ID`),
  ADD KEY `hanghoa_ID` (`hanghoa_ID`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `khachhang_ID` (`khachhang_ID`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `loaihang_ID` (`loaihang_ID`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loaihang`
--
ALTER TABLE `loaihang`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44444445;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaihang`
--
ALTER TABLE `loaihang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`donhang_ID`) REFERENCES `donhang` (`ID`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`hanghoa_ID`) REFERENCES `hanghoa` (`ID`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`khachhang_ID`) REFERENCES `khachhang` (`ID`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`loaihang_ID`) REFERENCES `loaihang` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
