<div class="main-content">
  <div class="page-content pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Quản lý đơn hàng</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">Quản lý đơn hàng</a>
                </li>
                <li class="breadcrumb-item active"><a href="?act=listdh">Cập nhật trạng thái đơn hàng</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="row frmtitle mb  ml-1">
        <h1>Cập nhật trạng thái đơn hàng</h1>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card-body">
            <form action="index.php?act=updatedh" method="post" enctype="multipart/form-data">
              <div class="form-group">
                Địa chỉ nhận hàng <br>
                <input class="form-control" type="text" name="diachinhanhang" value="<?= $donhang['diachinhanhang'] ?>">
              </div>
              <div class="form-group">
                <select name="trangthaidh" id="" class="form-control">
                  <?php if ($donhang['trangthaidonhang'] == 0) {
                    echo '<option value="0" selected >Chờ xác nhận</option>
                    <option value="1" >Đã xác nhận</option>
                    <option value="2" >Đang giao</option>
                    <option value="3" >Đã giao</option>
                    <option value="4" >Đã hủy</option>';
                  } elseif ($donhang['trangthaidonhang'] == 1) {
                    echo '<option value="1" selected >Đã xác nhận</option>
                    <option value="2" >Đang giao</option>
                    <option value="3" >Đã giao</option>
                    <option value="4" >Đã hủy</option>';
                  } elseif ($donhang['trangthaidonhang'] == 2) {
                    echo '<option value="2" selected >Đang giao</option>
                    <option value="3" >Đã giao</option>';
                  } elseif ($donhang['trangthaidonhang'] == 3) {
                    echo '<option value="3" selected >Đã giao</option>';
                  } elseif ($donhang['trangthaidonhang'] == 4) {
                    echo '<option value="4" selected >Đã hủy</option>';
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input class="btn btn-outline-success" type="submit" name="capnhat" value="Cập nhật" />
                <a href="index.php?act=listdh"><input class="btn btn-outline-success" type="button" value="Danh sách" name="listdh" /></a>
              </div>
              <?php
              if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>