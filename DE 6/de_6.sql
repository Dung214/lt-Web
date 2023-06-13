-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 13, 2023 lúc 11:41 AM
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
-- Cơ sở dữ liệu: `de_6`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `benhnhan`
--

CREATE TABLE `benhnhan` (
  `id` varchar(32) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `hovaten` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `benhnhan`
--

INSERT INTO `benhnhan` (`id`, `trangthai`, `hovaten`, `ngaysinh`, `dienthoai`, `mota`) VALUES
('1', 1, 'Trần Huy Mạnh', '2002-11-03', '0123456789', 'mô tả 1'),
('2', 2, 'Bùi Thế Đức', '2022-01-11', '0123456987', 'mô tả 2'),
('3', 2, 'Nguyễn Duy Chiến', '2022-01-11', '0123456987', 'mô tả 3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dieutri`
--

CREATE TABLE `dieutri` (
  `id` int(11) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `loaibenh_id` int(11) NOT NULL,
  `benhnhan` varchar(32) NOT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL,
  `nhanxet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dieutri`
--

INSERT INTO `dieutri` (`id`, `nhanvien_id`, `loaibenh_id`, `benhnhan`, `ngaybatdau`, `ngayketthuc`, `nhanxet`) VALUES
(1, 1, 1, '3', '2023-06-13', '2023-06-20', 'Trị mãi không khỏi'),
(2, 2, 3, '2', '2023-06-11', '2023-06-16', 'Phát bệnh'),
(3, 3, 2, '1', '2023-06-09', '2023-06-16', 'tâm bệnh'),
(14, 2, 2, '2', '2023-06-15', '2023-06-21', 'fssf');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `dieutri_view`
-- (See below for the actual view)
--
CREATE TABLE `dieutri_view` (
`id` int(11)
,`nhanvien_id` int(11)
,`hovaten` varchar(255)
,`tenbenh` varchar(255)
,`ngaybatdau` date
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hienthi`
-- (See below for the actual view)
--
CREATE TABLE `hienthi` (
`id` int(11)
,`ten` varchar(255)
,`hovanten` varchar(255)
,`dienthoai` varchar(10)
,`namkyhopdong` text
);

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
(1, 2000, 'Khoa chấn thương'),
(2, 2001, 'Khoa tim mạch'),
(3, 2002, 'Khoa thần kinh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaibenh`
--

CREATE TABLE `loaibenh` (
  `id` int(11) NOT NULL,
  `tenbenh` varchar(255) NOT NULL,
  `mota` varchar(500) NOT NULL,
  `trieuchung` text NOT NULL,
  `huongdieutri` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaibenh`
--

INSERT INTO `loaibenh` (`id`, `tenbenh`, `mota`, `trieuchung`, `huongdieutri`) VALUES
(1, 'Ngáo', 'Không', 'Ngáo', 'Đấm'),
(2, 'Đau tim', 'Không', 'khó thở', 'ko thở'),
(3, 'Đau đầu', 'Không', 'chongs mặt', 'ngủ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `hovanten` varchar(255) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `namkyhopdong` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `khoa_id`, `hovanten`, `dienthoai`, `namkyhopdong`) VALUES
(1, 2, 'Hoàng Anh Dũng', '0369258147', '2008'),
(2, 1, 'Nguyễn Quốc Trường', '0369258147', '2009'),
(3, 3, 'Phạm Như Hoàng', '0369258147', '2010');

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
-- Cấu trúc cho view `dieutri_view`
--
DROP TABLE IF EXISTS `dieutri_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dieutri_view`  AS SELECT `dieutri`.`id` AS `id`, `dieutri`.`nhanvien_id` AS `nhanvien_id`, `benhnhan`.`hovaten` AS `hovaten`, `loaibenh`.`tenbenh` AS `tenbenh`, `dieutri`.`ngaybatdau` AS `ngaybatdau` FROM ((`dieutri` join `loaibenh`) join `benhnhan`) WHERE `dieutri`.`loaibenh_id` = `loaibenh`.`id` AND `dieutri`.`benhnhan` = `benhnhan`.`id``id`  ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `hienthi`
--
DROP TABLE IF EXISTS `hienthi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hienthi`  AS SELECT `nhanvien`.`id` AS `id`, `khoa`.`ten` AS `ten`, `nhanvien`.`hovanten` AS `hovanten`, `nhanvien`.`dienthoai` AS `dienthoai`, `nhanvien`.`namkyhopdong` AS `namkyhopdong` FROM (`nhanvien` join `khoa`) WHERE `nhanvien`.`khoa_id` = `khoa`.`id``id`  ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `benhnhan`
--
ALTER TABLE `benhnhan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dieutri`
--
ALTER TABLE `dieutri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`),
  ADD KEY `loaibenh_id` (`loaibenh_id`),
  ADD KEY `benhnhan` (`benhnhan`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaibenh`
--
ALTER TABLE `loaibenh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_id` (`khoa_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dieutri`
--
ALTER TABLE `dieutri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `khoa`
--
ALTER TABLE `khoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaibenh`
--
ALTER TABLE `loaibenh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dieutri`
--
ALTER TABLE `dieutri`
  ADD CONSTRAINT `dieutri_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`),
  ADD CONSTRAINT `dieutri_ibfk_2` FOREIGN KEY (`loaibenh_id`) REFERENCES `loaibenh` (`id`),
  ADD CONSTRAINT `dieutri_ibfk_3` FOREIGN KEY (`benhnhan`) REFERENCES `benhnhan` (`id`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`khoa_id`) REFERENCES `khoa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
