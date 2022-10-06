<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $date = date('m-d-Y');

    $id = $_SESSION['uid'];

    $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
    $fetch_count = mysqli_fetch_array($user_info);
    $user_count = $fetch_count['users_count'];
    $ref = 'CS'.$id.'-22'.$user_count;

    $profile = $_SESSION['code'];

    $transaction = mysqli_query($connect, "SELECT trans_mop, trans_office FROM web_transaction WHERE trans_id = '$profile' AND trans_ref = '$ref'");
    $trans_fetch = mysqli_fetch_array($transaction);
    if (mysqli_num_rows($transaction) > 0) {
        $mode_of_payment = $trans_fetch['trans_mop'];
        $office = $trans_fetch['trans_office'];
    } else {
        $mode_of_payment = '';
        $office = '';
    }

    $address_stmt = mysqli_query($connect, "SELECT * FROM web_address WHERE add_uid = '$profile'");
    $address_fetch = mysqli_fetch_array($address_stmt);

    $address = $address_fetch['add_house'] .' '. $address_fetch['add_city'] .' '. $address_fetch['add_province'] .' '. $address_fetch['add_barangay'];

    if (isset($_POST['checkout'])) {
        $reseller_id = $_POST['reseller'];

        $transaction_stmt = mysqli_query($connect, "SELECT * FROM web_transaction WHERE trans_id = '$profile' AND trans_ref = '$ref'");
        $transaction = mysqli_fetch_array($transaction_stmt);
        if ($transaction['trans_office_status'] == '' && $transaction['trans_office'] == 'Direct Mail Box' && $customer_country == 'CANADA' || $customer_country == 'CANADA' && $transaction['trans_office'] == '') {
            flash("warn", "Please accept delivery options conditions");
            header('location: ../cart.php');
        } else {
            $payment_stmt = mysqli_query($connect, "SELECT * FROM web_payment WHERE payment_ref = '$ref' AND payment_uid = '$profile'");

            if (mysqli_num_rows($payment_stmt) > 0  && $transaction['trans_mop'] == 'Payment First' || mysqli_num_rows($payment_stmt) == 0  && $transaction['trans_mop'] != 'Payment First') {
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

                

                if ($user_count < 1) {
                  $discount = $subtotal * 0.05;
                  // Total Amount
                  $total_amount = $subtotal + $surcharge + $shipping - $less_shipping_fee;
                  $new_total = $total_amount - $discount;
                } else {
                  $discount = '';
                  // Total Amount
                  $total_amount = $subtotal + $surcharge + $shipping - $less_shipping_fee;
                  $new_total = $total_amount - $discount;
                }

                $trans_stmt = "UPDATE web_transaction SET 
                  trans_upline = '$reseller_id',
                  trans_shipping = '$shipping',
                  trans_surcharge = '$surcharge',
                  trans_less_shipping = '$less_shipping_fee',
                  trans_subtotal = '$new_total',
                  trans_discount = '$discount',
                  trans_date = '$date',
                  trans_time = '$time',
                  trans_address = '$address',
                  trans_upline = '$replicate_code',
                  trans_status = 'Pending'
                WHERE trans_ref = '$ref'";
                $trans_stmt_qry = mysqli_query($connect, $trans_stmt);

                $user_count_update = $user_count + 1;
                $increment = mysqli_query($connect, "UPDATE upti_users SET users_count = '$user_count_update' WHERE users_id = '$id'");

                $cart_status = mysqli_query($connect, "UPDATE web_cart SET cart_status = 'Pending' WHERE cart_ref = '$ref'");

                unset($_SESSION['repli_code']);

                flash("success", "Order has been submitted successfully");
                header('location: ../checkout-list.php');
                
            } else {
                flash("warn", "Please attach your receipt");
                header('location: ../cart.php');
            } #payment End
        } # delivery option End
    } #isset End

    if (isset($_POST['read'])) {

        $update_cod = mysqli_query($connect, "UPDATE web_transaction SET trans_office_status = 'Read' WHERE trans_ref = '$ref'");

        header('location: ../cart.php');
        
    }
?>
