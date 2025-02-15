<?php
     if(isset($_GET["act"]) && $_GET["act"] == "logout"){
        header("location:home.php");
    }
    
    if(isset($_SESSION["id_taikhoan"])){
        $informationAccount = select_taikhoan($_SESSION["id_taikhoan"]);
        $tentaikhoan = $informationAccount["tentaikhoan"];
    }
?>