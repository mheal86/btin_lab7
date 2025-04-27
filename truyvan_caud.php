<?php
// Kết nối cơ sở dữ liệu
require 'db_connect.php';

try {
    // Chuẩn bị truy vấn
    $sql = "SELECT bl.*
            FROM tbl_binhluan bl
            JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
            WHERE bt.tieude = 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kỳ thương mại điện tử'";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Lấy tất cả bình luận
    $results = $stmt->fetchAll();
    
    // Kiểm tra và hiển thị kết quả
    if (count($results) > 0) {
        echo "<h2>Danh sách bình luận của bản tin 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kỳ thương mại điện tử'</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID Bình luận</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Lượt thích</th>
                    <th>Thời gian</th>
                    <th>ID Bản tin</th>
                    <th>ID Độc giả</th>
                </tr>";
        
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id_binhluan']) . "</td>
                    <td>" . htmlspecialchars($row['tieude']) . "</td>
                    <td>" . htmlspecialchars($row['noidung']) . "</td>
                    <td>" . htmlspecialchars($row['like']) . "</td>
                    <td>" . htmlspecialchars($row['thoigian']) . "</td>
                    <td>" . htmlspecialchars($row['id_bantin']) . "</td>
                    <td>" . htmlspecialchars($row['id_docgia']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Không có bình luận nào cho bản tin này.";
    }
} catch (PDOException $e) {
    echo "Lỗi truy vấn: " . $e->getMessage();
}
?>