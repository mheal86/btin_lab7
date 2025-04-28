<?php
require_once("db_module.php");
$link = NULL;
taoKetNoi($link);

// Nếu có submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_binhluan = $_POST['id_binhluan'];
    $noidung_bl = $_POST['noidung_bl'];
    $id_docgia = $_POST['id_docgia'];
    $tieude = $_POST['tieude'];

    // Tìm id_bantin dựa trên tên bài viết
    $query_find = "SELECT id_bantin FROM tbl_bantin WHERE tieude LIKE N'%$tieude%' LIMIT 1";
    $rs_find = chayTruyVanTraVeDL($link, $query_find);
    $row_find = mysqli_fetch_assoc($rs_find);

    if ($row_find) {
        $id_bantin = $row_find['id_bantin'];

        // Chèn bình luận mới
        $query_insert = "INSERT INTO tbl_binhluan (id_binhluan, noidung, id_bantin, id_docgia, thoigian)
                         VALUES ('$id_binhluan', N'$noidung_bl', '$id_bantin', '$id_docgia', NOW())";

        $result = chayTruyVanKhongTraVeDL($link, $query_insert);

        if ($result) {
            echo "<h3>✅ Thêm bình luận thành công!</h3>";
        } else {
            echo "<h3>❌ Thêm bình luận thất bại! (Có thể ID bình luận đã tồn tại)</h3>";
        }

    } else {
        echo "<h3> Không tìm thấy bài viết có tiêu đề như vậy!</h3>";
    }
}

// Luôn SELECT tất cả bình luận kèm tên bài viết
$select = "SELECT 
              bl.id_binhluan,
              bl.noidung,
              b.tieude,
              bl.id_docgia,
              bl.thoigian
           FROM tbl_binhluan bl
           JOIN tbl_bantin b ON bl.id_bantin = b.id_bantin
           ORDER BY bl.thoigian DESC";

$rs = chayTruyVanTraVeDL($link, $select);

echo "<h3>Danh sách bình luận:</h3>";

if (mysqli_num_rows($rs) > 0) {
    echo "<div style='max-height: 500px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;'>";
    echo "<table border='1' cellpadding='5' cellspacing='0' style='width:100%;'>";
    echo "<tr>
            <th>ID Bình Luận</th>
            <th>Nội Dung</th>
            <th>Tiêu Đề Bản Tin</th>
            <th>ID Độc Giả</th>
            <th>Thời Gian</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($rs)) {
        echo "<tr>
                <td>{$row['id_binhluan']}</td>
                <td>{$row['noidung']}</td>
                <td>{$row['tieude']}</td>
                <td>{$row['id_docgia']}</td>
                <td>{$row['thoigian']}</td>
              </tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>Chưa có bình luận nào.</p>";
}

giaiPhongBoNho($link, $rs);
?>

<!-- Form nhập bình luận -->
<h2>➕ Thêm bình luận mới</h2>
<form method="post">
    ID Bình luận: <input type="number" name="id_binhluan" required><br><br>
    Nội dung bình luận: <textarea name="noidung_bl" rows="5" cols="50" required></textarea><br><br>
    ID Độc giả: <input type="number" name="id_docgia" required><br><br>
    Tiêu đề bài viết (hoặc từ khóa): <input type="text" name="tieude" required><br><br>
    <button type="submit">Thêm bình luận</button>
</form>
