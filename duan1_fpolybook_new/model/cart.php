<?php

function loadone_donhang($id) {
    $sql="select * from donhang where id=".$id;
    $donhang=pdo_query_one($sql);
    return $donhang;
}

function loadone_chitietdonhang($iddonhang) {
    $sql="select * from chitietdonhang where iddonhang=".$iddonhang;
    $chitietdonhang=pdo_query($sql);
    return $chitietdonhang;
}

function loadall_donhang($kyw,$trangthaidonhang) {
    $sql="select * from donhang where 1";
    if($trangthaidonhang>0) {
        $ttdh = $trangthaidonhang - 1;
        $sql.=" AND trangthaidonhang=".$ttdh;
    }
    if($kyw!="") $sql.=" AND id like '%".$kyw."%'";
    $sql.=" order by id desc";
    $listdonhang=pdo_query($sql);
    return $listdonhang;
}

function loadall_thongke() {
    // lấy về danh mục theo tên sp, đếm xem bao nhiêu sp, giá lớn, giá bé, giá tb
    $sql="select danhmuc.id as madm, danhmuc.ten as tendm, count(sanpham.id) as countsp, min(sanpham.giamoi) as minprice, max(sanpham.giamoi) as maxprice, avg(sanpham.giamoi) as avgprice";
    // liên kết  
    $sql.=" from sanpham left join danhmuc on danhmuc.id=sanpham.iddm";
    // danh mục nào nhập sau thì lên trên
    $sql.=" group by danhmuc.id order by danhmuc.id desc";
    $listtk=pdo_query($sql);
    return $listtk;
}

function update_donhang($id,$diachinhanhang,$trangthaidh) {
    $sql = "update donhang set diachinhanhang='".$diachinhanhang."', trangthaidonhang='".$trangthaidh."' where id=".$id;
                    pdo_execute($sql);
}
?>