<?php 
    

    $information = load_chitiet_sanpham($_GET["id"]);
    $loadSanPhamCungLoai = loadSanPhamCungLoai($_GET["id"],$information["iddm"]);
    $allCMT = select_binhluan($_GET["id"]);
    $hinhanh = $img_path.$information["hinhanh"];
    $idProduct = $_GET["id"];
    
    if(isset($_SESSION["id_taikhoan"])){
        $listGioHang = GioHang($_SESSION["id_taikhoan"]);
        $idAccount = $_SESSION["id_taikhoan"];
        // Giỏ hàng
        $InfAccount = select_taikhoan($_SESSION["id_taikhoan"]);
        if(isset($_POST["themgiohang"])){
            
            $idGioHang = createmagiohang();
            $soLuongSanPham = $_POST["soluongsanpham"];
            $giaSanPham = $_POST["giasanpham"];
            foreach($listGioHang as $key){
                $mangIDSanPham[] = $key["idsanpham"];
            }
            if(isset($mangIDSanPham) && in_array($idProduct,$mangIDSanPham)){
                updateSoLuongGioHang($idProduct,$soLuongSanPham);
                echo '<script> document.location = "home.php?act=chitietsanpham&id='.$idProduct.'"; </script>';
            }else{
                themvaogiohang($idGioHang,$idProduct,$idAccount);
                themchitietgiohang($idProduct,$soLuongSanPham,$idGioHang,$giaSanPham);
                echo '<script> document.location = "home.php?act=chitietsanpham&id='.$idProduct.'"; </script>';
            }
            foreach($listGioHang as $key){
                if($key["soluong"] >= $information["soluong"]){
                    updateSLSanPhamToiDaGioHang($idProduct,$information["soluong"]);
                }
            }
            
        }

        if(isset($_POST["muangay"])){
            $maDonHang = TaoMaDonHang();
            $ngayTaoDonHang = date("Y-m-d");
            $trangThai = 1;
            $fullChiTietDonHang = selectChiTietDonHang();
            $idChiTietDonHang_End = end($fullChiTietDonHang);
            $giaSanPham = $_POST["giasanpham"];
            $idSanPham = $_GET["id"];
            $soLuongSanPham = $_POST["soluongsanpham"];
            
            if(!$fullChiTietDonHang){
                $idChiTietDonHang = 1; 
                // echo '<script>alert("'.$idChiTietDonHang.'")</script>';
                // echo '<script>alert("'.$ngayTaoDonHang.'")</script>';
                // echo '<script>alert("'.$trangThai.'")</script>';
            }else{
                $idChiTietDonHang = $idChiTietDonHang_End["id"] + 1;
            }
            
            TaoDonHang($maDonHang,$InfAccount["diachi"],10000,$ngayTaoDonHang,$trangThai,$giaSanPham,$_SESSION["id_taikhoan"]);
            TaoChiTietDonHang($idChiTietDonHang,$maDonHang,$idSanPham,$soLuongSanPham);
            updateSoLuong($idProduct,$soLuongSanPham);
            echo '<script>alert("Đã tạo đơn hàng thành công.Hãy đợi admin xác nhận nhé ^^");</script>';
            echo '<script> document.location = "home.php?act=donhang"; </script>';
        }
    }
   
    if(isset($idProduct)){
        luotxem($idProduct);
    }
    if(isset($_POST["comment"])){
        $ValidCMT = [];
        $content = $_POST["content"];
        if(empty($content)){
            $ValidCMT["content"] = "Bạn chưa nhập bình luận";
        }
        if(!$ValidCMT){
            $ngayBinhLuan = date("Y-m-d");
            binhluan($idAccount,$idProduct,$content,$ngayBinhLuan);
            echo '<script>document.location = "home.php?act=chitietsanpham&id='.$idProduct.'"</script>';
        }
    }
?>

<div class="app__container ">
         <div class="grid infor-flex" id="inforpd">
            <div class="grid__column-3">
                <div class="infor-product-left">
                    <div class="infor-product-left__item">
                        <img src="<?=$hinhanh?>" alt="" class="infor-product-left__img">
                    </div>
                </div>
            </div>
            <div class="grid__column-9">
                <div class="infor-product-right">
                <form action="" method="POST">
                
                        <h3 class="infor-product-right__name">
                            <?=$information["tensanpham"]?>
                        </h3>
                        <div class="infor-product__right-price-old">
                            <h4 class="infor-product__right-price-number"><?=$information["giacu"]?></h4>
                        </div>
                        <div class="infor-product__right-price">
                            <h4 class="infor-product__right-price-number"><?=$information["giamoi"]?></h4>
                        </div>
                        <div class="infor-product__right-quantity">
                            <span class="infor-product__right-quantity-number">Số lượng:</span>
                            <input style="padding-left: 8px;" class="" type="number" name="soluongsanpham" value="1"  min="1" max="<?=$information["soluong"]-1?>">
                            <span class="infor-product__right-sanphamcosan"><?=$information["soluong"]?> sản phẩm có sẵn</span>
                        </div>
                        <div class="infor-product__right-btn">
                           
                           <input type="text" name="giasanpham" hidden value="<?=$information["giamoi"]?>" id="">
                            <?php
                                if(isset($_SESSION["id_taikhoan"])){
                                    echo '<button name="themgiohang" type="submit" class="infor-product__right-btn-add">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    Thêm vào giỏ hàng
                                </button>';
                                }else{
                                    echo '<a href="home.php?act=login" class="infor-product__right-btn-add" style="text-decoration: none;"><i class="fa-solid fa-cart-plus"></i>
                                    Thêm vào giỏ hàng</a>';
                                }
                            ?>
                            <?php 
                                if(isset($_SESSION["id_taikhoan"])){
                                    echo '<button type="submit" onclick="return confirm(`Bạn có chắc muốn mua món đồ này không?Thông tin giao hàng sẽ được dựa trên thông tin tài khoản của bạn`)" name="muangay" class="infor-product__right-btn-buy">Mua ngay</button>';
                                }else{
                                    echo '<a href="home.php?act=login" class="infor-product__right-btn-buy infor-product__right-btn-buy-link">Mua ngay</a>';
                                }

                            ?>
                            
                            
                            </form>
                        </div>

                    
                </div>
            </div>
         </div>
         <div class="grid container__ctsp">
            <div class="container__ctsp-title">
                <p class="container__ctsp-title-text">Chi tiết sản phẩm</p>
            </div>
            <ul class="container__ctsp-list">
                <li class="container__ctsp-list-item">
                    Danh mục : <span class="container__ctsp-list-item-primary"><?=$information["tendanhmuc"]?></span>
                </li>
                <li class="container__ctsp-list-item">
                    Nhà xuất bản : <span class="container__ctsp-list-item-primary"><?=$information["nhaxuatban"]?></span>
                </li>
                <li class="container__ctsp-list-item">
                    Số lượng : <span class="container__ctsp-list-item-primary"><?=$information["soluong"]?></span>
                </li>
                <li class="container__ctsp-list-item container__ctsp-list-item-mota">
                    Mô tả : <span class="container__ctsp-list-item-primary "><?=$information["mota"]?></span>
                </li>
            </ul>
         </div>
         <div class="grid container__ctsp">
            <div class="container__ctsp-title">
                <p class="container__ctsp-title-text">Bình luận</p>
                <form action="" class="form__comments" method="POST">
                    <input class="form__comments-input" name="content" type="text" placeholder="Nhập bình luận" autocomplete="off" name="" id="">
                    
                    <?php 
                        if(isset($_SESSION["id_taikhoan"])){
                            echo '<button type="submit" name="comment" class="btn form__comments-btn">Gửi bình luận</button>';
                        }else{
                            echo '<a href="home.php?act=login"class="btn form__comments-btn">Gửi bình luận</a>';
                        }
                        ?>
                    
                </form>
            </div>
            <ul class="container__ctsp-list-comments">
                <?php foreach($allCMT as $CMT): ?>
                <li class="container__ctsp-comment">
                    <div class="container__ctsp-comment-user">
                        <div class="container__ctsp-comment-user-img">
                            <img src="../assets/img_user/<?=$CMT["imgtaikhoan"]!=""?$CMT["imgtaikhoan"]:"default.jpg"?>" alt="" class="container__ctsp-comment-user-image">
                        </div>
                        <div class="container__ctsp-user-name_time">
                            <p class="container__ctsp-comment-user-name"><?=$CMT["tenhienthi"]?></p>
                        <p class="container__ctsp-comment-time"><?=$CMT["ngaybinhluan"]?></p>
                        </div>
                    </div>
                    <p class="container__ctsp-comment-user-content"><?=$CMT["noidung"]?></p>
                </li>
                <?php endforeach; ?>
            </ul>
         </div>
         <div class="grid container__ctsp">
            <div class="container__ctsp-heading"><h3 class="container__ctsp-heading">Sản phẩm cùng loại</h3></div>
            <div class="grid__row">
                <div class=" flex-same_product">
                    <?php 
                    foreach($loadSanPhamCungLoai as $SPCUNGLOAI):
                                        $tinhphantram = ($SPCUNGLOAI["giacu"] - $SPCUNGLOAI["giamoi"])/$SPCUNGLOAI["giacu"]*100;
                                        $phamtramgiamgia = intval($tinhphantram);
                                        $chuoiten_nxb = $SPCUNGLOAI["nhaxuatban"];
                                        $soKiTu = 6;
                                        $nguong = 10;
                                        if (strlen($chuoiten_nxb) > $nguong) {
                                            $chuoiMoi = substr($chuoiten_nxb, 0, $soKiTu) . '...';
                                        } else {
                                            $chuoiMoi = $chuoiten_nxb;
                                        }
                    ?>
                    <div class="grid__column-2-4" style="min-width: 224px;">
                        <a href="home.php?act=chitietsanpham&id=<?=$SPCUNGLOAI["id"]?>" class="home-product-item" >
                            <div class="home-product-item__img" style="background-image: url(../assets/img_product/<?=$SPCUNGLOAI["hinhanh"]?>);"></div>
                            <h4 class="home-product-item__name"><?=$SPCUNGLOAI["tensanpham"]?></h4>
                            <div class="home-product-item__price">
                                <span class="home-product-item__price-old"><?=$SPCUNGLOAI["giacu"]?></span>
                                <span class="home-product-item__price-current"><?=$SPCUNGLOAI["giamoi"]?></span>

                            </div>
                            <div class="home-product-item__action">
                                <span class="home-product-item__like home-product-item__liked">
                                    <i class="home-product-item__like-icon-isset fa-solid fa-heart"></i> 
                                    <i class="home-product-item__like-icon-empty fa-regular fa-heart"></i>
                                </span>
                                <!-- <div class="home-product-item__rating">
                                    <i class="home-product-item__rating-yellow fa-solid fa-star"></i>
                                    <i class="home-product-item__rating-yellow fa-solid fa-star"></i>
                                    <i class="home-product-item__rating-yellow fa-solid fa-star"></i>
                                    <i class="home-product-item__rating-yellow fa-solid fa-star"></i>
                                    <i class=" fa-solid fa-star"></i>
                                </div> -->
                                
                            </div>
                            <div class="home-product-item__origin">
                                <span class="home-product-item__brand">Số lượng:<?=$SPCUNGLOAI["soluong"]?></span>
                                <span class="home-product-item__origin-name"><?=$chuoiMoi?></span>
                            </div>
                            
                            <div class="home-product-item__sale-off">
                                <div class="home-product-item__sale-off-percent"><?=$phamtramgiamgia?>%</div>
                                <span class="home-product-item__sale-off-label">Giảm</span>
                            </div>
                        </a>
                    </div>
                    
                   <?php endforeach; ?>
                </div>
            </div>

         </div>
        </div>