<?php
   if(isset($_SESSION["id_taikhoan"])){
        $mangDonHang = selectDonHang($_SESSION["id_taikhoan"]);
        
   }else{
        echo '<script>document.location = "home.php" </script>';
   }
   if(isset($_POST["huydonhang"])){
        $ID = $_POST["iddonhang"];
        updateTrangThaiDonHang($ID);
        echo "<script>alert('Đã hủy đơn hàng');</script>";
        echo '<script>document.location = "home.php?act=donhang" </script>';
   }
?>

<div class="app__container container__giohang ">
            <div class="grid">
                <div class="grid__row app__content">
                    <div class="grid__column-2">
                        <nav class="category">
                            <h3 class="category__heading">
                                <i class="category__heading-icon fa-solid fa-list"></i>
                                 Danh mục
                            </h3>
                            <ul class="category-list">
                                <li class="category-item ">
                                    <a href="home.php?act=giohang" class="catogery-item__link">
                                       Giỏ hàng
                                    </a>
                                </li>
                                <li class="category-item ">
                                    <a href="home.php?act=donhang" class="catogery-item__link">
                                       Đơn hàng
                                    </a>
                                </li>
                               
                            </ul>
                        </nav>
                    </div>
                    <div class="grid__column-10">
                        <div class="home-filter">
                            <p class="home-filter__giohang">Đơn hàng</p>
                            </div>
                            <?php foreach($mangDonHang as $DonHang):
                                    if($DonHang["trangthaidonhang"] == 0){
                                        $TrangThaiDonHang = "Chờ xác nhận";
                                    }elseif($DonHang["trangthaidonhang"] == 1){
                                        $TrangThaiDonHang = "Đã xác nhận";
                                    }elseif($DonHang["trangthaidonhang"] == 2){
                                        $TrangThaiDonHang = "Đang giao";
                                    }elseif($DonHang["trangthaidonhang"] == 3){
                                        $TrangThaiDonHang = "Đã giao";
                                    }else{
                                        $TrangThaiDonHang = "Đã hủy";
                                    }
                                    $mangSanPham = HienThiDonHang($DonHang["id"],$_SESSION["id_taikhoan"]);
                                    $tongtien = 0;
                                    $soKiTu = 30;
                                        $nguong = 36;
                                        if (strlen($DonHang["diachinhanhang"]) > $nguong) {
                                            $chuoiMoi = substr($DonHang["diachinhanhang"], 0, $soKiTu) . '...';
                                        } else {
                                            $chuoiMoi = $DonHang["diachinhanhang"];
                                        }
                                ?>
                            <div class="home-card" style="background-color: var(--white-color);">
                            <div class="home-card-id-order">
                                <p class="home-card-id-order-text">Đơn hàng : <span class="home-card-id-order-text-id"><?=$DonHang["id"]?></span></p>
                                <p class="home-card-id-order-text">Phí vận chuyển : <span class="home-card-id-order-text-id"><?=$DonHang["phivanchuyen"]?>đ</span></p>
                                    <p class="home-card-id-day home-card-address">Địa chỉ giao hàng : <span class="home-card-id-day-a"><?=$chuoiMoi?></span></p>
                                <p class="home-card-id-day">Ngày tạo đơn : <span class="home-card-id-day-a"><?=$DonHang["ngaytaodonhang"]?></span></p>
                            </div>
                                <ul class="home-card-list home-card-list-donhang">
                                    <?php foreach($mangSanPham as $SanPham): 
                                        $tongtien += $SanPham["thanhtien"];
                                        ?>
                                    <li class="home-card-item">
                                        <div class="home-card-item-img">
                                            <img src="../assets/img_product/<?=$SanPham["hinhanh"]?>" alt="" class="home-card-item-image">
                                        </div>
                                        <div class="home-card-item-name"><p class="home-card-item-name-text"><?=$SanPham["tensanpham"]?></p></div>
                                        <div class="home-card-item-danhmuc"><p class="home-card-item-danhmuc-text"><?=$SanPham["danhmuc"]?></p></div>
                                        <div class="home-card-item-price">
                                            <div class="home-card-item-price-old"><p class="home-card-item-price-old-text"><?=$SanPham["giacu"]?>đ</p></div>
                                            <div class="home-card-item-price-new"><p class="home-card-item-price-old-text"><?=$SanPham["giamoi"]?>đ</p></div>
                                        </div>
                                        <div class="home-card-item-quantity">
                                            <p class="home-card-item-quantity-number">Số lượng:</p>
                                            <input style="border: none;" readonly class="home-card-item-quantity-input" min="1" max="10" type="number" value="<?=$SanPham["soluong"]?>">
                                        </div>
                                        <div class="home-card-item-thanhtien">
                                            <p class="home-card-item-thanhtien-text">Thành tiền : <span class="home-card-item-thanhtien-number"><?=$SanPham["thanhtien"]?>đ</span></p>
                                        </div>
                                    </li>
                                   <?php endforeach; ?>
                                </ul>   
                                
                                <div class="home-card-order">
                                    <div class="home-card-order-trangthai"><p class="home-card-order-trangthai-text">Trạng thái : <span style="color:<?=$TrangThaiDonHang != "Đã hủy"?' rgb(1, 121, 17)':"red"?>;" class="home-card-order-trangthai-text-a"><?=$TrangThaiDonHang?></span></p></div>
                                    <form action="" method="POST">
                                        <input type="text" hidden readonly value="<?=$DonHang["id"]?>" name="iddonhang" id="">
                                    <button type="submit" name="huydonhang" onclick="return confirm(`Bạn có chắc muốn hủy đơn hàng không?`)" style="display: <?=$TrangThaiDonHang != 'Chờ xác nhận'?'none':'block';?>;" class="btn btn--primary">Hủy đơn hàng</button>
                                    </form>
                                    
                                    <div class="home-card-order-tongtien"><p class="home-card-order-tongtien-text">Tổng tiền thanh toán: <span class="home-card-order-tongtien-number"><?=$tongtien+$DonHang["phivanchuyen"]?>đ</span></p></div>
                                </div>
                            </div>
                          <?php endforeach; ?>
                           
                        </div>
                        
                        
                    </div>
                </div>
            </div>