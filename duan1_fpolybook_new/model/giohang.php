<?php
    function themvaogiohang($id,$idsanpham,$idtaikhoan){
        $sql = "INSERT INTO giohang (`id`,`idtaikhoan`,`idsanpham`) VALUES ($id,$idtaikhoan,$idsanpham)";
        pdo_execute($sql);
    }
    function themchitietgiohang($idsanpham,$soluong,$idgiohang,$gia){
        $tongtien = $soluong*1*$gia;
        $sql = "INSERT INTO chitietgiohang (`masanpham`,`idvoucher`,`soluong`,`tongtien`,`magiohang`) VALUES ($idsanpham,1,$soluong,$tongtien,$idgiohang)";
        pdo_execute($sql);
    }
    function createmagiohang(){
        $chuoi = '0123456789'; // Chuỗi kí tự có sẵn
        $random = str_shuffle($chuoi);
        $giatri= substr($random, 0, 9);
        return $giatri;
   }
   function GioHang($idtaikhoan){
        $sql = "SELECT chitietgiohang.soluong as 'soluong',sanpham.giacu as 'giacu',sanpham.giamoi 
                as 'giamoi',sanpham.hinhanh as 'hinhanhsanpham',sanpham.tensanpham as 'tensanpham',sanpham.soluong as 'soluongspkho',sanpham.id as 'idsanpham'
                ,danhmuc.ten as 'danhmuc',
                chitietgiohang.soluong * sanpham.giamoi as 'tongtien',chitietgiohang.id as 'idchitietgiohang',giohang.id as 'idgiohang' 
                FROM giohang JOIN chitietgiohang ON giohang.id = chitietgiohang.magiohang JOIN sanpham ON giohang.idsanpham = sanpham.id
                 JOIN danhmuc ON sanpham.iddm = danhmuc.id WHERE giohang.idtaikhoan = $idtaikhoan;";
        $result = pdo_query($sql);
        return $result;
   }
   function GioHangCheckBox($idtaikhoan,$idsanpham){
       $sql = "SELECT chitietgiohang.soluong as 'soluong',sanpham.giacu as 'giacu',sanpham.giamoi 
               as 'giamoi',sanpham.hinhanh as 'hinhanhsanpham',sanpham.tensanpham as 'tensanpham',sanpham.soluong as 'soluongspkho',sanpham.id as 'idsanpham'
               ,danhmuc.ten as 'danhmuc',
               chitietgiohang.soluong * sanpham.giamoi as 'tongtien',chitietgiohang.id as 'idchitietgiohang',giohang.id as 'idgiohang' 
               FROM giohang JOIN chitietgiohang ON giohang.id = chitietgiohang.magiohang JOIN sanpham ON giohang.idsanpham = sanpham.id
                JOIN danhmuc ON sanpham.iddm = danhmuc.id WHERE giohang.idtaikhoan = $idtaikhoan AND sanpham.id = $idsanpham;";
       $result = pdo_query_one($sql);
       return $result;
  }
   function updateSoLuongGioHang($id,$soluong){
          $sql = "UPDATE chitietgiohang SET soluong = soluong+$soluong WHERE masanpham = $id";
          pdo_execute($sql);
   }
   
   function updateSLSanPhamToiDaGioHang($id,$soluong){
          $sql = "UPDATE chitietgiohang SET soluong = $soluong WHERE masanpham = $id";
          pdo_execute($sql);
   }
   function deleteChiTietGioHang($id){
        $sql = "DELETE FROM chitietgiohang WHERE id = $id";
        pdo_execute($sql);
   }
   function deleteGioHang($id){
        $sql = "DELETE FROM giohang WHERE id = $id";
        pdo_execute($sql);
   }
   function selectGioHangTaiKhoan($id){
          $sql = "SELECT * FROM giohang WHERE idtaikhoan = $id";
          $result = pdo_query($sql);
          return $result;
   }
   function deleteChiTietGioHang_TaiKhoan($magiohang){
          $sql = "DELETE FROM chitietgiohang WHERE magiohang = $magiohang";
          pdo_execute($sql);
   }
   function deleteGioHang_TaiKhoan($id){
          $sql = "DELETE FROM giohang WHERE id = $id";
          pdo_execute($sql);
   }
   function ChuoiIDGioHang($Chuoi){
          $ChuoiID = [];
          foreach($Chuoi as $chuoi1){
               $ChuoiID[] = $chuoi1;
          }
          return $ChuoiID;
   }
   function selectGioHangIDSanPham($id,$idtaikhoan){
       $sql = "SELECT * FROM giohang WHERE idsanpham = $id AND idtaikhoan = $idtaikhoan";
       $result = pdo_query_one($sql);
       return $result;
   }
?>