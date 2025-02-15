<?php 
        
    require "model/taikhoan.php";
    if(isset($_POST["checkbox"])){
        echo "abc";
    }
    if(isset($_POST["ok"])){
        echo 'ngu';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="" method="POST">
        <input type="text" name="ten" id="">
        <button type="submit">gui</button>
    </form> -->
    <form action="" method="POST">
        <input type="checkbox" name="checkbox">
        <button type="submit" name="ok">OK</button>
        <button type="submit" name="ko">CC</button>
    </form>
    <form action="" method="POST" class="home-filter home-filter__buyall">
                                <span class="home-filter__buyall-tongtien-text">Tổng tiền : </span>
                                <label for="tongtien" class=""><i style="color: red; margin: 0 4px ;font-size: 1.4rem;" class="home-filter__label-tongtien fa-solid fa-dong-sign"></i></label>
                                <input class="home-filter__buyall-tongtien"  type="text" name="tongtien" value="<?=$tongTien?>" readonly  id="tongtien">
                                <button type="submit" name="muatatca" onclick="return confirm(`Bạn có chắc muốn mua tất cả món đồ này không?`)" class="btn home-filter__btn-buyall btn--primary">Mua tất cả</button>
                            </form>
</body>
</html>