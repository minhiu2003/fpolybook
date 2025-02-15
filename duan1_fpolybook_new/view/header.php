<?php
    if(isset($_SESSION["id_taikhoan"])){
        $inForAccount = select_taikhoan($_SESSION["id_taikhoan"]);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php 
        $title = "Fpoly-Book";
        $danhmuc_header =load_all_danhmuc();
        if(isset($_SESSION["id_taikhoan"])){
        
            if(isset($_GET["act"]) && ($_GET["act"] == $tentaikhoan)){
                $title = "Thông tin của bạn";
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "danhmuc")){
                foreach($danhmuc_header as $danhmuc):
                if(isset($_GET["act"]) && ($_GET["id"] == $danhmuc["id"])){
                    $title = $danhmuc["ten"];
                    break;
                }
            endforeach;
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "chitietsanpham")){
                    $sanpham = load_one_sanpham($_GET["id"]);
                    $title = $sanpham["tensanpham"];
                
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "phobien")){
                    $title = "Phổ biến";
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "gia_thap-cao")){
                $title = "Sắp xếp giá thấp đến cao";
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "gia_cao-thap")){
                $title = "Sắp xếp giá cao đến thấp";
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "doimatkhau")){
                $title = "Cài đặt mật khẩu";
            }else{
                $title = "Fpoly-Book";
            }
        }else{
            if(isset($_GET["act"]) && ($_GET["act"] == "danhmuc")){
                foreach($danhmuc_header as $danhmuc):
                if(isset($_GET["act"]) && ($_GET["id"] == $danhmuc["id"])){
                    $title = $danhmuc["ten"];
                    break;
                }
            endforeach;
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "chitietsanpham")){
                    $sanpham = load_one_sanpham($_GET["id"]);
                    $title = $sanpham["tensanpham"];
                
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "phobien")){
                    $title = "Phổ biến";
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "gia_thap-cao")){
                $title = "Sắp xếp giá thấp đến cao";
            }elseif(isset($_GET["act"]) && ($_GET["act"] == "gia_cao-thap")){
                $title = "Sắp xếp giá cao đến thấp";
            }else{
                $title = "Fpoly-Book";
            }
        }
        echo $title;
       
    ?>
    </title>
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/test.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <!-- Fontawe -->
    <link rel="stylesheet" href="../assets/css/fontawesome-free-6.4.2-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-free-6.4.2-web/js/all.min.js">
    <!-- roboto font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- boostrap -->
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="grid ">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <!-- <li class="header__navbar-item--has-qr header__navbar-item header__navbar-item-separate">
                            Vào cửa hàng trên ứng dụng Luong viết
                            <div class="header__qr">
                                <img src="../assets/img/QR.png" alt="QR CODE" class="header__qr-img">
                                <div class="header__qr-apps">
                                    <a class="header__qr-link" href="">
                                        <img src="../assets/img/Google_play.png" alt="" class="header__qr-dowload-img">
                                    </a>
                                    <a class="header__qr-link" href="">
                                        <img src="../assets/img/app_store.png" alt="" class="header__qr-dowload-img">
                                    </a>
                                </div>
                            </div>
                        </li> -->
                        <li class="header__navbar-item">
                            <span class="header__item-title--no-pointer">Kết nối</span>
                            <a href="" class="header__navbar-icon-link">
                                <i title="Facebook" class="header__navbar-icon fa-brands fa-facebook"></i>
                            </a>
                            
                            <a href="" class="header__navbar-icon-link">
                                <i title="Instagram" class="header__navbar-icon fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
    
                    <ul class="header__navbar-list">
                        <!-- <li class="header__navbar-item  header__navbar--item-has-notify">
                            <a href="" class="header__navbar-item-link ">
                                <i class="header__navbar-icon fa-solid fa-bell"></i>
                                Thông báo
                            </a>
                            <div class="header__notify">
                                <header class="header__notify-header">
                                    <h3>Thông báo mới nhận</h3>
                                </header>
                                    <ul class="header__notify-list">
                                        <li class="header__notify-item header__notify-item--viewed">
                                            <a href="" class="header__notify-link">
                                                <span><img src="../assets/img/avtgithub.png" alt="" class="header__notify-img"></span>
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Mỹ phẩm ohui chính hãng</span>
                                                    <span class="header__notify-descriotion">Mô tả sản phẩm</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="header__notify-item header__notify-item--viewed">
                                            <a href="" class="header__notify-link">
                                                <span><img src="../assets/img/avtgithub.png" alt="" class="header__notify-img"></span>
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Mỹ phẩm ohui chính hãng</span>
                                                    <span class="header__notify-descriotion">Mô tả sản phẩm</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="header__notify-item header__notify-item--viewed">
                                            <a href="" class="header__notify-link">
                                                <span><img src="../assets/img/avtgithub.png" alt="" class="header__notify-img"></span>
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Mỹ phẩm ohui chính hãng</span>
                                                    <span class="header__notify-descriotion">Mô tả sản phẩm</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="header__notify-item header__notify-item--viewed">
                                            <a href="" class="header__notify-link">
                                                <span><img src="../assets/img/avtgithub.png" alt="" class="header__notify-img"></span>
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Mỹ phẩm ohui chính hãng</span>
                                                    <span class="header__notify-descriotion">Mô tả sản phẩm</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="header__notify-item">
                                            <a href="" class="header__notify-link">
                                                <span><img src="../assets/img/avtgithub.png" alt="" class="header__notify-img"></span>
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Mỹ phẩm ohui chính hãng</span>
                                                    <span class="header__notify-descriotion">Mô tả sản phẩm</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="header__notify-item">
                                            <a href="" class="header__notify-link">
                                                <span><img src="../assets/img/avtgithub.png" alt="" class="header__notify-img"></span>
                                                <div class="header__notify-info">
                                                    <span class="header__notify-name">Mỹ phẩm ohui chính hãng</span>
                                                    <span class="header__notify-descriotion">Mô tả sản phẩm</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <footer class="header__notify-footer">
                                        <a href="" class="header__notify--footer-btn">Xem tất cả</a>
                                    </footer>
                               
                            </div>
                        </li> -->
                        <li class="header__navbar-item" style="display: <?=isset($_SESSION["admin"])?"flex":"none"?>;">
                            <!-- Link của admin -->
                            <a href="../admin/index.php" class="header__navbar-item-link">
                            <i class="header__navbar-icon fa-solid fa-user-gear"></i>
                                Quản trị</a>
                        </li>
                        
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon fa-solid fa-circle-question"></i>
                                Trợ giúp</a>
                        </li>
                           <li class="header__navbar-item " style="display: <?=isset($_SESSION["id_taikhoan"])?"none":"flex"?>;">
                            <a href="home.php?act=register" class="header__navbar-item-link header__navbar-item--strong header__navbar-item-separate">Đăng ký</a>
                        </li>
                        <li class="header__navbar-item" style="display: <?=isset($_SESSION["id_taikhoan"])?"none":"flex"?>;">
                            <a href="home.php?act=login" class="header__navbar-item-link header__navbar-item--strong">Đăng nhập</a>
                        </li>   
                           <li class="header__navbar-item header__navbar-user" style="display: <?=isset($_SESSION["id_taikhoan"])?"flex":"none"?>;">
                            <img src="../assets/img_user/<?=isset($_SESSION["id_taikhoan"])&&($inForAccount["img"] != "")?$inForAccount["img"]:"default.jpg"?>" alt="" class="header__navbar-user-img">
                            <span class="header__navbar-user-name"><?=isset($_SESSION["id_taikhoan"])?$inForAccount["ten"]:""?></span>
                            <div class="header__navbar-user-menu">
                                <ul class="header__navbar-user-list-item">
                                    <li class="header__navbar-user-item">
                                        <a href="home.php?act=<?=$inForAccount["tentaikhoan"]?>">Cập nhật thông tin</a>
                                    </li>
                                    <li class="header__navbar-user-item">
                                        <a href="home.php?act=doimatkhau">Cài đặt mật khẩu</a>
                                    </li>
                                    <li class="header__navbar-user-item">
                                        <a href="home.php?act=donhang">Đơn mua</a>
                                    </li>
                                    <li class="header__navbar-user-item header__navbar-user-item-separative">
                                        <a href="home.php?act=logout">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </li>   
                    </ul>
                </nav>
                <!-- Header with search -->
               <form action="home.php" method="GET">
               <div class="header-with-search">
                    <div class="header__logo">
                        <a href="home.php" class="header__logo-link">
                            <img class="header__logo-img" src="../assets/img/Logo_poly.png" alt="">
                        </a>
                    </div>
                    <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" name="search" placeholder="Nhập để tìm kiếm sản phẩm" class="header__search-input">
                            <!-- search history -->
                            <!-- <div class="header__search-history">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list">
                                    <li class="header__search-history-list-item">
                                        <a href="">Tìm kiếm 1</a>
                                    </li>
                                    <li class="header__search-history-list-item">
                                        <a href="">Tìm kiếm 2</a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="header__search-select">
                            <span class="header__search-select-label">Trong shop</span>
                            <i class="header__search-select-icon fa-solid fa-caret-down"></i>
                            <ul class="header__search-option">
                                <li class="header__search-option-item header__search-option-item-active">
                                    <span>Trong shop</span>
                                    <i class="fa-solid fa-check"></i>
                                </li>
                                <!-- <li class="header__search-option-item">
                                    <span>Ngoài shop</span>
                                    <i class="fa-solid fa-check"></i>
                                </li> -->
                                
                            </ul>
                        </div>
                        <button type="submit" class="header__search-btn">
                            <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    </form>
                    <!-- cart layout -->
                    <div class="header__cart">
                        <?php 
                            if(isset($_SESSION["id_taikhoan"])){
                                $tongTien = 0;
                                $ItemGioHang = GioHang($_SESSION["id_taikhoan"]);
                                $SoLuongPhanTu = count($ItemGioHang);
                                foreach($ItemGioHang as $tong){
                                    
                                    $tongTien +=  $tong["tongtien"];
                                }
                                if($ItemGioHang == "" || empty($ItemGioHang)){
                                    echo '<div class="header__cart-wrap">
                                    <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
                                    <span class="header__cart-notice">0</span>
                                    <!-- No cart: header__cart-list--no-cart -->
                                    <div class="header__cart-list header__cart-list--no-cart">
                                        <img src="../assets/img/no_cart.png" alt="" class="header__cart-no-cart-img">
                                        <span class="header__cart-list-no-cart-msg">Chưa có sản phẩm</span>
                                        
                                    </div>
                                </div>';
                                }else{
                                    if(isset($_POST["deleteSanPhamGioHang"])){
                                        $idChiTietGioHang = $_POST["sanphamchitietgiohang"];
                                        deleteChiTietGioHang($idChiTietGioHang);
                                        $idGioHang = $_POST["sanphamgiohang"];
                                        deleteGioHang($idGioHang);
                                        if(isset($_GET["act"]) && $_GET["act"] == "chitietsanpham"){
                                            echo '<script> document.location = "home.php?act=chitietsanpham&id='.$_GET["id"].'"; </script>';
                                        }elseif(isset($_GET["act"]) && $_GET["act"] == "giohang"){
                                            echo '<script> document.location = "home.php?act=giohang"; </script>';
                                        }elseif(isset($_GET["act"]) && $_GET["act"] == "donhang"){
                                            echo '<script> document.location = "home.php?act=donhang"; </script>';
                                        }else{
                                            echo '<script> document.location = "home.php"; </script>';
                                        }
                                    }
                                    echo '<div class="header__cart-wrap">
                                    <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
                                    <span class="header__cart-notice">'.$SoLuongPhanTu.'</span>
                                    <div class="header__cart-list ">
                                    <img src="./assets/img/no_cart.png" alt="" class="header__cart-no-cart-img">
                                    <span class="header__cart-list-no-cart-msg">Chưa có sản phẩm</span>
                                    <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                    <ul class="header__cart-list-item">
                                        <!-- cart item -->';
                                        foreach($ItemGioHang as $item){
                                            echo ' <li class="header__cart-item">
                                            <img src="../assets/img_product/'.$item["hinhanhsanpham"].'" alt="" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name">
                                                        '.$item["tensanpham"].'
                                                    </h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price">'.$item["giamoi"].'đ</span>
                                                        <span class="header__cart-item-multiply">x</span>
                                                        <span class="header__cart-item-qnt">'.$item["soluong"].'</span>
                                                    </div>
                                                   
                                                </div>
                                                <div class="header__cart-item-body">
                                                    <span class="header__cart-item-description">
                                                        Danh mục :'.$item["danhmuc"].'
                                                    </span>
                                                    <span class="header__cart-item-delete">
                                                    <form action="" method="POST">
                                                        <input type="text" hidden name="sanphamgiohang" value="'.$item["idgiohang"].'" id="">
                                                        <input type="text" hidden name="sanphamchitietgiohang" value="'.$item["idchitietgiohang"].'" id="">
                                                        <button type="submit" name="deleteSanPhamGioHang" class="header__cart-item-delete-btn">Xóa</button>
                                                    </form>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>';
                                        }
                                       
                                    echo '</ul>
                                    <div class="btn header__cart-sum-money">Tổng tiền : <p class="header__cart-sum-money-text">'.$tongTien.'đ</p></div>
                                    <a href="home.php?act=giohang" class="btn btn--primary header__cart-view-cart">Xem giỏ hàng</a>
                                </div>';
                                }
                            }else{
                                echo '<div class="header__cart-wrap">
                                <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
                                <span class="header__cart-notice">0</span>
                                <!-- No cart: header__cart-list--no-cart -->
                                <div class="header__cart-list header__cart-list--no-cart">
                                    <img src="../assets/img/no_cart.png" alt="" class="header__cart-no-cart-img">
                                    <span class="header__cart-list-no-cart-msg">Chưa có sản phẩm</span>
                                    
                                </div>
                            </div>';
                            }
                        
                        ?>

                       
                    </div>
                </div>
               </form>
            </div>
        </header>