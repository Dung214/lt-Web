-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 10, 2023 lúc 12:12 PM
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
-- Cơ sở dữ liệu: `de_4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `caulacbo`
--

CREATE TABLE `caulacbo` (
  `ID` int(11) NOT NULL,
  `namthanhlap` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `muctieu` text NOT NULL,
  `chutich_ID` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `caulacbo`
--

INSERT INTO `caulacbo` (`ID`, `namthanhlap`, `ten`, `muctieu`, `chutich_ID`) VALUES
(1, 2021, 'CLB LT', 'Không', '1'),
(2, 2022, 'CLB Tiếng Anh', 'Thuần thục TA', '3'),
(3, 2023, 'CLB truyền thông', 'mục tiêu 3', '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoatdong`
--

CREATE TABLE `chitiethoatdong` (
  `ID` int(11) NOT NULL,
  `hoatdong_ID` int(11) NOT NULL,
  `sinhvien_ID` varchar(32) NOT NULL,
  `nhiemvu` varchar(500) NOT NULL,
  `nhanxet` text NOT NULL,
  `diemdanhgia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangkythanhvien`
--

CREATE TABLE `dangkythanhvien` (
  `ID` int(11) NOT NULL,
  `sinhvien_ID` varchar(32) NOT NULL,
  `clb_ID` int(11) NOT NULL,
  `ngaydangky` datetime NOT NULL,
  `ngayxetduyet` datetime NOT NULL,
  `chutichclb_ID` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dangkythanhvien`
--

INSERT INTO `dangkythanhvien` (`ID`, `sinhvien_ID`, `clb_ID`, `ngaydangky`, `ngayxetduyet`, `chutichclb_ID`) VALUES
(1, '2', 2, '2023-06-10 15:25:36', '2023-06-11 15:25:36', '1'),
(2, '3', 2, '2023-06-10 15:25:50', '2023-06-12 15:25:50', '2'),
(3, '1', 2, '2023-06-09 15:26:02', '2023-06-10 15:26:02', '3');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hienthi`
-- (See below for the actual view)
--
CREATE TABLE `hienthi` (
`ID` int(11)
,`ten` varchar(255)
,`namthanhlap` int(11)
,`muctieu` text
,`hovaten` varchar(255)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoatdong`
--

CREATE TABLE `hoatdong` (
  `ID` int(11) NOT NULL,
  `clbtochuc_ID` int(11) NOT NULL,
  `tungay` date NOT NULL,
  `denngay` date NOT NULL,
  `muctieu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoatdong`
--

INSERT INTO `hoatdong` (`ID`, `clbtochuc_ID`, `tungay`, `denngay`, `muctieu`) VALUES
(1, 3, '2023-06-10', '2023-06-11', 'Mục tiêu 1'),
(2, 2, '2023-06-10', '2023-06-11', 'Mục tiêu 2'),
(3, 1, '2023-06-10', '2023-06-11', 'Mục tiêu 3'),
(4, 1, '2023-06-13', '2023-06-23', ' hiến máu tình nguyện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `ID` varchar(32) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `hovaten` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`ID`, `trangthai`, `hovaten`, `ngaysinh`, `mota`) VALUES
('1', 1, 'Nguyễn Duy Chiến', '2002-08-17', 'Không'),
('2', 1, 'Hoàng Anh Dũng', '2002-04-21', 'Không'),
('3', 0, 'Nguyễn Quốc Trường', '2002-01-11', 'Không');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hienthi`  AS SELECT `caulacbo`.`ID` AS `ID`, `caulacbo`.`ten` AS `ten`, `caulacbo`.`namthanhlap` AS `namthanhlap`, `caulacbo`.`muctieu` AS `muctieu`, `sinhvien`.`hovaten` AS `hovaten` FROM (`caulacbo` join `sinhvien`) WHERE `caulacbo`.`chutich_ID` = `sinhvien`.`ID``ID`  ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `caulacbo`
--
ALTER TABLE `caulacbo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `chutich_ID` (`chutich_ID`);

--
-- Chỉ mục cho bảng `chitiethoatdong`
--
ALTER TABLE `chitiethoatdong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `hoatdong_ID` (`hoatdong_ID`),
  ADD KEY `sinhvien_ID` (`sinhvien_ID`);

--
-- Chỉ mục cho bảng `dangkythanhvien`
--
ALTER TABLE `dangkythanhvien`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `sinhvien_ID` (`sinhvien_ID`),
  ADD KEY `chutichclb_ID` (`chutichclb_ID`),
  ADD KEY `clb_ID` (`clb_ID`);

--
-- Chỉ mục cho bảng `hoatdong`
--
ALTER TABLE `hoatdong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `clbtochuc_ID` (`clbtochuc_ID`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
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
-- AUTO_INCREMENT cho bảng `caulacbo`
--
ALTER TABLE `caulacbo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `chitiethoatdong`
--
ALTER TABLE `chitiethoatdong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dangkythanhvien`
--
ALTER TABLE `dangkythanhvien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `hoatdong`
--
ALTER TABLE `hoatdong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `caulacbo`
--
ALTER TABLE `caulacbo`
  ADD CONSTRAINT `caulacbo_ibfk_1` FOREIGN KEY (`chutich_ID`) REFERENCES `sinhvien` (`ID`);

--
-- Các ràng buộc cho bảng `chitiethoatdong`
--
ALTER TABLE `chitiethoatdong`
  ADD CONSTRAINT `chitiethoatdong_ibfk_1` FOREIGN KEY (`hoatdong_ID`) REFERENCES `hoatdong` (`ID`),
  ADD CONSTRAINT `chitiethoatdong_ibfk_2` FOREIGN KEY (`sinhvien_ID`) REFERENCES `sinhvien` (`ID`);

--
-- Các ràng buộc cho bảng `dangkythanhvien`
--
ALTER TABLE `dangkythanhvien`
  ADD CONSTRAINT `dangkythanhvien_ibfk_1` FOREIGN KEY (`sinhvien_ID`) REFERENCES `sinhvien` (`ID`),
  ADD CONSTRAINT `dangkythanhvien_ibfk_2` FOREIGN KEY (`chutichclb_ID`) REFERENCES `sinhvien` (`ID`),
  ADD CONSTRAINT `dangkythanhvien_ibfk_3` FOREIGN KEY (`clb_ID`) REFERENCES `caulacbo` (`ID`);

--
-- Các ràng buộc cho bảng `hoatdong`
--
ALTER TABLE `hoatdong`
  ADD CONSTRAINT `hoatdong_ibfk_1` FOREIGN KEY (`clbtochuc_ID`) REFERENCES `caulacbo` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
