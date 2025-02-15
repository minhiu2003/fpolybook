<div class="main-content">
  <div class="page-content pt-4">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Quản lý đơn hàng</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">Quản lý đơn hàng</a>
                </li>
                <li class="breadcrumb-item active"><a href="?act=listdh">Danh sách đơn hàng</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="row frmtitle mb ml-1">
        <h2>Danh sách đơn hàng</h2>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="index.php?act=listdh" method="post">
              <div class="mb-3 d-flex mt-2 justify-content-between">
                <form action="" method="post">
                  <div class="input-group d-flex col-6">
                    <input type="text" class="form-control" name="kyw" placeholder="Nhập mã đơn hàng tìm kiếm">
                    <select name="ttdh" id="" class="form-control ml-2 mr-2">
                      <option value="0" selected>Trạng thái đơn hàng</option>
                      <option value="1">Chờ xác nhận</option>
                      <option value="2">Đã xác nhận</option>
                      <option value="3">Đang giao</option>
                      <option value="4">Đã giao</option>
                      <option value="5">Đã hủy</option>
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="submit" name="listok" value="Go">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-body">
                <table class="table table-hover">
                  <tr>
                    <th>Mã đơn hàng</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Phí vận chuyển</th>
                    <th>Ngày tạo đơn hàng</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Tổng tiền</th>
                    <th>Mã khách hàng</th>
                    <th>Thao tác</th>
                  </tr>
                  <?php
                  // do danh mục là mảng nên ta đọc dữ liệu là foreach
                  foreach ($listdonhang as $donhang) {
                    // show dữ liệu ra
                    extract($donhang);
                    // sửa danh mục
                    $suadonhang = 'index.php?act=suadh&id=' . $donhang['id'];
                    $chitietdonhang = 'index.php?act=chitietdonhang&iddonhang=' . $donhang['id'];
                    if ($donhang['trangthaidonhang'] == 0) {
                      $content_trangthaidonhang = "Chờ xác nhận";
                    } elseif ($donhang['trangthaidonhang'] == 1) {
                      $content_trangthaidonhang = "Đã xác nhận";
                    } elseif ($donhang['trangthaidonhang'] == 2) {
                      $content_trangthaidonhang = "Đang giao";
                    } elseif ($donhang['trangthaidonhang'] == 3) {
                      $content_trangthaidonhang = "Đã giao";
                    } else {
                      $content_trangthaidonhang = "Đã hủy";
                    }
                    echo '<tr>
                  <td>' . $id . '</td>
                  <td>' . $diachinhanhang . '</td>
                  <td>' . $phivanchuyen . '</td>
                  <td>' . $ngaytaodonhang . '</td>
                  <td>' . $content_trangthaidonhang . '</td>
                  <td>' . $tongtien . '</td>
                  <td>' . $idkhachhang . '</td>
                  <td>
                  <a href="' . $chitietdonhang . '" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Chi tiết đơn hàng"><i class="fas fa-clipboard-list"></i></a>';
                    if ($donhang['trangthaidonhang'] < 3) {
                      echo '<a href="' . $suadonhang . '" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fas fa-edit"></i></a>';
                    }
                    echo '</td>
                </tr>';
                  }
                  ?>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>