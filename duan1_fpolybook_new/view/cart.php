<?php
if (isset($_SESSION["id_taikhoan"])) {
    $tongTien = 0;
    $ItemGioHang = GioHang($_SESSION["id_taikhoan"]);
    $InfAccount = select_taikhoan($_SESSION["id_taikhoan"]);
    $GioHangTaiKhoan = selectGioHangTaiKhoan($_SESSION["id_taikhoan"]);
    $ChuoiIDDeXoa = ChuoiIDGioHang($GioHangTaiKhoan);
    foreach ($ItemGioHang as $tong) {
        $tongTien +=  $tong["tongtien"];
    }
    if (isset($_POST["xoaSanPhamGioHang"])) {
        $idChiTietGioHang = $_POST["sanphamchitietgiohang"];
        deleteChiTietGioHang($idChiTietGioHang);
        $idGioHang = $_POST["sanphamgiohang"];
        deleteGioHang($idGioHang);
        echo '<script> document.location = "home.php?act=giohang"; </script>';
    }
    // Mua tất cả sản phẩm
    if (isset($_POST["muatatca"])) {
        if (!empty($ItemGioHang) && $ItemGioHang != "") {
            $maDonHang = TaoMaDonHang();
            $ngayTaoDonHang = date("Y-m-d");
            $trangThai = 1;
            $fullChiTietDonHang = selectChiTietDonHang();
            $idChiTietDonHang_End = end($fullChiTietDonHang);
            if (!$fullChiTietDonHang) {
                $idChiTietDonHang = 1;
                // echo '<script>alert("'.$idChiTietDonHang.'")</script>';
                // echo '<script>alert("'.$ngayTaoDonHang.'")</script>';
                // echo '<script>alert("'.$trangThai.'")</script>';
            } else {
                $idChiTietDonHang = $idChiTietDonHang_End["id"] + 1;
            }
            $_SESSION["listsanpham"] = $ItemGioHang;
            $_SESSION["madonhang"] = $maDonHang;
            $_SESSION["ngaytaodonhang"] = $ngayTaoDonHang;
            $_SESSION["idchitietdonhang"] = $idChiTietDonHang;
            $_SESSION["tongtien"] = $_POST["tongtien"];
            $_SESSION["chuoiidgiohang"] = $ChuoiIDDeXoa;
            echo '<script> document.location = "home.php?act=review_information"; </script>';
        } else {
            echo '<script>alert("Chưa có sản phẩm trong giỏ");</script>';
        }
    }
    // Mua 1 sản phẩm

    if (isset($_POST["muamucdachon"])) {
        if (isset($_POST["arraycheckbox"])) {
            $arrayCheckBox = $_POST["arraycheckbox"];
            $tongtien = 0;
            foreach ($arrayCheckBox as $value) {
                $SanPhamCheckBox = GioHangCheckBox($_SESSION["id_taikhoan"], $value);
                $MangSanPhamCheckBox[] = $SanPhamCheckBox;
            }
            foreach ($MangSanPhamCheckBox as $Value) {
                $tongtien += $Value["tongtien"];
            }
            $maDonHang = TaoMaDonHang();
            $ngayTaoDonHang = date("Y-m-d");
            $trangThai = 1;
            $fullChiTietDonHang = selectChiTietDonHang();
            $idChiTietDonHang_End = end($fullChiTietDonHang);
            if (!$fullChiTietDonHang) {
                $idChiTietDonHang = 1;
                // echo '<script>alert("'.$idChiTietDonHang.'")</script>';
                // echo '<script>alert("'.$ngayTaoDonHang.'")</script>';
                // echo '<script>alert("'.$trangThai.'")</script>';
            } else {
                $idChiTietDonHang = $idChiTietDonHang_End["id"] + 1;
            }
            $_SESSION["listsanpham"] = $MangSanPhamCheckBox;
            $_SESSION["madonhang"] = $maDonHang;
            $_SESSION["ngaytaodonhang"] = $ngayTaoDonHang;
            $_SESSION["idchitietdonhang"] = $idChiTietDonHang;
            $_SESSION["tongtien"] = $tongtien;


            foreach ($arrayCheckBox as $value) {
                $SanPhamCheckBox = selectGioHangIDSanPham($value, $_SESSION["id_taikhoan"]);
                $ChuoiSanPhamCheckBox[] = $SanPhamCheckBox;
            }
            $_SESSION["chuoiidgiohang"] = $ChuoiSanPhamCheckBox;

            echo '<script> document.location = "home.php?act=review_information"; </script>';
        } else {
            echo '<script>alert("Bạn chưa chọn sản phẩm nào");</script>';
        }
    }
    if (isset($_POST["xoamucdachon"])) {

        if (isset($_POST["arraycheckbox"])) {
            $arrayCheckBox = $_POST["arraycheckbox"];
            $tongtien = 0;
            foreach ($arrayCheckBox as $value) {
                $SanPhamCheckBox = GioHangCheckBox($_SESSION["id_taikhoan"], $value);
                $MangSanPhamCheckBox[] = $SanPhamCheckBox;
            }
            foreach ($arrayCheckBox as $value) {
                $SanPhamCheckBox1 = selectGioHangIDSanPham($value, $_SESSION["id_taikhoan"]);
                $ChuoiSanPhamCheckBox[] = $SanPhamCheckBox1;
            }
            foreach ($ChuoiSanPhamCheckBox as $SanPham) {
                deleteChiTietGioHang_TaiKhoan($SanPham['id']);
                deleteGioHang_TaiKhoan($SanPham["id"]);
            }
            echo '<script> document.location = "home.php?act=giohang"; </script>';
        } else {
            echo '<script>alert("Bạn chưa chọn sản phẩm nào");</script>';
        }
    }
} else {
}
?>

<div class="app__container container__giohang">
    <div class="grid">
        <div class="grid__row app__content">
            <div class="grid__column-2">
                <nav class="category">
                    <h3 class="category__heading">
                        <i class="category__heading-icon fa-solid fa-list"></i>
                        Danh mục
                    </h3>
                    <ul class="category-list">
                        <li class="category-item ">
                            <a href="home.php?act=giohang" class="catogery-item__link">
                                Giỏ hàng
                            </a>
                        </li>
                        <!-- category-item--active -->
                        <li class="category-item ">
                            <a href="home.php?act=donhang" class="catogery-item__link">
                                Đơn hàng
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="grid__column-10">
                <div class="home-filter">
                    <p class="home-filter__giohang">Giỏ hàng</p>
                </div>
                <div class="home-card">
                    <ul class="home-card-list">
                        <form action="" method="POST">
                            <?php foreach ($ItemGioHang as $item) : ?>
                                <li class="home-card-item">
                                    <input type="checkbox" class="home-card-inp-checkbox" name="arraycheckbox[]" value="<?= $item["idsanpham"] ?>">
                                    <div class="home-card-item-img">
                                        <img src="../assets/img_product/<?= $item["hinhanhsanpham"] ?>" alt="" class="home-card-item-image">
                                    </div>
                                    <div class="home-card-item-name">
                                        <p class="home-card-item-name-text"><?= $item["tensanpham"] ?></p>
                                    </div>
                                    <div class="home-card-item-danhmuc">
                                        <p class="home-card-item-danhmuc-text"><?= $item["danhmuc"] ?></p>
                                    </div>
                                    <div class="home-card-item-price">
                                        <div class="home-card-item-price-old">
                                            <p class="home-card-item-price-old-text"><?= $item["giacu"] ?>đ</p>
                                        </div>
                                        <div class="home-card-item-price-new">
                                            <p class="home-card-item-price-old-text"><?= $item["giamoi"] ?>đ</p>
                                        </div>
                                    </div>
                                    <div class="home-card-item-quantity">
                                        <p class="home-card-item-quantity-number">Số lượng:</p>
                                        <input class="home-card-item-quantity-input" readonly style="border: none;" type="number" value="<?= $item["soluong"] ?>">
                                    </div>
                                </li>
                            <?php endforeach; ?>
                    </ul>
                </div>
                <div class="home-filter__buyall" style="background-color: var(--white-color);">
                    <div class="home-filter__buyall-control">
                        <div class="home-card-item-delete">
                            <div class="home-card__muangay">

                                <button name="xoamucdachon" type="submit" class="btn home-card__btn-muangay">Xóa mục đã chọn</button>
                            </div>
                        </div>
                        <div class="home-card-item-delete">

                            <div class="home-card__muangay">

                                <button name="muamucdachon" type="submit" class="btn btn--primary home-card__btn-muangay">Mua mục đã chọn</button>

                            </div>
                        </div>
                    </div>
                    <div action="" method="POST" class="home-filter " style="background-color: var(--white-color);">
                        <span class="home-filter__buyall-tongtien-text">Tổng tiền : </span>
                        <label for="tongtien" class=""><i style="color: red; margin: 0 4px ;font-size: 1.4rem;" class="home-filter__label-tongtien fa-solid fa-dong-sign"></i></label>
                        <input class="home-filter__buyall-tongtien" type="text" name="tongtien" value="<?= $tongTien ?>" readonly id="tongtien">
                        <button type="submit" name="muatatca" class="btn home-filter__btn-buyall btn--primary">Mua tất cả</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>