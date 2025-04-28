<?php
require_once "db_module.php"; // Kết nối với mô-đun kết nối

$link = NULL;
taoKetNoi($link); // Kết nối cơ sở dữ liệu

// Câu truy vấn tìm bản tin có tiêu đề chứa từ khóa "công nghệ"
$sql_find_bantin = "
    SELECT *
    FROM tbl_bantin
    WHERE tieude LIKE N'%Samsung%'
";

$result_find_bantin = chayTruyVanTraVeDL($link, $sql_find_bantin);

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result_find_bantin)) {
    echo "ID Bản Tin: " . $row['id_bantin'] . "<br>";
    echo "Tiêu Đề: " . $row['tieude'] . "<br>";
    echo "Nội Dung: " . $row['noidung'] . "<br><br>";
}

giaiPhongBoNho($link, $result_find_bantin); // Giải phóng bộ nhớ
?>
