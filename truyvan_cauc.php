<?php
require_once "db_module.php"; // Kết nối với mô-đun kết nối

$link = NULL;
taoKetNoi($link); // Kết nối cơ sở dữ liệu

// Câu truy vấn liệt kê tất cả bản tin thuộc danh mục "Giáo dục" và "Đời sống"
$sql_select_bantin = "
    SELECT bt.*
    FROM tbl_bantin bt
    JOIN tbl_danhmuc dm ON bt.id_danhmuc = dm.id_danhmuc
    WHERE dm.ten_danhmuc IN (N'Giáo dục', N'Đời sống')
";

$result_select_bantin = chayTruyVanTraVeDL($link, $sql_select_bantin);

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result_select_bantin)) {
    echo "ID Bản Tin: " . $row['id_bantin'] . "<br>";
    echo "Tiêu Đề: " . $row['tieude'] . "<br>";
    echo "Hình Ảnh: " . $row['hinhanh'] . "<br>";
    echo "Nội Dung: " . $row['noidung'] . "<br>";
    echo "Từ Khóa: " . $row['tukhoa'] . "<br>";
    echo "Nguồn Tin: " . $row['nguontin'] . "<br>";
    echo "Lượt Thích: " . $row['like'] . "<br>";
    echo "Điểm Đánh Giá: " . $row['rating'] . "<br><br>";
}

giaiPhongBoNho($link, $result_select_bantin); // Giải phóng bộ nhớ
?>