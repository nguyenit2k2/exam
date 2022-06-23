-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 21, 2022 lúc 10:39 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `exam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `all_test`
--

CREATE TABLE `all_test` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `turn` int(11) NOT NULL DEFAULT 0,
  `question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `all_test`
--

INSERT INTO `all_test` (`id`, `exam_id`, `test_id`, `name`, `school`, `date`, `turn`, `question`) VALUES
(1, 1, 1, 'Đề thi thử THPTQG Môn Toán', 'Trường THPT Hà Huy Tập', '2022-05-26', 0, 5),
(2, 1, 1, 'Đề thi thử THPTQG Môn Toán', 'Trường THPT Trần Quý Cáp', '2022-05-26', 0, 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `exam`
--

INSERT INTO `exam` (`exam_id`, `name`, `type`) VALUES
(1, 'Đề thi trắc nghiệm THPTQG 2022', 'Thi THPTQG'),
(2, 'Đề kiểm tra', 'Đề thi kiểm tra');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `alltest_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `turn` int(11) NOT NULL DEFAULT 0,
  `question` longtext NOT NULL,
  `answer_a` varchar(255) NOT NULL,
  `answer_b` varchar(255) NOT NULL,
  `answer_c` varchar(255) NOT NULL,
  `answer_d` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `question`
--

INSERT INTO `question` (`question_id`, `alltest_id`, `time`, `turn`, `question`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `answer`) VALUES
(1, 1, 90, 0, 'Tính đạo hàm của hàm số', 'Khong biet', 'Cau a sai', 'Cau b dung', 'Cau d sai', 'Khong biet'),
(2, 1, 90, 0, 'Tính đạo hàm của hàm số', 'Khong biet', 'Cau a sai', 'Cau b dung', 'Cau d sai', 'Cau a sai'),
(3, 1, 90, 0, 'Tính đạo hàm của hàm số', 'Khong biet', 'Cau a sai', 'Cau b dung', 'Cau d sai', 'Cau b dung'),
(4, 1, 90, 0, 'Tính đạo hàm của hàm số', 'Khong biet', 'Cau a sai', 'Cau b dung', 'Cau d sai', 'Cau d sai'),
(5, 1, 90, 0, 'Tính đạo hàm của hàm số', 'Khong biet', 'Cau a sai', 'Cau b dung', 'Cau d sai', 'Cau a sai');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `exam_id` int(255) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `quantity_exam` int(11) DEFAULT 0,
  `quantity_turn` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `test`
--

INSERT INTO `test` (`test_id`, `exam_id`, `exam`, `image`, `content`, `quantity_exam`, `quantity_turn`) VALUES
(1, 1, 'Đề thi THPTGQ môn Toán', 'https://s.tracnghiem.net/assets/images/thpt/toan-hoc.png', 'Nhằm giúp các em chuẩn bị thật tốt cho kì thi THPT QG môn Toán sắp đến. Xin gửi đến các em bộ đề thi trắc nghiệm THPT QG môn Toán được sưu tập qua các năm với đầy đủ lời giải chi tiết.', 2, 0),
(2, 1, 'Đề thi THPTQG môn Vật Lý', 'https://s.tracnghiem.net/assets/images/thpt/vat-ly.png', 'Nhằm giúp các em chuẩn bị thật tốt cho kì thi THPT QG môn Vật Lý sắp đến. Xin gửi đến các em bộ đề thi trắc nghiệm THPT QG môn Vật Lý được sưu tập qua các năm với đầy đủ lời giải chi tiết.', 0, 0),
(3, 1, 'Đề thi THPTQG môn Hóa Học', 'https://s.tracnghiem.net/assets/images/thpt/hoa-hoc.png', 'Nhằm giúp các em chuẩn bị thật tốt cho kì thi THPT QG môn Hóa Học sắp đến. Xin gửi đến các em bộ đề thi trắc nghiệm THPT QG môn Hóa Học được sưu tập qua các năm với đầy đủ lời giải chi tiết.', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `all_test`
--
ALTER TABLE `all_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exam_id` (`exam_id`),
  ADD KEY `FK_test_id` (`test_id`);

--
-- Chỉ mục cho bảng `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Chỉ mục cho bảng `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `FK_testID` (`alltest_id`);

--
-- Chỉ mục cho bảng `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `FK_exam` (`exam_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `all_test`
--
ALTER TABLE `all_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `all_test`
--
ALTER TABLE `all_test`
  ADD CONSTRAINT `FK_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`),
  ADD CONSTRAINT `FK_test_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`);

--
-- Các ràng buộc cho bảng `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_testID` FOREIGN KEY (`alltest_id`) REFERENCES `all_test` (`id`);

--
-- Các ràng buộc cho bảng `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `FK_exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
