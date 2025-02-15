<?php
if (is_array($dm)) {
  extract($dm);
}
?>

<div class="main-content">
  <div class="mb-0 font-size-18">
    <h1>Cập nhật loại hàng hóa</h1>
  </div>
  <div class="card-body">
    <form action="index.php?act=updatedm" method="post">
      <div class="form-group">
        Mã loại <br>
        <input type="text" name="maloai" value="<?= $id ?>" disabled class="form-control"/>
      </div>
      <div class="form-group">
        Tên loại <br>
        <input type="text" name="tenloai" id="" value="<?php if (isset($ten) && ($ten != "")) echo $ten; ?>" class="form-control"/>
      </div>
      <div class="float-right">
        <input type="hidden" name="id" value="<?php if (isset($id) && ($id > 0)) echo $id; ?>">
        <input type="submit" name="capnhat" class="btn btn-success" value="Cập nhật" />
        <a href="index.php?act=listdm"><input type="button" value="Danh sách" name="listdm" class="btn btn-outline-success"/></a>
      </div>
      <?php
      if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
      ?>
    </form>
  </div>
</div>
</div>