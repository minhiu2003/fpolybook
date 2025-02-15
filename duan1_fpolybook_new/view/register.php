<?php
    $validate = [];
    if(isset($_POST["dangnhap"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $fullname = $_POST["fullname"];
        $phoneNumber = $_POST["phone"];
        $address = $_POST["address"];
        if(empty($email)){
            $validate["email"] = "Bạn chưa nhập email"; 
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validate["email"] = "Email không đúng";
        }elseif(pdo_query_one("SELECT * FROM taikhoan WHERE email = '$email'")){
            $validate["email"] = "Email đã tồn tại vui lòng nhập email khác";
        }
        // Validate email
        if(empty($password)){
            $validate["password"] = "Bạn chưa nhập mật khẩu";
        }elseif(strlen($password) < 8){
            $validate["password"] = "Mật khẩu quá ngắn!Hãy nhập mật khẩu lớn hơn hoặc bằng 8 kí tự";
        }
        // Validate mật khẩu
        if(empty($fullname)){
            $validate["fullname"] = "Bạn chưa nhập tên";
        }elseif(strlen($fullname) < 6){
            $validate["fullname"] = "Tên quá ngắn";
        }elseif(preg_match('/[^a-zA-Z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ\s]/', $fullname)){
            $validate["fullname"] = "Tên có các kí tự không hợp lệ";
        }
        elseif(preg_match('/\s{2,}/', $fullname)){
            $validate["fullname"] = "Vui lòng nhập tên không quá xa(tên bạn nhập có 2 dấu cách liên tiếp)";
        }
        // Validate tên hiển thị
        if(empty($phoneNumber)){
            $validate["phoneNumber"] = "Bạn chưa nhập số điện thoại";
        }elseif(!isValidNumberPhone($phoneNumber)){
            $validate["phoneNumber"] = "Số điện thoại không hợp lệ";
        }
        // Validate số điện thoại
        if(empty($address)){
            $validate["address"] = "Bạn chưa nhập địa chỉ";
        }elseif(strlen($address) < 10){
            $validate["address"] = "Vui lòng nhập địa chỉ không quá ngắn";
        }elseif(preg_match('/[^a-zA-Z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ\s\.\,]/', $address)){
            $validate["address"] = "Địa chỉ có các kí tự không hợp lệ";
        }
        // Validate địa chỉ
        if(!$validate){
            $name_account = ten_taikhoan($fullname);
            create_account($email,$password,$fullname,$phoneNumber,$address,$name_account);
           
            echo '<script>
            alert("Đăng kí thành công");
            document.location = "home.php?act=login";
        </script>';
        }
    }
?>

<div class="modal" style="display:<?=isset($_SESSION["id_taikhoan"])?"none;":"flex;"?>">
        <div class="modal__overlay"></div>
        <div class="modal__body">
                      <div  class="auth-form auth-form-register" >
                       <form action="" method="POST">
                        <div class="auth-form__container">
                            <div class="auth-form__header">
                                <h3 class="auth__heading">Đăng ký</h3>
                                <a href="home.php?act=login" style="text-decoration: none;" class="auth-form__switch-btn">Đăng nhập</a>
                            </div>
                            <div class="auth-form__group">
                                    <label class="auth-form__group-label" for="email">Email:</label>
                                    <input id="email" name="email" type="text" placeholder="Nhập email của bạn" class="auth-form__input">
                                    <span class="auth-form__form-masage"><?=isset($validate["email"])?$validate["email"]:"";?></span>
                                </div>
                                <div class="auth-form__group">
                                    <label class="auth-form__group-label" for="password">Mật khẩu:</label>
                                    <input id="password" name="password" type="password" placeholder="Nhập mật khẩu của bạn" class="auth-form__input">
                                    <span class="auth-form__form-masage"><?=isset($validate["password"])?$validate["password"]:"";?></span>
                                </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group ">
                                    <label class="auth-form__group-label" for="fullname">Tên hiển thị:</label>
                                    <input id="fullname" name="fullname" type="text" placeholder="Nhập tên của bạn" class="auth-form__input">
                                    <span class="auth-form__form-masage"><?=isset($validate["fullname"])?$validate["fullname"]:"";?></span>
                                </div>
                                <div class="auth-form__group">
                                    <label class="auth-form__group-label" for="phone">Số điện thoại:</label>
                                    <input id="phone" name="phone" type="text" placeholder="Nhập số điện thoại của bạn" class="auth-form__input">
                                    <span class="auth-form__form-masage"><?=isset($validate["phoneNumber"])?$validate["phoneNumber"]:"";?></span>
                                </div>
                                <div class="auth-form__group">
                                    <label class="auth-form__group-label" for="address">Địa chỉ:</label>
                                    <input id="address" name="address" type="text" placeholder="Nhập địa chỉ của bạn" class="auth-form__input">
                                    <span class="auth-form__form-masage"><?=isset($validate["address"])?$validate["address"]:"";?></span>
                                </div>
                            </div>
                            <div class="auth-form__aside">
                                <p class="auth-form__policy-text">
                                    Bằng việc đăng kí, bạn đã đồng ý với Fpoly về
                                    <a href="" class="auth-form__text-link">Điều khoản dịch vụ </a>&
                                    <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
        
                                </p>
                            </div>
                            <div class="auth-form__controls">
                                <a href="home.php" class="btn auth-form__controls-back btn--nomals">TRỞ VỀ</a>
                                <button type="submit" name="dangnhap" class="btn btn--primary">ĐĂNG KÝ</button>
                            </div>
                        </div>
                       </form>
                        
                        
                    </div>  
                    

                    
                </div> 
    </div> 