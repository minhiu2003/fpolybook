<?php
    function TaoDonHang($id,$diachinhanhang,$phivanchuyen,$ngaytaodonhang,$trangthaidonhang,$tongtien,$idkhachhang){
        $sql = "INSERT INTO donhang VALUES($id,'$diachinhanhang',$phivanchuyen,'$ngaytaodonhang','$trangthaidonhang',$tongtien,$idkhachhang)";
        pdo_execute($sql);
    }

    function TaoMaDonHang(){
        $chuoi = '0123456789'; 
        $random = str_shuffle($chuoi);
        $giatri= substr($random, 0, 9);
        return $giatri;
   }
   function TaoChiTietDonHang($id,$iddonhang,$idsanpham,$soluong){
        $sql = "INSERT INTO chitietdonhang VALUES($id,$iddonhang,$idsanpham,$soluong)";
        pdo_execute($sql); 
   }
   function selectChiTietDonHang(){
        $sql = "SELECT * FROM chitietdonhang WHERE 1";
        $result = pdo_query($sql);
        return $result;
   }

  function selectDonHang($id){
     $sql = "SELECT * FROM donhang WHERE idkhachhang = $id ORDER BY ngaytaodonhang DESC";
     $result = pdo_query($sql);
     return $result;
  }
  function HienThiDonHang($id,$idtaikhoan){
          $sql = "SELECT 
          chitietdonhang.soluong as 'soluong',sanpham.giamoi as 'giamoi',sanpham.giacu as 'giacu',chitietdonhang.soluong * 	    sanpham.giamoi as 'thanhtien',
          sanpham.tensanpham as 'tensanpham',sanpham.hinhanh,danhmuc.ten as 'danhmuc' FROM donhang JOIN chitietdonhang
          ON donhang.id = chitietdonhang.iddonhang JOIN sanpham ON chitietdonhang.idsanpham = sanpham.id JOIN danhmuc 
          ON sanpham.iddm = danhmuc.id WHERE donhang.idkhachhang = $idtaikhoan AND donhang.id = $id;";
          $result = pdo_query($sql);
          return $result;
  }
  function deleteDonHang($id){
     $sql = "DELETE FROM donhang WHERE id = $id";
     pdo_execute($sql);
  }
  function deleteChiTietDonHang($id){
     $sql = "DELETE FROM chitietdonhang WHERE iddonhang = $id";
     pdo_execute($sql);
  }
  function updateTrangThaiDonHang($id){
      $sql = "UPDATE donhang SET trangthaidonhang = 4 WHERE id = $id";
      pdo_execute($sql);
  }
  function thongke_dh($ngaybatdau,$ngayketthuc){
    $sql = "select count(id) as countdh, min(tongtien) as mintongtien, max(tongtien) as maxtongtien, avg(tongtien) as avgptongtien where 1";
    if($ngaybatdau != "") $sql.=" AND ngaytaodonhang >". $ngaybatdau ." AND ngaytaodonhang <". $ngayketthuc;
  }

?>