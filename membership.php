
<?php include 'include/header.php'; ?>

<!--Body Content-->
<div id="page-content">     
    <div><img src="assets/images/main/skincare_banner.jpg" alt="" width="100%"></div>
    <br><br>
    <div class="container">
        
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7">
                <a href="shop.php" class="btn btn-dark">All Product</a>
                <a href="promo.php" class="btn btn-dark bg-success">Promo</a>
                <a href="regular.php" class="btn btn-dark bg-primary">Regular</a>
                <a href="best.php" class="btn btn-dark bg-info">Best Seller</a>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="row">
                    <div class="col-8">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Search Product" name="itemcode" class="form-control rounded-0 w-100" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-dark form-control w-100" name="shop">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h3>Membership Package</h3>
        <br>
        <?php 
            if (isset($_POST['shop'])) { #shop search start
                $item_code = $_POST['itemcode'];
        ?>
        <div class="row">
        <?php
        $d_item = "SELECT items_created, code_name, items_desc, items_status FROM upti_code 
        INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code 
        WHERE code_category = 'PROMO' AND items_status = 'Active' AND items_desc LIKE '%".$item_code."%' OR 
        code_category = 'REBATABLE' AND items_status = 'Active' AND items_desc LIKE '%".$item_code."%' OR
        code_category = 'BUY ONE GET ANY' AND items_status = 'Active' AND items_desc LIKE '%".$item_code."%' OR
        code_category = 'BUY ONE GET TWO' AND items_status = 'Active' AND items_desc LIKE '%".$item_code."%' 
        UNION 
        SELECT package_stamp, code_name, package_desc, package_status FROM upti_code 
        INNER JOIN upti_package ON upti_code.code_name = upti_package.package_code 
        WHERE code_category = 'PROMO' AND package_status = 'Active' AND package_desc LIKE '%".$item_code."%' OR
        code_category = 'REBATABLE' AND package_status = 'Active' AND package_desc LIKE '%".$item_code."%' OR
        code_category = 'BUY ONE GET ANY' AND package_status = 'Active' AND package_desc LIKE '%".$item_code."%' OR
        code_category = 'BUY ONE GET TWO' AND package_status = 'Active' AND package_desc LIKE '%".$item_code."%'
        ORDER BY items_created DESC";
        $d_item_sql = mysqli_query($connect, $d_item);
        if (mysqli_num_rows($d_item_sql) > 0) {
            ?>
            <div class="col-12">
                <br>
            <p class="text-center">Showing Result for <b><?php echo $item_code ?></b></p>
            </div>
            <?php
            while ($d_item_fetch = mysqli_fetch_array($d_item_sql)) {
                $d_item_code = $d_item_fetch['code_name'];

                $d_item_price = "SELECT * FROM upti_country WHERE country_name = '$customer_country' AND country_code = '$d_item_code'";
                $d_item_price_sql = mysqli_query($connect, $d_item_price);
                $d_item_price_fetch = mysqli_fetch_array($d_item_price_sql);

                $prod_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$d_item_code'");
                $get_img = mysqli_fetch_array($prod_stmt);

                if (mysqli_num_rows($prod_stmt) > 0) {
                    $images = $get_img['p_m_img'];
                } else {
                    $images = '';
                }

            ?>
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="col-12">
                    <!-- start product image -->
                    <span class="whislist"><a href="#" class="dis"><i class="fa-thin fa-heart"></i></a></span>
                    <span class="discount"><i class="fa fa-medal medds"></i></span>
                    
                    <div class="cart-img">
                        <?php
                            if ($images == '') {
                        ?>
                            <img src="assets\images\main\default.jpg">
                        <?php
                            } else {
                        ?>
                            <img src="assets\images\product\<?php echo $images ?>">
                        <?php
                            }
                        ?>
                    </div>
                    <!-- end product image -->

                    <!--start product details -->
                    <div class="product-details text-center item">
                        <!-- product name -->
                        <div class="product-name">
                            <a href="details.php?code=<?php echo $d_item_code ?>" class="product-name" style="font-size: 14px;"><?php echo $d_item_fetch['items_desc']; ?></a>
                        </div>
                        <!-- End product name -->
                    </div>
                    <?php if ($profile != '') { ?>
                    <form action="backend/add-to-cart.php?code=<?php echo $d_item_code ?>" onclick="window.location.href='cart.php'" method="post" class="item">
                        <?php
                            $main_code_qry = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$d_item_code'");
                            $maincode = mysqli_fetch_array($main_code_qry);

                            $main_code = $maincode['code_main'];
                            
                            $pack_stock = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$d_item_code'");
                            $pack_item = mysqli_fetch_array($pack_stock);

                            if (mysqli_num_rows($pack_stock)) {
                                
                                $c1 = $pack_item['package_one_code'];
                                $q1 = $pack_item['package_one_qty'];

                                $stocks_stmt1 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c1'");
                                $stockist_inv1 = mysqli_fetch_array($stocks_stmt1);

                                $pack1 = $stockist_inv1['si_item_stock'];

                                if ($pack1 == '') {
                                    $pack1 = 0;
                                }

                                $c2 = $pack_item['package_two_code'];
                                $q2 = $pack_item['package_two_qty'];

                                $stocks_stmt2 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c2'");
                                $stockist_inv2 = mysqli_fetch_array($stocks_stmt2);

                                $pack2 = $stockist_inv2['si_item_stock'];

                                if ($pack2 == '') {
                                    $pack2 = 0;
                                }

                                $c3 = $pack_item['package_three_code'];
                                $q3 = $pack_item['package_three_qty'];

                                $stocks_stmt3 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c3'");
                                $stockist_inv3 = mysqli_fetch_array($stocks_stmt3);

                                $pack3 = $stockist_inv3['si_item_stock'];

                                if ($pack3 == '') {
                                    $pack3 = 0;
                                }

                                $c4 = $pack_item['package_four_code'];
                                $q4 = $pack_item['package_four_qty'];

                                $stocks_stmt4 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c4'");
                                $stockist_inv4 = mysqli_fetch_array($stocks_stmt4);

                                $pack4 = $stockist_inv4['si_item_stock'];

                                if ($pack4 == '') {
                                    $pack4 = 0;
                                }

                                $c5 = $pack_item['package_five_code'];
                                $q5 = $pack_item['package_five_qty'];

                                $stocks_stmt5 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c5'");
                                $stockist_inv5 = mysqli_fetch_array($stocks_stmt5);

                                $pack5 = $stockist_inv5['si_item_stock'];

                                if ($pack5 == '') {
                                    $pack5 = 0;
                                }

                                $stocks = '1';
                            } else {
                                $stocks_stmt = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$main_code'");
                                $stockist_inv = mysqli_fetch_array($stocks_stmt);
        
                                if (mysqli_num_rows($stocks_stmt) > 0) {
                                    $stocks = $stockist_inv['si_item_stock'];
                                } else {
                                    $stocks = 0;
                                }

                                $pack1 = 0;
                                $pack2 = 0;
                                $pack3 = 0;
                                $pack4 = 0;
                                $pack5 = 0;
                            }

                            if ($d_item_price_fetch['country_price'] < 1) {
                        ?>
                            <button class="btn btn-custom w-100" tabindex="0" disabled>NO PRICE</button>
                            <?php } elseif ($stocks != 0 && $pack1 < 1 &&  $pack2 < 1 &&  $pack3 < 1 &&  $pack4 < 1 &&  $pack5 < 1 || $stocks == 1 && $pack1 >= $q1 &&  $pack2 >= $q2 &&  $pack3 >= $q3 && $pack4 >= $q4 && $pack5 >= $q5) { ?>
                                <button class="btn btn-custom w-100" tabindex="0" name="addtocart">ADD TO CART - <?php echo $country_code ?> <?php $price = $d_item_price_fetch['country_price']; echo number_format($price); ?></button>
                        <?php } else { ?>
                            <button class="btn btn-custom w-100" tabindex="0" disabled>OUT OF STOCK</button>
                        <?php } ?>
                    </form>
                    <?php } else { ?>
                        <a href="login.php" class="btn btn-custom w-100" tabindex="0">ADD TO CART - <?php echo $country_code ?> <?php $price = $d_item_price_fetch['country_price']; echo number_format($price); ?></a>
                    <?php } ?>
                    <!-- End product details -->
                    <br>
                </div>
            </div>
            <?php } ?>
            <?php } else { ?>
                <div class="row align-items-center text-center">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <img src="assets/images/main/empty.jpg" alt="" class="img-responsive w-100">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <h1 class="text-center">Showing results for <br><b><?php echo $item_code ?></b></h1>
                    </div>
                </div>
            <?php }  ?>
        <?php
            } else { #shop search middle
        ?>
        <div class="row">
        <?php

        $rpp = 20;

        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $start_from = ($page-1)*$rpp;

        $d_item = "SELECT items_created, code_name, items_desc, items_status FROM upti_code 
        INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code
        INNER JOIN upti_product ON upti_code.code_name = upti_product.p_code
        WHERE 
        code_category = 'RESELLER' AND items_status = 'Active' AND p_tag = 'Membership'
        UNION 
        SELECT package_stamp, code_name, package_desc, package_status FROM upti_code 
        INNER JOIN upti_package ON upti_code.code_name = upti_package.package_code
        INNER JOIN upti_product ON upti_package.package_code = upti_product.p_code
        WHERE
        code_category = 'RESELLER' AND package_status = 'Active' AND p_tag = 'Membership' 
        ORDER BY items_created DESC
        LIMIT $start_from, $rpp";
        $d_item_sql = mysqli_query($connect, $d_item);
        while ($d_item_fetch = mysqli_fetch_array($d_item_sql)) {
            $d_item_code = $d_item_fetch['code_name'];

            $d_item_price = "SELECT * FROM upti_country WHERE country_name = '$customer_country' AND country_code = '$d_item_code'";
            $d_item_price_sql = mysqli_query($connect, $d_item_price);
            $d_item_price_fetch = mysqli_fetch_array($d_item_price_sql);

            $prod_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$d_item_code'");
            $get_img = mysqli_fetch_array($prod_stmt);

            if (mysqli_num_rows($prod_stmt) > 0) {
                $images = $get_img['p_m_img'];
            } else {
                $images = '';
            }

        ?>
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="col-12">
                <!-- start product image -->
                <span class="whislist"><a href="#" class="dis"><i class="fa-thin fa-heart"></i></a></span>
                <span class="discount"><i class="fa fa-medal medds"></i></span>
                
                <div class="cart-img">
                    <?php
                        if ($images == '') {
                    ?>
                        <img src="assets\images\main\default.jpg">
                    <?php
                        } else {
                    ?>
                        <img src="assets\images\product\<?php echo $images ?>">
                    <?php
                        }
                    ?>
                </div>
                <!-- end product image -->

                <!--start product details -->
                <div class="product-details text-center item">
                    <!-- product name -->
                    <div class="product-name">
                        <a href="details.php?code=<?php echo $d_item_code ?>" class="product-name" style="font-size: 14px;"><?php echo $d_item_fetch['items_desc']; ?></a>
                    </div>
                    <!-- End product name -->
                </div>
                <?php if ($profile != '') { ?>
                <form action="backend/add-to-cart.php?code=<?php echo $d_item_code ?>" onclick="window.location.href='cart.php'" method="post" class="item">
                    <?php
                        $main_code_qry = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$d_item_code'");
                        $maincode = mysqli_fetch_array($main_code_qry);

                        $main_code = $maincode['code_main'];
                        
                        $pack_stock = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$d_item_code'");
                        $pack_item = mysqli_fetch_array($pack_stock);

                        if (mysqli_num_rows($pack_stock)) {
                            
                            $c1 = $pack_item['package_one_code'];
                            $q1 = $pack_item['package_one_qty'];

                            $stocks_stmt1 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c1'");
                            $stockist_inv1 = mysqli_fetch_array($stocks_stmt1);

                            $pack1 = $stockist_inv1['si_item_stock'];

                            if ($pack1 == '') {
                                $pack1 = 0;
                            }

                            $c2 = $pack_item['package_two_code'];
                            $q2 = $pack_item['package_two_qty'];

                            $stocks_stmt2 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c2'");
                            $stockist_inv2 = mysqli_fetch_array($stocks_stmt2);

                            $pack2 = $stockist_inv2['si_item_stock'];

                            if ($pack2 == '') {
                                $pack2 = 0;
                            }

                            $c3 = $pack_item['package_three_code'];
                            $q3 = $pack_item['package_three_qty'];

                            $stocks_stmt3 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c3'");
                            $stockist_inv3 = mysqli_fetch_array($stocks_stmt3);

                            $pack3 = $stockist_inv3['si_item_stock'];

                            if ($pack3 == '') {
                                $pack3 = 0;
                            }

                            $c4 = $pack_item['package_four_code'];
                            $q4 = $pack_item['package_four_qty'];

                            $stocks_stmt4 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c4'");
                            $stockist_inv4 = mysqli_fetch_array($stocks_stmt4);

                            $pack4 = $stockist_inv4['si_item_stock'];

                            if ($pack4 == '') {
                                $pack4 = 0;
                            }

                            $c5 = $pack_item['package_five_code'];
                            $q5 = $pack_item['package_five_qty'];

                            $stocks_stmt5 = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c5'");
                            $stockist_inv5 = mysqli_fetch_array($stocks_stmt5);

                            $pack5 = $stockist_inv5['si_item_stock'];

                            if ($pack5 == '') {
                                $pack5 = 0;
                            }

                            $stocks = '1';
                        } else {
                            $stocks_stmt = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$main_code'");
                            $stockist_inv = mysqli_fetch_array($stocks_stmt);
    
                            if (mysqli_num_rows($stocks_stmt) > 0) {
                                $stocks = $stockist_inv['si_item_stock'];
                            } else {
                                $stocks = 0;
                            }

                            $pack1 = 0;
                            $pack2 = 0;
                            $pack3 = 0;
                            $pack4 = 0;
                            $pack5 = 0;
                        }

                        if ($d_item_price_fetch['country_price'] < 1) {
                    ?>
                        <button class="btn btn-custom w-100" tabindex="0" disabled>NO PRICE</button>
                        <?php } elseif ($stocks != 0 && $pack1 < 1 &&  $pack2 < 1 &&  $pack3 < 1 &&  $pack4 < 1 &&  $pack5 < 1 || $stocks == 1 && $pack1 >= $q1 &&  $pack2 >= $q2 &&  $pack3 >= $q3 && $pack4 >= $q4 && $pack5 >= $q5) { ?>
                            <button class="btn btn-custom w-100" tabindex="0" name="addtocart">ADD TO CART - <?php echo $country_code ?> <?php $price = $d_item_price_fetch['country_price']; echo number_format($price); ?></button>
                    <?php } else { ?>
                        <button class="btn btn-custom w-100" tabindex="0" disabled>OUT OF STOCK</button>
                    <?php } ?>
                </form>
                <?php } else { ?>
                    <a href="login.php" class="btn btn-custom w-100" tabindex="0">ADD TO CART - <?php echo $country_code ?> <?php $price = $d_item_price_fetch['country_price']; echo number_format($price); ?></a>
                <?php } ?>
                <!-- End product details -->
                <br>
            </div>
        </div>
        <?php } ?>
        
        <div class="col-12">
            <br><br>
            <?php
                $page_info = "SELECT items_created, code_name, items_desc, items_status FROM upti_code 
                INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code
                INNER JOIN upti_product ON upti_code.code_name = upti_product.p_code
                WHERE 
                code_category = 'RESELLER' AND items_status = 'Active' AND p_tag = 'Membership'
                UNION 
                SELECT package_stamp, code_name, package_desc, package_status FROM upti_code 
                INNER JOIN upti_package ON upti_code.code_name = upti_package.package_code
                INNER JOIN upti_product ON upti_package.package_code = upti_product.p_code
                WHERE
                code_category = 'RESELLER' AND package_status = 'Active' AND p_tag = 'Membership'";
                $page_query = mysqli_query($connect, $page_info);
                $page_num = mysqli_num_rows($page_query);

                $tot_pages = ceil($page_num / $rpp);
            ?>
            <nav class="page navigation" aria-label="...">
                <ul class="pagination">
                    <?php
                        for ($loop = 1; $loop <= $tot_pages; $loop++) {
                    ?>
                    <li class="page-item"><a class="page-link" href="shop.php?page=<?php echo $loop; ?>"><?php echo $loop; ?></a></li>
                    <?php 
                        }
                    ?>
                </ul>
            </nav>
            <p class="text-center">Page <?php echo $page ?></p>
        </div>
        <?php
            } #shop search end
        ?>
    </div>
</div>
<!--End Body Content-->
    
<?php include 'include/footer.php'; ?>