<!-- <div class="row">
        <div class="card-title"><h1>Thêm mới loại hàng hóa</h1></div>
        <div class="row frmcontent">
          <form action="index.php?act=adddm" method="post">
            <div class="form-group">
              Mã loại <br>
              <input type="text" name="maloai" disabled class="form-control "/>
            </div>
            <div class="form-group">
              Tên loại <br>
              <input type="text" name="tenloai" id="" class="form-control " />
            </div>
            <div class="row mb10">
              <input type="submit" name="themmoi" value="Thêm mới" />
              <input type="reset" value="Nhập lại" name="reset"/>
            <a href="index.php?act=listdm"><input type="button" value="Danh sách" name="listdm"/></a>
            </div>
            <?php
            if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
            ?>
          </form>
        </div>
      </div>
    </div> -->

<div class="main-content">
    <div class="page-content pt-4 ">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Quản lý danh mục</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Quản lý danh mục</a>
                                </li>
                                <li class="breadcrumb-item active">Thêm danh mục</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm danh mục</h4>
                            <form action="?act=adddm" method="post" enctype="multipart/form-data" id="myForms" onsubmit="return checkForms()">
                                <div class="form-group">
                                    <label for="example-password">Mã danh mục</label>
                                    <input type="text" id="example-password" class="form-control " value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="simpleinput">Tên danh mục</label>
                                    <input type="text" id="simpleinput" class="form-control " placeholder="Nhập tên danh mục" name="ten_danh_muc">
                                    <div class="invalid-feedback">
                                        Tên danh mục không được bỏ trống
                                    </div>
                                </div>
                                <div class="float-right ">
                                    <a href="?act=listdm" class="btn btn-outline-success">Danh sách danh mục</a>
                                    <input type="submit" id="inputError" class="btn btn-success" value="Thêm danh mục" name="themmoi">
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
                        <!-- end card-body-->
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div>
    </div>
</div>