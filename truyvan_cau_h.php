<?php
require_once "db_module.php";

$link = NULL;
taoKetNoi($link);

// H) Thêm mới một bình luận vào bản tin
$sql_insert_cmt = "
    INSERT INTO tbl_binhluan (id_binhluan, noidung, id_bantin, id_docgia, thoigian)
    VALUES (
        123,
        N'[Câu h] Bình luận về bản tin Samsung có thành công không.',
        (SELECT id_bantin FROM tbl_bantin WHERE tieude = N'Liệu Samsung sẽ thành công với Galaxy S4 hay sẽ rơi vào tình trạng suy giảm sự tin cậy của nhà đầu tư như Apple'),
        1,
        NOW()
    )
";

$result_insert_cmt = chayTruyVanKhongTraVeDL($link, $sql_insert_cmt);
if ($result_insert_cmt) {
    echo "Thêm bình luận thành công.<br><br>";
} else {
    echo "Lỗi khi thêm bình luận.<br><br>";
}

// Hiển thị bình luận
$sql_select_cmt = "
    SELECT b.id_bantin, b.tieude, bl.noidung AS binhluan, bl.id_docgia, bl.thoigian
    FROM tbl_bantin b
    JOIN tbl_binhluan bl ON b.id_bantin = bl.id_bantin
    WHERE b.tieude = N'Liệu Samsung sẽ thành công với Galaxy S4 hay sẽ rơi vào tình trạng suy giảm sự tin cậy của nhà đầu tư như Apple'
";

$result_select_cmt = chayTruyVanTraVeDL($link, $sql_select_cmt);
while ($row = mysqli_fetch_assoc($result_select_cmt)) {
    echo "ID Bản Tin: " . $row['id_bantin'] . "<br>";
    echo "Tiêu Đề: " . $row['tieude'] . "<br>";
    echo "Nội dung Bình luận: " . $row['binhluan'] . "<br>";
    echo "ID Độc Giả: " . $row['id_docgia'] . "<br>";
    echo "Thời Gian: " . $row['thoigian'] . "<br><br>";
}

giaiPhongBoNho($link, $result_select_cmt);
?>
