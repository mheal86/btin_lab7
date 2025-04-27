<?php
// Kết nối cơ sở dữ liệu
require 'db_connect.php';

try {
    // Chuẩn bị truy vấn
    $sql = "SELECT bt.*
            FROM tbl_bantin bt
            JOIN tbl_danhmuc dm ON bt.id_danhmuc = dm.id_danhmuc
            WHERE dm.ten_danhmuc IN ('Giáo dục', 'Đời sống')";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Lấy tất cả bản tin
    $results = $stmt->fetchAll();
    
    // Kiểm tra và hiển thị kết quả
    if (count($results) > 0) {
        echo "<h2>Danh sách bản tin thuộc danh mục 'Giáo dục' và 'Đời sống'</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID Bản tin</th>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Nội dung</th>
                    <th>Từ khóa</th>
                    <th>Nguồn tin</th>
                    <th>Lượt thích</th>
                    <th>Điểm đánh giá</th>
                </tr>";
        
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id_bantin']) . "</td>
                    <td>" . htmlspecialchars($row['tieude']) . "</td>
                    <td>" . htmlspecialchars($row['hinhanh']) . "</td>
                    <td>" . htmlspecialchars($row['noidung']) . "</td>
                    <td>" . htmlspecialchars($row['tukhoa']) . "</td>
                    <td>" . htmlspecialchars($row['nguontin']) . "</td>
                    <td>" . htmlspecialchars($row['like']) . "</td>
                    <td>" . htmlspecialchars($row['rating']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Không có bản tin nào thuộc danh mục 'Giáo dục' hoặc 'Đời sống'.";
    }
} catch (PDOException $e) {
    echo "Lỗi truy vấn: " . $e->getMessage();
}
?>