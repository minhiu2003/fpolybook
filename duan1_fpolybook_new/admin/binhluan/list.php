<div class="main-content">
  <div class="card-title">
    <h1>Danh sách bình luận</h1>
  </div>
  <div class="card">
    <form action="" method="post">
      <div class="mb-3 d-flex mt-2 justify-content-between align-item-center">
        <form action="" method="post">
          <div class="input-group d-flex col-6">
            <input type="text" class="form-control mr-2 ml-2" name="kyw" placeholder="Nhập nội dung bình luận tìm kiếm">
            <div class="input-group-append">
              <button class="btn btn-outline-primary" type="submit" name="listbl" value="Go">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tr>
            <th></th>
            <th>Trạng thái bình luận</th>
            <th>ID</th>
            <th>Nội Dung</th>
            <th>User</th>
            <th>ID Sản Phẩm</th>
            <th>Ngày Bình Luận</th>
            <th>Thao tác</th>

          </tr>

          <?php
          if (isset($listbinhluan) && is_array($listbinhluan) && !empty($listbinhluan)) {
            // duyệt list bình luận từ db in ra giao diện table
            foreach ($listbinhluan as $binhluan) {
              // show dữ liệu ra
              extract($binhluan);
              // đường dẫn tới trang sửa bình luận dựa vào id của bình luận
              $xoabl = 'index.php?act=xoabl&id=' . $id;
              $anbl = "index.php?act=soft_delete_bl&id=" . $id;
              $hienbl = "index.php?act=hienbl&id=" . $id;
              echo '<tr>
                    <td><input type="checkbox" name="" id=""></td>
                    <td>';
              if ($trangthai == 0) {
                echo 'Đã ẩn';
              } else {
                echo 'Hiển thị';
              }
              echo '</td>
                  <td>' . $id . '</td>
                  <td>' . $noidung . '</td>
                  <td>';
              foreach ($listtaikhoan as $taikhoan) {
                extract($taikhoan);
                if ($binhluan['idtaikhoan'] == $taikhoan['id']) {
                  echo $taikhoan['ten'];
                }
              }
              echo '</td>
                  <td>';
              foreach ($listsanpham as $sanpham) {
                extract($sanpham);
                if ($binhluan['idsanpham'] == $sanpham['id']) {
                  echo $tensanpham;
                }
              }
              echo '</td>
                  <td>' . $ngaybinhluan . '</td>
                  <td>
                   <a href="' . $xoabl . '"> <input type="button" value="&#10006;" onclick="return confirm(\'Bạn có chắc chắn muốn xóa\')"class="btn btn-outline-danger" /></a>
                  <a href="' . $anbl . '"><input type="button" value="Ẩn"class="btn btn-outline-success" ></a>
                  <a href="' . $hienbl . '"><input type="button" value="hiện"class="btn btn-outline-success" ></a>
                  </td>

                </tr>';
            }
          }
          ?>

        </table>
      </div>
    </form>
  </div>
</div>