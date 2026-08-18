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
2. **Lê Phương Anh** - Tester & Soạn thảo Tài liệu
3. **Lê Khánh Linh** - Backend Developer & Quản lý cơ sở dữ liệu
4. **Nguyễn Quang Nghĩa** - Backend Developer & Xử lý Bảo mật (tạm thời)
5. **Đỗ Quang Anh** -Tester & Soạn thảo Tài liệu/ UI

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

## 5. Các Chức Năng Dự Kiến (Planned Features)

Hệ thống được thiết kế nhằm đáp ứng nhu cầu kết nối giữa Sinh viên và Giảng viên với các nhóm chức năng chính bao gồm:

### Phân Hệ Sinh Viên (Student)
* **Đăng ký & Đăng nhập:** Tạo và quản lý tài khoản cá nhân sinh viên.
* **Đặt lịch hẹn:** Đăng ký khung giờ hẹn gặp, ghi rõ lý do, nội dung cần tư vấn (có thể đính kèm tệp tài liệu).
* **Quản lý & Theo dõi trạng thái:** Xem danh sách lịch hẹn (Chờ phê duyệt, Đã chấp nhận, Từ chối, Hoàn thành).

### Phân Hệ Giảng Viên (Lecturer)
* **Quản lý Hồ sơ cá nhân:** Cập nhật thông tin cá nhân, văn phòng làm việc, email và giờ tiếp sinh viên cố định.
* **Quản lý Lịch rảnh (Schedule Availability):** Chủ động thiết lập, mở/đóng các khung giờ rảnh nhận đăng ký tư vấn.
* **Phê duyệt Lịch hẹn:** Tiếp nhận yêu cầu đặt lịch từ sinh viên, phê duyệt (Chấp nhận) hoặc Từ chối (kèm lý do / gợi ý khung giờ khác).
* **Nhật ký & Ghi chú tư vấn:** Xem lịch sử các buổi hẹn và ghi chú lại kết quả buổi gặp.

### Phân Hệ Quản Trị Viên (Admin)
* **Quản lý Tài khoản & Phân quyền:** Quản lý thông tin người dùng (Sinh viên, Giảng viên), cấp quyền và mở/khóa tài khoản.
* **Quản lý Danh mục:** Cấu hình danh sách Khoa, Bộ môn, Phòng học / Văn phòng làm việc.
* **Báo cáo & Thống kê:** Thống kê tổng số lượt đặt lịch, tỷ lệ phản hồi của giảng viên và mức độ hoạt động của hệ thống.

### Tính Năng Nâng Cao / Mở Rộng (có thể mở rộng trong tươngl ai)
* **Tích hợp họp trực tuyến:** Hỗ trợ chèn/tự động tạo liên kết Google Meet / Zoom cho hình thức tư vấn online.
* **Gửi Email tự động:** Thông báo qua email (PHPMailer) khi lịch hẹn được đăng ký mới hoặc thay đổi trạng thái.
* **Đánh giá & Phản hồi (Feedback):** Sinh viên gửi đánh giá chất lượng buổi tư vấn sau khi cuộc hẹn kết thúc.

### Tính năng đã làm được cho tới buổi 3
* **Đặt lịch hẹn:** Đăng ký khung giờ hẹn gặp, ghi rõ lý do, nội dung cần tư vấn (có thể đính kèm tệp tài liệu). 
* **Quản lý & Theo dõi trạng thái:** Xem danh sách lịch hẹn (Chờ phê duyệt, Đã chấp nhận, Từ chối, Hoàn thành).
* TK được giao diện form đăng ký.
* Quản lý được dữ liệu đăng ký nhập vào.
* Hiển thị được danh sách những sinh viên đã nhập thông tin.

---

## 6. Liên Hệ & Đóng Góp
Nếu có thắc mắc hoặc cần góp ý cho dự án, vui lòng truy cập [Repository GitHub](https://github.com/Minhlynek/ltweb) hoặc liên hệ nhóm phát triển.

