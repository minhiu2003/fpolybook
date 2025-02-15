<?php
    $error = [];
   if(isset($_POST["dangnhap"])){
    $email = $_POST["email"];
    $matkhau = $_POST["password"];
    if(empty($email)){
        $error["email"] = "Bạn chưa nhập email";
    }
    // Validate email trống
    if(empty($matkhau)){
        $error["matkhau"] = "Bạn chưa nhập mật khẩu";
    }
    // Validate email và mật khẩu
    if(isset($email) && isset($matkhau)){
        $sql_email = "SELECT * FROM taikhoan WHERE email = '$email'";
        $result_email = pdo_query_one($sql_email);
        if($result_email != false){
            $sql_matkhau = "SELECT * FROM taikhoan WHERE matkhau = '$matkhau'";
            $result_matkhau = pdo_query_one($sql_matkhau);
            if($result_matkhau != false){
                if($result_email["trangthai"] != 0){
                    $error["email"] = "Tài khoản đang bị khóa!Vui lòng liên hệ fanpage Fpoly-Book để được hỗ trợ";
                }elseif($result_email["role"] != 1){
                    $_SESSION["id_taikhoan"] = $result_email["id"];
                    $_SESSION["admin"] = $result_email["id"];
                    echo '<script>
                    document.location = "home.php";
                    </script>';
                }else{
                    $_SESSION["id_taikhoan"] = $result_email["id"];
                    echo '<script>
                    document.location = "home.php";
                    </script>';
                }
            }else{  
                // Khóa tài khoản
                if($error["email"] == "Tài khoản đang bị khóa!Vui lòng liên hệ fanpage Fpoly-Book để được hỗ trợ"){
                    
                }else{
                    $error["matkhau"] = "Mật khẩu không chính xác";
                }
            }
        }else{
            $error["email"] = "Không tìm thấy email";
        }
       
    }
    //Validate email tồn tại và mật khẩu sai
   }


?>


<div class="modal" style="display:<?=isset($_SESSION["id_taikhoan"])?"none;":"flex;"?>">
        <div class="modal__overlay"></div>
        <div class="modal__body">
                    <div class="auth-form" >
                        <form action="" method="POST">
                            <div class="auth-form__container">
                                <div class="auth-form__header">
                                    <h3 class="auth__heading">Đăng nhập</h3>
                                    <a href="home.php?act=register" style="text-decoration: none;" class="auth-form__switch-btn">Đăng ký</a>
                                </div>
                                <div class="auth-form__form">
                                    <div class="auth-form__group">
                                        <label class="auth-form__group-label" for="email">Email:</label>
                                        <input name="email" type="text" placeholder="Nhập email của bạn" class="auth-form__input">
                                        <span class="auth-form__form-masage"><?=isset($error["email"])?$error["email"]:"" ?></span>
                                    </div>
                                    <div class="auth-form__group">
                                    <label class="auth-form__group-label" for="password">Mật khẩu:</label>
                                        <input name="password" type="password" placeholder="Nhập mật khẩu của bạn" class="auth-form__input">
                                        <span class="auth-form__form-masage"><?=isset($error["matkhau"])?$error["matkhau"]:"" ?></span>
                                    </div>
                                </div>
                                <div class="auth-form__aside">
                                   <div class="auth-form__help">
                                    <a href="home.php?act=quenmatkhau" class="auth-form__help-link auth-form__help-forgot">Quên mật khẩu</a>
                                    
                                   </div>
                                </div>
                                <div class="auth-form__controls">
                                    <a href="home.php" class="btn auth-form__controls-back btn--nomals">TRỞ VỀ</a>
                                    <button name="dangnhap" type="submit" class="btn btn--primary">ĐĂNG NHẬP</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="auth-form__socials">
                            
                        </div>
                    </div> 
                </div> 
    </div> 