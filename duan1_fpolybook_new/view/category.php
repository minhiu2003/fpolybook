<?php 
    $danhmuc = load_all_danhmuc();
?>

<div class="grid__column-2">
                        <nav class="category">
                            <h3 class="category__heading">
                                <i class="category__heading-icon fa-solid fa-list"></i>
                                 Danh mục
                            </h3>
                            <ul class="category-list">
                                <?php 
                                foreach($danhmuc as $dm):
                                ?>
                                <li class="category-item <?=isset($_GET["act"])&&$_GET["act"]=="danhmuc"&&$_GET["id"]==$dm["id"]?"category-item--active":"";?>">
                                    <a href="home.php?act=danhmuc&id=<?=$dm["id"]?>" class="catogery-item__link">
                                        <?=$dm["ten"]?>
                                    </a>
                                </li>
                                <?php 
                               endforeach;
                                ?>
                            </ul>
                        </nav>
                    </div>