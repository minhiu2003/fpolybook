<?php 
    if(isset($_SESSION["id_taikhoan"])){
        $information = select_taikhoan($_SESSION["id_taikhoan"]);
        $hinhanh_nguoidung = $imgUser.$information["img"];
    }else{
        echo "<script>document.location = 'home.php'</script>";
    }
    // Validate update information
    $Validu = [];
    if(isset($_POST["update"])){
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $numberPhone = $_POST["numberPhone"];
        $nameAccount = $_POST["nameAccount"];
        $image = $_FILES["image"];
        if(empty($fullname)){
            $Validu["fullname"] = "Tên hiển thị không được để trống";
        }elseif(strlen($fullname) < 6){
            $Validu["fullname"] = "Tên quá ngắn";
        }elseif(preg_match('/[^a-zA-Z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ\s]/', $fullname)){
            $Validu["fullname"] = "Tên có các kí tự không hợp lệ";
        }
        elseif(preg_match('/\s{2,}/', $fullname)){
            $Validu["fullname"] = "Vui lòng nhập tên không quá xa(tên bạn nhập có 2 dấu cách liên tiếp)";
        }
        // Validate tên

        if(empty($numberPhone)){
            $Validu["phoneNumber"] = "Số điện thoại không được để trống";
        }elseif(!isValidNumberPhone($numberPhone)){
            $Validu["phoneNumber"] = "Số điện thoại không hợp lệ";
        }
        // Validate số điện thoại
        if(empty($address)){
            $Validu["address"] = "Bạn chưa nhập địa chỉ";
        }elseif(strlen($address) < 10){
            $Validu["address"] = "Vui lòng nhập địa chỉ không quá ngắn";
        }elseif(preg_match('/[^a-zA-Z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ\s\.\,]/', $address)){
            $Validu["address"] = "Địa chỉ có các kí tự không hợp lệ";
        }

        // Validate email

        if(empty($nameAccount)){
            $Validu["nameAccount"] = "Tên tài khoản không được bỏ trống";
        }elseif(preg_match('/[^a-zA-Z0-9.]+$/',$nameAccount)){
            $Validu["nameAccount"] = "Tên tài khoản không hợp lệ";
        }

        // Validate tên tài khoản

        if(isset($image)){
            $target_dir = "../assets/img_user/";
            $imageName = $image["name"];
            $target_file = $target_dir.$imageName;
            move_uploaded_file($image["tmp_name"],$target_file);
        }
        // Upload hình ảnh

        if(!$Validu){
            update_account($_SESSION["id_taikhoan"],$fullname,$imageName,$address,$nameAccount,$numberPhone);
            echo '<script>
            alert("Cập nhật thành công");
            document.location = "home.php";
        </script>';
            
        }
    }
?>

<div class="app__container">
        <div class="grid grid__information">
            <div class="information-heading">
                <p class="information-heading-text">Thông tin cá nhân</p>
            </div>
            <form action="" class="information grid__row" method="POST" enctype="multipart/form-data">
                <div class="grid__column-3 information__avt">
                    <div class="information-avatar">
                        <div class="information-image">
                            <img src="<?=isset($information["img"]) && $information["img"] != "" ?$hinhanh_nguoidung:"../assets/img/default.jpg"?>" alt="" class="information-image__img">
                        </div>
                        <span class="btn information-avatar__change">
                            <input class="btn" name="image" type="file"  accept="image/*">
                        </span>
                    </div>
                </div>
                <div class="grid__column-9">
                    <ul class="list__information">
                        <li class="list__information-item">
                            <span class="information__name-change">Tên người dùng :</span>
                            <div class="information__input-change">
                                <input type="text" name="fullname" value="<?=$information["ten"]?>">
                                <div class="text_update_validate"><p><?=isset($Validu["fullname"])?$Validu["fullname"]:"";?></p></div>
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change ">Email:</span>
                            <div class="information__input-change">
                                <input type="text" readonly name="email" value="<?=$information["email"]?>" >
                                
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change">Địa chỉ :</span>
                            <div class="information__input-change">
                                <input type="text" name="address" value="<?=$information["diachi"]?>">
                                <div class="text_update_validate"><p><?=isset($Validu["address"])?$Validu["address"]:"";?></p></div>
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change">Số điện thoại :</span>
                            <div class="information__input-change">
                                <input type="text" name="numberPhone" value="<?=$information["sdt"]?>">
                                <div class="text_update_validate"><p><?=isset($Validu["phoneNumber"])?$Validu["phoneNumber"]:"";?></p></div>
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change">Tên tài khoản :</span>
                            <div class="information__input-change">
                                <input type="text" class="nameAccount" name="nameAccount" value="<?=$information["tentaikhoan"]?>">
                                <div class="text_update_validate"><p><?=isset($Validu["nameAccount"])?$Validu["nameAccount"]:"";?></p></div>
                            </div>
                        </li>
                    </ul>
                </div>

               <div class="btn__information-update">
                <button type="submit" name="update" class="btn btn__information-update-ok">Cập nhật</button>
                <button type="reset" class="btn btn__information-reset">Reset</button>
               </div>
            </form>
        </div>
       </div>