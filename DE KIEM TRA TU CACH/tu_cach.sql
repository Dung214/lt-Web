-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 07, 2023 lúc 11:56 AM
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
-- Cơ sở dữ liệu: `tu_cach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietvandon`
--

CREATE TABLE `chitietvandon` (
  `ID` int(11) NOT NULL,
  `vandon` varchar(32) NOT NULL,
  `hanghoa_ID` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietvandon`
--

INSERT INTO `chitietvandon` (`ID`, `vandon`, `hanghoa_ID`, `soluong`) VALUES
(1, '1', 2, 1000),
(2, '2', 2, 2312),
(3, '3', 1, 50),
(4, 'A01', 2, 2000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `ID` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `hangsx_ID` int(11) NOT NULL,
  `quycach` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`ID`, `ten`, `hangsx_ID`, `quycach`) VALUES
(1, 'Hàng hóa 1', 1, 'Quy cách 1'),
(2, 'Hàng hóa 1', 2, 'Quy cách 2'),
(3, 'Hàng hóa 3', 3, 'Quy cách 3'),
(4, 'Hàng hóa 4', 1, 'Quy cách 4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangsanxuat`
--

CREATE TABLE `hangsanxuat` (
  `ID` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hangsanxuat`
--

INSERT INTO `hangsanxuat` (`ID`, `ten`, `mota`) VALUES
(1, 'hãng sản xuất 1', 'mô tả 1'),
(2, 'hãng sản xuất 2', 'mô tả 2'),
(3, 'hãng sản xuất 3', 'mô tả 3');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hienthi`
-- (See below for the actual view)
--
CREATE TABLE `hienthi` (
`ID` varchar(32)
,`hoten` varchar(255)
,`nguoinhan` varchar(255)
,`ten` varchar(255)
,`soluong` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `ID` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `diachi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`ID`, `hoten`, `dienthoai`, `email`, `diachi`) VALUES
(1, 'Nguyễn Văn A', '123456789', 'vana12@gmail.com', 'Hải Phòng'),
(2, 'Nguyễn Thị B', '123456789', 'vana12@gmail.com', 'Hà Nội'),
(3, 'Nguyễn Thị B', '123456789', 'vana12@gmail.com', 'Hải Dương\r\n ');

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
(1, 'dung', '123', 'Hoàng Anh Dũng', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vandon`
--

CREATE TABLE `vandon` (
  `ID` varchar(32) NOT NULL,
  `nhanvien_ID` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `nguoinhan` varchar(255) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `diachi` text NOT NULL,
  `ngaygiaohang` datetime NOT NULL,
  `ghichu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `vandon`
--

INSERT INTO `vandon` (`ID`, `nhanvien_ID`, `trangthai`, `nguoinhan`, `dienthoai`, `diachi`, `ngaygiaohang`, `ghichu`) VALUES
('1', 1, 0, 'Người nhận 1', '123456789', 'Đà Nẵng', '2023-06-07 09:06:03', 'Ghi chú 1'),
('2', 2, 0, 'Người nhận 2', '123456789', 'Nha Trang', '2023-06-06 09:06:20', 'Ghi chú 2'),
('3', 3, 0, 'Người nhận 3', '123456789', 'Hồ Chí Minh', '2023-06-08 09:06:33', 'Ghi chú 3'),
('4', 1, 0, 'Người nhận 4', '123456789', 'Đà Lạt', '2023-06-07 09:06:44', 'Ghi chú 4'),
('A01', 2, 0, 'Thắm', '', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Cấu trúc cho view `hienthi`
--
DROP TABLE IF EXISTS `hienthi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hienthi`  AS SELECT `vandon`.`ID` AS `ID`, `nhanvien`.`hoten` AS `hoten`, `vandon`.`nguoinhan` AS `nguoinhan`, `hanghoa`.`ten` AS `ten`, `chitietvandon`.`soluong` AS `soluong` FROM (((`vandon` join `nhanvien`) join `hanghoa`) join `chitietvandon`) WHERE `nhanvien`.`ID` = `vandon`.`nhanvien_ID` AND `vandon`.`ID` = `chitietvandon`.`vandon` AND `hanghoa`.`ID` = `chitietvandon`.`hanghoa_ID``hanghoa_ID`  ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietvandon`
--
ALTER TABLE `chitietvandon`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `vandon` (`vandon`),
  ADD KEY `hanghoa_ID` (`hanghoa_ID`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `hangsx_ID` (`hangsx_ID`);

--
-- Chỉ mục cho bảng `hangsanxuat`
--
ALTER TABLE `hangsanxuat`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `vandon`
--
ALTER TABLE `vandon`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nhanvien_ID` (`nhanvien_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietvandon`
--
ALTER TABLE `chitietvandon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hangsanxuat`
--
ALTER TABLE `hangsanxuat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
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
-- Các ràng buộc cho bảng `chitietvandon`
--
ALTER TABLE `chitietvandon`
  ADD CONSTRAINT `chitietvandon_ibfk_1` FOREIGN KEY (`vandon`) REFERENCES `vandon` (`ID`),
  ADD CONSTRAINT `chitietvandon_ibfk_2` FOREIGN KEY (`hanghoa_ID`) REFERENCES `hanghoa` (`ID`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`hangsx_ID`) REFERENCES `hangsanxuat` (`ID`);

--
-- Các ràng buộc cho bảng `vandon`
--
ALTER TABLE `vandon`
  ADD CONSTRAINT `vandon_ibfk_1` FOREIGN KEY (`nhanvien_ID`) REFERENCES `nhanvien` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
