<?php
require_once "db_module.php"; // Kết nối với mô-đun kết nối

$link = NULL;
taoKetNoi($link); // Kết nối cơ sở dữ liệu

// Câu truy vấn lấy 10 bản tin có lượt thích cao nhất
$sql_top10_bantin = "
    SELECT *
    FROM tbl_bantin
    ORDER BY luot_thich DESC
    LIMIT 10
";

$result_top10_bantin = chayTruyVanTraVeDL($link, $sql_top10_bantin);

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result_top10_bantin)) {
    echo "ID Bản Tin: " . $row['id_bantin'] . "<br>";
    echo "Tiêu Đề: " . $row['tieude'] . "<br>";
    echo "Lượt Thích: " . $row['luot_thich'] . "<br><br>";
}

giaiPhongBoNho($link, $result_top10_bantin); // Giải phóng bộ nhớ
?>
