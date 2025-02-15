<?php
function logout()
{
     if (isset($_SESSION["id_taikhoan"])) {
          unset($_SESSION["id_taikhoan"]);

          if (isset($_SESSION["admin"])) {
               unset($_SESSION["admin"]);
          }
     }
}
//    Hàm đăng xuất
function create_account($email, $password, $fullname, $telephone, $address, $nameAccount)
{
     $sql = "INSERT INTO `taikhoan` (`ten`,`matkhau`,`email`,`diachi`,`sdt`,`role`,`tentaikhoan`) VALUES('$fullname','$password','$email','$address','$telephone',1,'$nameAccount')";
     pdo_execute($sql);
}
//    Hàm đăng ký
function select_taikhoan($id)
{
     $sql = "SELECT * FROM taikhoan WHERE id = $id";
     $result = pdo_query_one($sql);
     return $result;
}
//    Hàm truy xuất tài khoản bằng id truyền vào
function ten_taikhoan($ten)
{
     $chuoi = 'abcdefghijklmnopqrstuvwxyz0123456789'; // Chuỗi kí tự có sẵn
     $random = str_shuffle($chuoi);
     $giatri = substr($random, 0, 5);
     // end rand
     $suadau =  mb_convert_encoding($ten, 'ASCII', 'UTF-8');;
     $xoadau = preg_replace('/[^a-zA-Z\s]/', '', $suadau);
     $themdaucham = str_replace(' ', '.', $xoadau);
     // Nối chuỗi
     $ten_tk = $themdaucham . $giatri;
     return $ten_tk;
}
// Hàm random tên tài khoản
function update_account($id, $ten, $anh, $diachi, $tentaikhoan, $sodienthoai)
{
     if ($anh != "") {
          $sql = "UPDATE taikhoan 
          SET ten = '$ten',img = '$anh', diachi = '$diachi' , sdt = '$sodienthoai', tentaikhoan = '$tentaikhoan'
          WHERE id = $id";
     } else {
          $sql = "UPDATE taikhoan 
          SET ten = '$ten',img = img , diachi = '$diachi' , sdt = '$sodienthoai', tentaikhoan = '$tentaikhoan'
          WHERE id = $id";
     }

     pdo_execute($sql);
}
//    Hàm cập nhật tài khoản
function changePassAccount($id, $matkhau)
{
     $sql = "UPDATE taikhoan SET matkhau = '$matkhau' WHERE id = $id";
     pdo_execute($sql);
}
// Hàm đổi mật khẩu

// Phần mailer
function sendMailPassword($email, $fullname, $password)
{

     require '../PHPMailer/src/Exception.php';
     require '../PHPMailer/src/PHPMailer.php';
     require '../PHPMailer/src/SMTP.php';

     $mail = new PHPMailer\PHPMailer\PHPMailer(true);

     try {
          //Server settings
          $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_OFF;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = '6978579e84059c';                     //SMTP username
          $mail->Password   = '83c15e4eccad38';                               //SMTP password
          $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
          $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          //Recipients
          $mail->setFrom('Fpolybook@example.com', 'Fpoly Book');
          $mail->addAddress($email, $fullname);     //Add a recipient
          $mail->CharSet = 'UTF-8'; // Thiết lập bộ mã hóa thành UTF-8
          $mail->Encoding = 'base64'; // Thiết lập bộ mã hóa thành base64

          //Attachments
          //     $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
          //     $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Forgot Password - Fpoly Book';
          $mail->Body    = 'Mật khẩu của bạn là : ' . $password;
          //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
     } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     }
}
// hiệnr thị tất cả tài khoản người dùng
function loadall_taikhoan($kyw){
     $sql = "select * from taikhoan where 1";
     if ($kyw != "") {
          $sql .= " AND ten like '%" . $kyw . "%'";
     }
     $sql .= " order by id desc";
     $listtk = pdo_query($sql);
     return $listtk;
}
// insert tài khoản lên database
function issert_taikhoan($email, $ten, $matkhau)
{
     $sql = "insert into taikhoan(email,ten,matkhau) values('$email', '$ten', '$matkhau')";
     pdo_execute($sql);
}

// kiêm tra người dùng có nhập đúng ten và matkhau không
function checkuser($ten, $matkhau)
{
     $sql = "select * from taikhoan where ten='" . $ten . "' AND matkhau='" . $matkhau . "'";
     $sp = pdo_query_one($sql);
     return $sp;
}

// check email 

function checkemail($email)
{
     $sql = "select * from taikhoan where email='" . $email . "'";
     $sp = pdo_query_one($sql);
     return $sp;
}

// cập nhật tài khoản 
function update_taikhoan($id, $ten, $matkhau, $email, $diachi, $sdt, $role, $img, $trangthai)
{
    if($img != ""){
     $sql = "update taikhoan set ten='" . $ten . "', matkhau='" . $matkhau . "',img='" . $img . "',trangthai='" . $trangthai . "', email='" . $email . "',diachi='" . $diachi . "',sdt='" . $sdt . "',role='" . $role . "' where id=" . $id;
    }else{
     $sql = "update taikhoan set ten='" . $ten . "', matkhau='" . $matkhau . "',img=img,trangthai='" . $trangthai . "', email='" . $email . "',diachi='" . $diachi . "',sdt='" . $sdt . "',role='" . $role . "' where id=" . $id;
    }
     pdo_execute($sql);
}

function update_taikhoanad($id, $ten, $matkhau, $email, $diachi, $sdt, $img, $trangthai)
{
     $sql = "update taikhoan set ten='" . $ten . "', matkhau='" . $matkhau . "',img='" . $img . "',trangthai='" . $trangthai . "', email='" . $email . "',diachi='" . $diachi . "',sdt='" . $sdt . "' where id=" . $id;
     pdo_execute($sql);
}

function loadone_taikhoan($id)
{
     $sql = "select * from taikhoan where id=" . $id;
     $taikhoan = pdo_query_one($sql);
     return $taikhoan;
}

function delete_taikhoan($id)
{
     $sql = "delete from taikhoan where id=" . $id;
     pdo_execute($sql);
}

function issert_taikhoanad($email, $ten, $matkhau, $img, $diachi, $sdt, $role, $tentaikhoan, $trangthai)
{
     $sql = "insert into taikhoan (email,ten,matkhau,img,diachi,sdt,role,tentaikhoan,trangthai)
    VALUES ('$email', '$ten', '$matkhau', '$img', '$diachi','$sdt','$role','$tentaikhoan','$trangthai')";
     pdo_execute($sql);
}
function check_Validate($message)
{
     return '<div class="alert alert-danger" role="alert">' . $message . '</div>';
}
function checktk($email)
{
     $sql = "SELECT * FROM taikhoan WHERE email = '$email'";
     $sp = pdo_query_one($sql);
     return $sp;
}
