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
                                <li class="breadcrumb-item active"><a href="?act=thongke">Thông kê sản phẩm theo loại</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row frmtitle mb ml-1">
                <h2>Thông kê sản phẩm theo loại</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>Mã danh mục</th>
                                    <th>Tên danh mục</th>
                                    <th>Số lượng</th>
                                    <th>Giá cao nhất</th>
                                    <th>Giá thấp nhất</th>
                                    <th>Giá trung bình</th>
                                </tr>
                                <?php
                                foreach ($listthongke as $thongke) {
                                    extract($thongke);
                                    echo '
                                <tr>
                                <td>' . $madm . '</td>
                                <td>' . $tendm . '</td>
                                <td>' . $countsp . '</td>
                                <td>' . $maxprice . '</td>
                                <td>' . $minprice . '</td>
                                <td>' . number_format($avgprice, 0) . '</td>
                                </tr>
                                ';
                                }
                                ?>
                            </table>
                        </div>
                        <div class="card-footer bg-transparent ">
                            <div class="float-right m-2">
                                <a href="index.php?act=bieudo" class="btn btn-success "><i class="fas fa-chart-pie"></i>Xem biểu đồ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>