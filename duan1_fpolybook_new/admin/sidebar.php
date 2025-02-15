<?php
if (empty($_SESSION["admin"]) || !isset($_SESSION["admin"])) {
    echo '<script>document.location = "../view/home.php" </script>';
}
$taikhoan = loadone_taikhoan($_SESSION['id_taikhoan']);
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div class="navbar-brand-box">
            <a href="index.php" class="logo">
                <img src="assets/images/Logo_poly1.png" />
            </a>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Quản lý</li>

                <li>
                    <a href="index.php" class="waves-effect"><i class="bx bx-home-smile"></i><span>Trang
                            chủ</span></a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-grid-alt"></i><span>Quản lý danh mục</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="?act=adddm">Thêm danh mục</a></li>
                        <li><a href="?act=listdm">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-box"></i><span>Quản lý sản phẩm</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="?act=addsp">Thêm sản phẩm</a></li>
                        <li><a href="?act=listsp">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <?php if ($taikhoan['role'] == 4) {
                    echo '<li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                class="bx bx-user-pin"></i><span>Quản lý khách hàng</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="?act=addtk">Thêm khách hàng</a></li>
                            <li><a href="?act=dskh">Danh sách khách hàng</a></li>
                            <!-- <li><a href="?act=updatetk">Lịch sử mua sắm khách hàng</a></li> -->
                        </ul>
                    </li>
                      <li>
                          <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                  class="bx bx-comment-dots"></i><span>Quản lý bình luận</span></a>
                          <ul class="sub-menu" aria-expanded="false">
                              <li><a href="?act=dsbl">Danh sách bình luận</a></li>
                          </ul>
                      </li>';
                }
                ?>
                <?php if ($taikhoan['role'] >= 3) {

                    echo '<li>
                          <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                  class="bx bxs-discount"></i><span>Quản lý đơn hàng</span></a>
                          <ul class="sub-menu" aria-expanded="false">
                              <li><a href="?act=listdh">Danh sách đơn hàng</a></li>
                          </ul>
                      </li>
                      <li>
                          <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                  class="bx bx-data"></i><span>Thống kê</span></a>
                          <ul class="sub-menu" aria-expanded="false">
                              <li><a href="?act=thongke">Thống kê theo loại sản phẩm</a></li>
                              <li><a href="?act=doanhthu">Doanh thu</a></li>
                              <li><a href="?act=thongkedh">Thống kê đơn hàng</a></li>
                          </ul>
                      </li>';
                }
                ?>
                <li class="menu-title">Quản trị</li>
                <li>
                    <a href="../index.php" class="waves-effect"><i class="bx bx-arrow-back"></i><span>Vào
                            website</span></a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->