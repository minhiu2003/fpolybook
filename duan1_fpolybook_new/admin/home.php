<?php $donhang_count = thongke_count_donhang();
$sanpham_count = thongke_count_sp();
$taikhoan_count = thongke_count_tk();
$donhang_squired = thongke_trangthai_donhang();
$thong_ke_home = don_hang_thong_ke_home("",""); ?>
<div class="main-content">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Trang chủ</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Admin</a>
                                </li>
                                <li class="breadcrumb-item active">Trang chủ</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-layer float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Đơn đặt hàng</h6>
                            <h3 class="mb-3" data-plugin="counterup"><?php echo number_format($donhang_count['count_dh']) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-dollar-circle float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Doanh thu</h6>
                            <h3 class="mb-3">
                                    <?= isset($thong_ke_home['total_price']) ? number_format($thong_ke_home['total_price']) : 0 ?>đ
                            </h3>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-bx bx-analyse float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">
                                AVG giá sản phẩm đã bán
                            </h6>
                            <h3 class="mb-3">
                                <span
                                    data-plugin="counterup"><?php echo isset($thong_ke_home['avg_price'])?number_format($thong_ke_home['avg_price']):0 ?></span>
                                VNĐ
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-basket float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">
                                Số lượng sản phẩm đã bán
                            </h6>
                            <h3 class="mb-3">
                                <?php echo isset($thong_ke_home['total_dh'])?number_format($thong_ke_home['total_dh']):0 ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-basket float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">
                                Tổng số đầu sách hiện đang bán
                            </h6>
                            <h3 class="mb-3">
                                <?php echo isset($sanpham_count['count_sp'])?number_format($sanpham_count['count_sp']):0 ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-basket float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">
                                Tổng số tài khoản người dùng được cấp quyền
                            </h6>
                            <h3 class="mb-3">
                                <?php echo isset($taikhoan_count['count_tk'])?number_format($taikhoan_count['count_tk']):0 ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-basket float-right m-0 h2 text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">
                                Tổng số đơn hàng đã bị hủy (trạng thái báo đã hủy)
                            </h6>
                            <h3 class="mb-3">
                                <?php echo isset($donhang_squired['so_donhang_dahuy'])?number_format($donhang_squired['so_donhang_dahuy']):0 ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->