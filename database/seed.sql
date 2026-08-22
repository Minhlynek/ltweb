-- -------------------------------------------------------
-- 1. CHÈN DỮ LIỆU TÀI KHOẢN (BẢNG user)
-- loai_tk: 1 = Sinh viên, 2 = Giảng viên, 0 = Khác
-- role: 1 = Admin, 0 = Không quyền
-- -------------------------------------------------------
INSERT INTO `user` (`id`, `username`, `password`, `name`, `email`, `phone`, `loai_tk`, `role`) VALUES
-- 5 Giảng viên
(1, 'gv_nguyenvana', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TS. Nguyễn Văn A', 'nguyenvana@vnu.edu.vn', '0901234501', 2, 0),
(2, 'gv_tranthib', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PGS.TS. Trần Thị B', 'tranthib@vnu.edu.vn', '0901234502', 2, 0),
(3, 'gv_lehoangc', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ThS. Lê Hoàng C', 'lehoangc@vnu.edu.vn', '0901234503', 2, 0),
(4, 'gv_phamminhd', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TS. Phạm Minh D', 'phamminhd@vnu.edu.vn', '0901234504', 2, 0),
(5, 'gv_vuthie', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ThS. Vũ Thị E', 'vuthie@vnu.edu.vn', '0901234505', 2, 0),

-- Sinh viên mẫu
(6, 'sv20010001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Văn Sinh', 'sv_sinh@st.vnu.edu.vn', '0981112233', 1, 0),
(7, 'sv20010002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Thị Viên', 'sv_vien@st.vnu.edu.vn', '0984445566', 1, 0),
(8, 'sv20010003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Hoàng Nam', 'sv_nam@st.vnu.edu.vn', '0987778899', 1, 0),
(9, 'sv20010004', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Thị Mỹ', 'sv_my@st.vnu.edu.vn', '0988889900', 1, 0),

-- Admin quản trị
(10, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Quản trị hệ thống', 'admin@vnu.edu.vn', '0900000000', 0, 1);

-- -------------------------------------------------------
-- 2. CHÈN DỮ LIỆU LỊCH TRỐNG CỦA GIẢNG VIÊN (BẢNG slot)
-- Thời gian từ 01/08/2026 đến 30/09/2026
-- -------------------------------------------------------
INSERT INTO `slot` (`id`, `id_gv`, `s_date`, `start_at`, `end_at`, `address`, `desscription`, `created_at`) VALUES
-- === TS. Nguyễn Văn A (id_gv = 1) ===
(1, 1, '2026-08-03', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp và Hướng dẫn NCKH', '2026-07-25 08:00:00'),
(2, 1, '2026-08-03', '10:00', '12:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp và Hướng dẫn NCKH', '2026-07-25 08:00:00'),
(3, 1, '2026-08-05', '14:00', '16:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn hướng nghiên cứu Machine Learning', '2026-07-25 08:00:00'),
(4, 1, '2026-08-10', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp', '2026-07-25 08:00:00'),
(5, 1, '2026-08-12', '14:00', '16:00', 'Phòng A2-301, Tòa nhà A2', 'Hỏi đáp bài tập lớn môn Xử lý ảnh', '2026-07-25 08:00:00'),
(6, 1, '2026-08-17', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp', '2026-07-25 08:00:00'),
(7, 1, '2026-08-19', '10:00', '12:00', 'Phòng A2-301, Tòa nhà A2', 'Trao đổi chuyên đề NCKH Sinh viên', '2026-07-25 08:00:00'),
(8, 1, '2026-08-24', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Duyệt đề tài Đồ án tốt nghiệp', '2026-07-25 08:00:00'),
(9, 1, '2026-08-26', '14:00', '16:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp', '2026-07-25 08:00:00'),
(10, 1, '2026-08-31', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp', '2026-07-25 08:00:00'),
(11, 1, '2026-09-07', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Hướng dẫn báo cáo tiến độ Đồ án', '2026-08-20 08:00:00'),
(12, 1, '2026-09-09', '14:00', '16:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn học tập đầu học kỳ', '2026-08-20 08:00:00'),
(13, 1, '2026-09-14', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Hướng dẫn viết báo cáo NCKH', '2026-08-20 08:00:00'),
(14, 1, '2026-09-16', '10:00', '12:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp', '2026-08-20 08:00:00'),
(15, 1, '2026-09-21', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Sửa bản thảo Đồ án tốt nghiệp', '2026-08-20 08:00:00'),
(16, 1, '2026-09-23', '14:00', '16:00', 'Phòng A2-301, Tòa nhà A2', 'Duyệt báo cáo tiến độ đợt 1', '2026-08-20 08:00:00'),
(17, 1, '2026-09-28', '08:00', '10:00', 'Phòng A2-301, Tòa nhà A2', 'Tư vấn Đồ án tốt nghiệp', '2026-08-20 08:00:00'),
(18, 1, '2026-09-30', '10:00', '12:00', 'Phòng A2-301, Tòa nhà A2', 'Tổng kết tiến độ Đồ án tháng 9', '2026-08-20 08:00:00'),

-- === PGS.TS. Trần Thị B (id_gv = 2) ===
(19, 2, '2026-08-04', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn môn Cơ sở dữ liệu nâng cao', '2026-07-25 08:00:00'),
(20, 2, '2026-08-04', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Giải đáp thắc mắc môn Lập trình Web', '2026-07-25 08:00:00'),
(21, 2, '2026-08-06', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn học tập và môn học', '2026-07-25 08:00:00'),
(22, 2, '2026-08-11', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Hướng dẫn làm Bài tập lớn CSDL', '2026-07-25 08:00:00'),
(23, 2, '2026-08-13', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn định hướng nghiên cứu Data Mining', '2026-07-25 08:00:00'),
(24, 2, '2026-08-18', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Duyệt đề tài Bài tập lớn Web', '2026-07-25 08:00:00'),
(25, 2, '2026-08-20', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn học tập', '2026-07-25 08:00:00'),
(26, 2, '2026-08-25', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Giải đáp thắc mắc trước kỳ thi', '2026-07-25 08:00:00'),
(27, 2, '2026-08-27', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn phương pháp học tốt CSDL', '2026-07-25 08:00:00'),
(28, 2, '2026-09-01', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn môn học đầu kỳ', '2026-08-20 08:00:00'),
(29, 2, '2026-09-03', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Giải đáp kiến thức thiết kế CSDL', '2026-08-20 08:00:00'),
(30, 2, '2026-09-08', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Hướng dẫn Chuẩn hóa dữ liệu 3NF', '2026-08-20 08:00:00'),
(31, 2, '2026-09-10', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn kiến trúc Web PHP/MySQL', '2026-08-20 08:00:00'),
(32, 2, '2026-09-15', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn Đồ án môn học', '2026-08-20 08:00:00'),
(33, 2, '2026-09-17', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Kiểm tra tiến độ Bài tập lớn Web', '2026-08-20 08:00:00'),
(34, 2, '2026-09-22', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn học tập', '2026-08-20 08:00:00'),
(35, 2, '2026-09-24', '13:30', '15:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Giải đáp bài tập SQL nâng cao', '2026-08-20 08:00:00'),
(36, 2, '2026-09-29', '08:30', '10:30', 'Phòng 402, Tòa B1 (Khoa CNTT)', 'Tư vấn tổng kết môn học', '2026-08-20 08:00:00'),

-- === ThS. Lê Hoàng C (id_gv = 3) ===
(37, 3, '2026-08-01', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Hướng dẫn thực hành Lập trình Mạng', '2026-07-25 08:00:00'),
(38, 3, '2026-08-07', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Giải đáp thắc mắc C++ & Data Structures', '2026-07-25 08:00:00'),
(39, 3, '2026-08-08', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Hướng dẫn sử dụng Git và GitHub', '2026-07-25 08:00:00'),
(40, 3, '2026-08-14', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Tư vấn Đồ án môn học Hệ điều hành', '2026-07-25 08:00:00'),
(41, 3, '2026-08-15', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Sửa lỗi bài thực hành Socket Programming', '2026-07-25 08:00:00'),
(42, 3, '2026-08-21', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Tư vấn bài tập thực hành', '2026-07-25 08:00:00'),
(43, 3, '2026-08-22', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Giải đáp bài tập cấu trúc dữ liệu', '2026-07-25 08:00:00'),
(44, 3, '2026-08-28', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Tư vấn kỹ năng lập trình thực tế', '2026-07-25 08:00:00'),
(45, 3, '2026-08-29', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Chữa bài tập thực hành số 4', '2026-07-25 08:00:00'),
(46, 3, '2026-09-04', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Hướng dẫn môn Kiến trúc máy tính', '2026-08-20 08:00:00'),
(47, 3, '2026-09-05', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Tư vấn Đồ án nhóm', '2026-08-20 08:00:00'),
(48, 3, '2026-09-11', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Hướng dẫn debug chương trình C/C++', '2026-08-20 08:00:00'),
(49, 3, '2026-09-12', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Giải đáp thắc mắc thực hành', '2026-08-20 08:00:00'),
(50, 3, '2026-09-18', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Tư vấn bài tập lớn môn Lập trình Mạng', '2026-08-20 08:00:00'),
(51, 3, '2026-09-19', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Kiểm tra bài thực hành giữa kỳ', '2026-08-20 08:00:00'),
(52, 3, '2026-09-25', '14:00', '16:00', 'Phòng Lab 3, Tòa C5', 'Tư vấn tối ưu thuật toán', '2026-08-20 08:00:00'),
(53, 3, '2026-09-26', '09:00', '11:00', 'Phòng Lab 3, Tòa C5', 'Tổng kết thực hành tháng 9', '2026-08-20 08:00:00'),

-- === TS. Phạm Minh D (id_gv = 4) ===
(54, 4, '2026-08-03', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn hướng nghiên cứu AI & Deep Learning', '2026-07-25 08:00:00'),
(55, 4, '2026-08-06', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Hướng dẫn môn Nhập môn Công nghệ Phần mềm', '2026-07-25 08:00:00'),
(56, 4, '2026-08-10', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn mô hình Học máy trong thực tế', '2026-07-25 08:00:00'),
(57, 4, '2026-08-13', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Duyệt yêu cầu phần mềm Đồ án môn học', '2026-07-25 08:00:00'),
(58, 4, '2026-08-17', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn thiết kế biểu đồ UML', '2026-07-25 08:00:00'),
(59, 4, '2026-08-20', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Hướng dẫn bài báo khoa học Sinh viên', '2026-07-25 08:00:00'),
(60, 4, '2026-08-24', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn kiến trúc phần mềm Microservices', '2026-07-25 08:00:00'),
(61, 4, '2026-08-27', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Đánh giá tiến độ đề tài NCKH', '2026-07-25 08:00:00'),
(62, 4, '2026-08-31', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn học tập môn Kiểm thử phần mềm', '2026-07-25 08:00:00'),
(63, 4, '2026-09-03', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn xây dựng mô hình Neural Network', '2026-08-20 08:00:00'),
(64, 4, '2026-09-07', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Hướng dẫn viết tài liệu thiết kế Software Design', '2026-08-20 08:00:00'),
(65, 4, '2026-09-10', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn Đồ án tốt nghiệp hướng AI', '2026-08-20 08:00:00'),
(66, 4, '2026-09-14', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Giải đáp thắc mắc môn Học máy', '2026-08-20 08:00:00'),
(67, 4, '2026-09-17', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn phương pháp Agile/Scrum', '2026-08-20 08:00:00'),
(68, 4, '2026-09-21', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Duyệt sprint 1 bài tập lớn CNPM', '2026-08-20 08:00:00'),
(69, 4, '2026-09-24', '15:00', '17:00', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Hướng dẫn cài đặt môi trường PyTorch/TensorFlow', '2026-08-20 08:00:00'),
(70, 4, '2026-09-28', '09:30', '11:30', 'Phòng 505, Tòa A1 (Bộ môn CNPM)', 'Tư vấn NCKH và bài báo chuyên ngành', '2026-08-20 08:00:00'),

-- === ThS. Vũ Thị E (id_gv = 5) ===
(71, 5, '2026-08-04', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn phương pháp học tập hiệu quả', '2026-07-25 08:00:00'),
(72, 5, '2026-08-07', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Hướng dẫn đăng ký khối lượng kiến thức', '2026-07-25 08:00:00'),
(73, 5, '2026-08-11', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn học cải thiện và học bù', '2026-07-25 08:00:00'),
(74, 5, '2026-08-14', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Giải đáp quy chế đào tạo tín chỉ', '2026-07-25 08:00:00'),
(75, 5, '2026-08-18', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn lập kế hoạch học tập cá nhân', '2026-07-25 08:00:00'),
(76, 5, '2026-08-21', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Hỗ trợ giải quyết vướng mắc thủ tục hành chính', '2026-07-25 08:00:00'),
(77, 5, '2026-08-25', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn chọn chuyên ngành Kỹ thuật phần mềm/HTTT', '2026-07-25 08:00:00'),
(78, 5, '2026-08-28', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn học tập chuẩn bị học kỳ mới', '2026-07-25 08:00:00'),
(79, 5, '2026-09-01', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn sinh viên khóa mới', '2026-08-20 08:00:00'),
(80, 5, '2026-09-04', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Hướng dẫn quy trình xét học bổng khuyến khích', '2026-08-20 08:00:00'),
(81, 5, '2026-09-08', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn đăng ký môn học tự chọn', '2026-08-20 08:00:00'),
(82, 5, '2026-09-11', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Hỗ trợ thủ tục tạm dừng / tiếp nhận lại', '2026-08-20 08:00:00'),
(83, 5, '2026-09-15', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn kỹ năng quản lý thời gian sinh viên', '2026-08-20 08:00:00'),
(84, 5, '2026-09-18', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Giải đáp thắc mắc về điểm rèn luyện', '2026-08-20 08:00:00'),
(85, 5, '2026-09-22', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn định hướng nghề nghiệp và thực tập', '2026-08-20 08:00:00'),
(86, 5, '2026-09-25', '13:30', '16:00', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tư vấn học tập giữa kỳ', '2026-08-20 08:00:00'),
(87, 5, '2026-09-29', '08:00', '10:30', 'Phòng Tiếp sinh viên, Tầng 2, Tòa A3', 'Tổng kết tư vấn sinh viên tháng 9', '2026-08-20 08:00:00');

-- -------------------------------------------------------
-- 3. CHÈN DỮ LIỆU ĐẶT LỊCH HẸN (BẢNG dat_lich_hen)
-- status: 0 = Đặt, 1 = Hủy (do GV), 2 = Duyệt, 3 = Từ chối, 4 = Hoàn thành
-- -------------------------------------------------------
INSERT INTO `dat_lich_hen` (`id`, `id_sv`, `id_s`, `title`, `content`, `status`, `create_at`) VALUES
-- Đã hoàn thành (status = 4)
(1, 6, 1, 'Đăng ký đề tài Đồ án tốt nghiệp', 'Em chào thầy A, em muốn xin thầy hướng dẫn đồ án về đề tài nhận diện khuôn mặt.', 4, '2026-07-28 09:15:00'),
(2, 7, 19, 'Hỏi bài tập chuẩn hóa CSDL', 'Thưa cô B, em chưa hiểu rõ về dạng chuẩn 3NF và BCNF, em xin gặp cô để nhờ cô giải đáp ạ.', 4, '2026-07-29 10:30:00'),
(3, 8, 37, 'Hướng dẫn lập trình Socket trong C', 'Thưa thầy C, bài thực hành socket của em bị lỗi connection refused, em nhờ thầy hỗ trợ.', 4, '2026-07-30 14:20:00'),
(4, 9, 54, 'Xin định hướng nghiên cứu Deep Learning', 'Em chào thầy D, em muốn tìm hiểu hướng áp dụng YOLO vào phát hiện biển số xe.', 4, '2026-08-01 11:00:00'),

-- Đã duyệt (status = 2)
(5, 6, 4, 'Báo cáo tiến độ Đồ án đợt 1', 'Em đã làm xong phần khảo sát hiện trạng, xin hẹn thầy để báo cáo.', 2, '2026-08-06 08:00:00'),
(6, 7, 22, 'Hỏi về thiết kế sơ đồ ERD', 'Em chào cô, nhóm em đã vẽ xong ERD cho dự án bài tập lớn Web.', 2, '2026-08-08 15:45:00'),
(7, 8, 56, 'Trao đổi về mô hình Convolutional Neural Network', 'Thưa thầy, em có một số câu hỏi về cách chọn hyperparameter.', 2, '2026-08-08 16:20:00'),

-- Mới đặt - Đang chờ duyệt (status = 0)
(8, 9, 71, 'Tư vấn đăng ký môn học nâng cao', 'Em nhờ cô E tư vấn giúp em các môn tự chọn học kỳ tới ạ.', 0, '2026-08-02 09:00:00'),
(9, 6, 8, 'Thông qua thiết kế cơ sở dữ liệu đồ án', 'Thưa thầy A, em đã thiết kế xong DB đồ án tốt nghiệp.', 0, '2026-08-20 10:00:00'),
(10, 7, 30, 'Hỏi bài tập SQL nâng cao', 'Em chào cô B, em xin hẹn gặp cô để hỏi về truy vấn Recursive CTE.', 0, '2026-08-21 11:30:00'),

-- Từ chối (status = 3)
(11, 8, 3, 'Trùng lịch thi học phần', 'Em xin lỗi thầy A, buổi chiều thứ 4 em trùng lịch thi nên không đến được ạ.', 3, '2026-08-01 13:00:00'),

-- Hủy do Giảng viên (status = 1)
(12, 9, 21, 'Giảng viên bận họp đột xuất', 'Thầy B bận họp Hội đồng khoa nên hủy slot này.', 1, '2026-08-05 07:30:00');

-- -------------------------------------------------------
-- 4. CHÈN DỮ LIỆU PHẢN HỒI (BẢNG feedback)
-- Đánh giá các cuộc hẹn đã hoàn thành (status = 4)
-- -------------------------------------------------------
INSERT INTO `feedback` (`id`, `id_hen`, `star`, `content`, `create_at`) VALUES
(1, 1, 5, 'Thầy A hướng dẫn rất nhiệt tình và chi tiết, giúp em định hình rõ đề tài đồ án tốt nghiệp!', '2026-08-03 11:00:00'),
(2, 2, 5, 'Cô B giải thích rất dễ hiểu, em đã nắm vững kiến thức chuẩn hóa 3NF sau buổi hẹn.', '2026-08-04 11:30:00'),
(3, 3, 4, 'Thầy C chỉ rõ lỗi socket lập trình C của em và hướng dẫn cách debug rất hay.', '2026-08-01 11:45:00'),
(4, 4, 5, 'Thầy D định hướng tài liệu và mô hình AI phù hợp với năng lực của sinh viên.', '2026-08-03 12:00:00');
