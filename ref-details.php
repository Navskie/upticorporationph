<?php include 'include/header.php'; ?>
<?php 
    $csid = $_SESSION['code'];

    $ref = $_GET['ref'];

    $transaction_stmt = mysqli_query($connect, "SELECT * FROM web_transaction WHERE trans_ref = '$ref'");
    $transaction = mysqli_fetch_array($transaction_stmt);

    if (mysqli_num_rows($transaction_stmt) > 0) {
        $name = $transaction['trans_name'];
        $address = $transaction['trans_address'];
        $email = $transaction['trans_email'];
        $mobile = $transaction['trans_mobile'];
        $status = $transaction['trans_status'];
        $office = $transaction['trans_office'];
        $tracking = $transaction['trans_tracking'];

        $shipping = $transaction['trans_shipping'];
        $less_shipping = $transaction['trans_less_shipping'];
        $surcharge = $transaction['trans_surcharge'];
        $subtotal = $transaction['trans_subtotal'];
    } else {
        $name = '';
        $address = '';
        $email = '';
        $mobile = '';
        $status = '';
        $office = '';
        $tracking = '';

        $shipping = '';
        $less_shipping = '';
        $surcharge = '';
        $subtotal = '';
    }

    $notification_stmt = mysqli_query($connect, "SELECT COUNT(trans_ref) AS notif FROM upti_remarks INNER JOIN web_transaction ON upti_remarks.remark_poid = web_transaction.trans_ref WHERE trans_id = '$profile' AND remark_reseller = 'Unread'");
    $notification = mysqli_fetch_array($notification_stmt);

    $notif = $notification['notif'];

?>
<!--Body Content-->
<div id="page-content">     

    <!--Breadcrumb-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.php" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Profile</span></a>
        </div>
    </div>
    <!--End Breadcrumb-->

    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="form-group text-left">
                    <a href="profile.php">
                    <i class="uil uil-user-square"></i> Profile Information
                    </a>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="notification.php">
                    <i class="uil uil-bell"></i> Notification <span class="badge badge-danger rounded-circle float-right mr-3"><?php echo $notif ?></span>
                    </a>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="checkout-list.php">
                    <i class="uil uil-luggage-cart"></i> Checkout List
                    </a>
                </div>
                <hr>
                <div class="form-group text-left">
                    <a href="logout.php">
                    <i class="uil uil-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    
                    <div class="col-2">
                        <div class="form-group">
                            <?php if ($status == 'Pending') { ?>
                                <img src="assets/images/status/pending-2.png" class="img-responsive w-100" style="border: 1px solid #333">
                            <?php } else { ?>
                                <img src="assets/images/status/pending.png" class="img-responsive w-100" style="opacity: 0.2">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <?php if ($status == 'On Process') { ?>
                                <img src="assets/images/status/onprocess-2.png" class="img-responsive w-100" style="border: 1px solid #333">
                            <?php } else { ?>
                                <img src="assets/images/status/onprocess.png" class="img-responsive w-100" style="opacity: 0.2">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <?php if ($status == 'In Transit') { ?>
                                <img src="assets/images/status/intransit-2.png" class="img-responsive w-100" style="border: 1px solid #333">
                            <?php } else { ?>
                                <img src="assets/images/status/intransit.png" class="img-responsive w-100" style="opacity: 0.2">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <?php if ($status == 'Deliver') { ?>
                                <img src="assets/images/status/delivered-2.png" class="img-responsive w-100" style="border: 1px solid #333">
                            <?php } else { ?>
                                <img src="assets/images/status/delivered.png" class="img-responsive w-100" style="opacity: 0.2">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <?php if ($status == 'RTS') { ?>
                                <img src="assets/images/status/rts-2.png" class="img-responsive w-100" style="border: 1px solid #333">
                            <?php } else { ?>
                                <img src="assets/images/status/rts.png" class="img-responsive w-100" style="opacity: 0.2">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <?php if ($status == 'Canceled') { ?>
                                <img src="assets/images/status/cancel-2.png" class="img-responsive w-100" style="border: 1px solid #333">
                            <?php } else { ?>
                                <img src="assets/images/status/cancel.png" class="img-responsive w-100" style="opacity: 0.2">
                            <?php } ?>
                        </div>
                    </div>
                    
                    
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <b>Customer Name: </b><p class="text-center pt-1"><?php echo $name ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <b>Customer email: </b><p class="text-center pt-1"><?php echo $email ?></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <b>Complete Address: </b><p class="text-center pt-1"><?php echo $address ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <b>Customer Number: </b><p class="text-center pt-1"><?php echo $mobile ?></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <b>Delivery Option: </b><p class="text-center pt-1"><?php echo $office ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <b>Tracking Number: </b><p class="text-center pt-1"><?php echo $tracking ?></p>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="cart style2">
                    <table>
                        <thead class="cart__row cart__header">
                            <tr>
                                <th colspan="2" class="text-center">Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cart_stmt = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_id = '$profile' AND cart_ref = '$ref'");
                                while ($cart = mysqli_fetch_array($cart_stmt)) {
                                    $cart_code = $cart['cart_code'];

                                    $image = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$cart_code'");
                                    $image_fetch = mysqli_fetch_array($image);
                            ?>
                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__image-wrapper cart-flex-item text-center">
                                    <a href="#"><img class="cart__image" src="assets/images/product/<?php echo $image_fetch['p_m_img'] ?>"></a>
                                </td>
                                <td class="cart__meta small--text-left cart-flex-item">
                                    <div class="list-view-item__title" style="font-size: 13px !important;">
                                        <a href="#"><?php echo $cart['cart_desc'] ?></a>
                                    </div>
                                    
                                    <div class="cart__meta-text">
                                        Item Code: <?php echo $cart['cart_code'] ?><br>
                                    </div>
                                </td>
                                <td class="cart__price-wrapper text-center cart-flex-item">
                                    <span class="money"><?php echo $cart['cart_price'] ?></span>
                                </td>
                                <td class="cart__update-wrapper cart-flex-item text-center">
                                    <span class="money"><?php echo $cart['cart_qty'] ?></span>
                                </td>
                                <td class="text-right small--hide cart-price">
                                <?php
                                    $order_country = $transaction['trans_country'];

                                    $c_code2 = mysqli_query($connect, "SELECT * FROM upti_country_currency WHERE cc_country = '$order_country'");
                                    $cc_fetch2 = mysqli_fetch_array($c_code2);
                                    
                                    $country_code2 = $cc_fetch2['cc_sign'];
                                  ?>
                                    <div><span class="money"><?php echo $country_code2 ?> <?php echo $transaction['trans_subtotal'] ?></span></div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>                    
                </div>
                <div class="row">
                    <div class="col-10">
                        <p class="text-right">Surcharge:</p>
                    </div>
                    <div class="col-2">
                        <p class="text-right"><?php echo $surcharge ?></p>
                    </div>

                    <div class="col-10">
                        <p class="text-right">Shipping:</p>
                    </div>
                    <div class="col-2">
                        <p class="text-right"><?php echo $shipping ?></p>
                    </div>

                    <div class="col-10">
                        <p class="text-right">Less Shipping:</p>
                    </div>
                    <div class="col-2">
                        <p class="text-right"><?php echo $less_shipping ?></p>
                    </div>
                    <div class="col-10">
                        <p class="text-right"></p>
                    </div>
                    <div class="col-2">
                        <hr>
                    </div>
                    <div class="col-10">
                        <p class="text-right">Total Amount:</p>
                    </div>
                    <div class="col-2">
                        <p class="text-right"><?php echo $subtotal ?></p>
                    </div>
                </div>
                <hr>
                <h3>Order Remarks</h3>
                <div class="row">
                    <div class="col-12">
                        <form action="backend/remarks.php?ref=<?php echo $ref ?>" method="post">
                            <textarea name="remarks" id="" cols="30" rows="2"></textarea><br>
                            <button class="btn float-right" name="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <?php
                        $remarks_ref = mysqli_query($connect, "SELECT * FROM upti_remarks WHERE remark_poid = '$ref' ORDER BY id DESC");
                        while ($remarkss = mysqli_fetch_array($remarks_ref)) {
                            $ucode = $remarkss['remark_code'];
                            $name = $remarkss['remark_name'];

                            $name_stmt = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$ucode'");
                            $name_fetch = mysqli_fetch_array($name_stmt);

                            if (mysqli_num_rows($name_stmt) > 0) {
                                $urole = $name_fetch['users_role'];
                            } else {
                                $urole = 'Uptimised Corporation';
                            }
                    ?>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <img src="assets/images/main/default-profile.jpg" class="rounded-circle" alt="" width="100%">
                            </div>

                            <div class="col-lg-7 col-md-7 col-sm-12 text-left">
                                <h6 class="text-left" style="line-height: 0.5"><?php echo $name ?></h6>
                                <i style="font-size: 11px;" class="">
                                <?php echo $urole ?>
                                </i>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <span class="float-right"><?php echo $remarkss['remark_date'] ?> / <?php echo $remarkss['remark_time'] ?></span>
                        <br><br>
                        <p class="text-left"><?php echo $remarkss['remark_content'] ?></p>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->
    
<?php include 'include/footer.php'; ?>