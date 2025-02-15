<?php
    $load_danhmuc_footer = load_all_danhmuc();

?>
<footer class="footer">
            <div class="grid grid__footer">
                <div class="grid__row">
                    <div class="grid__column-2-4">
                        <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Trung tâm trợ giúp</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Trang chủ</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Điều khoản</a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column-2-4">
                        <h3 class="footer__heading">Giới thiệu</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giới thiệu</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Tuyển dụng</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Điều khoản</a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column-2-4">
                        <h3 class="footer__heading">Danh mục</h3>
                        <ul class="footer-list">
                           <?php foreach($load_danhmuc_footer as $danhmuc): ?>
                            <li class="footer-item">
                                <a href="home.php?act=danhmuc&id=<?=$danhmuc["id"]?>" class="footer-item__link"><?=$danhmuc["ten"]?></a>
                            </li>
                           <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="grid__column-2-4">
                        <h3 class="footer__heading">Theo dõi</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="https://www.facebook.com/luongnguyen.1124" class="footer-item__link">
                                    <i class="footer-item-icon fa-brands fa-facebook"></i>
                                    Facebook
                                </a>
                            </li>
                                <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item-icon fa-brands fa-instagram"></i>
                                    Instagram
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                    <div class="grid__column-2-4" style="display: <?=isset($_SESSION["id_taikhoan"])?"none":"block"?>;">
                        <h3 class="footer__heading">Tài khoản</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="home.php?act=register" class="footer-item__link">
                                   Đăng ký
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="home.php?act=login" class="footer-item__link">
                                   Đăng nhập
                                </a>
                               
                            </li>
                        </ul>
                    </div>
                </div>
               
            </div>
            <div class="footer-end">
                <p class="footer-text">© 2023 Bản quyền thuộc về cá nhân Nguyễn Minh Lương - Website được tạo ra vì mục đích học tập, không vì mục đích thương mại</p>
            </div>
        </footer>
    </div>
   
    </body>
</html>