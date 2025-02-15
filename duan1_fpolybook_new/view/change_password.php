<?php 
    if(isset($_SESSION["id_taikhoan"])){
        $information = select_taikhoan($_SESSION["id_taikhoan"]);
        $ValidCP = [];
        if(isset($_POST["update"])){
            $PasswordOld = $_POST["password_old"];
            $PasswordNew1 = $_POST["password_new1"];
            $PasswordNew2 = $_POST["password_new2"];

            if(empty($PasswordOld)){
                $ValidCP["PasswordOld"] = "Mật khẩu cũ không được bỏ trống";
            }elseif($PasswordOld != $information["matkhau"]){
                $ValidCP["PasswordOld"] = "Mật khẩu sai!Vui lòng nhập lại";
            }

            // Validate mật khẩu cũ

            if(empty($PasswordNew1)){
                $ValidCP["PasswordNew1"] = "Mật khẩu mới không được để trống";
            }elseif(strlen($PasswordNew1) < 8){
                $ValidCP["PasswordNew1"] = "Mật khẩu quá ngắn!Hãy nhập ít nhất 8 kí tự";
            }
            // Validate mật khẩu mới


            if(empty($PasswordNew2)){
                $ValidCP["PasswordNew2"] = "Vui lòng nhập lại mật khẩu";
            }elseif($PasswordNew2 != $PasswordNew1){
                $ValidCP["PasswordNew2"] = "Hãy nhập lại mật khẩu giống mật khẩu vừa nhập";
            }
            // Validate nhập lại mật khẩu
            if(!$ValidCP){
                changePassAccount($_SESSION["id_taikhoan"],$PasswordNew1);
                echo '<script>alert("Đổi mật khẩu thành công");</script>';
            }
        }
    }else{
        echo "<script>document.location = 'home.php'</script>";
    }

?>

<div class="app__container">
        <div class="grid grid__information">
            <div class="information-heading">
                <p class="information-heading-text">Cập nhật mật khẩu</p>
            </div>
            <form action="" class="information grid__row" method="POST" enctype="multipart/form-data">
                    <ul class="list__information">
                        <li class="list__information-item">
                            <span class="information__name-change">Tên người dùng :</span>
                            <div class="information__input-change">
                                <input type="text" name="" style="cursor: default;" readonly  value="<?=$information["ten"]?>">
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change ">Email:</span>
                            <div class="information__input-change">
                                <input class="notemail" type="text" style="cursor: default;" readonly name="" value="<?=$information["email"]?>" >
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change">Tên tài khoản :</span>
                            <div class="information__input-change">
                                <input type="text" name="" style="cursor: default;" readonly value="<?=$information["tentaikhoan"]?>">
                            </div>
                        </li>
                        <li class="list__information-item">
                            <span class="information__name-change">Mật khẩu cũ:</span>
                            <div class="information__input-change">
                                <input type="password" name="password_old">
                                <p><?=isset($ValidCP["PasswordOld"])?$ValidCP["PasswordOld"]:""?></p>
                            </div>
                        </li> 
                        <li class="list__information-item">
                            <span class="information__name-change">Mật khẩu mới:</span>
                            <div class="information__input-change">
                                <input type="password" name="password_new1">
                                <p><?=isset($ValidCP["PasswordNew1"])?$ValidCP["PasswordNew1"]:""?></p>
                            </div>
                        </li>  
                        <li class="list__information-item">
                            <span class="information__name-change">Nhập lại mật khẩu:</span>
                            <div class="information__input-change">
                                <input type="password" name="password_new2">
                                <p><?=isset($ValidCP["PasswordNew2"])?$ValidCP["PasswordNew2"]:""?></p>
                            </div>
                        </li>  
                       
                    </ul>
           

               <div class="btn__information-update">
                <button type="submit" name="update" class="btn btn__information-update-ok">Cập nhật</button>
                <button type="reset" class="btn btn__information-reset">Reset</button>
               </div>
            </form>
        </div>
       </div>