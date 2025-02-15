<?php
    function search_sanpham($name){
        $sql = "SELECT * FROM sanpham WHERE tensanpham LIKE N'%$name%' ORDER BY luotxem DESC LIMIT 0,10";
        $result = pdo_query($sql);
        return $result;
    }

  
?>