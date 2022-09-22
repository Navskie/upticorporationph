<?php include 'include/header.php'; ?>

<?php
    $item_code = $_GET['code'];

    $image_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$item_code'");
    $image = mysqli_fetch_array($image_stmt);

    if (mysqli_num_rows($image_stmt) > 0) {
        $main_image = $image['p_m_img'];
        $one_image = $image['p_1_img'];
        $two_image = $image['p_2_img'];
        $three_image = $image['p_3_img'];

        $desc = $image['p_desc'];
        $benefits = $image['p_benefits'];
        $ingredients = $image['p_ingredients'];
        $howtouse = $image['p_howtouse'];
    } else {
        $main_image = '';
        $one_image = '';
        $two_image = '';
        $three_image = '';

        $desc = '';
        $benefits = '';
        $ingredients = '';
        $howtouse = '';
    }

    $single_item = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$item_code'");
    if(mysqli_num_rows($single_item) > 0) {
        $s_fetch = mysqli_fetch_array($single_item);

        $item_name = $s_fetch['items_desc'];
    } else {
        $package_item = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$item_code'");
        $p_fetch = mysqli_fetch_array($package_item);

        $item_name = $p_fetch['package_desc'];
    }

    $price_stmt = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$customer_country' AND country_code = '$item_code'");
    $price_fetch = mysqli_fetch_array($price_stmt);

    $price = $price_fetch['country_price'];
?>

<!--Body Content-->
<div id="page-content">     

    <!--Breadcrumb-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.php" title="Back to the home page">Home</a><span aria-hidden="true">›</span><a href="shop.php" title="Back to the home page">Shop</a><span aria-hidden="true">›</span><span>Product Details</span>
        </div>
    </div>
    <!--End Breadcrumb-->

    <!-- Container Start -->
    <div class="container">
        <!-- Row Column -->
        <div class="row">
            
            <!-- First Column -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="product-details-img product-single__photos bottom">
                    <div class="zoompro-wrap product-zoom-right pl-20">
                        <div class="zoompro-span">
                            <img class="blur-up lazyload zoompro" data-zoom-image="assets/images/product/<?php echo $main_image ?>" alt="" src="assets/images/product/<?php echo $main_image ?>" />               
                        </div>
                        <!-- <div class="product-labels"><span class="lbl on-sale">Sale</span><span class="lbl pr-label1">new</span></div> -->
                        <div class="product-buttons">
                            <a href="https://www.youtube.com/watch?v=BvR-1cIvAjQ" class="btn popup-video" title="View Video"><i class="icon anm anm-play-r" aria-hidden="true"></i></a>
                            <!-- <a href="#" class="btn prlightbox" title="Zoom"><i class="icon anm anm-expand-l-arrows" aria-hidden="true"></i></a> -->
                        </div>
                    </div>
                    <div class="product-thumb product-thumb-1">
                        <div id="gallery" class="product-dec-slider-1 product-tab-left">
                            <a data-image="assets/images/product/mesh.png" data-zoom-image="assets/images/product/<?php echo $one_image ?>" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                <img class="blur-up lazyload" src="assets/images/product/<?php echo $one_image ?>" alt="" />
                            </a>
                            <a data-image="assets/images/product/mesh.png" data-zoom-image="assets/images/product/<?php echo $two_image ?>" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                <img class="blur-up lazyload" src="assets/images/product/<?php echo $two_image ?>" alt="" />
                            </a>
                            <a data-image="assets/images/product/mesh.png" data-zoom-image="assets/images/product/<?php echo $three_image ?>" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                <img class="blur-up lazyload" src="assets/images/product/<?php echo $three_image ?>" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Column -->
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="product-single__meta">
                    <br>
                    <h1 class="product-single__title" style="font-weight: 700; font-size: 30px;"><?php echo $item_name ?></h1>
                    <div class="prInfoRow">
                        <!-- <div class="product-stock"> <span class="instock ">Sleeping Pack, 120g</span> -->
                    </div>
                    <br><br>
                    <div class="product-single__description rte" style="font-size: 20px;">
                        <p><?php echo $desc ?>.</p>
                        <!-- <ul>
                            <li>Contains 3% of highly concentrated Sanghwang mushroom extract.</li>
                            <li>Infused with aloe, loofah and licorice to nourish skin for clearer and softer skin texture</li>
                            <li>Creamy, lightweight texture absorbs instantly absorbs instantly into skin.</li>
                        </ul> -->
                    </div>
                    <br>
                    <form action="backend/add-to-cart.php?code=<?php echo $item_code ?>" method="post">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <p class="product-single__price product-single__price-product-template">
                                    <span class="visually-hidden">Regular price</span>
                                    <s id="ComparePrice-product-template"><span class="money"></span></s>
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money"><?php echo $country_code ?> <?php echo number_format($price) ?></span></span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="wrapQtyBtn float-right">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                        <input type="text" id="Quantity" name="qty" value="1" class="product-form__input qty">
                                        <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <?php if ($profile != '') { ?>
                                    <button class="btn form-control" style="background: #2752ae;" name="details">ADD TO CART</button>
                                <?php } else { ?>
                                    <button class="btn form-control" style="background: #2752ae;" disabled>ADD TO CART</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- Row Column End -->
        
    </div>
    <!-- Container End -->
    <br><br>
    <!--Breadcrumb-->
    <div class="bredcrumbWrap" style="background: #fff !important; border-top: 2px solid #000; border-bottom: 2px solid #000">
        <div class="container breadcrumbs font-weight-bold">
            <div class="row text-center">
                <div class="col-3">
                    <a href="#">Benefits</a>
                </div>
                <div class="col-3">
                    <a href="#">Ingredients</a>
                </div>
                <div class="col-3">
                    <a href="#">How to use</a>
                </div>
                <div class="col-3">
                    <a href="#">Reviews</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Breadcrumb-->

    <div class="container">
        <!-- Benefits -->
        <div class="benefits text-center">
            <h1 style="font-weight: 700; font-size: 30px;">Benefits</h1>
            <p style="padding: 0 80px 0 80px">
                <?php echo $benefits ?>
            </p>
        </div>
        <br><br>
        <div class="text-center" style="background-color: #f3eded; padding: 20px 20px 20px 20px;">
            <div class="row">
                <div class="col-8">
                    <video width="400" controls class="w-100">
                        <source src="assets/video/testimonial.mp4" type="video/mp4">
                    </video>
                    <br>
                </div>
                <div class="col-4">
                    <br><br>
                    <h1 style="font-weight: 700; font-size: 30px;">How to use</h1>
                    <br><br>
                    <p style="padding: 0 20px 0 20px; font-size: 20px;">
                    <?php
                        echo $howtouse;
                    ?>
                    </p>
                </div>
            </div>
        </div>

        <br><br>
        <!-- Benefits -->
        <div class="benefits text-center">
            <h1 style="font-weight: 700; font-size: 30px;">Reviews 4.8</h1>
            <!-- <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i> -->
            <hr>
            <h4>Write A Review</h4>
            <form action="backend/reviews.php?code=<?php echo $item_code ?>" method="post">
                <div class="row">
                    <div class="col-4">
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="rating">
                            <option value="">Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="skin">
                            <option value="">Skin</option>
                            <option value="Combination">Combination</option>
                            <option value="Dry">Dry</option>
                            <option value="Normal">Normal</option>
                            <option value="Oily">Oily</option>
                        </select>

                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="concern">
                            <option value="">Skin Concern</option>
                            <option value="Dryness">Dryness</option>
                            <option value="Pores">Pores</option>
                            <option value="Troubled Skin">Troubled Skin</option>
                            <option value="Uneven Skin Tone">Uneven Skin Tone</option>
                            <option value="Lifting & Firming">Lifting & Firming</option>
                        </select>

                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="age">
                            <option value="">Age</option>
                            <option value="Under 18">Under 18</option>
                            <option value="18-24">18-24</option>
                            <option value="25-34">25-34</option>
                            <option value="35-44">35-44</option>
                            <option value="45-54">45-54</option>
                            <option value="55 & Older">55 & Older</option>
                        </select>
                    </div>

                    <div class="col-8">
                        <!-- <label class="float-left">Title</label>
                        <br> -->
                        <input type="text" class="form-control rounded-0" placeholder="Title" name="title">
                        <br>
                        <!-- <label class="float-left">Write a comment</label> -->
                        <textarea name="desc" id="" cols="20" rows="3"></textarea>

                        <div class="pt-2 float-right">
                            <button class="btn btn-success" name="review">Submit Comment</button>
                        </div>
                    </div>
                </div>
            </form>
                <hr>
                <?php
                    $reviews = mysqli_query($connect, "SELECT * FROM web_reviews WHERE rev_code = '$item_code'");
                    $reviews_count = mysqli_query($connect, "SELECT COUNT(id) AS reviews FROM web_reviews WHERE rev_code = '$item_code'");
                    $count = mysqli_fetch_array($reviews_count);
                ?>
                <h4 class="text-left">Total of <?php echo $count['reviews'] ?> Reviews</h4>
                <br>
                <?php
                    while ($rows = mysqli_fetch_array($reviews)) {
                        $user_id = $rows['rev_user'];
                        $get_user = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$user_id'");
                        $fetch_user = mysqli_fetch_array($get_user);

                        $name = $fetch_user['users_name'];
                        $image = $fetch_user['users_img'];
                        
                ?>
                <div class="row">
                    <div class="col-3">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <?php if ($image != '') { ?>
                                    <img src="system/images/profile/<?php echo $image ?>" class="rounded-circle" alt="" width="100%">
                                <?php } else { ?>
                                    <img src="system/images/profile/default.jpg" class="rounded-circle" alt="" width="100%">
                                <?php } ?>
                            </div>

                            <div class="col-lg-7 col-md-7 col-sm-12 text-left">
                                <h6 class="text-left" style="line-height: 0.5"><?php echo $name ?></h6>
                                <?php if ($rows['rev_star'] == 5) { ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i><br>
                                <?php } elseif ($rows['rev_star'] == 4) { ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i><br>
                                <?php } elseif ($rows['rev_star'] == 3) { ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i><br>
                                <?php } elseif ($rows['rev_star'] == 2) { ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i><br>
                                <?php } elseif ($rows['rev_star'] == 1) { ?>
                                    <i class="fa-solid fa-star"></i><br>
                                <?php } ?>
                                <i style="font-size: 11px;" class="">
                                    Skin Concern: <?php echo $rows['rev_concern'] ?> <br>
                                    Age: <?php echo $rows['rev_age'] ?>
                                </i>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        <span class="float-right"><?php echo $rows['rev_time'] ?> - <?php echo $rows['rev_date'] ?></span>
                        <h5 class="text-left"><?php echo $rows['rev_title'] ?></h5>
                        <p class="text-left"><?php echo $rows['rev_desc'] ?></p>
                        <hr>
                    </div>
                </div>
                <?php
                    }
                ?>
        </div>
        <!-- Benefits End -->
    </div>
</div>
<!--End Body Content-->
    
<?php include 'include/footer.php'; ?>