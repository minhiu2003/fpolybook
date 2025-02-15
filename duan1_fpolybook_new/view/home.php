<?php 
   session_start();
    include "../model/pdo.php";
    include "../model/danhmuc.php";
    include "../global.php";
    include "../model/sanpham.php";
    include "../model/search.php";
    include "../model/taikhoan.php";
    include "../model/binhluan.php";
    include "../model/giohang.php";
    include "../model/donhang.php";
    //
   
    include "../model/dieuhuong.php";
    include "header.php";

    if(isset($_GET["act"]) && $_GET["act"] != ""){
        $act = $_GET["act"];
        switch($act){
            case "login":
                include "product.php";
                include "login.php";
                break;
            case "logout":
                logout();
                include "product.php";
                break;
            case "register":
                include "product.php";
                include "register.php";
                break;
            case "quenmatkhau":
                include "product.php";
                include "forgot_password.php";
                break;    
            case "danhmuc":
                include "product.php";
                break;
            case "phobien":
                include "product.php";
                break;
            case "chitietsanpham":
                include "information_product.php";
                break;
            case "gia_tang":
                include "product.php";
                break;
            case "gia_giam":
                include "product.php";
                break;
            case $tentaikhoan:
                include "information_account.php";
                break;
            case "doimatkhau":
                include "change_password.php";
                break;
            case "giohang":
                include "cart.php";
                break;
            case "donhang":
                include "order.php";
                break;
            case "review_information":
                include "review_information.php";
                break;
        }
    }else{
        
        include "product.php";
    }
    
    include "footer.php";

?>