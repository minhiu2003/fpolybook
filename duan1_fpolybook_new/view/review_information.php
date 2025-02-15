<?php
if (isset($_SESSION["listsanpham"])) {
    if (isset($_POST["muangay"])) {
        $tongtien = $_SESSION["tongtien"];
        $address = $_POST["address"];
        if(empty($address) || $address == ""){
            $address = $informationAccount["diachi"];
        }
        $trangThai = 0;
        TaoDonHang($_SESSION["madonhang"], $address, 10000, $_SESSION["ngaytaodonhang"], $trangThai, $tongtien, $_SESSION["id_taikhoan"]);
        foreach ($_SESSION["listsanpham"] as $itemmua) {
            TaoChiTietDonHang($_SESSION["idchitietdonhang"], $_SESSION["madonhang"], $itemmua["idsanpham"], $itemmua["soluong"]);
            $_SESSION["idchitietdonhang"]++;
            updateSoLuong($itemmua["idsanpham"], $itemmua["soluong"]);
        }
        foreach ($_SESSION["chuoiidgiohang"] as $chuoi) {
            deleteChiTietGioHang_TaiKhoan($chuoi["id"]);
            deleteGioHang_TaiKhoan($chuoi["id"]);
        }
        unset($_SESSION["listsanpham"]);
        unset($_SESSION["madonhang"]);
        unset($_SESSION["ngaytaodonhang"]);
        unset($_SESSION["idchitietdonhang"]);
        unset($_SESSION["tongtien"]);
        unset($_SESSION["chuoiidgiohang"]);
        echo '<script>alert("Đã tạo đơn hàng thành công.Hãy đợi admin xác nhận nhé ^^");</script>';
        echo '<script> document.location = "home.php?act=donhang"; </script>';
    }
} else {
    echo '<script> document.location = "home.php?act=giohang"; </script>';
}
?>
<div class="app__container container__giohang ">
    <div class="grid">
        <div class="grid__row app__content">
            <div class="grid__column-2">
                <nav class="category">
                    <h3 class="category__heading">
                        <i class="category__heading-icon fa-solid fa-credit-card"></i>
                        Phương thức thanh toán
                    </h3>
                    <select name="" id="">
                        <option value="1">Thanh toán khi nhận hàng</option>
                        <option value="2">Thanh toán online</option>
                    </select>
                </nav>
            </div>
            <div class="grid__column-10">
                <div class=" home-filter-information-receive">
                    <div class="home-filter-information-receive-header">
                        <i class="information-receive-header-icon fa-solid fa-location-dot"></i>
                        <p class="information-receive-header-text">Địa chỉ nhận hàng</p>
                    </div>
                    <form action="" method="POST">
                        <div class="home-filter-information-receive-content">
                            <div class="home-filter-information-receive-content-name-phone">
                                <p class="home-filter-information-receive-content-name"><?= $informationAccount["ten"] ?></p>
                                <input type="text" readonly value="<?= $informationAccount["sdt"] ?>" class="home-filter-information-receive-content-phone">
                            </div>
                            <input type="text" value="<?= $informationAccount["diachi"] ?>" placeholder="Địa chỉ" name="address" class="home-filter-information-receive-content-address">
                        </div>
                </div>
                <div class="home-filter">
                    <p class="home-filter__giohang">Sản phẩm</p>
                </div>
                <div class="home-card" style="background-color: var(--white-color);">

                    <ul class="home-card-list home-card-list-donhang">
                        <?php foreach ($_SESSION["listsanpham"] as $sanpham) : ?>
                            <li class="home-card-item">
                                <div class="home-card-item-img">
                                    <img src="../assets/img_product/<?= $sanpham["hinhanhsanpham"] ?>" alt="" class="home-card-item-image">
                                </div>
                                <div class="home-card-item-name">
                                    <p class="home-card-item-name-text"><?= $sanpham["tensanpham"] ?></p>
                                </div>
                                <div class="home-card-item-danhmuc">
                                    <p class="home-card-item-danhmuc-text"><?= $sanpham["danhmuc"] ?></p>
                                </div>
                                <div class="home-card-item-price">
                                    <div class="home-card-item-price-old">
                                        <p class="home-card-item-price-old-text"><?= $sanpham["giacu"] ?>đ</p>
                                    </div>
                                    <div class="home-card-item-price-new">
                                        <p class="home-card-item-price-old-text"><?= $sanpham["giamoi"] ?>đ</p>
                                    </div>
                                </div>
                                <div class="home-card-item-quantity">
                                    <p class="home-card-item-quantity-number">Số lượng:</p>
                                    <input style="border: none;" readonly class="home-card-item-quantity-input" min="1" max="10" type="number" value="<?= $sanpham["soluong"] ?>">
                                </div>
                                <div class="home-card-item-thanhtien">
                                    <p class="home-card-item-thanhtien-text">Thành tiền : <span class="home-card-item-thanhtien-number"><?= $sanpham["tongtien"] ?>đ</span></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="home-card-order">
                        <div class="home-card-order-tongtien">
                            <p class="home-card-order-tongtien-text">Tổng tiền : <span class="home-card-order-tongtien-number"><?= $_SESSION["tongtien"] + 10000 ?>đ</span></p>
                        </div>
                        <button type="submit" onclick="return confirm(`Bạn có chắc muốn mua những món đồ này không?Thông tin giao hàng sẽ được dựa trên thông tin bạn cung cấp`)" name="muangay" class="btn btn--primary home-card-order-btn-mua">Mua ngay</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>