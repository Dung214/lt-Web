-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 13, 2023 lúc 02:37 AM
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
-- Cơ sở dữ liệu: `de_5`
--

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hienthi`
-- (See below for the actual view)
--
CREATE TABLE `hienthi` (
`id` int(11)
,`tenlop` varchar(255)
,`namthanhlap` int(11)
,`ten` varchar(255)
,`siso` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketquathi`
--

CREATE TABLE `ketquathi` (
  `id` int(11) NOT NULL,
  `monhoc_id` int(11) NOT NULL,
  `sinhvien_id` int(11) NOT NULL,
  `loaidiem` int(11) NOT NULL,
  `lanthi` int(11) NOT NULL,
  `diem` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `id` int(11) NOT NULL,
  `namthanhlap` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`id`, `namthanhlap`, `ten`) VALUES
(1, 2000, 'Khoa công nghệ thông tin'),
(2, 1990, 'Khoa lái tàu'),
(3, 1999, 'Khoa kinh tế');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophanhchinh`
--

CREATE TABLE `lophanhchinh` (
  `id` int(11) NOT NULL,
  `tenlop` varchar(255) NOT NULL,
  `namthanhlap` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `siso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `lophanhchinh`
--

INSERT INTO `lophanhchinh` (`id`, `tenlop`, `namthanhlap`, `khoa_id`, `siso`) VALUES
(1, 'CNT60DH', 2019, 1, 135),
(2, 'KTN61DH', 2020, 3, 235),
(3, 'MTB62DH', 2021, 2, 200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `id` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `tenmon` varchar(255) NOT NULL,
  `sotinchi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `lop_id` int(11) NOT NULL,
  `hovaten` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `trangthai`, `lop_id`, `hovaten`, `ngaysinh`, `mota`) VALUES
(1, 1, 1, 'Nguyễn Duy Chiến', '2001-08-11', 'Không có'),
(2, 1, 2, 'Nguyễn Quốc Trường', '2002-01-11', 'Không có'),
(3, 1, 3, 'Hoàng Anh Dũng', '2003-04-21', 'Không có'),
(4, 0, 3, 'Bùi Thế Đức', '0000-00-00', 'ngu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `tendaydu` varchar(255) NOT NULL,
  `quyenhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `matkhau`, `tendaydu`, `quyenhan`) VALUES
(1, 'dung', '123', 'Hoàng Anh Dũng', 1);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `hienthi`
--
DROP TABLE IF EXISTS `hienthi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hienthi`  AS SELECT `lophanhchinh`.`id` AS `id`, `lophanhchinh`.`tenlop` AS `tenlop`, `lophanhchinh`.`namthanhlap` AS `namthanhlap`, `khoa`.`ten` AS `ten`, `lophanhchinh`.`siso` AS `siso` FROM (`lophanhchinh` join `khoa`) WHERE `lophanhchinh`.`khoa_id` = `khoa`.`id``id`  ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ketquathi`
--
ALTER TABLE `ketquathi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monhoc_id` (`monhoc_id`),
  ADD KEY `sinhvien_id` (`sinhvien_id`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lophanhchinh`
--
ALTER TABLE `lophanhchinh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_id` (`khoa_id`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_id` (`khoa_id`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lop_id` (`lop_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ketquathi`
--
ALTER TABLE `ketquathi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khoa`
--
ALTER TABLE `khoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `lophanhchinh`
--
ALTER TABLE `lophanhchinh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ketquathi`
--
ALTER TABLE `ketquathi`
  ADD CONSTRAINT `ketquathi_ibfk_1` FOREIGN KEY (`monhoc_id`) REFERENCES `monhoc` (`id`),
  ADD CONSTRAINT `ketquathi_ibfk_2` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhvien` (`id`);

--
-- Các ràng buộc cho bảng `lophanhchinh`
--
ALTER TABLE `lophanhchinh`
  ADD CONSTRAINT `lophanhchinh_ibfk_1` FOREIGN KEY (`khoa_id`) REFERENCES `khoa` (`id`);

--
-- Các ràng buộc cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `monhoc_ibfk_1` FOREIGN KEY (`khoa_id`) REFERENCES `khoa` (`id`);

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`lop_id`) REFERENCES `lophanhchinh` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
