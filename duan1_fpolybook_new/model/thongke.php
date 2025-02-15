<?php

function thong_ke_doanh_thu_dm($ngaybatdau,$ngayketthuc){
    $sql = "SELECT danhmuc.ten, SUM(chitietdonhang.soluong*sanpham.giamoi) AS total_dh FROM chitietdonhang JOIN donhang ON chitietdonhang.iddonhang = donhang.id JOIN sanpham ON chitietdonhang.idsanpham = sanpham.id JOIN danhmuc ON sanpham.iddm = danhmuc.id WHERE donhang.trangthaidonhang != 4";
    if ($ngaybatdau != "" && $ngayketthuc != "") {
        $sql .= " AND donhang.ngaytaodonhang BETWEEN '". $ngaybatdau ."' AND '". $ngayketthuc . "'";
    }
    $sql .= " GROUP BY danhmuc.ten";
    return pdo_query($sql);
}

function thong_ke_doanh_thu_kh($ngaybatdau,$ngayketthuc){
    $sql = "SELECT taikhoan.ten, SUM(chitietdonhang.soluong*sanpham.giamoi) AS total_dh FROM chitietdonhang JOIN donhang ON chitietdonhang.iddonhang = donhang.id JOIN sanpham ON chitietdonhang.idsanpham = sanpham.id JOIN taikhoan ON donhang.idkhachhang = taikhoan.id WHERE donhang.trangthaidonhang != 4";
    if ($ngaybatdau != "" && $ngayketthuc != "") {
        $sql .= " AND donhang.ngaytaodonhang BETWEEN '". $ngaybatdau ."' AND '". $ngayketthuc . "'";
    }
    $sql .= " GROUP BY taikhoan.ten";
    return pdo_query($sql);
}

function thong_ke_doanh_thu_sp($ngaybatdau,$ngayketthuc){
    $sql = "SELECT sanpham.tensanpham, SUM(chitietdonhang.soluong*sanpham.giamoi) AS total_dh FROM chitietdonhang JOIN donhang ON chitietdonhang.iddonhang = donhang.id JOIN sanpham ON chitietdonhang.idsanpham = sanpham.id WHERE donhang.trangthaidonhang != 4";
    if ($ngaybatdau != "" && $ngayketthuc != "") {
        $sql .= " AND donhang.ngaytaodonhang BETWEEN '". $ngaybatdau ."' AND '". $ngayketthuc . "'";
    }
    $sql .= " GROUP BY sanpham.tensanpham";
    return pdo_query($sql);
}

function don_hang_thong_ke_home($ngaybatdau,$ngayketthuc){
    $sql = "SELECT COUNT(donhang.id) AS count_dh, SUM(chitietdonhang.soluong) AS total_dh, SUM(chitietdonhang.soluong*sanpham.giamoi) AS total_price, AVG(sanpham.giamoi) AS avg_price FROM donhang JOIN chitietdonhang ON donhang.id = chitietdonhang.iddonhang JOIN sanpham ON chitietdonhang.idsanpham = sanpham.id WHERE donhang.trangthaidonhang != 4";
    if ($ngaybatdau != "" && $ngayketthuc != "") {
        $sql .= " AND donhang.ngaytaodonhang BETWEEN '". $ngaybatdau ."' AND '". $ngayketthuc . "'";
    }
    return pdo_query_one($sql);
}
function thongke_count_donhang(){
    $sql = "SELECT COUNT(id) AS count_dh FROM donhang";
    return pdo_query_one($sql);
}
function thongke_count_sp(){
    $sql = "SELECT COUNT(id) AS count_sp FROM sanpham WHERE trangthai=0";
    return pdo_query_one($sql);
}
function thongke_count_tk(){
    $sql = "SELECT COUNT(id) AS count_tk FROM taikhoan WHERE trangthai=0";
    return pdo_query_one($sql);
}
function thongke_trangthai_donhang(){
    $sql = "SELECT (SELECT COUNT(id) FROM donhang WHERE trangthaidonhang = '0') AS so_donhang_choxacnhan, (SELECT COUNT(id) FROM donhang WHERE trangthaidonhang = '1') AS so_donhang_daxacnhan, (SELECT COUNT(id) FROM donhang WHERE trangthaidonhang = '2') AS so_donhang_danggiao, (SELECT COUNT(id) FROM donhang WHERE trangthaidonhang = '3') AS so_donhang_dagiao, (SELECT COUNT(id) FROM donhang WHERE trangthaidonhang = '4') AS so_donhang_dahuy";
    return pdo_query_one($sql);
}