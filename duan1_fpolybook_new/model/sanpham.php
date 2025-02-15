<?php
function SanPham()
{
    $sql = "SELECT * FROM sanpham";
    $result = pdo_query($sql);
    return $result;
}
function load_one_sanpham($id)
{
    $sql = "SELECT * FROM sanpham WHERE id = $id";
    $result = pdo_query_one($sql);
    return $result;
}
//Load 1 sản phẩm
function load_10_sanpham($itemPage, $offSet)
{
    $sql = "SELECT * FROM sanpham WHERE soluong > 0 ORDER BY id DESC LIMIT $itemPage OFFSET $offSet";
    $result = pdo_query($sql);
    return $result;
}
//Load 10 sản phẩm
function load_sanpham_theo_danhmuc($id, $sapxep)
{
    if ($sapxep != "" && $sapxep == "tang") {
        $sql = "SELECT * FROM sanpham WHERE iddm = $id AND soluong > 0 ORDER BY giamoi ASC LIMIT 0,10 ";
    } elseif ($sapxep != "" && $sapxep == "giam") {
        $sql = "SELECT * FROM sanpham WHERE iddm = $id AND soluong > 0 ORDER BY giamoi DESC LIMIT 0,10 ";
    } else {
        $sql = "SELECT * FROM sanpham WHERE iddm = $id AND soluong > 0 ORDER BY id DESC LIMIT 0,10 ";
    }
    $result = pdo_query($sql);
    return $result;
}
//Load sản phẩm theo danh mục
function load_sanpham_phobien()
{
    $sql = "SELECT * FROM sanpham WHERE soluong > 0 ORDER BY luotxem DESC LIMIT 0,10 ";
    $result = pdo_query($sql);
    return $result;
}
//Load sản phẩm theo lượt xem
function load_chitiet_sanpham($id)
{
    $sql = "SELECT a.*,b.ten as 'tendanhmuc' FROM sanpham a JOIN danhmuc b ON a.iddm = b.id WHERE a.id = $id";
    $result = pdo_query_one($sql);
    return $result;
}
//Load thông tin chi tiết sản phẩm
function sapxep_giacao()
{
    $sql = "SELECT * FROM sanpham WHERE soluong > 0 ORDER BY giamoi ASC LIMIT 0,10 ";
    $result = pdo_query($sql);
    return $result;
}
// Hiển thị sản phẩm theo giá cao đến thấp
function sapxep_giathap()
{
    $sql = "SELECT * FROM sanpham WHERE soluong > 0 ORDER BY giamoi DESC LIMIT 0,10  ";
    $result = pdo_query($sql);
    return $result;
}
// Hiển thị sản phẩm theo gía thấp đến cao
function loadSanPhamCungLoai($id, $iddm)
{
    $sql = "SELECT * FROM sanpham WHERE id <> $id AND iddm = $iddm AND soluong > 0 ORDER BY luotxem DESC LIMIT 0,10 ";
    $result = pdo_query($sql);
    return $result;
}
//Load các sản phẩm cùng loại
function luotxem($id)
{
    $sql = "UPDATE sanpham SET luotxem = luotxem+1 WHERE id = $id";
    pdo_execute($sql);
}
// Hàm thêm lượt xem sau khi click
function updateSoLuong($id, $soluong)
{
    $sql = "UPDATE sanpham SET soluong = soluong-$soluong WHERE id = $id";
    pdo_execute($sql);
}

function issert_sanpham($tensanpham, $giamoi, $giacu, $nxb, $mota, $soluong, $hinh, $iddm)
{
    $sql = "insert into sanpham(tensanpham,giamoi,giacu,nhaxuatban,mota,soluong,hinhanh,iddm) values('$tensanpham', '$giamoi', '$giacu', '$nxb', '$mota', '$soluong', '$hinh', '$iddm' )";
    pdo_execute($sql);
}

// load toàn bộ list sản phẩm
function loadall_sanpham($kyw, $iddm = 0)
{
    $sql = "select * from sanpham where 1 ";
    if ($kyw != "") {
        $sql .= " and tensanpham like '%" . $kyw . "%'";
    }
    if ($iddm > 0) {
        $sql .= " and iddm = '" . $iddm . "'";
    }
    $sql .= " order by tensanpham";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

// load tên danh mục
function load_ten_dm($iddm)
{
    // nếu dm > 0 thì thực hiện câu lệnh, ngược lại rỗng
    if ($iddm > 0) {
        $sql = "select * from danhmuc where id=" . $iddm;
        $dm = pdo_query_one($sql);
        extract($dm);
        return $ten;
    } else {
        return "";
    }
}

function loadone_sanpham($id)
{
    $sql = "select * from sanpham where id=" . $id;
    $sp = pdo_query_one($sql);
    return $sp;
}

// sản phẩm cùng loại
function load_sanpham_cungloai($id, $iddm)
{
    $sql = "select * from sanpham where iddm=" . $iddm . " AND id <>" . $id;
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}


// cập nhật
function update_sanpham($tensanpham, $giamoi, $giacu, $nxb, $mota, $soluong, $hinh, $iddm, $id)
{
    if ($hinh != "")
        $sql = "update sanpham set iddm='" . $iddm . "', tensanpham='" . $tensanpham . "', giamoi='" . $giamoi . "', giacu='" . $giacu . "', nhaxuatban='" . $nxb . "', mota='" . $mota . "', soluong='" . $soluong . "', hinhanh='" . $hinh . "' where id=" . $id;
    else
        $sql = "update sanpham set iddm='" . $iddm . "', tensanpham='" . $tensanpham . "', giamoi='" . $giamoi . "', giacu='" . $giacu . "', nhaxuatban='" . $nxb . "', mota='" . $mota . "', soluong='" . $soluong . "' where id=" . $id;
    pdo_execute($sql);
}

function doitrangthaisp($id, $trangthai)
{
    if ($trangthai == 1) {
        $sql = "update sanpham set trangthai='0' where id=" . $id;
    } elseif ($trangthai == 0) {
        $sql = "update sanpham set trangthai='1' where id=" . $id;
    }
    pdo_execute($sql);
}

function checksanpham($tensanpham)
{
    $sql = "SELECT * FROM taikhoan WHERE tentaikhoan = '$tensanpham'";
    $sp = pdo_query_one($sql);
    return $sp;
}

?>