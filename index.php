<?php
$folderName = basename(__DIR__);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập thực hành <?php echo htmlspecialchars($folderName); ?> - Lê Thị Minh Lý</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f6f9; margin: 0; padding: 40px; color: #333; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto; }
        h1 { color: #2c3e50; margin-top: 0; }
        a { display: inline-block; margin-top: 20px; color: #4f46e5; text-decoration: none; font-weight: 600; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h1>bài tập thực hành <?php echo htmlspecialchars(mb_strtolower($folderName, 'UTF-8')); ?></h1>
        <p>Nội dung bài tập thực hành <?php echo htmlspecialchars(mb_strtolower($folderName, 'UTF-8')); ?> của nhóm 4 (chủ đề 5).</p>
        
    </div>
</body>
</html>
