<?php
require_once("db_module.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $link = NULL;
    taoKetNoi($link);

    switch ($action) {
        case 'them_bantin':  // Câu g
            if (isset($_POST['tieude'])) {
                // Lấy id danh mục "Công nghệ"
                $q_dm = "SELECT id_danhmuc FROM tbl_danhmuc WHERE ten_danhmuc = 'Công nghệ' LIMIT 1";
                $res_dm = chayTruyVanTraVeDL($link, $q_dm);
                $row_dm = mysqli_fetch_assoc($res_dm);
                $id_danhmuc = $row_dm['id_danhmuc'];

                // Thêm bản tin
                $tieude = $_POST['tieude'];
                $hinhanh = $_POST['hinhanh'];
                $noidung = $_POST['noidung'];
                $tukhoa = $_POST['tukhoa'];

                $query = "INSERT INTO tbl_bantin (id_danhmuc, tieude, hinhanh, noidung, tukhoa, ngaydang, rating)
                          VALUES ('$id_danhmuc', '$tieude', '$hinhanh', '$noidung', '$tukhoa', NOW(), 0)";
                $result = chayTruyVanKhongTraVeDL($link, $query);

                header("Location: index.php?msg=" . ($result ? "them_bantin_done" : "them_bantin_fail"));
                exit;
            }
            break;

        case 'them_binhluan':  // Câu h
            if (isset($_POST['tieude']) && isset($_POST['email'])) {
                // Tìm id bài tin Galaxy S4
                $q_bt = "SELECT id_bantin FROM tbl_bantin WHERE tieude LIKE '%Galaxy S4%' LIMIT 1";
                $res_bt = chayTruyVanTraVeDL($link, $q_bt);
                $row_bt = mysqli_fetch_assoc($res_bt);
                $id_bantin = $row_bt['id_bantin'];

                // Tìm id_docgia theo email
                $email = $_POST['email'];
                $q_dg = "SELECT id_docgia FROM tbl_docgia WHERE email = '$email' LIMIT 1";
                $res_dg = chayTruyVanTraVeDL($link, $q_dg);
                $row_dg = mysqli_fetch_assoc($res_dg);
                $id_docgia = $row_dg['id_docgia'];

                // Thêm bình luận
                $tieude_bl = $_POST['tieude'];
                $noidung_bl = $_POST['noidung'];

                $query = "INSERT INTO tbl_binhluan (tieude, noidung, thoigian, id_bantin, id_docgia)
                          VALUES ('$tieude_bl', '$noidung_bl', NOW(), '$id_bantin', '$id_docgia')";
                $result = chayTruyVanKhongTraVeDL($link, $query);

                header("Location: index.php?msg=" . ($result ? "them_binhluan_done" : "them_binhluan_fail"));
                exit;
            }
            break;

        case 'capnhat_bantin':  // Câu i
            if (isset($_POST['noidung_moi'])) {
                $noidung_moi = $_POST['noidung_moi'];
                $query = "UPDATE tbl_bantin SET noidung = '$noidung_moi' WHERE id_bantin = 123";
                $result = chayTruyVanKhongTraVeDL($link, $query);

                header("Location: index.php?msg=" . ($result ? "capnhat_done" : "capnhat_fail"));
                exit;
            }
            break;

        default:
            echo "Action không hợp lệ!";
    }

    giaiPhongBoNho($link);
}
?>
