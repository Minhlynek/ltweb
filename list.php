<?php
require_once 'db.php';

$message = '';
$error = '';

// Xử lý cập nhật trạng thái cuộc hẹn (POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $appointment_id = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : 0;
    $new_status = isset($_POST['trang_thai']) ? intval($_POST['trang_thai']) : -1;

    if ($appointment_id > 0 && $new_status >= 0 && $new_status <= 4) {
        $stmt_update = $pdo->prepare("UPDATE cuoc_hen SET trang_thai = :trang_thai WHERE id = :id");
        $stmt_update->execute([
            ':trang_thai' => $new_status,
            ':id' => $appointment_id
        ]);
        $message = "Đã cập nhật trạng thái cuộc hẹn #{$appointment_id} thành công!";
    } else {
        $error = "Dữ liệu cập nhật không hợp lệ!";
    }
}

// Lấy danh sách tất cả các cuộc hẹn
$stmt_list = $pdo->query("SELECT * FROM cuoc_hen ORDER BY id DESC");
$appointments = $stmt_list->fetchAll();

$status_labels = [
    0 => ['text' => '0 - Đã đặt', 'badge' => 'status-0'],
    1 => ['text' => '1 - Đã hủy', 'badge' => 'status-1'],
    2 => ['text' => '2 - Đã duyệt', 'badge' => 'status-2'],
    3 => ['text' => '3 - Từ chối', 'badge' => 'status-3'],
    4 => ['text' => '4 - Hoàn thành', 'badge' => 'status-4'],
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lịch Hẹn Giảng Viên</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            padding: 24px;
            color: #1e293b;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            background: #ffffff;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .header-bar h1 {
            font-size: 20px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-add {
            background-color: #2563eb;
            color: #ffffff;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background-color: #1d4ed8;
        }

        .alert-success {
            background-color: #ecfdf5;
            border: 1px solid #6ee7b7;
            color: #065f46;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .table-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-0 { background: #dbeafe; color: #1e40af; }
        .status-1 { background: #f3f4f6; color: #4b5563; }
        .status-2 { background: #dcfce7; color: #166534; }
        .status-3 { background: #fee2e2; color: #991b1b; }
        .status-4 { background: #f3e8ff; color: #6b21a8; }

        .update-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .select-status {
            padding: 6px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13px;
            background-color: #ffffff;
            outline: none;
            cursor: pointer;
        }

        .select-status:focus {
            border-color: #2563eb;
        }

        .btn-update {
            background-color: #0284c7;
            color: #ffffff;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-update:hover {
            background-color: #0369a1;
        }

        .action-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            margin-right: 8px;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #64748b;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header-bar">
        <h1>
            <span>📅</span> Quan Lý & Danh Sách Cuộc Hẹn
        </h1>
        <a href="index.php" class="btn-add">➕ Đặt lịch hẹn mới</a>
    </div>

    <!-- Notifications -->
    <?php if (!empty($message)): ?>
        <div class="alert-success">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Mã cuộc hẹn</th>
                        <th>Họ tên & SV</th>
                        <th>Giảng viên</th>
                        <th>Ngày hẹn & Khung giờ</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái hiện tại</th>
                        <th>Cập nhật trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($appointments) > 0): ?>
                        <?php foreach ($appointments as $row): ?>
                            <tr>
                                <td>
                                    <strong>#<?php echo str_pad($row['id'], 5, '0', STR_PAD_LEFT); ?></strong>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($row['ho_ten']); ?></strong><br>
                                    <small style="color: #64748b;"><?php echo htmlspecialchars($row['ma_sv']); ?> | <?php echo htmlspecialchars($row['so_dien_thoai']); ?></small>
                                </td>
                                <td>
                                    <span style="color: #2563eb; font-weight: 600;"><?php echo htmlspecialchars($row['ten_giang_vien']); ?></span>
                                </td>
                                <td>
                                    📅 <?php echo date('d/m/Y', strtotime($row['ngay_hen'])); ?><br>
                                    ⏰ <strong><?php echo date('H:i', strtotime($row['start_at'])); ?> - <?php echo date('H:i', strtotime($row['end_at'])); ?></strong>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['tieu_de']); ?>
                                </td>
                                <td>
                                    <?php 
                                        $st = $row['trang_thai'];
                                        $lbl = $status_labels[$st] ?? ['text' => 'N/A', 'badge' => 'status-0'];
                                    ?>
                                    <span class="badge <?php echo $lbl['badge']; ?>"><?php echo $lbl['text']; ?></span>
                                </td>
                                <td>
                                    <!-- Form Cập nhật Trạng thái -->
                                    <form action="" method="POST" class="update-form">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                        <select name="trang_thai" class="select-status">
                                            <?php foreach ($status_labels as $key => $info): ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($row['trang_thai'] == $key) ? 'selected' : ''; ?>>
                                                    <?php echo $info['text']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn-update">Lưu</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="result.php?id=<?php echo $row['id']; ?>" class="action-link">👁️ Xem chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="empty-state">
                                Chưa có cuộc hẹn nào được lưu trong hệ thống. <a href="index.php" style="color: #2563eb;">Nhấp vào đây để đặt lịch đầu tiên</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
