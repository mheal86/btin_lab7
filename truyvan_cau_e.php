<?php
require_once "db_module.php"; // Kết nối với mô-đun kết nối

$link = NULL;
taoKetNoi($link); // Kết nối cơ sở dữ liệu

// Câu truy vấn liệt kê độc giả bình luận về Apple Ngốc Nghếch
$sql_select_cmt_apple = "
    SELECT dg.id_docgia, dg.hoten, bl.noidung
    FROM tbl_binhluan bl
    JOIN tbl_docgia dg ON bl.id_docgia = dg.id_docgia
    JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
    WHERE bt.tieude = N'Thoái trào tất yếu của Apple trước cạnh tranh trên thị trường smartphone'
      AND bl.noidung LIKE N'%ngốc nghếch%'
";

$result_select_cmt_apple = chayTruyVanTraVeDL($link, $sql_select_cmt_apple);

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result_select_cmt_apple)) {
    echo "ID Độc Giả: " . $row['id_docgia'] . "<br>";
    echo "Họ Tên: " . $row['hoten'] . "<br>";
    echo "Nội Dung: " . $row['noidung'] . "<br><br>";
}

giaiPhongBoNho($link, $result_select_cmt_apple); // Giải phóng bộ nhớ
?>
