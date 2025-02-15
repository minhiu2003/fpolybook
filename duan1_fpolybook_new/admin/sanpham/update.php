<?php
if (is_array($sanpham)) {
  extract($sanpham);
}
$hinhanhpath = "../upload/" . $sanpham['hinhanh'];
if (is_file($hinhanhpath)) {
  $hinh = "<img src='" . $hinhanhpath . "' height='80'>";
} else {
  $hinh = "no photo";
}
?>

<div class="main-content">
  <div class="page-content pt-4">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Quản lý sản phẩm</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">Quản lý sản phẩm</a>
                </li>
                <li class="breadcrumb-item active">Sửa sản phẩm</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Sửa sản phẩm</h4>
              <form action="index.php?act=updatesp" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <select class="form-control" name="iddm" id="">
                    <option value="0" selected>Tất cả</option>
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                      extract($danhmuc);

                      if ($iddm == $danhmuc['id'])
                        echo '<option value="' . $danhmuc['id'] . '" selected>' . $danhmuc['ten'] . '</option>';
                      else echo '<option value="' . $danhmuc['id'] . '">' . $danhmuc['ten'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  Tên sản phẩm <br>
                  <input class="form-control" type="text" name="tensp" value="<?= $tensanpham ?>">
                </div>
                <div class="form-group">
                  Giá mới (*)<br>
                  <input class="form-control" type="text" name="giamoi" id="" value="<?= $giamoi ?>" />
                </div>
                <div class="form-group">
                  Giá cũ (*)<br>
                  <input class="form-control" type="text" name="giacu" id="" value="<?= $giacu ?>" />
                </div>
                <div class="form-group">
                  Nhà xuất bản <br>
                  <input class="form-control" type="text" name="nxb" id="" value="<?= $nhaxuatban ?>" />
                </div>
                <div class="form-group">
                  Mô tả sản phẩm <br>
                  <textarea name="mota" id="" cols="30" rows="10"><?= $mota ?></textarea>
                </div>
                <div class="form-group">
                  Số lượng (*)<br>
                  <input class="form-control" type="text" name="soluong" id="" value="<?= $soluong ?>" />
                </div>
                <div class="form-group">
                  Hình ảnh sản phẩm <br>
                  <div class="d-flex">
                    <input class="form-control col-6 mr-2" type="file" name="hinh" id="" />
                    <?= $hinh ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?= $sanpham['id'] ?>">
                  <input class="btn btn-outline-success" type="submit" name="capnhat" value="Cập nhật" />
                  <a href="index.php?act=listsp"><input class="btn btn-outline-success" type="button" value="Danh sách" name="listsp" /></a>
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
</div>