<?php
require_once("db_module.php");
$link = NULL;
taoKetNoi($link);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bantin = $_POST['id_bantin'];
    $tieude = $_POST['tieude'];
    $hinhanh = $_POST['hinhanh'];
    $noidung = $_POST['noidung'];
    $tukhoa = $_POST['tukhoa'];
    $nguontin = $_POST['nguontin'];

    // Build query dựa trên input
    $query = "INSERT INTO tbl_bantin (id_danhmuc, id_bantin, tieude, hinhanh, noidung, tukhoa, nguontin)
              VALUES (
                  (SELECT id_danhmuc FROM tbl_danhmuc WHERE ten_danhmuc = N'Công nghệ' LIMIT 1),
                  '$id_bantin',
                  N'$tieude',
                  '$hinhanh',
                  N'$noidung',
                  N'$tukhoa',
                  '$nguontin'
              )";

    $result = chayTruyVanKhongTraVeDL($link, $query);

    if ($result) {
        echo "<h3>Thêm bản tin thành công!</h3>";
    } else {
        echo "<h3>Thêm bản tin thất bại!</h3>";
    }

    // Hiển thị kết quả
    $select = "SELECT b.id_bantin, b.tieude, d.ten_danhmuc
               FROM tbl_bantin b
               JOIN tbl_danhmuc d ON b.id_danhmuc = d.id_danhmuc
               WHERE d.ten_danhmuc = 'Công nghệ'";
    $rs = chayTruyVanTraVeDL($link, $select);

    echo "<h3>Dữ liệu hiện tại:</h3><table border='1'>";
    while($row = mysqli_fetch_assoc($rs)) {
        echo "<tr><td>{$row['id_bantin']}</td><td>{$row['tieude']}</td><td>{$row['ten_danhmuc']}</td></tr>";
    }
    echo "</table>";

    giaiPhongBoNho($link, $rs);
    exit;
}
?>

<h2>Thêm bản tin mới vào Công nghệ</h2>
<form method="post">
    ID Bản Tin: <input type="text" name="id_bantin" required><br><br>
    Tiêu đề: <input type="text" name="tieude" required><br><br>
    Hình ảnh: <input type="text" name="hinhanh"><br><br>
    Nội dung: <textarea name="noidung" rows="5" cols="50" required></textarea><br><br>
    Từ khóa: <input type="text" name="tukhoa"><br><br>
    Nguồn tin: <input type="text" name="nguontin"><br><br>
    <button type="submit">Thêm bản tin</button>
</form>
