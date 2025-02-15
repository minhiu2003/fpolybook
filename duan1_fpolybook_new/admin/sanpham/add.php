<div class="main-content">
  <div class="page-content pt-4">
    <div class="container-fluid">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Quản lý sản phẩm</h4>
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Quản lý sản phẩm</a>
                  </li>
                  <li class="breadcrumb-item active">Thêm sản phẩm</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <form action="index.php?act=addsp" method="post" enctype="multipart/form-data">
          <div class="form-group">
            Danh mục sản phẩm <br>
            <select name="iddm" class="form-control" >
              <?php
              foreach ($listdanhmuc as $danhmuc) {
                extract($danhmuc);
                echo '<option value="' . $id . '">' . $ten . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            Tên sản phẩm <br>
            <input class="form-control" type="text" name="tensp" id="" />
          </div>
          <div class="form-group">
            Giá mới (*)<br>
            <input class="form-control" type="number" name="giamoi" id="" />
          </div>
          <div class="form-group">
            Giá cũ (*)<br>
            <input class="form-control" type="number" name="giacu" id="" />
          </div>
          <div class="form-group">
            Nhà xuất bản <br>
            <input class="form-control" type="text" name="nxb" id="" />
          </div>
          <div class="form-group">
            Mô tả sản phẩm <br>
            <textarea name="mota" id="" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
            Số lượng (*)<br>
            <input class="form-control" type="number" name="soluong" id="" />
          </div>
          <div class="form-group">
            Hình sản phẩm <br>
            <input class="form-control" type="file" name="hinh" id="" />
            <?php
          if (isset($loiupload) && ($loiupload != "")) echo $loiupload;
          ?>
          </div>
          <div class="float-right">
            <input class="btn btn-outline-success" type="submit" name="themmoi" value="Thêm mới" />
            <input class="btn btn-outline-success" type="reset" value="Nhập lại" name="reset" />
            <a href="index.php?act=listsp"><input class="btn btn-outline-success" type="button" value="Danh sách" name="listsp" /></a>
          </div>
        </form>
        <?php
          if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
          ?>
      </div>
    </div>
  </div>
</div>