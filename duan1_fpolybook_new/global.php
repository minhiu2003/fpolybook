<?php
    $img_path = "../assets/img_product/";
    $imgUser = "../assets/img_user/";

    // Validate số điện thoại
    function isValidNumberPhone($PhoneNumber){
        $pattern = '/^(0[35789]|09)[0-9]{8}$/';
        return preg_match($pattern, $PhoneNumber);
    }
    
    // Kết thúc
    
?>