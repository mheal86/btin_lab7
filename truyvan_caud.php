<?php
require_once "db_module.php"; // Kết nối với mô-đun kết nối

$link = NULL;
taoKetNoi($link); // Kết nối cơ sở dữ liệu

// Câu truy vấn liệt kê tất cả bình luận của bản tin có tiêu đề "Sự thay đổi cách thức mua sắm..."
$sql_select_binhluan = "
    SELECT bl.*
    FROM tbl_binhluan bl
    JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
    WHERE bt.tieude = N'Sự thay đổi cách thức mua sắm của khách hàng trong thời kỳ thương mại điện tử'
";

$result_select_binhluan = chayTruyVanTraVeDL($link, $sql_select_binhluan);

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result_select_binhluan)) {
    echo "ID Bình Luận: " . $row['id_binhluan'] . "<br>";
    echo "Tiêu Đề: " . $row['tieude'] . "<br>";
    echo "Nội Dung: " . $row['noidung'] . "<br>";
    echo "Lượt Thích: " . $row['like'] . "<br>";
    echo "Thời Gian: " . $row['thoigian'] . "<br>";
    echo "ID Bản Tin: " . $row['id_bantin'] . "<br>";
    echo "ID Độc Giả: " . $row['id_docgia'] . "<br><br>";
}

giaiPhongBoNho($link, $result_select_binhluan); // Giải phóng bộ nhớ
?>