<?php
session_start();
include "../model/pdo.php";
include "../model/danhmuc.php";
include "../model/sanpham.php";
include "../model/taikhoan.php";
include "../model/binhluan.php";
include "../model/cart.php";
include "../model/thongke.php";
include "../admin/header.php";
include "../admin/sidebar.php";

if (empty($_SESSION["admin"]) || !isset($_SESSION["admin"])) {
    echo '<script>document.location = "../view/home.php" </script>';
}
// LẤY YÊU CẦU
if (isset($_GET['act'])) {
    // nếu tồn tại nó sẽ làm gì
    $act = $_GET['act'];
    switch ($act) {
            // nếu ấn vào danh mục
        case 'adddm':
            // ktra người dùng có ấn vào nút add hay không
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tenloai = $_POST['ten_danh_muc'];
                // $checkdm = checkdm($tenloai);
                if (empty(trim($tenloai))) {
                    $thongbao = "Tên danh mục không được để trống";
                } else if (checkdm($tenloai)) {
                    $thongbao = "Tên danh mục đã tồn tại!";
                } else {
                    issert_danhmuc($tenloai);
                    $thongbao = "Thêm danh mục thành công";
                }
            }
            //    hiển thị danh mục
            include "danhmuc/add.php";
            break;
            // nếu ấn vào sản phẩm
        case "listdm":
            // load dữ liệu lên danh mục
            $listdanhmuc = loadall_danhmuc();
            // hiển thị sản phẩm
            include "danhmuc/list.php";
            break;

            // xóa danh mục
        case "xoadm":
            // ktra id có tồn ại hay khôngg
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_danhmuc($_GET['id']);
            }

            $listdanhmuc = loadall_danhmuc();
            include "danhmuc/list.php";
            break;

        case "suadm":
            // hiển thi chi tiết 1 danh mục nào đó
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {

                $dm = loadone_danhmuc($_GET['id']);
            }
            include "danhmuc/update.php";
            break;
        case "updatedm":
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $listdm = loadone_danhmuc($id);
                if ($listdm['ten'] != $_POST['tenloai']) {
                    if (checkdm($_POST['tenloai'])) {
                        $thongbao = "Tên danh mục đã tồn tại!";
                    } else {
                        update_danhmuc($_POST);
                        $thongbao = "Cập nhật thành công";
                    }
                } else {
                    update_danhmuc($_POST);
                    $thongbao = "Cập nhật thành công";
                }
            }
            $dm = loadone_danhmuc($_POST['id']);
            include "danhmuc/update.php";
            break;
            // end controler danh mục

            // controler sản phẩm

            // nếu ấn vào sản phẩm
        case 'addsp':
            // ktra người dùng có ấn vào nút add hay không
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $iddm = $_POST['iddm'];
                $tensanpham = trim($_POST['tensp']);
                $giamoi = $_POST['giamoi'];
                $giacu = $_POST['giacu'];
                $nxb = trim($_POST['nxb']);
                $mota = trim($_POST['mota']);
                $soluong = $_POST['soluong'];
                if (empty($iddm) || empty($tensanpham) || empty($giamoi) || empty($giacu) || empty($nxb) || empty($mota) || empty($soluong)) {
                    $thongbao = "Vui lòng điền đầy đủ các trường thông tin";
                } else {
                    if (checksanpham($tensanpham)) {
                        $thongbao = "Tên sản phẩm đã tồn tại";
                    } elseif (($giamoi <= 0) || ($giacu <= 0) || ($soluong <= 0)) {
                        $thongbao = "Các trường thông tin có gắn dấu (*) phải có giá trị lớn hơn 0";
                    } else {
                        $hinh = $_FILES['hinh']['name'];
                        $target_dir = "../assets/img_product/";
                        $target_file = $target_dir . $hinh;
                        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                            $loiupload = "";
                        } else {
                            $loiupload = "Xin lỗi, Có lỗi xảy ra trong quá trình tải ảnh lên.";
                        }
                        issert_sanpham($tensanpham, $giamoi, $giacu, $nxb, $mota, $soluong, $hinh, $iddm);
                        $thongbao = "Thêm thành công";
                    }
                }
            }
            $listdanhmuc = loadall_danhmuc();
            //    hiển thị danh mục
            include "sanpham/add.php";
            break;
            // nếu ấn vào sản phẩm
        case "listsp":
            // ktra post tồn tại không để lọc
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $kyw = $_POST['kyw'];
                $iddm = $_POST['iddm'];
            } else {
                $kyw = '';
                $iddm = 0;
            }
            $listdanhmuc = loadall_danhmuc();
            // load dữ liệu lên danh mục
            $listsanpham = loadall_sanpham($kyw, $iddm); // show ở file list.php dòng 13
            // hiển thị sản phẩm
            include "sanpham/list.php";
            break;

        case "suasp":
            // hiển thi chi tiết 1 danh mục nào đó
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {

                $sanpham = loadone_sanpham($_GET['id']);
            }
            $listdanhmuc = loadall_danhmuc();
            include "sanpham/update.php";
            break;

        case "updatesp":
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $iddm = $_POST['iddm'];
                $tensanpham = $_POST['tensp'];
                $giamoi = $_POST['giamoi'];
                $giacu = $_POST['giacu'];
                $nxb = $_POST['nxb'];
                $mota = trim($_POST['mota']);
                $soluong = $_POST['soluong'];

                if (empty($iddm) || empty($tensanpham) || empty($giamoi) || empty($giacu) || empty($nxb) || empty($mota) || empty($soluong)) {
                    $thongbao = "Vui lòng điền đầy đủ các trường thông tin";
                } else {
                    if (($giamoi <= 0) || ($giacu <= 0) || ($soluong <= 0)) {
                        $thongbao = "Các trường thông tin có gắn dấu (*) phải có giá trị lớn hơn 0";
                    } else {
                        $hinh = $_FILES['hinh']['name'];
                        $target_dir = "../assets/img_product/";
                        $target_file = $target_dir . $hinh;
                        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                            $loiupload = "";
                        } else {
                            $loiupload = "Xin lỗi, Có lỗi xảy ra trong quá trình tải ảnh lên.";
                        }
                        update_sanpham($tensanpham, $giamoi, $giacu, $nxb, $mota, $soluong, $hinh, $iddm, $id);
                        $thongbao = "Cập nhật thành công";
                    }
                }
            }
            $sanpham = loadone_sanpham($id);
            $listdanhmuc = loadall_danhmuc();
            include "sanpham/update.php";
            break;
            // phải gọi list danh mục mới hiển thì được danh mục ở file update
            // $listdanhmuc = loadall_danhmuc();
            // $listsanpham = loadall_sanpham("", 0);
            // include "sanpham/list.php";
            // break;

        case "doitrangthaisp":
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sp = loadone_sanpham($id);
                $trangthai = $sp['trangthai'];
                doitrangthaisp($id, $trangthai);
            }
            $listdanhmuc = loadall_danhmuc();
            $listsanpham = loadall_sanpham("", 0);
            include "sanpham/list.php";
            break;
            // end controler sản phẩm


        case "dskh":
            if (isset($_POST['listtaikhoan']) && ($_POST['listtaikhoan'])) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = '';
            }
            $listtaikhoan = loadall_taikhoan($kyw);
            include "../admin/taikhoan/list.php";
            break;
        case 'addtk':
            // ktra người dùng có ấn vào nút add hay không
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $email = trim($_POST['email']);
                $ten = trim($_POST['ten']);
                $matkhau = trim($_POST['matkhau']);
                $diachi = trim($_POST['diachi']);
                $sdt = trim($_POST['sdt']);
                // $img = $_FILES['img']['name'];
                $trangthai = 0;
                $tentaikhoan = trim($_POST['tentaikhoan']);
                $role = $_POST['role'];
                if ($role == "") {
                    $role = 1;
                }

                // issert_taikhoanad($email,$ten,$matkhau,$img,$diachi,$sdt,$tentaikhoan,$trangthai);
                // $thongbao = "Thêm mới tài khoản thành công";
                if (empty($tentaikhoan) || empty($matkhau) || empty($ten) || empty($diachi) || empty($email) || empty($sdt) || !isset($trangthai)) {
                    $thongbao = check_Validate("Vui lòng điền đầy đủ thông tin!");
                } else if (checktk($email)) {
                    $thongbao = check_Validate("Email đã tồn tại!");
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $thongbao = check_Validate("Định dạng email không hợp lệ!");
                    } else {
                        if (!is_numeric($sdt)) {
                            $thongbao = check_Validate("Số điện thoại phải là số!");
                        } else {
                            $img = $_FILES['img']['name'];
                            $target_dir = "../assets/img_user/";
                            $target_file = $target_dir . $img;
                            if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                                issert_taikhoanad($email, $ten, $matkhau, $img, $diachi, $sdt, $role, $tentaikhoan, $trangthai);
                                $thongbao = check_Validate("Thêm thành công");
                            } else {
                                $thongbao = check_Validate("Upload ảnh không thành công");
                            }
                        }
                    }
                }
            }
            $listtaikhoan = loadall_taikhoan("");
            include "taikhoan/addtk.php";
            break;
        case "suatk":
            // hiển thi chi tiết 1 danh mục nào đó
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $taikhoan = loadone_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan("");
            include "taikhoan/updatetk.php";
            break;

        case 'updatetk':
            if (isset($_REQUEST['capnhattk']) && ($_REQUEST['capnhattk'])) {
                $ten = $_POST['ten'];
                $matkhau = $_POST['matkhau'];
                $email = $_POST['email'];
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $id = $_POST['id'];
                $img = $_FILES['img']['name'];
                $trangthai = $_POST['trangthai'];
                $role = $_POST['role'];
                if ($role == "") {
                    $taikhoan = loadone_taikhoan($id);
                    $role = $taikhoan['role'];
                }
                if ($img == "") {
                    $tk = loadone_taikhoan($id);
                    $img = $tk['img'];
                }
                $target_dir = "../assets/img_user/";
                $target_file = $target_dir . $img;
                if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                    // Upload thành công
                    // echo "Bạn đã upload ảnh thành công";
                } else {
                    // Upload không thành công
                    // echo "Upload ảnh không thành công";
                }
                update_taikhoan($id, $ten, $matkhau, $email, $diachi, $sdt, $role, $img, $trangthai);
                $thongbao = "Sửa thành công";
            }
            $taikhoan = loadone_taikhoan($id);
            include "../admin/taikhoan/updatetk.php";
            break;


        case "xoatk":
            // ktra id có tồn ại hay khôngg
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_binhluan_tk($_GET['id']);
                delete_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan("");
            include "../admin/taikhoan/list.php";
            //done
            break;
        case "dsbl":
            if (isset($_POST['listbl']) && ($_POST['listbl'])) {
                $kywbl = $_POST['kyw'];
            } else {
                $kywbl = '';
            }
            $listsanpham = loadall_sanpham($kyw = '', $iddm = 0);
            $listtaikhoan = loadall_taikhoan("");
            $listbinhluan = loadall_binhluan($kywbl);
            include "binhluan/list.php";
            break;

        case "hienbl":
            if (isset($_GET['id'])) {
                hienbl($_GET['id']);
            }
            $listbinhluan = loadall_binhluan_admin();
            $listtaikhoan = loadall_taikhoan("");
            $listsanpham = loadall_sanpham($keyw = "", $iddm = 0);
            include "binhluan/list.php";
            break;

        case "xoabl":
            // ktra id có tồn ại hay khôngg
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_binhluan($_GET['id']);
            }
            $listsanpham = loadall_sanpham($kyw = '', $iddm = 0);
            $listtaikhoan = loadall_taikhoan("");
            $listbinhluan = loadall_binhluan(0);
            include "../admin/binhluan/list.php";
            break;

        case "soft_delete_bl":
            if (isset($_GET['id'])) {
                soft_delete_bl($_GET['id']);
            }
            $listbinhluan = loadall_binhluan_admin();
            $listtaikhoan = loadall_taikhoan("");
            $listsanpham = loadall_sanpham($keyw = "", $iddm = 0);
            include "binhluan/list.php";
            break;

        case 'listdh':
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $kyw = $_POST['kyw'];
                $trangthaidonhang = $_POST['ttdh'];
            } else {
                $kyw = '';
                $trangthaidonhang = 0;
            }
            $listdonhang = loadall_donhang($kyw, $trangthaidonhang);
            include "donhang/list.php";
            break;

        case "suadh":
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $donhang = loadone_donhang($_GET['id']);
            }
            $listdonhang = loadall_donhang($kyw = '', $iduser = 0);
            include "donhang/updatett.php";
            break;

        case 'updatedh':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $diachinhanhang = $_POST['diachinhanhang'];
                $trangthaidh = $_POST['trangthaidh'];
                $id = $_POST['id'];
                update_donhang($id, $diachinhanhang, $trangthaidh);
            }
            $listdonhang = loadall_donhang($kyw = '', $iduser = 0);
            include "../admin/donhang/list.php";
            break;

        case 'chitietdonhang':
            if (isset($_GET['iddonhang']) && ($_GET['iddonhang'] > 0)) {
                $chitietdonhang = loadone_chitietdonhang($_GET['iddonhang']);
            }
            $listsanpham = loadall_sanpham($kyw = '', 0);
            include "donhang/listchitiet.php";
            break;
            //endcode đơn hàng

        case 'thongke':
            $listthongke = loadall_thongke();
            include "thongke/list.php";
            break;
        case 'bieudo':
            $listthongke = loadall_thongke();
            include "thongke/bieudo.php";
            break;

        case 'doanhthu':
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $ngaybatdau = $_POST['date1'];
                $ngayketthuc = $_POST['date2'];
            } else {
                $ngaybatdau = "";
                $ngayketthuc = "";
            }
            $doanh_thu_dm = thong_ke_doanh_thu_dm($ngaybatdau, $ngayketthuc);
            $doanh_thu_kh = thong_ke_doanh_thu_kh($ngaybatdau, $ngayketthuc);
            $doanh_thu_sp = thong_ke_doanh_thu_sp($ngaybatdau,$ngayketthuc);
            include "thongke/doanhthu.php";
            break;
        case 'thongkedh':
            $tinhtrang_donhang = thongke_trangthai_donhang();
            $donhang = thongke_count_donhang();
            include "thongke/tinhtrangdonhang.php";
            break;
            // ======
    }
} else {
    include "home.php";
}
include "footer.php";
