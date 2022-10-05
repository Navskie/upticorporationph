<?php include 'include/header.php' ?>
<style>
  span.money p {
    color: #fff !important;
  }
</style>
    <?php 
        $id = $_SESSION['uid'];
        $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
        $fetch_count = mysqli_fetch_array($user_info);
        $user_count = $fetch_count['users_count'];

        $transaction = mysqli_query($connect, "SELECT trans_mop, trans_office, trans_office_status FROM web_transaction WHERE trans_id = '$profile' AND trans_ref = '$ref'");
        $trans_fetch = mysqli_fetch_array($transaction);
        if (mysqli_num_rows($transaction) > 0) {
            $mode_of_payment = $trans_fetch['trans_mop'];
            $office = $trans_fetch['trans_office'];
            $office_status = $trans_fetch['trans_office_status'];
        } else {
            $mode_of_payment = '';
            $office = '';
            $office_status = '';
        }

        $address_stmt = mysqli_query($connect, "SELECT * FROM web_address WHERE add_uid = '$profile'");
        $address_fetch = mysqli_fetch_array($address_stmt);
    ?>
    <!--Body Content-->
    <div id="page-content">
    	<!--Page Title-->
    	<div class="page section-header text-center">
			<div class="page-title">
        		<div class="wrapper"><h1 class="page-width">Your cart</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
        <br>
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
                    <div class="cart style2">
                		<table>
                            <thead class="cart__row cart__header">
                                <tr>
                                    <th colspan="2" class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Total</th>
                                    <th class="action">&nbsp;</th>
                                </tr>
                            </thead>
                    		<tbody>
                                <?php
                                    $cart_stmt = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_id = '$profile' AND cart_ref = '$ref' AND cart_status = 'On Cart'");
                                    while ($cart = mysqli_fetch_array($cart_stmt)) {
                                        $cart_code = $cart['cart_code'];

                                        $image = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$cart_code'");
                                        $image_fetch = mysqli_fetch_array($image);
                                ?>
                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                    <td class="cart__image-wrapper cart-flex-item">
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
                                    <td class="cart__price-wrapper cart-flex-item text-center">
                                      <span class="money"><?php echo $country_code ?> <?php echo $cart['cart_subtotal'] ?></span>
                                    </td>
                                    <td class="cart__update-wrapper cart-flex-item text-right">
                                        <form action="backend/update-cart.php?id=<?php echo $cart['id'] ?>" method="post">
                                        <div class="cart__qty text-center">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                                                <input class="cart__qty-input qty" type="text" name="qtys" id="qty" value="<?php echo $cart['cart_qty'] ?>" pattern="[0-9]*">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right small--hide cart-price">
                                      <div><span class="money"><?php echo $country_code ?> <?php echo $cart['cart_subtotal'] ?></span></div>
                                    </td>
                                    <td class="text-center small--hide">
                                        <button class="btn btn--secondary cart__remove" title="Remove Item" name="delete_item"><i class="uil uil-trash"></i></button>
                                        <button class="btn btn--secondary cart__remove" title="Refresh" name="update_qty"><i class="uil uil-sync"></i></button>
                                    </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                    </table>                    
                    </div>
                    <?php if (mysqli_num_rows($address_stmt) == 0) { ?>
                    <label><b>Customer Address</b></label>
                    <form action="backend/address.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>House / Block / Unit / Building</label>
                                    <input type="text" class="form-control rounded-0" name="house">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Barangay</label>
                                    <input type="text" class="form-control rounded-0" name="barangay">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control rounded-0" name="city">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" class="form-control rounded-0" name="province">
                                </div>
                            </div>
                            <div class="col-4">
                                <?php if ($customer_country == 'CANADA' || $customer_country == 'canada') { ?>
                                <div class="form-group">
                                  <label>State</label>
                                  <select name="state" id="" class="form-control">
                                    <option value="">Select State</option>
                                    <?php
                                      $state_stmt = mysqli_query($connect, "SELECT * FROM upti_state");
                                      foreach ($state_stmt as $state) {
                                    ?>
                                      <option value="<?php echo $state['state_name'] ?>"><?php echo $state['state_name'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <?php } else { ?>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control rounded-0" name="state">
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-dark float-right" name="address">Save Address <i class="uil uil-location-pin-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>

                    <hr>
                    <label><b>Payment Method</b></label>
                    <form action="backend/mop.php" method="POST">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <button class="btn btn-dark w-100" name="COD">Cash On Delivery <i class="uil uil-truck"></i></button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button class="btn btn-dark w-100" name="COP">Cash On Pick Up <i class="uil uil-money-withdrawal"></i></button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button class="btn btn-dark w-100" name="BANK">Payment First <i class="uil uil-master-card"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php if ($customer_country == 'CANADA' && $mode_of_payment != '') { ?>
                    <hr>
                    <label><b>Delivery Options</b></label>
                    <form action="backend/options.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <button class="btn btn-dark w-100" name="POPU">Post Office Pick Up <i class="uil uil-postcard"></i></button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <button class="btn btn-dark w-100" name="DMB">Direct Mail Box <i class="uil uil-mailbox"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>

                    <hr>
                    <?php
                        if($mode_of_payment == 'Payment First') {
                    ?>
                    <label><b>Customer Payment</b></label>
                    <form action="backend/payment.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <table class="table-bordered">
                                    <tr>
                                        <th class="text-center">BANK NAME</th>
                                        <th class="text-center">ACCOUNT NAME</th>
                                        <th class="text-center">ACCOUNT NUMBER</th>
                                    </tr>
                                    <?php
                                        $mod = mysqli_query($connect, "SELECT * FROM upti_mod WHERE mod_country = '$customer_country'");
                                        while ($modrow = mysqli_fetch_array($mod)) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $modrow['mod_branch'] ?></td>
                                        <td class="text-center"><?php echo $modrow['mod_name'] ?></td>
                                        <td class="text-center"><?php echo $modrow['mod_number'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Attach Image File here:</label>
                                    <input type="file" class="form-control rounded-0" name="file">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-dark float-right" name="pay">Submit <i class="uil uil-image-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
               	</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                	<!-- <div class="cart-note">
                    	<div class="solid-border">
							<h5><label for="CartSpecialInstructions" class="cart-note__label small--text-center">Add a note to your order</label></h5>
							<textarea name="note" id="CartSpecialInstructions" class="cart-note__input"></textarea>
						</div>
                    </div> -->
                    <?php 
                        // SUBTOTAL
                        $subtotal_sql = "SELECT SUM(cart_subtotal) AS subtotal FROM web_cart WHERE cart_ref = '$ref'";
                        $subtotal_qry = mysqli_query($connect, $subtotal_sql);
                        $subtotal_fetch = mysqli_fetch_array($subtotal_qry);

                        $subtotal = $subtotal_fetch['subtotal'];

                        // LESS SHIPPING FEE
                        $less_shipping_sql = "SELECT SUM(cart_qty) AS less_shipping FROM web_cart WHERE cart_ref = '$ref'";
                        $less_shipping_qry = mysqli_query($connect, $less_shipping_sql);
                        $less_shipping_fetch = mysqli_fetch_array($less_shipping_qry);

                        $order_qtys = $less_shipping_fetch['less_shipping'];

                        // ADDED non-rebatable
                        $rebatable_sql = "SELECT * FROM upti_code INNER JOIN web_cart ON upti_code.code_name = web_cart.cart_code WHERE web_cart.cart_ref = '$ref' AND upti_code.code_category = 'NON-REBATABLE'";
                        $rebatable_qry = mysqli_query($connect, $rebatable_sql);
                        $rebatable_num = mysqli_num_rows($rebatable_qry);

                        if ($rebatable_num > 0) {
                            while ($rebatable = mysqli_fetch_array($rebatable_qry)) {
                                $codeitem = $rebatable['code_name'];
                                $rebate_shipping_sql = "SELECT SUM(cart_qty) AS rebate_shipping FROM web_cart WHERE cart_code = '$codeitem' AND cart_ref = '$ref'";
                                $rebate_shipping_qry = mysqli_query($connect, $rebate_shipping_sql);
                                $rebate_shipping_fetch = mysqli_fetch_array($rebate_shipping_qry);

                                $rebate_less += $rebate_shipping_fetch['rebate_shipping'];
                                //echo $rebate_less++;
                            }
                        } else {
                            $rebate_less = 0;
                        }

                        // ADDED FREE
                        $free_sql = "SELECT * FROM upti_code INNER JOIN web_cart ON upti_code.code_name = web_cart.cart_code WHERE web_cart.cart_code = '$ref' AND upti_code.code_category = 'FREE'";
                        $free_qry = mysqli_query($connect, $free_sql);
                        if (mysqli_num_rows($free_qry) > 0) {
                            while ($rebatable = mysqli_fetch_array($free_qry)) {
                                $codeitemfree = $rebatable['code_name'];
                                $rebatefree_shipping_sql = "SELECT SUM(cart_qty) AS rebate_shipping FROM web_cart WHERE cart_code = '$codeitemfree' AND cart_ref = '$ref'";
                                $rebatefree_shipping_qry = mysqli_query($connect, $rebatefree_shipping_sql);
                                $rebatefree_shipping_fetch = mysqli_fetch_array($rebatefree_shipping_qry);

                                $free_less += $rebatefree_shipping_fetch['rebate_shipping'];
                                //echo $rebate_less++;
                            }
                        } else {
                            $free_less = 0;
                        }

                        // ADDED FREE
                        $free2_sql = "SELECT * FROM upti_code INNER JOIN web_cart ON upti_code.code_name = web_cart.cart_code WHERE web_cart.cart_ref = '$ref' AND upti_code.code_category = 'FREE TWO'";
                        $free2_qry = mysqli_query($connect, $free2_sql);
                        if (mysqli_num_rows($free2_qry) > 0) {
                            while ($rebatable = mysqli_fetch_array($free2_qry)) {
                                $codeitemfree2 = $rebatable['code_name'];
                                $rebatefree2_shipping_sql = "SELECT SUM(cart_qty) AS rebate_shipping FROM web_cart WHERE cart_code = '$codeitemfree2' AND cart_ref = '$ref'";
                                $rebatefree2_shipping_qry = mysqli_query($connect, $rebatefree2_shipping_sql);
                                $rebatefree2_shipping_fetch = mysqli_fetch_array($rebatefree2_shipping_qry);

                                $free_less2 += $rebatefree2_shipping_fetch['rebate_shipping'];
                                //echo $rebate_less++;
                            }
                        } else {
                            $free_less2 = 0;    
                        }
                        $order_qty = $order_qtys - $rebate_less - $free_less - $free_less2;

                        // FOR CANADA PART
                        if ($customer_country == 'CANADA') {
                            $get_less_shipping_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                            $get_less_shipping_fee_qry = mysqli_query($connect, $get_less_shipping_fee);
                            $get_less_shipping_fee_num = mysqli_num_rows($get_less_shipping_fee_qry);
                            $get_less_shipping_fee_fetch = mysqli_fetch_array($get_less_shipping_fee_qry);

                            if ($get_less_shipping_fee_num == 0) {
                                $less_shipping_fee = 0;
                            } else {
                                if ($order_qty > 2) {
                                    $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'];
                                } else {
                                    $less_shipping_fee = 0;
                                }
                            }
                        }
                        // FOR JAPAN PART
                        elseif ($customer_country == 'JAPAN') {
                            $get_less_shipping_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                            $get_less_shipping_fee_qry = mysqli_query($connect, $get_less_shipping_fee);
                            $get_less_shipping_fee_num = mysqli_num_rows($get_less_shipping_fee_qry);
                            $get_less_shipping_fee_fetch = mysqli_fetch_array($get_less_shipping_fee_qry);

                            if ($get_less_shipping_fee_num == 0) {
                                $less_shipping_fee = 0;
                            } else {
                                if ($order_qty > 1) {
                                    $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'];
                                } else {
                                    $less_shipping_fee = 0;
                                }
                            }
                        }
                        // FOR OTHER COUNTRY ONLY
                        elseif ($order_qty > 1) {
                            $get_less_shipping_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                            $get_less_shipping_fee_qry = mysqli_query($connect, $get_less_shipping_fee);
                            $get_less_shipping_fee_num = mysqli_num_rows($get_less_shipping_fee_qry);
                            $get_less_shipping_fee_fetch = mysqli_fetch_array($get_less_shipping_fee_qry);

                            if ($get_less_shipping_fee_num == 0) {
                                $less_shipping_fee = 0;
                            } else {
                                if($order_qty > 3) {
                                    $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'] * 2;
                                } else {
                                    $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'];    
                                }
                            }
                        } else {
                            $less_shipping_fee = 0;
                        }
                        // LESS SHIPPING FEE END

                        // SHIPPING FEE START
                        $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                        $shipping_qry = mysqli_query($connect, $shipping_sql);
                        $shipping_fetch = mysqli_fetch_array($shipping_qry);
                        $shipping_num = mysqli_num_rows($shipping_qry);

                        $remove_shipping = "SELECT * FROM web_cart WHERE cart_ref = '$ref' AND cart_code = 'JN04'";
                        $remove_shipping_sql = mysqli_query($connect, $remove_shipping);
                        $remove_num = mysqli_num_rows($remove_shipping_sql);

                        if ($shipping_num <= 0 || $mode_of_payment == 'Cash On Pick Up' || $order_qty <= 2 && $customer_country == 'PHILIPPINES' && $remove_num == 1) {
                            $shipping = 0;
                        } else {
                            $shipping = $shipping_fetch['shipping_price'];
                        }

                        if($customer_country == 'HONGKONG' AND $mode_of_payment == 'Cash On Delivery') {
                            // echo 'try';
                            $surcharge = $subtotal * 0.025;
                        } else {
                            $surcharge = 0;
                        }

                        // Total Amount
                        $total_amount = $subtotal + $surcharge + $shipping - $less_shipping_fee ;
                    ?>
                    <div class="solid-border">
                    <div class="row">
                      	<span class="col-12 col-sm-6"><strong>Order Information</strong></span>
                      </div>
                    <br>
                    <?php
                        $personal_stmt = mysqli_query($connect, "SELECT * FROM upti_customer WHERE cs_uid = '$profile'");
                        $info_fetch = mysqli_fetch_array($personal_stmt);
                    ?>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Name</strong></span>
                        <span class="col-12 col-sm-6 text-right"><span class="money"><?php echo $info_fetch['cs_fname'] ?> <?php echo $info_fetch['cs_lname'] ?></span></span>
                      </div>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Phone</strong></span>
                        <span class="col-12 col-sm-6 text-right"><span class="money"><?php echo $info_fetch['cs_mobile'] ?></span></span>
                      </div>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Email</strong></span>
                        <span class="col-12 col-sm-6 text-right"><span class="money"><?php echo  $info_fetch['cs_email'] ?></span></span>
                      </div>
                      <div class="row"> 
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Address</strong></span>
                        <?php
                            if (mysqli_num_rows($address_stmt) > 0) {
                        ?>
                            <span class="col-12 col-sm-6 text-right"><span class="money"><?php echo $address_fetch['add_house'] ?> <?php echo $address_fetch['add_city'] ?> <?php echo $address_fetch['add_province'] ?> <?php echo $address_fetch['add_barangay'] ?></span></span>
                        <?php
                            } else {
                        ?>
                            <span class="col-12 col-sm-6 text-right text-danger"><span class="money">No address found</span></span>
                        <?php
                            }
                        ?>
                      </div>
                    </div>

                    <div class="solid-border">
                    <div class="row">
                      	<span class="col-12 col-sm-6"><strong>Delivery Option</strong></span>
                      </div>
                    <br>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Mode of Payment</strong></span>
                        <span class="col-12 col-sm-6 text-right"><span class="money"><?php echo $mode_of_payment ?></span></span>
                      </div>
                      <?php if ($customer_country == 'CANADA') { ?>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Delivery Options</strong></span>
                        <span class="col-12 col-sm-6 text-right"><span class="money"><?php echo $office ?></span></span>
                      </div>
                      <?php } ?>
                      <?php if ($mode_of_payment == 'Payment First') { ?>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Receipt</strong></span>
                        <span class="col-12 col-sm-6 text-right">
                            <?php
                                $payment_stmt = mysqli_query($connect, "SELECT payment_img FROM web_payment WHERE payment_ref = '$ref' AND payment_uid = '$profile'");

                                if (mysqli_num_rows($payment_stmt) > 0) {
                                    while ($receipt = mysqli_fetch_array($payment_stmt)) {
                            ?>
                                <img src="assets/images/payment/<?php echo $receipt['payment_img'] ?>" alt="" class="img-responsive w-100">
                            <?php
                                    }
                                } else { 
                            ?>
                                <span class="money text-danger">attachment is required.</span>
                            <?php } ?>
                        </span>
                      </div>
                      <?php } ?>
                    </div>

                      <form action="discount.php" method="post">
                        <div class="solid-border">
                            <div class="row">
                                <div class="col-8">
                                  <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-0" name="reseller" placeholder="Discount Code">
                                    </div>
                                </div>
                                <div class="col-4">
                                  <br>
                                    <div class="form-group">
                                        <button class="btn btn-danger form-control w-100" name="discount">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </form>
                      <form action="backend/checkout.php" method="post">
                        <?php
                            if ($office == 'Direct Mail Box' && $customer_country == 'CANADA') {
                        ?>
                        <div class="solid-border">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <p>
                                        By clicking <b>"ACCEPT"</b> you agree that Uptimised parties gives no warranty and accepts no responsibility or liability for any loss or damages you experience including any claims of product defects.
                                        </p>
                                        <?php if ($office_status == '') { ?>
                                        <button class="btn btn-dark float-right" name="read">Accept</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>

                    <div class="solid-border">
                      <div class="row">
                      	<span class="col-12 col-sm-6"><strong>Payment Summary</strong></span>
                      </div>
                    <br>
                      <?php if ($user_count < 1) { 
                        $discount = $subtotal * 0.05;  
                      ?>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title text-danger"><strong>Discount</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right text-danger"><span class="money"><?php echo $country_code ?> <?php echo number_format($discount, '2') ?></span></span>
                      </div>
                      <?php } 
                            else
                            {
                              $discount = 0;
                      ?>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Discount</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?php echo $country_code ?> <p><?php echo number_format($discount, '2') ?></p></span></span>
                      </div>
                      <?php
                            }
                      ?>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Surcharge</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?php echo $country_code ?> <?php echo number_format($surcharge, '2') ?></span></span>
                      </div>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Shipping Fee</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?php echo $country_code ?> <?php echo number_format($shipping, '2') ?></span></span>
                      </div>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Less Shipping Fee</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?php echo $country_code ?> <?php echo number_format($less_shipping_fee, '2') ?></span></span>
                      </div>
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Subtotal</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?php echo $country_code ?> <?php echo number_format($subtotal, '2') ?></span></span>
                      </div>
                      <hr>
                      <div class="row">
                        <?php $new_total = $total_amount - $discount ?>
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Total Amount</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?php echo $country_code ?> <?php echo number_format($new_total, '2') ?></span></span>
                      </div>
                      <br><br>
                      <!-- <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div> -->
                      <button name="checkout" id="cartCheckout" class="btn btn--small-wide checkout">CHECK OUT</button>
                    </form>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
    <!--End Body Content-->

<?php include 'include/footer.php'; ?>
<script>
  <?php if (isset($_SESSION['warn'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error("<?php echo flash('warn'); ?>");

    <?php } ?>

    <?php if (isset($_SESSION['success'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success("<?php echo flash('success'); ?>");

    <?php } ?>
</script>