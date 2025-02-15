<div class="main-content">
    <div class="card-body">
        <h4 class="card-title ">Thêm mới tài khoản</h4>
        <div class="card-body">
            <form action="index.php?act=addtk" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            Email:
                            <input type="email" name="email" id="" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            Họ và Tên :
                            <input type="text" name="ten" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            Tên:
                            <input type="text" name="tentaikhoan" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            Mật khẩu:
                            <input type="password" name="matkhau" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            Ảnh đại diện: <br>
                            <input type="file" name="img" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            Địa chỉ:
                            <input type="text" name="diachi" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            Số điện thoại:
                            <input type="text" name="sdt" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            Quyền
                            <select class="form-control" name="role" id="">
                                <option value="1">Khách hàng</option>
                                <option value="2">Nhân viên</option>
                                <option value="3">Kế toán</option>
                                <option value="4">Quản trị viên</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <input type="submit" name="themmoi" value="Thêm mới" class="btn btn-success" />
                    <a href="index.php?act=dskh"><input type="button" value="Danh sách" class="btn btn-outline-success" /></a>
                </div>
            </form>

        </div>
    </div>
    <h2 class="thongbao">
        <?php
        if (isset($thongbao) && ($thongbao != "")) {
            echo $thongbao;
        }
        ?>
    </h2>
</div>