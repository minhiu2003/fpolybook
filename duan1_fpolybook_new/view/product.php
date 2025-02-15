
<?php 
    $itemPerPage = 10;
    $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
    $allSanPham = SanPham();
    $countSanPham = count($allSanPham);
    $offSet = ($currentPage - 1) * $itemPerPage;
    $totalPage = ceil($countSanPham / $itemPerPage);
    if(isset($_GET["act"]) && ($_GET["act"] == "danhmuc")){
        $sapxep = "";
        if(isset($_GET["sapxep"]) && $_GET["sapxep"] == "tang"){
           $sapxep = "tang";
        }elseif(isset($_GET["sapxep"]) && $_GET["sapxep"] == "giam"){
            $sapxep = "giam";
        }
        $sanpham_danhmuc = load_sanpham_theo_danhmuc($_GET["id"],$sapxep);
        $top10sanpham = $sanpham_danhmuc;
    }elseif(isset($_GET["act"]) && ($_GET["act"] == "phobien")){
        $sanpham_phobien = load_sanpham_phobien();
        $top10sanpham = $sanpham_phobien;
    }elseif(isset($_GET["search"])){
        $sanpham_timkiem = search_sanpham($_GET["search"]);
        $top10sanpham = $sanpham_timkiem;
    }
    elseif(isset($_GET["act"]) && ($_GET["act"] == "gia_tang")){
        $sanpham_sapxep_cao = sapxep_giacao();
        $top10sanpham = $sanpham_sapxep_cao;
    }elseif(isset($_GET["act"]) && ($_GET["act"] == "gia_giam")){
        $sanpham_sapxep_thap = sapxep_giathap();
        $top10sanpham = $sanpham_sapxep_thap;
    }
    else{
        $top10sanpham = load_10_sanpham($itemPerPage,$offSet);
    }
    
    
?>  
<div class="app__container">
            <div class="grid">
                <div class="grid__row app__content">
                    <?php include "category.php"; ?>
                    <div class="grid__column-10">
                        <div class="home-filter">
                            <span class="home-filter__label">Sắp xếp theo</span>
                            <a href="home.php?act=phobien" class="home-filter__btn btn <?=isset($_GET["act"])&&($_GET["act"] == "phobien")?"btn--primary":"";?>">Phổ biến</a>
                            <a href="home.php" class="home-filter__btn btn <?=empty($_GET["act"])?"btn--primary":"";?>">Mới nhất</a>
                            <!-- <button class="home-filter__btn btn">Bán chạy</button> -->
                            <div class="select-input">
                                <span class="select-input__label">Giá</span>
                                <i class="select-input__icon fas fa-angle-down"></i>
                                <ul class="select-input__list">
                                    <li class="select-input__item">
                                        <a href="home.php?<?=isset($_GET["act"]) && $_GET["act"] == "danhmuc"?"act=danhmuc&id=".$_GET["id"]."&sapxep=tang": "act=gia_tang"?>" class="select-input__link">Giá thấp đến cao</a>
                                    </li>
                                    <li class="select-input__item">
                                        <a href="home.php?<?=isset($_GET["act"]) && $_GET["act"] == "danhmuc"?"act=danhmuc&id=".$_GET["id"]."&sapxep=giam": "act=gia_giam"?>" class="select-input__link">Giá cao đến thấp</a>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        <div class="home-product">
                            <div class="grid__row">
                                <!-- product column 2-4 phần sản phẩm copy cả grid__column-2-4 -->
                                <?php foreach($top10sanpham as $sanpham):
                                        $hinhanh = $img_path.$sanpham["hinhanh"];
                                        $tinhphantram = ($sanpham["giacu"] - $sanpham["giamoi"])/$sanpham["giacu"]*100;
                                        $phamtramgiamgia = intval($tinhphantram);
                                        $chuoiten_nxb = $sanpham["nhaxuatban"];
                                        $soKiTu = 6;
                                        $nguong = 10;
                                        if (strlen($chuoiten_nxb) > $nguong) {
                                            $chuoiMoi = substr($chuoiten_nxb, 0, $soKiTu) . '...';
                                        } else {
                                            $chuoiMoi = $chuoiten_nxb;
                                        }
                                        
                                       
                                    ?>
                                <div class="grid__column-2-4">
                                    <a href="home.php?act=chitietsanpham&id=<?=$sanpham["id"]?>" class="home-product-item">
                                        <div class="home-product-item__img" style="background-image: url(<?=$hinhanh?>);"></div>
                                        <h4 class="home-product-item__name"><?=$sanpham["tensanpham"]?></h4>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-old"><?=$sanpham["giacu"]?></span>
                                            <span class="home-product-item__price-current"><?=$sanpham["giamoi"]?></span>

                                        </div>
                                        <div class="home-product-item__action">
                                            <span class="home-product-item__like home-product-item__liked">
                                                <i class="home-product-item__like-icon-isset fa-solid fa-heart"></i> 
                                                <i class="home-product-item__like-icon-empty fa-regular fa-heart"></i>
                                            </span>
                                            
                                           
                                        </div>
                                        <div class="home-product-item__origin">
                                            <span class="home-product-item__brand">Số Lượng:<?=$sanpham["soluong"]?> </span>
                                            <span class="home-product-item__origin-name"><?=$chuoiMoi?></span>
                                        </div>
                                        
                                        <div class="home-product-item__sale-off">
                                            <div class="home-product-item__sale-off-percent"><?=$phamtramgiamgia?>%</div>
                                            <span class="home-product-item__sale-off-label">Giảm</span>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <ul class="pagination home-product__pagination">
                            <li class="pagination-item">
                                <a href="home.php<?=empty($_GET["page"]) || $_GET["page"] == 1?"?page=1" : "?page=".$_GET["page"]-1 ?>" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-left"></i>
                                </a>
                                
                            </li>
                            <?php for($num = 1;$num <= $totalPage ;$num++): 
                                if($num > $currentPage -3 && $num < $currentPage +3 ){
                                ?>
                            <li class="pagination-item   <?php  if(empty($_GET["page"]) && $num == 1){ echo "pagination-item--active"; }else{ echo isset($_GET["page"]) && $_GET["page"] == $num ?"pagination-item--active":""; }  ?>">
                                <a href="home.php?page=<?=$num ?>" class="pagination-item__link "><?=$num?></a>
                                
                            </li>

                            <?php } endfor; ?>
                            <li class="pagination-item">
                                <a href="home.php?page=<?php if(empty($_GET["page"])){ if($totalPage < 2){ echo 1;}else{ echo 2;} }else{ echo $_GET["page"]==$totalPage ?$totalPage : $_GET["page"]+1;}  ?>" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-right"></i>
                                </a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>