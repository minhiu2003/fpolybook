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
                <li class="breadcrumb-item active"><a href="?act=listdh">Chi tiết đơn hàng</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="row frmtitle mb ml-1">
        <h2>Chi tiết đơn hàng</h2>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="#" method="post">
              <div class="card-body">
                <table class="table table-hover">
                  <tr>
                    <th>Mã đơn hàng chi tiết</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                  </tr>
                  <?php
                  // do là mảng nên ta đọc dữ liệu là foreach
                  foreach ($chitietdonhang as $ctdh) {
                    // show dữ liệu ra
                    extract($ctdh);
                    // sửa danh mục
                    $print = 'index.php?act=print&id=' . $ctdh['id'];
                    echo '<tr>
                      <td>' . $id . '</td>
                      <td>' . $iddonhang . '</td>
                      <td>';
                    foreach ($listsanpham as $sanpham) {
                      extract($sanpham);
                      if ($ctdh['idsanpham'] == $sanpham['id']) {
                        echo $tensanpham;
                      }
                    }
                    echo '</td>
                      <td>' . $ctdh['soluong'] . '</td>
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