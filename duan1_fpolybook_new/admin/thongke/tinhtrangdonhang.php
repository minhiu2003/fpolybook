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
                                <li class="breadcrumb-item active"><a href="?act=thongkedh">Thống kê đơn hàng</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê đơn hàng</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Số đơn hàng chờ xác nhận</th>
                                        <th>Số đơn hàng đã xác nhận</th>
                                        <th>Số đơn hàng đang giao</th>
                                        <th>Số đơn hàng đã giao</th>
                                        <th>Số đơn hàng đã hủy</th>
                                        <th>Tổng số đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $tinhtrang_donhang['so_donhang_choxacnhan'] ?></td>
                                        <td><?php echo $tinhtrang_donhang['so_donhang_daxacnhan'] ?></td>
                                        <td><?php echo $tinhtrang_donhang['so_donhang_danggiao'] ?></td>
                                        <td><?php echo $tinhtrang_donhang['so_donhang_dagiao'] ?></td>
                                        <td><?php echo $tinhtrang_donhang['so_donhang_dahuy'] ?></td>
                                        <td><?php echo $donhang['count_dh'] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Biểu đồ</h4>
                            <div id="piechart" style="width: 100%; height: 500px;"></div>
                            <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {

                                var data = google.visualization.arrayToDataTable([
                                    ['Task', 'Hours per Day'],
                                    ['Số đơn hàng chờ xác nhận', <?=$tinhtrang_donhang['so_donhang_choxacnhan'] ?>],
                                    ['Số đơn hàng đã hủy', <?=$tinhtrang_donhang['so_donhang_dahuy'] ?>],
                                    ['Số đơn hàng đang xử lý', <?=$tinhtrang_donhang['so_donhang_danggiao'] ?>],
                                    ['Số đơn hàng đã giao hàng', <?=$tinhtrang_donhang['so_donhang_dagiao'] ?>],
                                    ['Số đơn hàng đã xác nhận', <?=$tinhtrang_donhang['so_donhang_daxacnhan'] ?>]
                                ]);

                                var options = {
                                    title: ''
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                chart.draw(data, options);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
</div>