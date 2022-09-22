  <!DOCTYPE html>
  <?php 
    session_start();
    include 'function.php';
    include 'db.php';

    $profile = $_SESSION['code'];
    $id = $_SESSION['uid'];

    $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
    $fetch_count = mysqli_fetch_array($user_info);
    $user_count = $fetch_count['users_count'];
    $ref = 'CS'.$id.'-22'.$user_count;
    
  ?>
  <html class="no-js" lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Uptimised Corporation</title>
  <meta name="description" content="description">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/274966106_640652090373107_513539919171817442_n.ico">
  <!-- Plugins CSS -->
  <link rel="stylesheet" href="assets/css/plugins.css">
  <!-- Bootstap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Main Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Toastr -->
  <link rel="stylesheet" href="toastr/toastr.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <style>
      .pagination li a {
      font-size: 12px;
      color: #000;
      height: 30px !important;
      width: 30px !important;
      line-height: 12px !important;
      margin-right: 2px;
      text-align: center;
      display: inline-block;
      border: 1px solid #000000;
      vertical-align: center;
      }
      .list-inline, .list-unstyled {
        padding-left: 0 !important;
        height: 174px !important;
        list-style: none !important;
        overflow-y: auto !important;
      }
  </style>
  </head>
  <body class="page-template lookbook-template error-page belle">
  <div class="pageWrapper">
    <!--Search Form Drawer-->
    <div class="search">
          <div class="search__form">
              <form class="search-bar__form" action="#">
                  <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                  <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
              </form>
              <button type="button" class="search-trigger close-btn"><i class="icon anm anm-times-l"></i></button>
          </div>
      </div>
      <!--End Search Form Drawer-->
      <!--Top Header-->
      <div class="top-header" style="background-color: #cdb97e;">
          <div class="container-fluid">
              <div class="row">
                <!-- <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                  <p class="phone-no"><i class="anm anm-phone-s"></i> (+63 47) 252-0189</p>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                  <div class="text-center"><p class="top-header_middle-text"> Uptimised Corporation</p></div>
                </div> -->
                <!-- <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                  <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                    <ul class="customer-links list-inline">
                      <li><a href="https://upticorporationph.com" target="_blank">Login</a></li>
                      <li><a href="#">Create Account</a></li>
                      <li><a href="#">Wishlist</a></li>
                    </ul>
                </div> -->
              </div>
          </div>
      </div>
      <!--End Top Header-->
      <!--Header-->
      <div class="header-wrap animated d-flex">
        <div class="container-fluid">        
              <div class="row align-items-center">               
                  <div class="col-4">
                    <div class="d-block d-lg-none">
                          <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                            <i class="icon anm anm-times-l"></i>
                            <i class="anm anm-bars-r"></i>
                          </button>
                      </div>
                    <!--Desktop Menu-->
                      <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                        <ul id="siteNav" class="site-nav medium hidearrow">                               
                          <li class="parent dropdown"><a href="#">Our Story<i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown">
                              <li><a href="whoweare.php" class="site-nav">Who We Are</a></li>
                              <li><a href="phil.php" class="site-nav">Product Philosophy</a></li>
                            </ul>
                          </li>
                          <li class="parent dropdown2"><a href="shop.php">SHOP <i class="anm anm-angle-down-l"></i></a>
                            <!-- <ul class="dropdown2">
                              <li><a href="whoweare.php" class="site-nav">Promo</a></li>
                              <li><a href="phil.php" class="site-nav">Best Seller</a></li>
                              <li><a href="whoweare.php" class="site-nav">Regular SKU</a></li>
                              <li><a href="phil.php" class="site-nav">Membership</a></li>
                            </ul> -->
                          </li>
                          <li class="parent dropdown"><a href="joinus.php">Join Us <i class="anm anm-angle-down-l"></i></a></li>
                        </ul>
                      </nav>
                      <!--End Desktop Menu-->
                  </div>
                  <div class="logo col-4">
                    <center>
                      <a href="index.php">
                        <img src="assets/images/main/logi.png"/>
                      </a>
                    </center>
                  </div>
                  <div class="col-4">
                  <div class="site-cart pt-1">
                          <?php
                            $cart_num_rows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_id = '$profile' AND cart_ref = '$ref'"));

                            if ($cart_num_rows == 0) {
                          ?>
                          <!-- START EMPTY CART -->
                          <a href="#" class="site-header__cart" title="Cart">
                            <i class="icon anm anm-bag-l"></i>
                            <!-- <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">0</span> -->
                          </a>
                          <!--Minicart Popup-->
                          <div id="header-cart" class="block block-cart">
                            <ul class="mini-products-list">
                                  <li class="item">
                                    <b>Order List</b>
                                  </li>
                                  <li class="item text-center">
                                    Empty Cart
                                  </li>
                              </ul>
                              <div class="total">
                                <div class="total-in">
                                  <span class="label">a Subtotal:</span><span class="product-price"><span class="money">0.00</span></span>
                                </div>
                                <div class="buttonSet text-center">
                                  <a href="shop.php" class="btn btn-secondary btn--small">Shop Now</a>
                                </div>
                              </div>
                          </div>
                          <?php $cart_total = 0; ?>
                          <!--End Minicart Popup-->
                          <!-- END EMPTY CART -->
                          <?php } else { ?>
                          <!-- START NOT EMPTY CART -->
                          <a href="#" class="site-header__cart" title="Cart">
                            <i class="icon anm anm-bag-l"></i>
                            <?php
                              $sum_cart = mysqli_query($connect, "SELECT COUNT(*) AS cart FROM web_cart WHERE cart_id = '$profile' AND cart_ref = '$ref'");
                              $fetch_sum = mysqli_fetch_array($sum_cart);
                            ?>
                            <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count"><?php echo $fetch_sum['cart'] ?></span>
                          </a>
                          <!--Minicart Popup-->
                          <div id="header-cart" class="block block-cart">
                            <ul class="mini-products-list">
                                <?php
                                  $loop_cart = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_id = '$profile' AND cart_ref = '$ref' AND cart_status = 'On Cart'");
                                  while ($cart = mysqli_fetch_array($loop_cart)) {
                                    $cart_code = $cart['cart_code'];

                                    $image = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$cart_code'");
                                    $image_fetch = mysqli_fetch_array($image);
                                ?>
                                  <li class="item">
                                      <a class="product-image" href="#">
                                        <img src="assets/images/product/<?php echo $image_fetch['p_m_img'] ?>" title="" />
                                      </a>
                                      <div class="product-details">
                                          <a href="backend/remove-navbar-cart.php?id=<?php echo $cart['id'] ?>" class="remove"><i class="anm anm-times-l" aria-hidden="true"></i></a>
                                          <!-- <a href="#" class="edit-i remove"><i class="anm anm-edit" aria-hidden="true"></i></a> -->
                                          <a class="pName" href="cart.php"><?php echo $cart['cart_desc'] ?></a>
                                          <div class="variant-cart"><?php echo $cart['cart_code'] ?></div>
                                          
                                          <div class="priceRow">
                                            <div class="product-price">
                                              <span class="money"> <?php echo $country_code ?> <?php echo $cart['cart_price'] ?></span>
                                            </div>
                                          </div>
                                      </div>
                                  </li>
                                <?php } ?>
                              </ul>
                              <div class="total">
                                <?php
                                  $sum_cart = mysqli_query($connect, "SELECT SUM(cart_subtotal) AS tot_cart FROM web_cart WHERE cart_id = '$profile' AND cart_ref = '$ref' AND cart_status = 'On Cart'");
                                  $cart_tot = mysqli_fetch_array($sum_cart);
                                  $cart_total = $cart_tot['tot_cart'];
                                ?>
                                <div class="total-in">
                                  <span class="label">Cart Subtotal:</span><span class="product-price"><span class="money"> <?php echo $country_code ?> <?php echo $cart_total ?></span></span>
                                </div>
                                <div class="buttonSet text-center">
                                  <a href="cart.php" class="btn btn-secondary btn--small">View Cart</a>
                                  <a href="cart.php" class="btn btn-secondary btn--small">Checkout</a>
                                </div>
                              </div>
                          </div>
                          <!--End Minicart Popup-->
                          <!-- END NOT EMPTY CART -->
                          <?php } ?>
                      </div>
                      <div class="site-cart pr-3">
                        <?php
                          if ($profile == '') {
                        ?>
                          <a href="login.php" title="Profile" style="font-size: 22px; text-decoration: none">
                            <i class="icon anm anm-user-l"></i>
                          </a>
                        <?php } elseif ($_SESSION['role'] == 'Customer') { ?>
                          <a href="profile.php" title="Profile" style="font-size: 22px; text-decoration: none">
                            <i class="icon anm anm-user-l"></i>
                          </a>
                        <?php } elseif ($_SESSION['role'] == 'UPTICREATIVES') { ?>
                          <a href="creatives.php" title="Profile" style="font-size: 22px; text-decoration: none">
                            <i class="icon anm anm-user-l"></i>
                          </a>
                        <?php } else { ?>
                          <a href="login.php" title="Profile" style="font-size: 22px; text-decoration: none">
                            <i class="icon anm anm-user-l"></i>
                          </a>
                        <?php } ?>
                      </div>
                      <div class="site-header__search">
                        <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                      </div>
                  </div>
            </div>
          </div>
      </div>
      <!--End Header-->

      <!--Mobile Menu-->
      <div class="mobile-nav-wrapper" role="navigation">
      <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
        <ul id="MobileNav" class="mobile-nav">
          <li class="lvl1 parent megamenu"><a href="index.php">Home</a>
          </li>
          <li class="lvl1 parent megamenu"><a href="shop.php">Shop</a>
            <!-- <ul>
              <li><a href="whoweare.php" class="site-nav">Promo</a></li>
              <li><a href="phil.php" class="site-nav">Best Seller</a></li>
              <li><a href="whoweare.php" class="site-nav">Regular SKU</a></li>
              <li><a href="phil.php" class="site-nav">Membership</a></li>
            </ul> -->
          </li>
          <li class="lvl1 parent megamenu"><a href="joinus.php">Join Us</a>
          </li>
          <li class="lvl1 parent megamenu"><a href="#">Our Story <i class="anm anm-plus-l"></i></a>
            <ul>
              <li><a href="whoweare.php" class="site-nav">Who We Are</a></li>
              <li><a href="phil.php" class="site-nav">Product Philosophy</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--End Mobile Menu-->