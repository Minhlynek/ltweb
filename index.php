<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hệ thống đặt lịch tư vấn và hẹn gặp giảng viên - Dự án môn Lập Trình Web">
    <title>Trang Chủ - Hệ Thống Đặt Lịch Hẹn Giảng Viên</title>
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
            --shadow-hover: 0 20px 25px -5px rgba(67, 56, 202, 0.15), 0 8px 10px -6px rgba(67, 56, 202, 0.05);
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

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 0.65rem 1.4rem;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(67, 56, 202, 0.25);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(67, 56, 202, 0.35);
        }

        /* Hero Section */
        .hero {
            padding: 5rem 1.5rem 4rem;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.08), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(6, 182, 212, 0.08), transparent 50%);
            text-align: center;
        }

        .hero-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background-color: var(--primary-bg);
            color: var(--primary);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hero h1 {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1.25;
            color: var(--dark);
            margin-bottom: 1.25rem;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            max-width: 750px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-outline {
            background: white;
            color: var(--text-main);
            border: 1.5px solid var(--gray-border);
            padding: 0.65rem 1.4rem;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background-color: var(--primary-bg);
        }

        /* Features Section */
        .features {
            padding: 4rem 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.75rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-border);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-bg);
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .feature-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Banner info */
        .info-banner {
            max-width: 1200px;
            margin: 2rem auto 5rem;
            padding: 0 1.5rem;
        }

        .banner-content {
            background: linear-gradient(135deg, #1e1b4b, #312e81);
            color: white;
            border-radius: 20px;
            padding: 3rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .banner-text h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .banner-text p {
            opacity: 0.85;
            font-size: 1rem;
            max-width: 600px;
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
                <li><a href="index.php" class="active">Trang Chủ</a></li>
                <li><a href="about.php">Giới Thiệu Nhóm & Đề Tài</a></li>
                <li><a href="README.md" target="_blank">Hướng Dẫn Run (README)</a></li>
            </ul>
            <a href="about.php" class="btn-primary">Xem Nhóm Phát Triển &rarr;</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="badge">🚀 Dự Án Môn Lập Trình Web • Buổi Đặt Đề Tài</div>
            <h1>Hệ Thống Đặt Lịch Tư Vấn &<br><span>Hẹn Gặp Giảng Viên</span></h1>
            <p>
                Giải pháp công nghệ hiện đại giúp tối ưu hóa quy trình trao đổi, đặt lịch hẹn và tư vấn học tập/đồ án giữa Sinh viên và Giảng viên trong nhà trường.
            </p>
            <div class="hero-btns">
                <a href="about.php" class="btn-primary">Tìm Hiểu Về Đề Tài & Nhóm</a>
                <a href="README.md" target="_blank" class="btn-outline">📖 Hướng Dẫn Cài Đặt (README)</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="section-header">
            <h2>Các Tính Năng Dự Kiến Phát Triển</h2>
            <p>Hệ thống được thiết kế hướng tới trải nghiệm linh hoạt cho cả Sinh viên và Giảng viên</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3>Quản Lý Lịch Rảnh</h3>
                <p>Giảng viên chủ động đăng tải khung giờ làm việc, tư vấn đồ án hoặc nhận hẹn gặp sinh viên theo tuần/tháng.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">✍️</div>
                <h3>Đặt Lịch Nhanh Chóng</h3>
                <p>Sinh viên dễ dàng chọn giảng viên, đăng ký khung giờ rảnh và điền lý do/nội dung cần tư vấn trực tuyến.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔔</div>
                <h3>Xác Nhận & Thông Báo</h3>
                <p>Giảng viên duyệt hoặc hủy lịch hẹn kèm ghi chú. Hệ thống tự động gửi thông báo trạng thái cho sinh viên.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3>Theo Dõi Tiến Độ</h3>
                <p>Lưu trữ lịch sử các buổi tư vấn, ghi chú phản hồi của giảng viên giúp sinh viên nắm rõ lộ trình hoàn thành đồ án.</p>
            </div>
        </div>
    </section>

    <!-- Banner Info -->
    <div class="info-banner">
        <div class="banner-content">
            <div class="banner-text">
                <h3>Thực hiện bởi Nhóm 5 Sinh Viên</h3>
                <p>Trưởng nhóm: <strong>Lê Thị Minh Lý</strong> cùng các thành viên Lê Phương Anh, Lê Khánh Linh, Nguyễn Quang Nghĩa, Đỗ Quang Anh.</p>
            </div>
            <a href="about.php" class="btn-primary" style="background: white; color: var(--primary);">Xem Chi Tiết Nhóm &rarr;</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Dự án Lập Trình Web - Hệ Thống Đặt Lịch Hẹn Giảng Viên. Tất cả các quyền được bảo lưu.</p>
    </footer>

</body>
</html>
