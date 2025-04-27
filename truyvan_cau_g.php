<?php
require_once "db_module.php";

$link = NULL;
taoKetNoi($link);

// G) Thêm mới một bản tin vào danh mục "Công nghệ"
$sql_insert = "
    INSERT INTO tbl_bantin (
        id_danhmuc,
        id_bantin,
        tieude,
        hinhanh,
        noidung,
        tukhoa,
        nguontin
    )
    VALUES (
        (SELECT id_danhmuc FROM tbl_danhmuc WHERE ten_danhmuc = N'Công nghệ' LIMIT 1),
        123,
        N'Liệu Samsung sẽ thành công với Galaxy S4 hay sẽ rơi vào tình trạng suy giảm sự tin cậy của nhà đầu tư như Apple',
        'images/news/m4chip.jpg',
        N'[Câu g] Bản tin thuộc danh mục công nghệ',
        N'Apple, đầu tư, công nghệ',
        N'VnExpress'
    )
";

$result_insert = chayTruyVanKhongTraVeDL($link, $sql_insert);
if ($result_insert) {
    echo "Thêm bản tin thành công.<br><br>";
} else {
    echo "Lỗi khi thêm bản tin.<br><br>";
}

// Hiển thị bản tin vừa thêm
$sql_select = "
    SELECT tbl_bantin.id_bantin, tbl_bantin.tieude, tbl_danhmuc.ten_danhmuc
    FROM tbl_bantin
    JOIN tbl_danhmuc ON tbl_bantin.id_danhmuc = tbl_danhmuc.id_danhmuc
    WHERE tbl_danhmuc.ten_danhmuc = 'Công nghệ'
";

$result_select = chayTruyVanTraVeDL($link, $sql_select);
while ($row = mysqli_fetch_assoc($result_select)) {
    echo "ID Bản Tin: " . $row['id_bantin'] . "<br>";
    echo "Tiêu Đề: " . $row['tieude'] . "<br>";
    echo "Tên Danh Mục: " . $row['ten_danhmuc'] . "<br><br>";
}

giaiPhongBoNho($link, $result_select);
?>
