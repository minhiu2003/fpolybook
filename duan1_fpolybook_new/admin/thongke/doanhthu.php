<div class="main-content">
    <div class="page-content pt-4">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Thống kê</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Thống kê</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="?act=doanhthu">Doanh thu</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 d-flex mt-2 justify-content-between align-items-center">
                                <h4 class="card-title">Doanh thu</h4>
                                <div class="d-flex">
                                    <form action="" method="post" class="d-flex col-6 align-items-center">
                                        <label for="date1" class="mb-0">Từ</label>
                                        <input type="date" name="date1" id="" class="form-control mr-2 ml-2">
                                        <label for="date1" class="mb-0">Đến</label>
                                        <input type="date" name="date2" id="" class="form-control mr-2 ml-2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="submit" name="listok" value="Go">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mb-4">
                                <span class="font-weight-bolder">Tổng doanh thu <?php if($ngaybatdau != "" && $ngayketthuc != ""){ echo "từ $ngaybatdau đến $ngayketthuc là"; } ?>: </span>
                                <?php $thong_ke_home = don_hang_thong_ke_home($ngaybatdau, $ngayketthuc);
                                echo isset($thong_ke_home['total_price']) ? number_format($thong_ke_home['total_price']) : 0 ?>đ
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Doanh thu theo danh mục</h4>
                                        </div>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Danh mục sản phẩm</th>
                                                    <th>Doanh thu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($doanh_thu_dm as $value) : ?>
                                                    <tr>
                                                        <td><?php echo $value['ten'] ?></td>
                                                        <td><?php echo number_format($value['total_dh']) ?>đ</td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Doanh thu theo khách hàng</h4>
                                        </div>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Khách hàng</th>
                                                    <th>Doanh thu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($doanh_thu_kh as $value) : ?>
                                                    <tr>
                                                        <td><?php echo $value['ten'] ?></td>
                                                        <td><?php echo number_format($value['total_dh']) ?>đ</td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Doanh thu theo sản phẩm</h4>
                                        </div>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Doanh thu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($doanh_thu_sp as $value) : ?>
                                                    <tr>
                                                        <td><?php echo $value['tensanpham'] ?></td>
                                                        <td><?php echo number_format($value['total_dh']) ?>đ</td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class=" p-3">
                                    <span class="font-weight-bolder">Tổng doanh thu: </span>
                                    <?php $thong_ke_home = don_hang_thong_ke_home($ngaybatdau, $ngayketthuc);
                                    echo isset($thong_ke_home['total_price']) ? number_format($thong_ke_home['total_price']) : 0 ?>đ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
</div>