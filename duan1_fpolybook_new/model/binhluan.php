<?php
function select_binhluan($idsanpham)
{
    $sql = "SELECT binhluan.*,taikhoan.img as 'imgtaikhoan',taikhoan.ten as 'tenhienthi'
         FROM binhluan JOIN taikhoan ON binhluan.idtaikhoan = taikhoan.id WHERE binhluan.trangthai = 1 AND idsanpham = $idsanpham";
    $result = pdo_query($sql);
    return $result;
}
// Hiển thị tất bình luận 

function binhluan($idnguoidung, $idsanpham, $noidung, $ngaybinhluan)
{
    $sql = "INSERT INTO binhluan (`idtaikhoan`,`idsanpham`,`noidung`,`ngaybinhluan`,`trangthai`) 
        VALUES('$idnguoidung','$idsanpham','$noidung','$ngaybinhluan',1)";
    pdo_execute($sql);
}
// Người dùng bình luận
// nhập bình luận sau đó nó sẽ insert (chèn) vào database

// Hiển thị tất cả bình luận
function loadall_binhluan($kywbl)
{
    $sql = "select * from binhluan where 1";

    if ($kywbl != "") {
        $sql .= " AND noidung like '%" . $kywbl . "%'";
    }
    $sql .= " order by id desc";
    $listbl = pdo_query($sql);
    return $listbl;
    
}

function loadall_binhluan_admin()
{
    $sql = 'select * from binhluan order by id asc';
    $result = pdo_query($sql);
    return $result;
}

// xóa binhl uận 
function delete_binhluan_tk($id)
{
    $sql = "delete from binhluan where idtaikhoan=" . $id;
    pdo_execute($sql);
}
function delete_binhluan($id)
{
    $sql = "delete from binhluan where id=" . $id;
    pdo_execute($sql);
}

function soft_delete_bl($id)
{
    $sql = "UPDATE `binhluan` SET `trangthai` = 0 WHERE `binhluan`.`id` = $id";
    pdo_execute($sql);
}

function hienbl($id)
{
    $sql = "UPDATE `binhluan` SET `trangthai` = 1 WHERE `binhluan`.`id` = $id";
    pdo_execute($sql);
}