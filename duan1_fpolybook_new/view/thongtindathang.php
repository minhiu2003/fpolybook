<div class="main-content">
    <div class="card-body">
        <h4 class="card-title">Thông tin đặt hàng</h4>
        <div class="card-body">
            <?php
            if (is_array($taikhoan)) {
                extract($taikhoan);
            }
            ?>
            <form action="index.php?act=updatetk" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            Email:
                            <input type="email" name="email" id="" class="form-control" value="<?= $email ?>">
                        </div>
                        <div class="form-group">
                            Ho Tên :
                            <input type="text" name="ten" class="form-control" value="<?= $ten ?>">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            Địa chỉ:
                            <input type="text" name="diachi" class="form-control" value="<?= $diachi ?>">
                        </div>
                        <div class="form-group">
                            Số điện thoại:
                            <input type="text" name="sdt" class="form-control" value="<?= $sdt ?>">
                        </div>
                        <div class="float-right">
                            <input type="hidden" name="id" value="<?= $id ?> ">
                            <input type="submit" value="Đặt hàng" name="thongtindathang" class="btn btn-success">
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>