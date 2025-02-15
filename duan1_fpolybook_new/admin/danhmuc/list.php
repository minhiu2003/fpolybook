<div class="main-content">
  <div class="frmtitle">
    <h1>Danh sách loại hàng hóa</h1>
  </div>
  <div class="card">
    <form action="#" method="post" class="card-body">
      <div class="page-title-right">
        <table class="table table-hover">
          <tr>
            <th>Mã Loại</th>
            <th>Tên Loại</th>
            <th>Thao tác</th>
          </tr>
          <?php
          // do danh mục là mảng nên ta đọc dữ liệu là foreach
          foreach ($listdanhmuc as $danhmuc) {
            // show dữ liệu ra
            extract($danhmuc);
            // sửa danh mục
            $suadm = 'index.php?act=suadm&id=' . $id;
            $xoadm = 'index.php?act=xoadm&id=' . $id;

            echo '<tr>
                  <td>' . $id . '</td>
                  <td>' . $ten . '</td>
                  <td>
                   <a href="' . $suadm . '" name="updatedm" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fas fa-edit"></i></a>
                   <a href="' . $xoadm . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa\')" class="btn btn-light text-center p-2 " data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>';
          }
          ?>
        </table>
      </div>
      <div class="mb10">
        <!-- index.php?act=adddm để nhập thêm thêm -->
        <a href="index.php?act=adddm"><input type="button" value="Nhập thêm" name="adddm" class="btn btn-success " /></a>
      </div>
    </form>
  </div>
</div>