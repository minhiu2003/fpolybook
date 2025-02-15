<div class="main-content">
  <div class="page-content pt-4">
    <h1>Danh sách khách hàng</h1>
  </div>
  <div class="card">
    <form action="#" method="post">
      <div class="mb-3 d-flex mt-2 justify-content-between align-item-center">
        <form action="" method="post">
          <div class="input-group d-flex col-6">
            <input type="text" class="form-control mr-2 ml-2" name="kyw" placeholder="Nhập họ và tên tìm kiếm">
            <div class="input-group-append">
              <button class="btn btn-outline-primary" type="submit" name="listtaikhoan" value="Go">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tr>
            <th>Mã Tài Khoản</th>
            <th>Họ và tên</th>
            <th>Mật Khẩu</th>
            <th>Email</th>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Ảnh Đại Diện</th>
            <th>Vai Trò</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
          <?php
          
          foreach ($listtaikhoan as $key) {
            extract($key);
            $hinhpart = "../assets/img_user/" . $img;

            if ($role == 1) {
              $vaitro = "Khách hàng";
            }elseif($role == 2){
              $vaitro = "Nhân viên";
            }elseif($role == 3){
              $vaitro = "Kế toán";
            }elseif($role == 4){
              $vaitro = "Quản trị viên";
            }
            $tt = ($key['trangthai'] == 0) ? "Mở" : "Khóa";
            $suatk = 'index.php?act=suatk&id=' . $id;
            $xoatk = 'index.php?act=xoatk&id=' . $id;

            echo '<tr>
                  <td>' . $id . '</td>
                  <td>' . $ten . '</td>
                  <td>' . $matkhau . '</td>
                  <td>' . $email . '</td>
                  <td>' . $diachi . '</td>
                  <td>' . $sdt . '</td>
                  <td><img src ="' . $hinhpart . '"width="100px" height="100px"></td>
                  <td>' . $vaitro . '</td>
                  <td>' . $tt . '</td>
                  <td>
                   <a href="' . $suatk . '" name="updatedm" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fas fa-edit"></i></a>
                   <a href="' . $xoatk . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa\')" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Xoa"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>';
          }
          ?>
        </table>
      </div>
      <div class="float-right ml-3 mb-3">
        <!-- index.php?act=addtk để nhập thêm -->
        <a href="index.php?act=addtk"><input type="button" value="Nhập thêm" class="btn btn-success" /></a>
      </div>
    </form>
  </div>
</div>