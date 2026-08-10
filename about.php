<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Giới thiệu nhóm phát triển và đề tài Hệ thống đặt lịch tư vấn/hẹn gặp giảng viên">
    <title>Giới Thiệu Nhóm & Đề Tài - Hệ Thống Đặt Lịch Hẹn Giảng Viên</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4338ca;
            --primary-light: #6366f1;
            --primary-bg: #eef2ff;
            --accent: #06b6d4;
            --dark: #0f172a;
            --gray-light: #f8fafc;
            --gray-border: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --radius-lg: 16px;
            --radius-md: 12px;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            --shadow-hover: 0 15px 30px -5px rgba(67, 56, 202, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--gray-light);
            color: var(--text-main);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-border);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--primary);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary);
        }

        /* Header banner */
        .page-header {
            background: linear-gradient(135deg, #312e81 0%, #4338ca 100%);
            color: white;
            padding: 4rem 1.5rem;
            text-align: center;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gray-border);
        }

        .section-title span {
            color: var(--primary);
        }

        /* Team Grid */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 4rem;
        }

        .team-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 2rem 1.5rem;
            text-align: center;
            border: 1px solid var(--gray-border);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary-light);
        }

        .leader-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-bg), #c7d2fe);
            color: var(--primary);
            font-size: 2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .member-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.35rem;
        }

        .member-role {
            font-size: 0.85rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.75rem;
            background: var(--primary-bg);
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
        }

        .member-desc {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Project Details Section */
        .project-detail-box {
            background: white;
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            border: 1px solid var(--gray-border);
            box-shadow: var(--shadow);
            margin-bottom: 4rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .detail-item {
            background: var(--gray-light);
            padding: 1.5rem;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--primary);
        }

        .detail-item h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-item p, .detail-item ul {
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .detail-item ul {
            padding-left: 1.25rem;
            margin-top: 0.5rem;
        }

        .detail-item ul li {
            margin-bottom: 0.35rem;
        }

        /* Tech stack pills */
        .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .tech-pill {
            background: white;
            border: 1px solid var(--gray-border);
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* Footer */
        footer {
            background: white;
            border-top: 1px solid var(--gray-border);
            padding: 2rem 1.5rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <div class="logo-icon">🎓</div>
                <span>EduSchedule</span>
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="about.php" class="active">Giới Thiệu Nhóm & Đề Tài</a></li>
                <li><a href="README.md" target="_blank">Hướng Dẫn Run (README)</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <h1>Giới Thiệu Nhóm & Đề Tài Dự Án</h1>
        <p>Tìm hiểu về các thành viên nhóm phát triển và thông tin tổng quan đề tài môn Lập Trình Web</p>
    </header>

    <div class="container">

        <!-- 1. Thành viên nhóm -->
        <h2 class="section-title">👥 <span>Thành Viên</span> Nhóm Phát Triển</h2>
        <div class="team-grid">

            <!-- Member 1: Lê Thị Minh Lý -->
            <div class="team-card">
                <span class="leader-badge">Trưởng Nhóm</span>
                <div class="avatar">LÝ</div>
                <div class="member-name">Lê Thị Minh Lý</div>
                <div class="member-role">Fullstack & Leader</div>
                <div class="member-desc">
                    Quản lý tiến độ dự án, phân công nhiệm vụ, thiết kế kiến trúc hệ thống và phát triển giao diện tổng quan.
                </div>
            </div>

            <!-- Member 2: Lê Phương Anh -->
            <div class="team-card">
                <div class="avatar">ANH</div>
                <div class="member-name">Lê Phương Anh</div>
                <div class="member-role">Frontend Developer</div>
                <div class="member-desc">
                    Thiết kế giao diện UI/UX người dùng, phát triển trang danh sách giảng viên và giao diện chọn khung giờ đặt lịch.
                </div>
            </div>

            <!-- Member 3: Lê Khánh Linh -->
            <div class="team-card">
                <div class="avatar">LINH</div>
                <div class="member-name">Lê Khánh Linh</div>
                <div class="member-role">Backend Developer</div>
                <div class="member-desc">
                    Xây dựng cơ sở dữ liệu MySQL, phát triển xử lý logic đặt lịch hẹn và kết nối dữ liệu PHP với hệ thống.
                </div>
            </div>

            <!-- Member 4: Nguyễn Quang Nghĩa -->
            <div class="team-card">
                <div class="avatar">NGHĨA</div>
                <div class="member-name">Nguyễn Quang Nghĩa</div>
                <div class="member-role">Backend & Security</div>
                <div class="member-desc">
                    Xử lý hệ thống đăng ký/đăng nhập, phân quyền người dùng (Sinh viên, Giảng viên, Admin) và bảo mật dữ liệu.
                </div>
            </div>

            <!-- Member 5: Đỗ Quang Anh -->
            <div class="team-card">
                <div class="avatar">ANH</div>
                <div class="member-name">Đỗ Quang Anh</div>
                <div class="member-role">QA & Documentation</div>
                <div class="member-desc">
                    Thực hiện kiểm thử các kịch bản đặt lịch, ghi nhận lỗi UI/UX, soạn thảo file tài liệu README và hướng dẫn sử dụng.
                </div>
            </div>

        </div>

        <!-- 2. Giới thiệu đề tài -->
        <h2 class="section-title">📌 Giới Thiệu Đề Tài: <span>HỆ THỐNG ĐẶT LỊCH TƯ VẤN / HẸN GẶP GIẢNG VIÊN</span></h2>
        
        <div class="project-detail-box">
            <h3 style="font-size: 1.4rem; color: var(--dark); margin-bottom: 1rem;">🎯 Tổng Quan Đề Tài</h3>
            <p style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.7;">
                Trong môi trường đại học, nhu cầu sinh viên gặp gỡ giảng viên để tham vấn kiến thức, xin định hướng đồ án tốt nghiệp, bài tập lớn hay giải đáp thắc mắc là rất cao. 
                Tuy nhiên, việc hẹn gặp trực tiếp thường gặp nhiều trở ngại như giảng viên bận lịch dạy, sinh viên không biết khung giờ rảnh của thầy cô, hoặc việc gửi email hẹn gặp bị thất lạc. 
                Vì vậy, nhóm chúng tôi chọn đề tài <strong>"Hệ thống Đặt Lịch Tư Vấn / Hẹn Gặp Giảng Viên"</strong> nhằm số hóa và đơn giản hóa quy trình này.
            </p>

            <div class="detail-grid">
                
                <div class="detail-item">
                    <h4>💡 Lý Do Chọn Đề Tài</h4>
                    <p>
                        Khắc phục tình trạng xung đột lịch trình giữa sinh viên và giảng viên, giúp việc đặt lịch hẹn trở nên minh bạch, nhanh chóng và chuyên nghiệp hơn.
                    </p>
                </div>

                <div class="detail-item">
                    <h4>🎯 Mục Tiêu Hệ Thống</h4>
                    <p>
                        Cung cấp một nền tảng trực tuyến cho phép giảng viên quản lý thời gian rảnh và cho phép sinh viên chủ động đăng ký lịch tư vấn theo từng chủ đề cụ thể.
                    </p>
                </div>

                <div class="detail-item">
                    <h4>👥 Đối Tượng Sử Dụng</h4>
                    <ul>
                        <li><strong>Sinh viên:</strong> Tra cứu giảng viên, đăng ký đặt lịch, nhận phản hồi.</li>
                        <li><strong>Giảng viên:</strong> Quản lý khung giờ rảnh, duyệt/hủy lịch hẹn.</li>
                        <li><strong>Quản trị viên (Admin):</strong> Quản lý danh mục khoa, tài khoản người dùng.</li>
                    </ul>
                </div>

                <div class="detail-item">
                    <h4>🛠️ Công Nghệ Sử Dụng</h4>
                    <p>Hệ thống được phát triển trên nền tảng Web tiêu chuẩn:</p>
                    <div class="tech-tags">
                        <span class="tech-pill">PHP 8.1.25</span>
                        <span class="tech-pill">MariaDB / MySQL 10.4</span>
                        <span class="tech-pill">XAMPP Server</span>
                        <span class="tech-pill">HTML5 & CSS3</span>
                        <span class="tech-pill">JavaScript</span>
                        <span class="tech-pill">Git / GitHub</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Nhóm Dự Án Lập Trình Web - Trường Đại Học. Tất cả các quyền được bảo lưu.</p>
    </footer>

</body>
</html>
