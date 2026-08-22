-- 1. Bảng User (Tài khoản)
CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE COMMENT 'Mã sinh viên hoặc mã giảng viên',
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(100) NOT NULL COMMENT 'Họ và tên',
    `email` VARCHAR(100) DEFAULT NULL,
    `phone` VARCHAR(10) DEFAULT NULL,
    `loai_tk` TINYINT NOT NULL DEFAULT 1 COMMENT '1: Sinh viên, 2: Giảng viên, 0: Khác',
    `role` TINYINT NOT NULL DEFAULT 0 COMMENT '1: Admin, 0: Không quyền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Bảng Slot (Lịch trống của giảng viên)
CREATE TABLE IF NOT EXISTS `slot` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_gv` INT NOT NULL COMMENT 'ID Giảng viên tạo slot',
    `s_date` DATE NOT NULL COMMENT 'Ngày hẹn',
    `start_at` VARCHAR(10) NOT NULL COMMENT 'Thời gian bắt đầu (VD: 08:00)',
    `end_at` VARCHAR(10) NOT NULL COMMENT 'Thời gian kết thúc (VD: 10:00)',
    `address` VARCHAR(255) NOT NULL COMMENT 'Địa chỉ hẹn',
    `desscription` VARCHAR(255) NOT NULL COMMENT 'Mô tả cuộc hẹn',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo',
    
    -- Khóa ngoại liên kết tới bảng user (giảng viên)
    CONSTRAINT `fk_slot_user` 
        FOREIGN KEY (`id_gv`) REFERENCES `user` (`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Bảng Dat_Lich_Hen (Đặt lịch hẹn)
CREATE TABLE IF NOT EXISTS `dat_lich_hen` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_sv` INT NOT NULL COMMENT 'ID Sinh viên đặt lịch',
    `id_s` INT NOT NULL COMMENT 'ID Slot được đặt',
    `title` VARCHAR(255) NOT NULL COMMENT 'Tiêu đề cuộc hẹn',
    `content` TEXT COMMENT 'Nội dung cuộc hẹn',
    `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0: Đặt, 1: Hủy (do GV), 2: Duyệt, 3: Từ chối, 4: Hoàn thành',
    `create_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo',

    -- Khóa ngoại liên kết tới bảng user (sinh viên)
    CONSTRAINT `fk_booking_student` 
        FOREIGN KEY (`id_sv`) REFERENCES `user` (`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE,

    -- Khóa ngoại liên kết tới bảng slot
    CONSTRAINT `fk_booking_slot` 
        FOREIGN KEY (`id_s`) REFERENCES `slot` (`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Bảng phản hồi cuộc hẹn
CREATE TABLE IF NOT EXISTS `feedback` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_hen` INT NOT NULL COMMENT 'ID cuộc hẹn',
    `star` INT NOT NULL COMMENT 'Số sao đánh giá 1-5',
    `content` TEXT NOT NULL COMMENT 'Nội dung phản hồi',
    `create_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian tạo',
    
    -- Khóa ngoại liên kết tới bảng dat_lich_hen
    CONSTRAINT `fk_feedback_booking` 
        FOREIGN KEY (`id_hen`) REFERENCES `dat_lich_hen` (`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;