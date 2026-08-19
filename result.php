<?php
require_once 'db.php';

// Phương thức GET: Lấy id cuộc hẹn từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Cờ kiểm tra xem có cờ success=1 từ trang index.php chuyển sang không
$is_new_success = (isset($_GET['success']) && $_GET['success'] == 1);

$appointment = null;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM cuoc_hen WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $appointment = $stmt->fetch();
}

$status_labels = [
    0 => ['text' => 'Đã đặt', 'class' => 'status-0'],
    1 => ['text' => 'Đã hủy', 'class' => 'status-1'],
    2 => ['text' => 'Đã duyệt', 'class' => 'status-2'],
    3 => ['text' => 'Từ chối', 'class' => 'status-3'],
    4 => ['text' => 'Hoàn thành', 'class' => 'status-4'],
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Đặt Lịch Hẹn</title>
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

        .result-card {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            max-width: 620px;
            padding: 32px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .success-banner {
            background-color: #ecfdf5;
            border: 1.5px solid #6ee7b7;
            color: #065f46;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .success-banner svg {
            width: 28px;
            height: 28px;
            color: #10b981;
            flex-shrink: 0;
        }

        .success-banner h3 {
            font-size: 17px;
            font-weight: 700;
        }

        .success-banner p {
            font-size: 13px;
            color: #047857;
            margin-top: 2px;
        }

        .details-group {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #f1f5f9;
            margin-bottom: 24px;
        }

        .details-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-row {
            display: flex;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            width: 170px;
            font-weight: 600;
            color: #64748b;
            flex-shrink: 0;
        }

        .detail-value {
            color: #1e293b;
            font-weight: 500;
            flex-grow: 1;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-0 { background: #dbeafe; color: #1e40af; }
        .status-1 { background: #f3f4f6; color: #4b5563; }
        .status-2 { background: #dcfce7; color: #166534; }
        .status-3 { background: #fee2e2; color: #991b1b; }
        .status-4 { background: #f3e8ff; color: #6b21a8; }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn {
            height: 42px;
            padding: 0 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-outline {
            background-color: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .btn-outline:hover {
            background-color: #f8fafc;
            color: #0f172a;
        }
    </style>
</head>
<body>

<div class="result-card">
    <?php if ($appointment): ?>
        
        <!-- CHỈ HIỂN THỊ THÔNG BÁO THÀNH CÔNG KHI CHUYỂN HƯỚNG TỪ LÚC TẠO XONG -->
        <?php if ($is_new_success): ?>
            <div class="success-banner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3>Tạo lịch hẹn thành công!</h3>
                    <p>Thông tin cuộc hẹn đã được lưu vào hệ thống.</p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Chi tiết thông tin cuộc hẹn -->
        <div class="details-group">
            <div class="details-title">
                <span>Thông Tin Cuộc Hẹn #<?php echo str_pad($appointment['id'], 5, '0', STR_PAD_LEFT); ?></span>
                <?php 
                    $st = $appointment['trang_thai'];
                    $lbl = $status_labels[$st] ?? ['text' => 'Không xác định', 'class' => 'status-0'];
                ?>
                <span class="badge <?php echo $lbl['class']; ?>"><?php echo $lbl['text']; ?></span>
            </div>

            <div class="detail-row">
                <div class="detail-label">Họ và tên SV:</div>
                <div class="detail-value"><strong><?php echo htmlspecialchars($appointment['ho_ten']); ?></strong></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Mã số sinh viên:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['ma_sv']); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Email:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['email']); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Số điện thoại:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['so_dien_thoai']); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Giảng viên hẹn gặp:</div>
                <div class="detail-value"><strong style="color: #2563eb;"><?php echo htmlspecialchars($appointment['ten_giang_vien']); ?></strong></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Ngày hẹn:</div>
                <div class="detail-value">
                    <?php echo date('d/m/Y', strtotime($appointment['ngay_hen'])); ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Khung giờ:</div>
                <div class="detail-value">
                    <strong><?php echo date('H:i', strtotime($appointment['start_at'])); ?> - <?php echo date('H:i', strtotime($appointment['end_at'])); ?></strong> (1 giờ)
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Tiêu đề:</div>
                <div class="detail-value"><?php echo htmlspecialchars($appointment['tieu_de']); ?></div>
            </div>

            <?php if (!empty($appointment['noi_dung'])): ?>
            <div class="detail-row">
                <div class="detail-label">Nội dung chi tiết:</div>
                <div class="detail-value"><?php echo nl2br(htmlspecialchars($appointment['noi_dung'])); ?></div>
            </div>
            <?php endif; ?>

            <div class="detail-row">
                <div class="detail-label">Thời gian đăng ký:</div>
                <div class="detail-value"><?php echo date('d/m/Y H:i:s', strtotime($appointment['created_at'])); ?></div>
            </div>
        </div>

        <div class="actions">
            <a href="index.php" class="btn btn-outline">➕ Đặt lịch mới</a>
            <a href="list.php" class="btn btn-primary">📋 Danh sách lịch hẹn</a>
        </div>

    <?php else: ?>
        <div style="text-align: center; padding: 20px;">
            <h3 style="color: #ef4444; margin-bottom: 10px;">Không tìm thấy thông tin cuộc hẹn!</h3>
            <p style="color: #64748b; margin-bottom: 20px;">Mã cuộc hẹn không hợp lệ hoặc không tồn tại trong hệ thống.</p>
            <a href="index.php" class="btn btn-primary">Quay lại trang đặt lịch</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
