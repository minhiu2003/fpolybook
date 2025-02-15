<div class="main-content">
  <div class="page-content pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Quản lý sản phẩm</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">Quản lý sản phẩm</a>
                </li>
                <li class="breadcrumb-item active"><a href="?act=listdh">Danh sách sản phẩm</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="row frmtitle mb  ml-1">
        <h1>Danh sách sản phẩm</h1>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="index.php?act=listsp" method="post">
              <div class="mb-3 d-flex mt-2 justify-content-between">
                <form action="" method="post">
                  <div class="input-group d-flex col-6">
                    <input type="text" class="form-control" name="kyw" placeholder="Nhập tên sản phẩm tìm kiếm">
                    <select name="iddm" id="" class="form-control ml-2 mr-2">
                      <option value="0" selected>Tất cả</option>
                      <?php
                      foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        echo '<option value="' . $id . '">' . $ten . '</option>';
                      }
                      ?>
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="submit" name="listok" value="Go">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
                <div class="float-right mr-2">
                  <!-- index.php?act=addsp để nhập thêm thêm -->
                  <a href="index.php?act=addsp" class="btn btn-success "> <i class="bx bx-plus pr-1"></i>Thêm sản phẩm </a>
                </div>
              </div>
              <?php
              if (isset($_POST['listok']) && ($_POST['listok'])) {
                $dm = loadone_danhmuc($iddm);
                $tendm = $dm['ten'];
                echo '<div class="ml-3"><h4> Danh muc sản phẩm: ' . $tendm . '</h4></div>';
              }
              ?>
              <div class="card-body">
                <table class="table table-hover">
                  <tr>
                    <th>Mã sản phẩm</th>
                    <th class="col-2">Tên sản phẩm</th>
                    <th>Giá mới</th>
                    <th>Giá cũ</th>
                    <th>Nhà xuất bản</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th>
                    <th>Lượt xem</th>
                    <th>Hình sản phẩm</th>
                    <th>Thao tác</th>
                  </tr>
                  <?php
                  // do danh mục là mảng nên ta đọc dữ liệu là foreach
                  foreach ($listsanpham as $sanpham) {
                    // show dữ liệu ra
                    extract($sanpham);
                    // sửa danh mục
                    $suasp = 'index.php?act=suasp&id=' . $sanpham['id'];
                    $doitrangthaisp = 'index.php?act=doitrangthaisp&id=' . $sanpham['id'];
                    $bieutuong = ($sanpham['trangthai'] == 0) ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                    $contenttitle = ($sanpham['trangthai'] == 0) ? "Ẩn sản phẩm" : "Hiện sản phẩm";
                    $hinhanhpath = "../assets/img_product/" . $hinhanh;
                    if (is_file($hinhanhpath)) {
                      $hinh = "<img src='" . $hinhanhpath . "' height='80' width='80'>";
                    } else {
                      $hinh = "no photo";
                    }
                    echo '<tr>
                  <td>' . $id . '</td>
                  <td>' . $tensanpham . '</td>
                  <td>' . $giamoi . '</td>
                  <td>' . $giacu . '</td>
                  <td>' . $nhaxuatban . '</td>
                  <td><textarea rows="10" cols="30" style="border: none;" readonly="readonly" class="bg-light">' . $mota . '</textarea></td>
                  <td>' . $soluong . '</td>
                  <td>' . $luotxem . '</td>
                  <td>' . $hinh . '</td>
                  <td>
                  <a href="' . $doitrangthaisp . '" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="' . $contenttitle . '"> ' . $bieutuong . ' </a>
                  <a href="' . $suasp . '" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>';
                  }
                  ?>
                </table>
              </div>
              <div class="card-footer bg-transparent ">
                <div class="float-right m-2">
                  <!-- index.php?act=addsp để nhập thêm thêm -->
                  <a href="index.php?act=addsp" class="btn btn-success "> <i class="bx bx-plus pr-1"></i>Thêm sản phẩm </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>