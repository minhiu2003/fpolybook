<div class="main-content">
    <div class="card-body">
        <h4 class="card-title">Cập nhật tài khoản</h4>
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
                            Họ và tên :
                            <input type="text" name="ten" class="form-control" value="<?= $ten ?>">
                        </div>
                        <div class="form-group">
                            Tên:
                            <input type="text" name="tentaikhoan" class="form-control" value="<?= $tentaikhoan ?>">
                        </div>
                        <div class="form-group">
                            Mật khẩu:
                            <input type="password" name="matkhau" class="form-control" value="<?= $matkhau ?>">
                        </div>
                        <div class="form-group">
                            Ảnh đại diện: <br>
                            <input type="file" name="img" id="" class="form-control" value="<?= $img ?> ">
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
                        <div class="form-group">
                            Trạng thái
                            <select class="form-control" name="trangthai" id="">
                                <option value="0" <?= ($taikhoan['trangthai'] ==0) ? "selected" : "" ?> >Mở</option>
                                <option value="1" <?= ($taikhoan['trangthai'] ==1) ? "selected" : "" ?> >Khóa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Quyền
                            <select class="form-control" name="role" id="">
                                <option value="1" <?= ($role == 1) ? "selected" : "" ?>>Khách hàng</option>
                                <option value="2" <?= ($role == 2) ? "selected" : "" ?>>Nhân viên</option>
                                <option value="3" <?= ($role == 3) ? "selected" : "" ?>>Kế toán</option>
                                <option value="4" <?= ($role == 4) ? "selected" : "" ?>>Quản trị viên</option>
                            </select>
                        </div>
                        <div class="float-right">
                            <input type="hidden" name="id" value="<?= $id ?> ">
                            <input type="submit" value="Cập nhật" name="capnhattk" class="btn btn-success">
                            <a href="index.php?act=dskh"><input type="button" value="Danh sách" class="btn btn-outline-success" /></a>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        <h2 class="thongbao">
            <?php
            if (isset($thongbao) && ($thongbao != "")) {
                echo $thongbao;
            }
            ?>
        </h2>
    </div>
</div>