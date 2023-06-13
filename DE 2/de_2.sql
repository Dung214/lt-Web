-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 10, 2023 lúc 09:52 AM
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
-- Cơ sở dữ liệu: `de_2`
--

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hienthi`
-- (See below for the actual view)
--
CREATE TABLE `hienthi` (
`ID` varchar(32)
,`hovaten` varchar(255)
,`trinhdohocvan` varchar(255)
,`phongban` varchar(255)
,`bangcap` varchar(255)
,`dienthoai` varchar(10)
,`email` varchar(255)
,`thannhan` varchar(255)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhansu`
--

CREATE TABLE `nhansu` (
  `ID` varchar(32) NOT NULL,
  `phongban_ID` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `trinhdo_ID` int(11) NOT NULL,
  `hovaten` varchar(255) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhansu`
--

INSERT INTO `nhansu` (`ID`, `phongban_ID`, `trangthai`, `trinhdo_ID`, `hovaten`, `dienthoai`, `email`) VALUES
('NS01', 1, 0, 3, 'Nguyễn Duy Chiến', '0159375846', 'chien@gmail.com'),
('NS02', 2, 1, 2, 'Hoàng Anh Dũng', '0705520421', 'dung@gmail.com'),
('NS03', 3, 0, 1, 'Nguyễn Quốc Trường', '0932019452', 'truong@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `ID` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `diachi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`ID`, `ten`, `dienthoai`, `diachi`) VALUES
(1, 'Kế toán', '0123456789', 'Lê Hồng Phong'),
(2, 'Thư ký', '0987654321', 'Lê Hồng Phong'),
(3, 'Công nghệ', '0147258369', 'Lê Hồng Phong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quatrinhdaotao`
--

CREATE TABLE `quatrinhdaotao` (
  `ID` varchar(32) NOT NULL,
  `nhansu_ID` varchar(32) NOT NULL,
  `tungay` datetime NOT NULL,
  `denngay` datetime NOT NULL,
  `loaihinhdaotao` varchar(100) NOT NULL,
  `bangcap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quatrinhdaotao`
--

INSERT INTO `quatrinhdaotao` (`ID`, `nhansu_ID`, `tungay`, `denngay`, `loaihinhdaotao`, `bangcap`) VALUES
('DT11', 'NS01', '2023-06-04 17:01:51', '2023-06-05 17:01:51', 'online', 'bằng cấp 1'),
('DT12', 'NS02', '2023-06-08 17:02:13', '2023-06-10 17:02:13', 'offline', 'bằng cấp 2'),
('DT13', 'NS03', '2023-06-20 17:02:27', '2023-06-22 17:02:27', 'online', 'bằng cấp 3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thannhan`
--

CREATE TABLE `thannhan` (
  `ID` int(11) NOT NULL,
  `nhansu_ID` varchar(32) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `quanhe` varchar(50) NOT NULL,
  `dienthoai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thannhan`
--

INSERT INTO `thannhan` (`ID`, `nhansu_ID`, `ten`, `quanhe`, `dienthoai`) VALUES
(1, 'NS01', 'Nguyễn Duy Thắng', 'bố', '0123587469'),
(2, 'NS02', 'Vũ Thị Nguyệt', 'mẹ', '0123587469'),
(3, 'NS03', 'Nguyễn Thị Chi', 'chị gái', '0123587469'),
(7, 'NS01', 'a', 'con', '0235135563'),
(17, 'NS03', 'Bùi Thế Đức', 'em trai họ', '0123564789'),
(18, 'NS02', 'Hoàng Minh', 'bố', '099999999');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trinhdohocvan`
--

CREATE TABLE `trinhdohocvan` (
  `ID` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `trinhdohocvan`
--

INSERT INTO `trinhdohocvan` (`ID`, `ten`, `mota`) VALUES
(1, 'Cử nhân', 'mô tả 1'),
(2, 'Tiến sĩ', 'mô tả 2'),
(3, 'Thạc sĩ', 'mô tả 3');

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
(1, 'dung', '123', 'Hoàng Anh Dũng', 1);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `hienthi`
--
DROP TABLE IF EXISTS `hienthi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hienthi`  AS SELECT `nhansu`.`ID` AS `ID`, `nhansu`.`hovaten` AS `hovaten`, `trinhdohocvan`.`ten` AS `trinhdohocvan`, `phongban`.`ten` AS `phongban`, `quatrinhdaotao`.`bangcap` AS `bangcap`, `nhansu`.`dienthoai` AS `dienthoai`, `nhansu`.`email` AS `email`, `thannhan`.`ten` AS `thannhan` FROM ((((`nhansu` join `trinhdohocvan`) join `phongban`) join `quatrinhdaotao`) join `thannhan`) WHERE `nhansu`.`phongban_ID` = `phongban`.`ID` AND `nhansu`.`trinhdo_ID` = `trinhdohocvan`.`ID` AND `thannhan`.`nhansu_ID` = `nhansu`.`ID` AND `quatrinhdaotao`.`nhansu_ID` = `nhansu`.`ID``ID`  ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nhansu`
--
ALTER TABLE `nhansu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `phongban_ID` (`phongban_ID`),
  ADD KEY `trinhdo_ID` (`trinhdo_ID`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `quatrinhdaotao`
--
ALTER TABLE `quatrinhdaotao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nhansu_ID` (`nhansu_ID`);

--
-- Chỉ mục cho bảng `thannhan`
--
ALTER TABLE `thannhan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nhansu_ID` (`nhansu_ID`);

--
-- Chỉ mục cho bảng `trinhdohocvan`
--
ALTER TABLE `trinhdohocvan`
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
-- AUTO_INCREMENT cho bảng `phongban`
--
ALTER TABLE `phongban`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thannhan`
--
ALTER TABLE `thannhan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `trinhdohocvan`
--
ALTER TABLE `trinhdohocvan`
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
-- Các ràng buộc cho bảng `nhansu`
--
ALTER TABLE `nhansu`
  ADD CONSTRAINT `nhansu_ibfk_1` FOREIGN KEY (`phongban_ID`) REFERENCES `phongban` (`ID`),
  ADD CONSTRAINT `nhansu_ibfk_2` FOREIGN KEY (`trinhdo_ID`) REFERENCES `trinhdohocvan` (`ID`);

--
-- Các ràng buộc cho bảng `quatrinhdaotao`
--
ALTER TABLE `quatrinhdaotao`
  ADD CONSTRAINT `quatrinhdaotao_ibfk_1` FOREIGN KEY (`nhansu_ID`) REFERENCES `nhansu` (`ID`);

--
-- Các ràng buộc cho bảng `thannhan`
--
ALTER TABLE `thannhan`
  ADD CONSTRAINT `thannhan_ibfk_1` FOREIGN KEY (`nhansu_ID`) REFERENCES `nhansu` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
