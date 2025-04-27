<?php
require_once "db_module.php"; // Kết nối với mô-đun kết nối

$link = NULL;
taoKetNoi($link); // Kết nối cơ sở dữ liệu

// Câu truy vấn đếm lượt like bài viết
$sql_select_like = "
    SELECT 
        bt.id_bantin,
        bt.tieude,
        bt.`like` AS luot_like_bantin,
        COALESCE(SUM(bl.`like`), 0) AS tong_like_binhluan,
        bt.`like` + COALESCE(SUM(bl.`like`), 0) AS tong_like_toan_bai
    FROM tbl_bantin bt
    LEFT JOIN tbl_binhluan bl ON bt.id_bantin = bl.id_bantin
    GROUP BY bt.id_bantin, bt.tieude, bt.`like`
";

$result_select_like = chayTruyVanTraVeDL($link, $sql_select_like);

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result_select_like)) {
    echo "ID Bài Viết: " . $row["id_bantin"] . "<br>";
    echo "Tiêu Đề: " . $row["tieude"] . "<br>";
    echo "Lượt Like Bài Viết: " . $row["luot_like_bantin"] . "<br>";
    echo "Tổng Like Bình Luận: " . $row["tong_like_binhluan"] . "<br>";
    echo "Tổng Like Toàn Bài: " . $row["tong_like_toan_bai"] . "<br><br>";
}

giaiPhongBoNho($link, $result_select_like); // Giải phóng bộ nhớ
?>
