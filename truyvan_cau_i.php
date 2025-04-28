<?php
require_once("db_module.php");
$link = NULL;
taoKetNoi($link);

// Hàm cập nhật bài viết trong PHP
function updateNewsContent($link, $id_bantin, $noidung_moi) {
    // Kiểm tra bài viết có tồn tại không
    $check_sql = "SELECT 1 FROM tbl_bantin WHERE id_bantin = '$id_bantin'";
    $rs_check = mysqli_query($link, $check_sql);

    if (mysqli_num_rows($rs_check) == 0) {
        return "⚠️ Không tìm thấy bài viết với ID = $id_bantin!";
    }

    // Nếu có bài viết, tiến hành UPDATE
    $update_sql = "UPDATE tbl_bantin
                   SET noidung = N'$noidung_moi'
                   WHERE id_bantin = '$id_bantin'";

    if (mysqli_query($link, $update_sql)) {
        return "✅ Cập nhật bài viết ID = $id_bantin thành công!";
    } else {
        return "❌ Cập nhật thất bại!";
    }
}

// Nếu submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bantin = $_POST['id_bantin'];
    $noidung_moi = $_POST['noidung_moi'];

    $message = updateNewsContent($link, $id_bantin, $noidung_moi);
    echo "<h3>$message</h3>";
}

// Luôn hiển thị danh sách bài viết
$select = "SELECT id_bantin, tieude, noidung FROM tbl_bantin ORDER BY id_bantin ASC";
$rs = chayTruyVanTraVeDL($link, $select);

echo "<h3>📄 Danh sách tất cả bài viết:</h3>";

if (mysqli_num_rows($rs) > 0) {
    echo "<div style='max-height: 500px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;'>";
    echo "<table border='1' cellpadding='5' cellspacing='0' style='width:100%;'>";
    echo "<tr>
            <th>ID Bản Tin</th>
            <th>Tiêu Đề</th>
            <th>Nội Dung</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($rs)) {
        echo "<tr>
                <td>{$row['id_bantin']}</td>
                <td>{$row['tieude']}</td>
                <td>{$row['noidung']}</td>
              </tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>Không có bài viết nào.</p>";
}

giaiPhongBoNho($link, $rs);
?>

<!-- Form nhập nội dung mới -->
<h2>✏️ Cập nhật nội dung bài viết (Dùng Function PHP)</h2>
<form method="post">
    ID Bản Tin cần cập nhật: <input type="number" name="id_bantin" required><br><br>
    Nội dung mới: <br>
    <textarea name="noidung_moi" rows="6" cols="80" required></textarea><br><br>
    <button type="submit">Cập nhật bài viết</button>
</form>
