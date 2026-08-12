# 🎓 HỆ THỐNG ĐẶT LỊCH TƯ VẤN / HẸN GẶP GIẢNG VIÊN

> **Dự án nhóm môn Lập Trình Web**  
> **Repository GitHub:** [https://github.com/Minhlynek/ltweb](https://github.com/Minhlynek/ltweb)

---

## 1. Môi Trường & Yêu Cầu Hệ Thống

Dự án được xây dựng và kiểm thử trên môi trường **XAMPP (Windows OS)** với các thông số kỹ thuật chính xác như sau:

* **Môi trường máy chủ:** XAMPP cho Windows
* **Phiên bản PHP:**
  ```text
  PHP 8.1.25 (cli) (built: Oct 25 2023 08:06:57) (ZTS Visual C++ 2019 x64)
  Copyright (c) The PHP Group
  Zend Engine v4.1.25, Copyright (c) Zend Technologies
  ```
* **Phiên bản Cơ sở dữ liệu (MySQL / MariaDB):**
  ```text
  mysql  Ver 15.1 Distrib 10.4.32-MariaDB, for Win64 (AMD64), source revision c4143f909528e3fab0677a28631d10389354c491
  ```
* **Đường dẫn thư mục dự án trên máy local:** `C:\xampp\htdocs\ltweb`

---

## 2. Hướng Dẫn Cài Đặt & Chạy Dự Án (Getting Started)

### Bước 1: Clone Repository từ GitHub về máy
Mở **Command Prompt**, **Git Bash**, hoặc **PowerShell** trên máy tính của bạn và thực hiện lệnh:

```bash
# 1. Di chuyển vào thư mục htdocs của XAMPP
cd C:\xampp\htdocs

# 2. Clone mã nguồn dự án từ GitHub về
git clone https://github.com/Minhlynek/ltweb.git

# 3. Di chuyển vào thư mục dự án vừa clone
cd ltweb
```

---

### Bước 2: Khởi động XAMPP Control Panel
1. Mở ứng dụng **XAMPP Control Panel** trên Windows.
2. Nhấn nút **Start** tại dịch vụ **Apache** (Web Server).
3. Nhấn nút **Start** tại dịch vụ **MySQL** (Database Server).

---

### Bước 3: Truy cập hệ thống trên Trình Duyệt Web
Sau khi Apache & MySQL đã khởi chạy thành công, hãy mở trình duyệt web (Chrome, Edge, Firefox, ...) và truy cập các đường dẫn sau:

* **Trang chủ hệ thống (Giới thiệu chung):**  
  👉 [http://localhost/ltweb/](http://localhost/ltweb/) hoặc [http://localhost/ltweb/index.php](http://localhost/ltweb/index.php)

* **Trang giới thiệu Nhóm & Chi tiết Đề tài:**  
  👉 [http://localhost/ltweb/about.php](http://localhost/ltweb/about.php)

---

## 3. Thành Viên Nhóm Phát Triển

1. **Lê Thị Minh Lý** *(Trưởng Nhóm)* - Fullstack Developer & Quản lý dự án
2. **Lê Phương Anh** - Frontend Developer (UI/UX)
3. **Lê Khánh Linh** - Backend Developer & Quản lý cơ sở dữ liệu
4. **Nguyễn Quang Nghĩa** - Backend Developer & Xử lý Bảo mật
5. **Đỗ Quang Anh** - QA / Tester & Soạn thảo Tài liệu

---

## 4. Cấu Trúc Thư Mục Dự Án (Hiện Tại)

```text
c:\xampp\htdocs\ltweb\
│
├── index.php         # Trang tổng quan dự án "Đặt lịch hẹn gặp giảng viên"
├── about.php         # Trang giới thiệu chi tiết thành viên nhóm & đề tài
└── README.md         # File hướng dẫn cấu hình & cài đặt hệ thống
```

---

## 5. Liên Hệ & Đóng Góp
Nếu có thắc mắc hoặc cần góp ý cho dự án, vui lòng truy cập [Repository GitHub](https://github.com/Minhlynek/ltweb) hoặc liên hệ nhóm phát triển.
