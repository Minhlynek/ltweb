<?php
require_once 'db.php';

// Danh sách giảng viên có sẵn để validate
$ds_giang_vien = [
    "TS. Nguyễn Văn A",
    "PGS.TS. Trần Thị B",
    "ThS. Lê Hoàng C",
    "TS. Phạm Minh D",
    "ThS. Vũ Thị E"
];

// Danh sách khung giờ có sẵn
$ds_khung_gio = [
    "08:00" => "08:00 - 09:00",
    "09:00" => "09:00 - 10:00",
    "10:00" => "10:00 - 11:00",
    "11:00" => "11:00 - 12:00",
    "13:30" => "13:30 - 14:30",
    "14:30" => "14:30 - 15:30",
    "15:30" => "15:30 - 16:30",
    "16:30" => "16:30 - 17:30"
];

$errors = [];
$old_data = [
    'ho_ten' => '',
    'ma_sv' => '',
    'email' => '',
    'so_dien_thoai' => '',
    'ten_giang_vien' => '',
    'ngay_hen' => '',
    'khung_gio' => '',
    'tieu_de' => '',
    'noi_dung' => ''
];

// Xử lý logic và Validate ngay tại trang Form (Phương thức POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_data['ho_ten'] = trim($_POST['ho_ten'] ?? '');
    $old_data['ma_sv'] = trim($_POST['ma_sv'] ?? '');
    $old_data['email'] = trim($_POST['email'] ?? '');
    $old_data['so_dien_thoai'] = trim($_POST['so_dien_thoai'] ?? '');
    $old_data['ten_giang_vien'] = trim($_POST['ten_giang_vien'] ?? '');
    $old_data['ngay_hen'] = trim($_POST['ngay_hen'] ?? '');
    $old_data['khung_gio'] = trim($_POST['khung_gio'] ?? '');
    $old_data['tieu_de'] = trim($_POST['tieu_de'] ?? '');
    $old_data['noi_dung'] = trim($_POST['noi_dung'] ?? '');

    // 1. Validate Họ và tên
    if (empty($old_data['ho_ten'])) {
        $errors['ho_ten'] = "Vui lòng nhập Họ và tên!";
    }

    // 2. Validate Mã sinh viên (Phải là dãy số gồm 10 chữ số)
    if (empty($old_data['ma_sv'])) {
        $errors['ma_sv'] = "Vui lòng nhập Mã sinh viên!";
    }

    // 3. Validate Email (Phải đúng định dạng email)
    if (empty($old_data['email'])) {
        $errors['email'] = "Vui lòng nhập Email!";
    } elseif (!filter_var($old_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không đúng định dạng (VD: example@domain.com)!";
    }

    // 4. Validate Số điện thoại (Bắt đầu bằng số 0 và có 10 chữ số)
    if (empty($old_data['so_dien_thoai'])) {
        $errors['so_dien_thoai'] = "Vui lòng nhập Số điện thoại!";
    } elseif (!preg_match('/^0[0-9]{9}$/', $old_data['so_dien_thoai'])) {
        $errors['so_dien_thoai'] = "Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 chữ số!";
    }

    // 5. Validate Giảng viên
    if (empty($old_data['ten_giang_vien'])) {
        $errors['ten_giang_vien'] = "Vui lòng chọn Giảng viên!";
    } elseif (!in_array($old_data['ten_giang_vien'], $ds_giang_vien)) {
        $errors['ten_giang_vien'] = "Giảng viên được chọn không nằm trong danh sách hợp lệ!";
    }

    // 6. Validate Ngày hẹn (Không chọn ngày quá khứ)
    $today = date('Y-m-d');
    if (empty($old_data['ngay_hen'])) {
        $errors['ngay_hen'] = "Vui lòng chọn Ngày hẹn!";
    } elseif ($old_data['ngay_hen'] < $today) {
        $errors['ngay_hen'] = "Ngày hẹn không được chọn ngày trong quá khứ!";
    }

    // 7. Validate Khung giờ (Định dạng HH:MM và nằm trong danh sách)
    if (empty($old_data['khung_gio'])) {
        $errors['khung_gio'] = "Vui lòng chọn Khung giờ!";
    } elseif (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $old_data['khung_gio'])) {
        $errors['khung_gio'] = "Khung giờ phải đúng định dạng giờ:phút (VD: 08:00)!";
    } elseif (!array_key_exists($old_data['khung_gio'], $ds_khung_gio)) {
        $errors['khung_gio'] = "Khung giờ được chọn không nằm trong danh sách hợp lệ!";
    } elseif ($old_data['ngay_hen'] === $today && $old_data['khung_gio'] < date('H:i')) {
        $errors['khung_gio'] = "Khung giờ chọn đã trôi qua trong ngày hôm nay!";
    }

    // 8. Validate Tiêu đề
    if (empty($old_data['tieu_de'])) {
        $errors['tieu_de'] = "Vui lòng nhập Tiêu đề!";
    }

    // 9. Tính toán start_at và end_at (+1 hour)
    $start_at = '';
    $end_at = '';
    if (!empty($old_data['khung_gio']) && preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $old_data['khung_gio'])) {
        $start_at = date('H:i:s', strtotime($old_data['khung_gio']));
        $end_at = date('H:i:s', strtotime($old_data['khung_gio'] . ' +1 hour'));
    }

    // 10. Validate chống trùng lịch
    if (empty($errors)) {
        // 10a. Kiểm tra sinh viên đã có lịch vào ngày và khung giờ này chưa
        $stmt_check_sv = $pdo->prepare("SELECT id FROM cuoc_hen WHERE ma_sv = :ma_sv AND ngay_hen = :ngay_hen AND start_at = :start_at AND trang_thai != 1 LIMIT 1");
        $stmt_check_sv->execute([
            ':ma_sv' => $old_data['ma_sv'],
            ':ngay_hen' => $old_data['ngay_hen'],
            ':start_at' => $start_at
        ]);

        if ($stmt_check_sv->fetch()) {
            $errors['khung_gio'] = "Mã sinh viên {$old_data['ma_sv']} đã có lịch hẹn vào lúc {$old_data['khung_gio']} ngày {$old_data['ngay_hen']}!";
        }

        // 10b. Kiểm tra giảng viên tương ứng với khung giờ đã duyệt (trang_thai = 2) thì không thể yêu cầu đặt lịch
        $stmt_check_gv = $pdo->prepare("SELECT id FROM cuoc_hen WHERE ten_giang_vien = :ten_giang_vien AND ngay_hen = :ngay_hen AND start_at = :start_at AND trang_thai = 2 LIMIT 1");
        $stmt_check_gv->execute([
            ':ten_giang_vien' => $old_data['ten_giang_vien'],
            ':ngay_hen' => $old_data['ngay_hen'],
            ':start_at' => $start_at
        ]);

        if ($stmt_check_gv->fetch()) {
            $errors['khung_gio'] = "Giảng viên {$old_data['ten_giang_vien']} đã có lịch hẹn ĐÃ DUYỆT vào lúc {$old_data['khung_gio']} ngày {$old_data['ngay_hen']}, không thể đặt thêm!";
        }
    }

    // 11. Khi Validate xong hết -> Thêm vào CSDL & Chuyển hướng sang trang kết quả (result.php)
    if (empty($errors)) {
        $stmt_insert = $pdo->prepare("
            INSERT INTO cuoc_hen (ho_ten, ma_sv, email, so_dien_thoai, ten_giang_vien, ngay_hen, start_at, end_at, tieu_de, noi_dung, trang_thai)
            VALUES (:ho_ten, :ma_sv, :email, :so_dien_thoai, :ten_giang_vien, :ngay_hen, :start_at, :end_at, :tieu_de, :noi_dung, 0)
        ");
        
        $stmt_insert->execute([
            ':ho_ten' => $old_data['ho_ten'],
            ':ma_sv' => $old_data['ma_sv'],
            ':email' => $old_data['email'],
            ':so_dien_thoai' => $old_data['so_dien_thoai'],
            ':ten_giang_vien' => $old_data['ten_giang_vien'],
            ':ngay_hen' => $old_data['ngay_hen'],
            ':start_at' => $start_at,
            ':end_at' => $end_at,
            ':tieu_de' => $old_data['tieu_de'],
            ':noi_dung' => $old_data['noi_dung']
        ]);

        $new_id = $pdo->lastInsertId();

        header("Location: result.php?id=" . $new_id . "&success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lịch Tư Vấn / Hẹn Gặp Giảng Viên</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .booking-card {
            background: #ffffff;
            border: 2px solid #38bdf8;
            border-radius: 16px;
            width: 100%;
            max-width: 680px;
            padding: 24px 28px;
            box-shadow: 0 10px 25px -5px rgba(56, 189, 248, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            background-color: #eff6ff;
            border: 2px solid #60a5fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            flex-shrink: 0;
        }

        .header-text h2 {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.2px;
            text-transform: uppercase;
        }

        .header-text p {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            padding-left: 20px;
            margin-top: 4px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            position: relative;
        }

        .form-group label {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e293b;
        }

        .form-group label span.required {
            color: #ef4444;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper svg {
            position: absolute;
            left: 12px;
            width: 18px;
            height: 18px;
            color: #94a3b8;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 42px;
            padding: 0 12px 0 38px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            color: #334155;
            background-color: #ffffff;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control.is-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
        }

        .field-error-text {
            color: #dc2626;
            font-size: 12px;
            font-weight: 500;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        select.form-control {
            padding-left: 12px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2064748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        textarea.form-control {
            height: 110px;
            padding: 10px 12px;
            resize: none;
        }

        .textarea-container {
            position: relative;
        }

        .char-counter {
            position: absolute;
            bottom: 8px;
            right: 12px;
            font-size: 12px;
            color: #94a3b8;
            background: rgba(255, 255, 255, 0.9);
            padding: 2px 4px;
            border-radius: 4px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            height: 42px;
            padding: 0 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-reset {
            background-color: #fde047;
            color: #0f172a;
            border: 1px solid #eab308;
        }

        .btn-reset:hover {
            background-color: #facc15;
        }

        .btn-submit {
            background-color: #60a5fa;
            color: #ffffff;
            box-shadow: 0 4px 10px -2px rgba(96, 165, 250, 0.5);
        }

        .btn-submit:hover {
            background-color: #3b82f6;
        }

        .nav-links {
            margin-top: 15px;
            text-align: center;
            font-size: 13px;
        }

        .nav-links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .full-width {
                grid-column: span 1;
            }
            .booking-card {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

<div class="booking-card">
    <!-- Header -->
    <div class="card-header">
        <div class="icon-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <path d="m9 16 2 2 4-4"></path>
            </svg>
        </div>
        <div class="header-text">
            <h2>ĐẶT LỊCH TƯ VẤN/HẸN GẶP GIẢNG VIÊN</h2>
            <p>Vui lòng điền đầy đủ thông tin để đặt lịch hẹn.</p>
        </div>
    </div>

    <!-- Thông báo lỗi tổng quát nếu có -->
    <?php if (!empty($errors)): ?>
        <div class="alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <strong>Có lỗi xảy ra, vui lòng kiểm tra lại thông tin bên dưới</strong>
        </div>
    <?php endif; ?>

    <!-- Form xử lý dữ liệu POST tại chính trang index.php với novalidate -->
    <form action="" method="POST" id="appointmentForm" novalidate>
        <div class="form-grid">
            
            <!-- Họ và tên -->
            <div class="form-group">
                <label>Họ và tên <span class="required">*</span></label>
                <div class="input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <input type="text" name="ho_ten" class="form-control <?php echo isset($errors['ho_ten']) ? 'is-invalid' : ''; ?>" placeholder="Nguyễn Văn A" value="<?php echo htmlspecialchars($old_data['ho_ten']); ?>">
                </div>
                <?php if (isset($errors['ho_ten'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['ho_ten']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mã số sinh viên -->
            <div class="form-group">
                <label>Mã số sinh viên <span class="required">*</span></label>
                <div class="input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2" />
                    </svg>
                    <input type="text" name="ma_sv" class="form-control <?php echo isset($errors['ma_sv']) ? 'is-invalid' : ''; ?>" placeholder="Mã số sinh viên" value="<?php echo htmlspecialchars($old_data['ma_sv']); ?>">
                </div>
                <?php if (isset($errors['ma_sv'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['ma_sv']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <div class="input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" placeholder="nguyenvana@gmail.com" value="<?php echo htmlspecialchars($old_data['email']); ?>">
                </div>
                <?php if (isset($errors['email'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['email']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Số điện thoại (bắt đầu 0, 10 chữ số) -->
            <div class="form-group">
                <label>Số điện thoại <span class="required">*</span></label>
                <div class="input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <input type="tel" name="so_dien_thoai" maxlength="10" class="form-control <?php echo isset($errors['so_dien_thoai']) ? 'is-invalid' : ''; ?>" placeholder="0912345678" value="<?php echo htmlspecialchars($old_data['so_dien_thoai']); ?>">
                </div>
                <?php if (isset($errors['so_dien_thoai'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['so_dien_thoai']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Chọn giảng viên -->
            <div class="form-group full-width">
                <label>Chọn giảng viên <span class="required">*</span></label>
                <select name="ten_giang_vien" class="form-control <?php echo isset($errors['ten_giang_vien']) ? 'is-invalid' : ''; ?>">
                    <option value="">--- Chọn giảng viên ---</option>
                    <?php foreach ($ds_giang_vien as $gv): ?>
                        <option value="<?php echo htmlspecialchars($gv); ?>" <?php echo ($old_data['ten_giang_vien'] === $gv) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($gv); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['ten_giang_vien'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['ten_giang_vien']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Ngày hẹn -->
            <div class="form-group">
                <label>Ngày hẹn <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input type="date" name="ngay_hen" min="<?php echo date('Y-m-d'); ?>" class="form-control <?php echo isset($errors['ngay_hen']) ? 'is-invalid' : ''; ?>" style="padding-left: 12px;" value="<?php echo htmlspecialchars($old_data['ngay_hen']); ?>">
                </div>
                <?php if (isset($errors['ngay_hen'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['ngay_hen']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Khung giờ -->
            <div class="form-group">
                <label>Khung giờ <span class="required">*</span></label>
                <select name="khung_gio" class="form-control <?php echo isset($errors['khung_gio']) ? 'is-invalid' : ''; ?>">
                    <option value="">--- Chọn khung giờ ---</option>
                    <?php foreach ($ds_khung_gio as $val => $label): ?>
                        <option value="<?php echo $val; ?>" <?php echo ($old_data['khung_gio'] === $val) ? 'selected' : ''; ?>>
                            <?php echo $label; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['khung_gio'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['khung_gio']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tiêu đề -->
            <div class="form-group full-width">
                <label>Tiêu đề <span class="required">*</span></label>
                <input type="text" name="tieu_de" class="form-control <?php echo isset($errors['tieu_de']) ? 'is-invalid' : ''; ?>" style="padding-left: 12px;" placeholder="--- Nhập tiêu đề ---" value="<?php echo htmlspecialchars($old_data['tieu_de']); ?>">
                <?php if (isset($errors['tieu_de'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['tieu_de']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Nội dung chi tiết -->
            <div class="form-group full-width">
                <label>Nội dung chi tiết (nếu có)</label>
                <div class="textarea-container">
                    <textarea name="noi_dung" id="noiDungTextarea" maxlength="300" class="form-control <?php echo isset($errors['noi_dung']) ? 'is-invalid' : ''; ?>" placeholder="Bạn có thể nhập thêm thông tin chi tiết về nội dung cần tư vấn..."><?php echo htmlspecialchars($old_data['noi_dung']); ?></textarea>
                    <div class="char-counter" id="charCounter">0/300</div>
                </div>
                <?php if (isset($errors['noi_dung'])): ?>
                    <div class="field-error-text">
                        
                        <?php echo htmlspecialchars($errors['noi_dung']); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Buttons -->
        <div class="form-actions">
            <button type="reset" class="btn btn-reset" onclick="resetCharCounter()">Nhập lại</button>
            <button type="submit" class="btn btn-submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                    <path d="m9 16 2 2 4-4"></path>
                </svg>
                Đặt lịch ngay
            </button>
        </div>
    </form>

    <div class="nav-links">
        <a href="list.php">📋 Xem danh sách tất cả lịch hẹn</a>
    </div>
</div>

<script>
    const textarea = document.getElementById('noiDungTextarea');
    const counter = document.getElementById('charCounter');

    function updateCounter() {
        const len = textarea.value.length;
        counter.textContent = `${len}/300`;
    }

    textarea.addEventListener('input', updateCounter);

    function resetCharCounter() {
        setTimeout(() => {
            counter.textContent = '0/300';
            document.querySelectorAll('.field-error-text').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));
        }, 10);
    }
    
    // Set default char count on load
    updateCounter();
</script>

</body>
</html>
