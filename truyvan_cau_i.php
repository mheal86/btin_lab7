<?php
require_once "db_module.php";

$link = NULL;
taoKetNoi($link);

// I) Cập nhật nội dung bài viết ID 123
$sql_update = "
    UPDATE tbl_bantin
    SET noidung = CONCAT(N'[CẬP NHẬT - [Câu i]] ', noidung)
    WHERE id_bantin = 123
";

$result_update = chayTruyVanKhongTraVeDL($link, $sql_update);
if ($result_update) {
    echo "Cập nhật nội dung thành công.<br><br>";
} else {
    echo "Lỗi khi cập nhật.<br><br>";
}

// Hiển thị kết quả
$sql_select_update = "SELECT * FROM tbl_bantin WHERE id_bantin = 123";
$result_select_update = chayTruyVanTraVeDL($link, $sql_select_update);
while ($row = mysqli_fetch_assoc($result_select_update)) {
    echo "ID: " . $row['id_bantin'] . "<br>";
    echo "Tiêu đề: " . $row['tieude'] . "<br>";
    echo "Nội dung: " . $row['noidung'] . "<br>";
}

giaiPhongBoNho($link, $result_select_update);
?>
