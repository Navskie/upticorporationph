<?php
    session_start();
    include 'dbms/conn.php';
    include 'function.php';
    include('smtp/PHPMailerAutoload.php');    

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');
    $time = date('h:i A');

    $Uid = $_SESSION['uid'];
    $Urole = $_SESSION['role'];
    $Ucode = $_SESSION['code'];
    $Ureseller = $_SESSION['code'];

    $count_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);

    $Ucount = $count_fetch['users_count'];
 
    if($Urole == 'UPTIOSR') {
        $upline_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
        $upline_qry = mysqli_query($connect, $upline_sql); 
        $upline_fetch = mysqli_fetch_array($upline_qry);

        $Ucode = $upline_fetch['users_code'];
        $Ureseller = $upline_fetch['users_main']; 
        $Ucount = $upline_fetch['users_count'];
    }
    // Get Users Code & Users Upline Code

    $poid = 'PD'.$Uid.'-'.$Ucount;
    // Poid Number / Reference Number

    $get_transaction = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
    $get_transaction_qry = mysqli_query($connect, $get_transaction);
    $get_transaction_fetch = mysqli_fetch_array($get_transaction_qry);
    $get_transaction_num = mysqli_num_rows($get_transaction_qry);

    if ($get_transaction_num == 1) {
        $mode_of_payment = $get_transaction_fetch['trans_mop'];
        $customer_country = $get_transaction_fetch['trans_country'];
        $csid = $get_transaction_fetch['trans_csid'];
    } else {
        $mode_of_payment = '';
        $customer_country = '';
        $csid = '';
    }

    $check_boga_sql_2 = "SELECT SUM(ol_qty) AS pq FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE ol_poid = '$poid' AND code_category = 'BUY ONE GET ANY'";
    $check_boga_qrys_2 = mysqli_query($connect, $check_boga_sql_2);
    $check_boga_qrys_fetch_2 = mysqli_fetch_array($check_boga_qrys_2);
    $check_boga_num_2 = $check_boga_qrys_fetch_2['pq'];
    
    if($check_boga_num_2 >= 1) {
        $check_boga_num = 1;

       $check_boga_sql = "SELECT SUM(ol_qty) AS pq FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE ol_poid = '$poid' AND code_category = 'FREE'";
        $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
        $check_boga_qrys_fetch = mysqli_fetch_array($check_boga_qrys);
        $check_boga_num_free = $check_boga_qrys_fetch['pq'];
        // mysqli_num_rows($check_boga_qrys);

        if (mysqli_num_rows($check_boga_qrys) >= 1 && $check_boga_qrys >= $check_boga_num_free) {
            $free = 0;
        } else {
            $free = 1;
        }

    } else {
        $check_boga_num = 0;
        $free = 0;
    }

    $checkfree2 = mysqli_query($connect, "SELECT * FROM upti_free_2 WHERE f2_poid = '$poid'");

    if (mysqli_num_rows($checkfree2) < 1) {

        if ($check_boga_num != 1 && $free != 1 || $check_boga_num != 0 && $free != 1) {
            $get_rebatable_item = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_code.code_category = 'REBATABLE' AND upti_order_list.ol_poid = '$poid'";
            $get_rebatable_item_qry = mysqli_query($connect, $get_rebatable_item);
            $get_num_rebatable = mysqli_num_rows($get_rebatable_item_qry);
            $get_num_rebatable_fetch = mysqli_fetch_array($get_rebatable_item_qry);

            $codenameasero = $get_num_rebatable_fetch['code_name'];
            $exclusive = $get_num_rebatable_fetch['code_exclusive'];

            // EXCLUSIVE
            $check_exclusive = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$codenameasero' AND code_exclusive != ''");
            $ce_num = mysqli_num_rows($check_exclusive);

            $check_ol_exc = mysqli_query($connect, "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = '$exclusive'");
            $ol_ex_num = mysqli_num_rows($check_ol_exc);

            if ($ce_num == 0 && $ol_ex_num == 0 || $ce_num >= 1 && $ol_ex_num >= 1) {
            // REBATABLE

            $check_n_item = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_code.code_category = 'NON-REBATABLE' AND upti_order_list.ol_poid = '$poid'";
            $check_n_qry = mysqli_query($connect, $check_n_item);
            $check_n_r = mysqli_num_rows($check_n_qry);

            if ($get_num_rebatable > 0 && $check_n_r > 0 || $get_num_rebatable > 0 && $check_n_r == 0) {
                
                // CHECK REBATABLE

                $check_regular = mysqli_query($connect, "SELECT * FROM upti_order_list INNER JOIN upti_code ON code_name = ol_code WHERE code_category = 'PROMO'");

                if ($check_n_r == 0 || $check_regular == 0) {
                    // echo "<script>alert('Please Add More Product!');window.location='order-list.php'</script>";
                    flash("warning", "This promo code needs a tie-up promo. Please add now!");
                    header('location: order-list.php');
                } else {
                // CHECK REBATABLE
        
                    // Stockist History 
                    $stockist_rp = "INSERT INTO stockist_report (
                        rp_poid,
                        rp_country,
                        rp_date,
                        rp_status
                        ) VALUES (
                        '$poid',
                        '$customer_country',
                        '$date_today',
                        'Pending'
                        )
                        ";
                    $stockist_rp_qry = mysqli_query($connect, $stockist_rp);
        
                    // SUBTOTAL
                    $subtotal_sql = "SELECT SUM(ol_subtotal) AS subtotal FROM upti_order_list WHERE ol_poid = '$poid'";
                    $subtotal_qry = mysqli_query($connect, $subtotal_sql);
                    $subtotal_fetch = mysqli_fetch_array($subtotal_qry);
        
                    $subtotal = $subtotal_fetch['subtotal'];
        
                    // LESS SHIPPING FEE
                    $less_shipping_sql = "SELECT SUM(ol_qty) AS less_shipping FROM upti_order_list WHERE ol_poid = '$poid'";
                    $less_shipping_qry = mysqli_query($connect, $less_shipping_sql);
                    $less_shipping_fetch = mysqli_fetch_array($less_shipping_qry);
        
                    $order_qtys = $less_shipping_fetch['less_shipping'];
        
                    // ADDED non-rebatable
                    $rebatable_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'NON-REBATABLE'";
                    $rebatable_qry = mysqli_query($connect, $rebatable_sql);
                    while ($rebatable = mysqli_fetch_array($rebatable_qry)) {
                        $codeitem = $rebatable['code_name'];
                        $rebate_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitem' AND ol_poid = '$poid'";
                        $rebate_shipping_qry = mysqli_query($connect, $rebate_shipping_sql);
                        $rebate_shipping_fetch = mysqli_fetch_array($rebate_shipping_qry);
                    
                        $rebate_less += $rebate_shipping_fetch['rebate_shipping'];
                        //echo $rebate_less++;
                    }
                    // ADDED non-rebatable
        
                    // ADDED FREE
                    $free_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'FREE'";
                    $free_qry = mysqli_query($connect, $free_sql);
                    while ($rebatable = mysqli_fetch_array($free_qry)) {
                        $codeitemfree = $rebatable['code_name'];
                        $rebatefree_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitemfree' AND ol_poid = '$poid'";
                        $rebatefree_shipping_qry = mysqli_query($connect, $rebatefree_shipping_sql);
                        $rebatefree_shipping_fetch = mysqli_fetch_array($rebatefree_shipping_qry);

                        $free_less += $rebatefree_shipping_fetch['rebate_shipping'];
                        //echo $rebate_less++;
                    }

                    // ADDED FREE
                    $free2_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'FREE TWO'";
                    $free2_qry = mysqli_query($connect, $free2_sql);
                    while ($rebatable = mysqli_fetch_array($free2_qry)) {
                        $codeitemfree2 = $rebatable['code_name'];
                        $rebatefree2_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitemfree2' AND ol_poid = '$poid'";
                        $rebatefree2_shipping_qry = mysqli_query($connect, $rebatefree2_shipping_sql);
                        $rebatefree2_shipping_fetch = mysqli_fetch_array($rebatefree2_shipping_qry);

                        $free_less2 += $rebatefree2_shipping_fetch['rebate_shipping'];
                        //echo $rebate_less++;
                    }

                    $order_qty = $order_qtys - $rebate_less - $free_less - $free_less2;
        
                    // FOR CANADA PART
                    if ($customer_country == 'CANADA' || $customer_country == 'UNITED ARAB EMIRATES') {
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
                    // FOR CANADA PART
        
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
                    // FOR JAPAN PART
        
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
                    // FOR OTHER COUNTRY ONLY
                    // LESS SHIPPING FEE END
        
                    // SHIPPING FEE START
                    $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                    $shipping_qry = mysqli_query($connect, $shipping_sql);
                    $shipping_fetch = mysqli_fetch_array($shipping_qry);
                    $shipping_num = mysqli_num_rows($shipping_qry);
        
                    $remove_shipping = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = 'JN04'";
                    $remove_shipping_sql = mysqli_query($connect, $remove_shipping);
                    $remove_num = mysqli_num_rows($remove_shipping_sql);
        
                    if ($shipping_num < 0 || $mode_of_payment == 'Cash On Pick Up' || $order_qty <= 2 && $customer_country == 'PHILIPPINES' && $remove_num == 1) {
                        $shipping = 0;
                    } else {
                        $shipping = $shipping_fetch['shipping_price'];
                    }
                    // SHIPPING FEE START
        
                    // UPDATE OL DATE
                    $sql_date_ol = mysqli_query($connect, "UPDATE upti_order_list SET ol_date = '$date_today' WHERE ol_poid = '$poid'");
                    // UPDATE OL DATE
        
                    // Total Amount
                    $total_amount = $subtotal + $shipping - $less_shipping_fee;
        
                    // PROCESS ORDER
                    if(isset($_POST['checkouts'])) {
                        $img_name = $_FILES['file']['name'];
                        $img_size = $_FILES['file']['size'];
                        $img_tmp = $_FILES['file']['tmp_name'];
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        // echo ($img_ex);
                        $img_ex_lc = strtolower($img_ex);
        
                        $allow_ex = array("jpg", "jpeg", "png", "gif");
        
                        if($img_name == '' && $mode_of_payment == 'E-Payment' || $img_name == '' && $mode_of_payment == 'Bank') {
                            flash("warning", "You forgot to attach your payment receipt Attach it now!");
                            header('location: order-list.php');
                        } else {
        
                            if (in_array($img_ex_lc, $allow_ex)) {
                                $new_name = $poid.'.'.$img_ex_lc;
                                $img_path_sa_buhay_niya = './images/payment/'.$new_name;
                                move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);
                
                                $checkout_sql = "UPDATE upti_transaction SET 
                                    trans_date = '$date_today',
                                    trans_time = '$time',
                                    trans_status = 'Pending',
                                    trans_subtotal = '$total_amount',
                                    trans_ship = '$shipping',
                                    trans_less_ship = '$less_shipping_fee',
                                    trans_img = '$new_name'
                                WHERE trans_poid = '$poid'";
                                $checkout_qry = mysqli_query($connect, $checkout_sql);
                            } else {
                                $checkout_sql = "UPDATE upti_transaction SET 
                                    trans_date = '$date_today',
                                    trans_time = '$time',
                                    trans_status = 'Pending',
                                    trans_subtotal = '$total_amount',
                                    trans_ship = '$shipping',
                                    trans_less_ship = '$less_shipping_fee',
                                    trans_img = '$new_name'
                                WHERE trans_poid = '$poid'";
                                $checkout_qry = mysqli_query($connect, $checkout_sql);
                            }
            
                            // ADD 1 TO POID Number
                            $New_count = $Ucount + 1;
                            $update_user_count = "UPDATE upti_users SET users_count = '$New_count' WHERE users_code = '$Ucode'";
                            $update_user_count_qry = mysqli_query($connect, $update_user_count);
            
                            // Email Send to Stockist
                            // Get Stockist ID NUMBER
                            $stockist_sql = "SELECT * FROM stockist WHERE stockist_country = '$customer_country'";
                            $stockist_qry = mysqli_query($connect, $stockist_sql);
                            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            
                            $stockist_code = $stockist_fetch['stockist_code'];
            
                            // Get Stockist Email Address
                            $email_sql = "SELECT * FROM upti_reseller WHERE reseller_code = '$stockist_code'";
                            $email_qry = mysqli_query($connect, $email_sql);
                            $email_fetch = mysqli_fetch_array($email_qry);
            
                            $stockist_email = $email_fetch['reseller_email'];
                            $stockist_name = $email_fetch['reseller_name'];
            
                            // SEND TO STOCKIST EMAIL
                            $remarks = 'Hi '.$stockist_name. ',<br><br> We noticed there were NEW orders added to your ‘Incoming Order’ cart. If you’re ready to fulfill these, your account is waiting for your return.<br><br>
                            <a href="https://upticorporationph.com/incoming-pending-order.php" target="_blank">CHECK NOW</a>';
            
                            $mail = new PHPMailer(); 
                            //$mail->SMTPDebug=3;
                            $mail->IsSMTP(); 
                            $mail->SMTPAuth = true; 
                            $mail->SMTPSecure = 'ssl'; 
                            $mail->Host = "smtp.hostinger.com";
                            $mail->Port = "465"; 
                            $mail->IsHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Username = "beautybyuptimised@upticorporationph.com";
                            $mail->Password = '@User2022';
                            $mail->SetFrom("beautybyuptimised@upticorporationph.com", "Beauty By Uptimised");
                            $mail->Subject = 'Your Uptimised Cart is waiting for you…';
                            $mail->Body = $remarks;
                            $mail->AddAddress($stockist_email);
                            $mail->SMTPOptions=array('ssl'=>array(
                                'verify_peer'=>false,
                                'verify_peer_name'=>false,
                                'allow_self_signed'=>false
                            ));
                            if(!$mail->Send()){
                                echo $mail->ErrorInfo;
                            }
                            // SEND TO STOCKIST EMAIL

                            flash("order", "Thank you! Your order was successfully submitted!");
                            header('location: my-order.php');
            
                        }
                        // PROCESS ORDER
                    }
                }
            }
            // REBATABLE
            else
            // SCAPE REBATABLE
            {
                // Stockist History 
                $stockist_rp = "INSERT INTO stockist_report (
                    rp_poid,
                    rp_country,
                    rp_date,
                    rp_status
                    ) VALUES (
                    '$poid',
                    '$customer_country',
                    '$date_today',
                    'Pending'
                    )
                    ";
                $stockist_rp_qry = mysqli_query($connect, $stockist_rp);

                // SUBTOTAL
                $subtotal_sql = "SELECT SUM(ol_subtotal) AS subtotal FROM upti_order_list WHERE ol_poid = '$poid'";
                $subtotal_qry = mysqli_query($connect, $subtotal_sql);
                $subtotal_fetch = mysqli_fetch_array($subtotal_qry);

                $subtotal = $subtotal_fetch['subtotal'];

                // LESS SHIPPING FEE
                $less_shipping_sql = "SELECT SUM(ol_qty) AS less_shipping FROM upti_order_list WHERE ol_poid = '$poid'";
                $less_shipping_qry = mysqli_query($connect, $less_shipping_sql);
                $less_shipping_fetch = mysqli_fetch_array($less_shipping_qry);

                $order_qtys = $less_shipping_fetch['less_shipping'];

                // ADDED non-rebatable
                $rebatable_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'NON-REBATABLE'";
                $rebatable_qry = mysqli_query($connect, $rebatable_sql);
                while ($rebatable = mysqli_fetch_array($rebatable_qry)) {
                    $codeitem = $rebatable['code_name'];
                    $rebate_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitem' AND ol_poid = '$poid'";
                    $rebate_shipping_qry = mysqli_query($connect, $rebate_shipping_sql);
                    $rebate_shipping_fetch = mysqli_fetch_array($rebate_shipping_qry);
                
                    $rebate_less += $rebate_shipping_fetch['rebate_shipping'];
                    //echo $rebate_less++;
                }
                // ADDED non-rebatable

                // ADDED FREE
                $free_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'FREE'";
                $free_qry = mysqli_query($connect, $free_sql);
                while ($rebatable = mysqli_fetch_array($free_qry)) {
                    $codeitemfree = $rebatable['code_name'];
                    $rebatefree_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitemfree' AND ol_poid = '$poid'";
                    $rebatefree_shipping_qry = mysqli_query($connect, $rebatefree_shipping_sql);
                    $rebatefree_shipping_fetch = mysqli_fetch_array($rebatefree_shipping_qry);

                    $free_less += $rebatefree_shipping_fetch['rebate_shipping'];
                    //echo $rebate_less++;
                }

                // ADDED FREE
                $free2_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'FREE TWO'";
                $free2_qry = mysqli_query($connect, $free2_sql);
                while ($rebatable = mysqli_fetch_array($free2_qry)) {
                    $codeitemfree2 = $rebatable['code_name'];
                    $rebatefree2_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitemfree2' AND ol_poid = '$poid'";
                    $rebatefree2_shipping_qry = mysqli_query($connect, $rebatefree2_shipping_sql);
                    $rebatefree2_shipping_fetch = mysqli_fetch_array($rebatefree2_shipping_qry);

                    $free_less2 += $rebatefree2_shipping_fetch['rebate_shipping'];
                    //echo $rebate_less++;
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
                // FOR CANADA PART

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
                // FOR JAPAN PART

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
                // FOR OTHER COUNTRY ONLY
                // LESS SHIPPING FEE END

                // SHIPPING FEE START
                $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                $shipping_qry = mysqli_query($connect, $shipping_sql);
                $shipping_fetch = mysqli_fetch_array($shipping_qry);
                $shipping_num = mysqli_num_rows($shipping_qry);

                $remove_shipping = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = 'JN04'";
                $remove_shipping_sql = mysqli_query($connect, $remove_shipping);
                $remove_num = mysqli_num_rows($remove_shipping_sql);

                if ($shipping_num < 0 || $mode_of_payment == 'Cash On Pick Up' || $order_qty <= 2 && $customer_country == 'PHILIPPINES' && $remove_num == 1) {
                    $shipping = 0;
                } else {
                    $shipping = $shipping_fetch['shipping_price'];
                }
                // SHIPPING FEE START

                // UPDATE OL DATE
                $sql_date_ol = mysqli_query($connect, "UPDATE upti_order_list SET ol_date = '$date_today' WHERE ol_poid = '$poid'");
                // UPDATE OL DATE

                // Total Amount
                $total_amount = $subtotal + $shipping - $less_shipping_fee;

                // PROCESS ORDER
                if(isset($_POST['checkouts'])) {
                    $img_name = $_FILES['file']['name'];
                    $img_size = $_FILES['file']['size'];
                    $img_tmp = $_FILES['file']['tmp_name'];
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    // echo ($img_ex);
                    $img_ex_lc = strtolower($img_ex);

                    $allow_ex = array("jpg", "jpeg", "png", "gif");

                    if($img_name == '' && $mode_of_payment == 'E-Payment' || $img_name == '' && $mode_of_payment == 'Bank') {
                        flash("warning", "You forgot to attach your payment receipt Attach it now!");
                        header('location: order-list.php');
                    } else {

                        if (in_array($img_ex_lc, $allow_ex)) {
                            $new_name = $poid.'.'.$img_ex_lc;
                            $img_path_sa_buhay_niya = './images/payment/'.$new_name;
                            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);
            
                            $checkout_sql = "UPDATE upti_transaction SET 
                                trans_date = '$date_today',
                                trans_time = '$time',
                                trans_status = 'Pending',
                                trans_subtotal = '$total_amount',
                                trans_ship = '$shipping',
                                trans_less_ship = '$less_shipping_fee',
                                trans_img = '$new_name'
                            WHERE trans_poid = '$poid'";
                            $checkout_qry = mysqli_query($connect, $checkout_sql);
                        } else {
                            $checkout_sql = "UPDATE upti_transaction SET 
                                trans_date = '$date_today',
                                trans_time = '$time',
                                trans_status = 'Pending',
                                trans_subtotal = '$total_amount',
                                trans_ship = '$shipping',
                                trans_less_ship = '$less_shipping_fee',
                                trans_img = '$new_name'
                            WHERE trans_poid = '$poid'";
                            $checkout_qry = mysqli_query($connect, $checkout_sql);
                        }

                        // ADD 1 TO POID Number
                        $New_count = $Ucount + 1;
                        $update_user_count = "UPDATE upti_users SET users_count = '$New_count' WHERE users_code = '$Ucode'";
                        $update_user_count_qry = mysqli_query($connect, $update_user_count);

                        // Email Send to Stockist
                        // Get Stockist ID NUMBER
                        $stockist_sql = "SELECT * FROM stockist WHERE stockist_country = '$customer_country'";
                        $stockist_qry = mysqli_query($connect, $stockist_sql);
                        $stockist_fetch = mysqli_fetch_array($stockist_qry);

                        $stockist_code = $stockist_fetch['stockist_code'];

                        // Get Stockist Email Address
                        $email_sql = "SELECT * FROM upti_reseller WHERE reseller_code = '$stockist_code'";
                        $email_qry = mysqli_query($connect, $email_sql);
                        $email_fetch = mysqli_fetch_array($email_qry);

                        $stockist_email = $email_fetch['reseller_email'];
                        $stockist_name = $email_fetch['reseller_name'];

                        // SEND TO STOCKIST EMAIL
                        $remarks = 'Hi '.$stockist_name. ',<br><br> We noticed there were NEW orders added to your ‘Incoming Order’ cart. If you’re ready to fulfill these, your account is waiting for your return.<br><br>
                        <a href="https://upticorporationph.com/incoming-pending-order.php" target="_blank">CHECK NOW</a>';

                        $mail = new PHPMailer(); 
                        //$mail->SMTPDebug=3;
                        $mail->IsSMTP(); 
                        $mail->SMTPAuth = true; 
                        $mail->SMTPSecure = 'ssl'; 
                        $mail->Host = "smtp.hostinger.com";
                        $mail->Port = "465"; 
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Username = "beautybyuptimised@upticorporationph.com";
                        $mail->Password = '@User2022';
                        $mail->SetFrom("beautybyuptimised@upticorporationph.com", "Beauty By Uptimised");
                        $mail->Subject = 'Your Uptimised Cart is waiting for you…';
                        $mail->Body = $remarks;
                        $mail->AddAddress($stockist_email);
                        $mail->SMTPOptions=array('ssl'=>array(
                            'verify_peer'=>false,
                            'verify_peer_name'=>false,
                            'allow_self_signed'=>false
                        ));
                        if(!$mail->Send()){
                            echo $mail->ErrorInfo;
                        }
                        // // SEND TO STOCKIST EMAIL

                        flash("order", "Thank you! Your order was successfully submitted!");
                        header('location: my-order.php');

                    }
                    // PROCESS ORDER
                }
            }
            // SCAPE REBATABLE
            } else {
                flash("warning", "Please add main tie up promo");
                header('location: order-list.php');
            }
            // EXCLUSIVE
        }
        // CHECK FREE
        else 
        // CHECK FREE
        {
            flash("order", "Ooops, you forgot to add your FREE item! Add to cart now");
            header('location: order-list.php');
        }
    
    } else {
        flash("warning", "Ooops! You miss to add more tieup item");
        header('location: order-list.php');
    }

?>