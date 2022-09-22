<?php

    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');
 
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

    $get_country = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
    $get_country_qry = mysqli_query($connect, $get_country);
    $get_country_fetch = mysqli_fetch_array($get_country_qry);

    $customer_country = $get_country_fetch['trans_country'];
    $state = $get_country_fetch['trans_state'];

    if ($customer_country == 'QATAR' || $customer_country == 'BAHRAIN' || $customer_country == 'OMAN' || $customer_country == 'KUWAIT') {
      $c_country = 'UNITED ARAB EMIRATES';
    } else {
      $c_country = $customer_country;
    }

    if ($customer_country == 'CANADA') {
      if ($state != 'ALBERTA') {
        $c_state = 'ALL';
      } else {
        // $c_state = $get_country_fetch['trans_state'];
        $c_state = 'ALL';
      }
    } else {
      $c_state = 'ALL';
    }

    if(isset($_POST['add_items'])) {
        $item_code = $_POST['item_code'];
        $item_qty = $_POST['qty'];

        if ($item_code == '' || $item_qty == '') {
            flash("warning", "Empty Item Code, Please try again");
            header('location: order-list.php');
            } else {

                $check_cd = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$item_code'");
                $check_cd_fetch = mysqli_fetch_array($check_cd);

                if (mysqli_num_rows($check_cd) > 0) {
                    $exclusive = $check_cd_fetch['code_exclusive'];
                } else {
                    $exclusive = '';
                }
 
                if ($exclusive != '') {
                    $check_order_list = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = '$exclusive'";
                    $check_order_list_sql = mysqli_query($connect, $check_order_list);
                    $check_order_list_num = mysqli_num_rows($check_order_list_sql);
                    
                    if ($check_order_list_num == 0) {

                        $get_packages = "SELECT * FROM upti_package WHERE package_code = '$exclusive'";
                        $get_package_qrys = mysqli_query($connect, $get_packages);
                        $get_package_nums = mysqli_num_rows($get_package_qrys);
                        $get_package_fetchs = mysqli_fetch_array($get_package_qrys);

                        if ($get_package_nums > 0) {
                            // Package Check
                            $c1 = $get_package_fetch['package_one_code'];
                            $oq1 = $get_package_fetch['package_one_qty'];
                            $q1 = $item_qty * $oq1;
                
                            $c2 = $get_package_fetch['package_two_code'];
                            $oq2 = $get_package_fetch['package_two_qty'];
                            $q2 = $item_qty * $oq2;
                
                            $c3 = $get_package_fetch['package_three_code'];
                            $oq3 = $get_package_fetch['package_three_qty'];
                            $q3 = $item_qty * $oq3;
                
                            $c4 = $get_package_fetch['package_four_code'];
                            $oq4 = $get_package_fetch['package_four_qty'];
                            $q4 = $item_qty * $oq4;
                
                            $c5 = $get_package_fetch['package_five_code'];
                            $oq5 = $get_package_fetch['package_five_qty'];
                            $q5 = $item_qty * $oq5;

                            // 1
                            $check_stock1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry1 = mysqli_query($connect, $check_stock1);
                            $check_stock_fetch1 = mysqli_fetch_array($check_stock_qry1);
                            $check_stock_num1 = mysqli_num_rows($check_stock_qry1);
                            if ($check_stock_num1 == 0) {
                                $stockist_stock1 = 0;
                            } else {
                                $stockist_stock1 = $check_stock_fetch1['si_item_stock'];
                            }
                            // echo '<br>';
                            // 2
                            $check_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry2 = mysqli_query($connect, $check_stock2);
                            $check_stock_fetch2 = mysqli_fetch_array($check_stock_qry2);
                            $check_stock_num2 = mysqli_num_rows($check_stock_qry2);
                            if ($check_stock_num2 == 0) {
                                $stockist_stock2 = 0;
                            } else {
                                $stockist_stock2 = $check_stock_fetch2['si_item_stock'];
                            }
                            // echo '<br>';
                            // 3
                            $check_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry3 = mysqli_query($connect, $check_stock3);
                            $check_stock_fetch3 = mysqli_fetch_array($check_stock_qry3);
                            $check_stock_num3 = mysqli_num_rows($check_stock_qry3);
                            if ($check_stock_num3 == 0) {
                                $stockist_stock3 = 0;
                            } else {
                                $stockist_stock3 = $check_stock_fetch3['si_item_stock'];
                            }
                            // echo '<br>';
                            // 4
                            $check_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry4 = mysqli_query($connect, $check_stock4);
                            $check_stock_fetch4 = mysqli_fetch_array($check_stock_qry4);
                            $check_stock_num4 = mysqli_num_rows($check_stock_qry4);
                            if ($check_stock_num4 == 0) {
                                $stockist_stock4 = 0;
                            } else {
                                $stockist_stock4 = $check_stock_fetch4['si_item_stock'];
                            }
                            // echo '<br>';
                            // 5
                            $check_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry5 = mysqli_query($connect, $check_stock5);
                            $check_stock_fetch5 = mysqli_fetch_array($check_stock_qry5);
                            $check_stock_num5 = mysqli_num_rows($check_stock_qry5);
                            if ($check_stock_num5 == 0) {
                                $stockist_stock5 = 0;
                            } else {
                                $stockist_stock5 = $check_stock_fetch5['si_item_stock'];
                            }

                            if ($stockist_stock1 >= $q1 && $stockist_stock2 >= $q2 && $stockist_stock3 >= $q3 && $stockist_stock4 >= $q4 && $stockist_stock5 >= $q5) {
                                $check_package = "SELECT * FROM upti_package WHERE package_code = '$exclusive'";
                                $check_package_qry = mysqli_query($connect, $check_package);
                                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                                $check_package_num = mysqli_num_rows($check_package_qry);
                
                                if($check_package_num < 1) {
                                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$exclusive'";
                                    $check_item_qry = mysqli_query($connect, $check_item);
                                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                                    $check_item_num = mysqli_num_rows($check_item_qry);
                
                                    $description = $check_item_fetch['items_desc'];
                                    $points = $check_item_fetch['items_points'] * $item_qty;
                                } else {
                                    $description = $check_package_fetch['package_desc'];
                                    $points = $check_package_fetch['package_points'] * $item_qty;
                                }
                
                                // Change Country if National into Philippines
                                if ($customer_country == 'INTERNATIONAL') {
                                    $customer_country = 'PHILIPPINES';
                                }

                                // check_boga
                            $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET ANY'";
                            $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
                            $check_boga_num = mysqli_num_rows($check_boga_qrys);
                
                            if ($check_boga_num >= 1) {
                                $add_free = mysqli_query($connect, "INSERT INTO upti_free (free_number, free_poid) VALUES ('$item_qty', '$poid')");
                            }
                
                                // Get Country Price
                                $get_price = "SELECT * FROM upti_country WHERE country_code = '$exclusive' AND country_name = '$customer_country'";
                                $get_price_qry = mysqli_query($connect, $get_price);
                                $get_price_fetch = mysqli_fetch_array($get_price_qry);
                
                                $philippines = $get_price_fetch['country_total_php'] * $item_qty;
                                $c_price = $get_price_fetch['country_price'];
                                $stockist_price = $get_price_fetch['country_stockist'];
                                $total_c_price = $get_price_fetch['country_price'] * $item_qty;
                
                                $insert_order = "INSERT INTO upti_order_list (
                                    ol_country,
                                    ol_poid,
                                    ol_code,
                                    ol_seller,
                                    ol_reseller,
                                    ol_admin,
                                    ol_desc,
                                    ol_price,
                                    ol_php,
                                    ol_stockist,
                                    ol_qty,
                                    ol_points,
                                    ol_subtotal,
                                    ol_status,
                                    ol_date
                                ) VALUES (
                                    '$customer_country',
                                    '$poid',
                                    '$exclusive',
                                    '$Ucode',
                                    '$Ureseller',
                                    'UPTIMAIN',
                                    '$description',
                                    '$c_price',
                                    '$philippines',
                                    '$stockist_price',
                                    '$item_qty',
                                    '$points',
                                    '$total_c_price',
                                    'Pending',
                                    '$date_today'
                                )";
                                $upline_qry = mysqli_query($connect, $insert_order);

                            }                
                        } else {
                            // get new code
                            $get_new_code = "SELECT * FROM upti_code WHERE code_name = '$exclusive'";
                            $get_new_code_qry = mysqli_query($connect, $get_new_code);
                            $get_new_code_fetch = mysqli_fetch_array($get_new_code_qry);

                            $new_item_code = $get_new_code_fetch['code_main'];

                            // Single Item Check
                            echo $check_stock = "SELECT * FROM stockist_inventory WHERE si_item_code = '$new_item_code' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry = mysqli_query($connect, $check_stock);
                            $check_stock_fetch = mysqli_fetch_array($check_stock_qry);
                            $check_stock_num = mysqli_num_rows($check_stock_qry);

                            if ($check_stock_num == 0) {
                                $stockist_stock = 0;
                            } else {
                                $stockist_stock = $check_stock_fetch['si_item_stock'];
                            }
                
                                $check_package = "SELECT * FROM upti_package WHERE package_code = '$exclusive'";
                                $check_package_qry = mysqli_query($connect, $check_package);
                                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                                $check_package_num = mysqli_num_rows($check_package_qry);
                
                                if($check_package_num < 1) {
                                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$exclusive'";
                                    $check_item_qry = mysqli_query($connect, $check_item);
                                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                                    $check_item_num = mysqli_num_rows($check_item_qry);
                
                                    $description = $check_item_fetch['items_desc'];
                                    $points = $check_item_fetch['items_points'] * $item_qty;
                                } else {
                                    $description = $check_package_fetch['package_desc'];
                                    $points = $check_package_fetch['package_points'] * $item_qty;
                                }
                
                                // Change Country if National into Philippines
                                if ($customer_country == 'INTERNATIONAL') {
                                    $customer_country = 'PHILIPPINES';
                                }

                                // check_boga
                                $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET ANY'";
                                $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
                                $check_boga_num = mysqli_num_rows($check_boga_qrys);
                    
                                if ($check_boga_num >= 1) {
                                    $add_free = mysqli_query($connect, "INSERT INTO upti_free (free_number, free_poid) VALUES ('$item_qty', '$poid')");
                                }
                
                                // Get Country Price
                                $get_price = "SELECT * FROM upti_country WHERE country_code = '$exclusive' AND country_name = '$customer_country'";
                                $get_price_qry = mysqli_query($connect, $get_price);
                                $get_price_fetch = mysqli_fetch_array($get_price_qry);
                
                                $philippines = $get_price_fetch['country_total_php'] * $item_qty;
                                $c_price = $get_price_fetch['country_price'];
                                $stockist_price = $get_price_fetch['country_stockist'];
                                $total_c_price = $get_price_fetch['country_price'] * $item_qty;
                
                                $insert_order = "INSERT INTO upti_order_list (
                                    ol_country,
                                    ol_poid,
                                    ol_code,
                                    ol_seller,
                                    ol_reseller,
                                    ol_admin,
                                    ol_desc,
                                    ol_price,
                                    ol_php,
                                    ol_stockist,
                                    ol_qty,
                                    ol_points,
                                    ol_subtotal,
                                    ol_status,
                                    ol_date
                                ) VALUES (
                                    '$customer_country',
                                    '$poid',
                                    '$exclusive',
                                    '$Ucode',
                                    '$Ureseller',
                                    'UPTIMAIN',
                                    '$description',
                                    '$c_price',
                                    '$philippines',
                                    '$stockist_price',
                                    '$item_qty',
                                    '$points',
                                    '$total_c_price',
                                    'Pending',
                                    '$date_today'
                                )";
                                $upline_qry = mysqli_query($connect, $insert_order);
                            }
                        }
                    

                    $check_order_list = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = '$item_code'";
                    $check_order_list_sql = mysqli_query($connect, $check_order_list);
                    $check_order_list_num = mysqli_num_rows($check_order_list_sql);
                    
                    if ($check_order_list_num == 0) {

                        $get_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                        $get_package_qry = mysqli_query($connect, $get_package);
                        $get_package_num = mysqli_num_rows($get_package_qry);
                        $get_package_fetch = mysqli_fetch_array($get_package_qry);
                
                        if ($get_package_num > 0) {
                            // Package Check

                            $c1 = $get_package_fetch['package_one_code'];
                            $oq1 = $get_package_fetch['package_one_qty'];
                            $q1 = $item_qty * $oq1;
                
                            $c2 = $get_package_fetch['package_two_code'];
                            $oq2 = $get_package_fetch['package_two_qty'];
                            $q2 = $item_qty * $oq2;
                
                            $c3 = $get_package_fetch['package_three_code'];
                            $oq3 = $get_package_fetch['package_three_qty'];
                            $q3 = $item_qty * $oq3;
                
                            $c4 = $get_package_fetch['package_four_code'];
                            $oq4 = $get_package_fetch['package_four_qty'];
                            $q4 = $item_qty * $oq4;
                
                            $c5 = $get_package_fetch['package_five_code'];
                            $oq5 = $get_package_fetch['package_five_qty'];
                            $q5 = $item_qty * $oq5;
                            
                            // 1
                            $check_stock1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry1 = mysqli_query($connect, $check_stock1);
                            $check_stock_fetch1 = mysqli_fetch_array($check_stock_qry1);
                            $check_stock_num1 = mysqli_num_rows($check_stock_qry1);
                            if ($check_stock_num1 == 0) {
                                $stockist_stock1 = 0;
                            } else {
                                $stockist_stock1 = $check_stock_fetch1['si_item_stock'];
                            }
                            // echo '<br>';
                            // 2
                            $check_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry2 = mysqli_query($connect, $check_stock2);
                            $check_stock_fetch2 = mysqli_fetch_array($check_stock_qry2);
                            $check_stock_num2 = mysqli_num_rows($check_stock_qry2);
                            if ($check_stock_num2 == 0) {
                                $stockist_stock2 = 0;
                            } else {
                                $stockist_stock2 = $check_stock_fetch2['si_item_stock'];
                            }
                            // echo '<br>';
                            // 3
                            $check_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry3 = mysqli_query($connect, $check_stock3);
                            $check_stock_fetch3 = mysqli_fetch_array($check_stock_qry3);
                            $check_stock_num3 = mysqli_num_rows($check_stock_qry3);
                            if ($check_stock_num3 == 0) {
                                $stockist_stock3 = 0;
                            } else {
                                $stockist_stock3 = $check_stock_fetch3['si_item_stock'];
                            }
                            // echo '<br>';
                            // 4
                            $check_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry4 = mysqli_query($connect, $check_stock4);
                            $check_stock_fetch4 = mysqli_fetch_array($check_stock_qry4);
                            $check_stock_num4 = mysqli_num_rows($check_stock_qry4);
                            if ($check_stock_num4 == 0) {
                                $stockist_stock4 = 0;
                            } else {
                                $stockist_stock4 = $check_stock_fetch4['si_item_stock'];
                            }
                            // echo '<br>';
                            // 5
                            $check_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry5 = mysqli_query($connect, $check_stock5);
                            $check_stock_fetch5 = mysqli_fetch_array($check_stock_qry5);
                            $check_stock_num5 = mysqli_num_rows($check_stock_qry5);
                            if ($check_stock_num5 == 0) {
                                $stockist_stock5 = 0;
                            } else {
                                $stockist_stock5 = $check_stock_fetch5['si_item_stock'];
                            }

                            if ($stockist_stock1 >= $q1 && $stockist_stock2 >= $q2 && $stockist_stock3 >= $q3 && $stockist_stock4 >= $q4 && $stockist_stock5 >= $q5) {
                                $check_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                                $check_package_qry = mysqli_query($connect, $check_package);
                                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                                $check_package_num = mysqli_num_rows($check_package_qry);
                
                                if($check_package_num < 1) {
                                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$item_code'";
                                    $check_item_qry = mysqli_query($connect, $check_item);
                                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                                    $check_item_num = mysqli_num_rows($check_item_qry);
                
                                    $description = $check_item_fetch['items_desc'];
                                    $points = $check_item_fetch['items_points'] * $item_qty;
                                } else {
                                    $description = $check_package_fetch['package_desc'];
                                    $points = $check_package_fetch['package_points'] * $item_qty;
                                }
                
                                // check_boga
                                $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET ANY'";
                                $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
                                $check_boga_num = mysqli_num_rows($check_boga_qrys);
                    
                                if ($check_boga_num >= 1) {
                                    $add_free = mysqli_query($connect, "INSERT INTO upti_free (free_number, free_poid) VALUES ('$item_qty', '$poid')");
                                }

                                $get_country2 = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                                $get_country_qry2 = mysqli_query($connect, $get_country2);
                                $get_country_fetch2 = mysqli_fetch_array($get_country_qry2);

                                $customer_country = $get_country_fetch2['trans_country'];

                                 // Change Country if National into Philippines
                                 if ($customer_country == 'INTERNATIONAL') {
                                    $customer_country = 'PHILIPPINES';
                                }

                                // Get Country Price
                                $get_price = "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'";
                                $get_price_qry = mysqli_query($connect, $get_price);
                                $get_price_fetch = mysqli_fetch_array($get_price_qry);
                
                                $philippines = $get_price_fetch['country_total_php'] * $item_qty;
                                $c_price = $get_price_fetch['country_price'];
                                $stockist_price = $get_price_fetch['country_stockist'];
                                $total_c_price = $get_price_fetch['country_price'] * $item_qty;
                
                                $insert_order = "INSERT INTO upti_order_list (
                                    ol_country,
                                    ol_poid,
                                    ol_code,
                                    ol_seller,
                                    ol_reseller,
                                    ol_admin,
                                    ol_desc,
                                    ol_price,
                                    ol_php,
                                    ol_stockist,
                                    ol_qty,
                                    ol_points,
                                    ol_subtotal,
                                    ol_status,
                                    ol_date
                                ) VALUES (
                                    '$customer_country',
                                    '$poid',
                                    '$item_code',
                                    '$Ucode',
                                    '$Ureseller',
                                    'UPTIMAIN',
                                    '$description',
                                    '$c_price',
                                    '$philippines',
                                    '$stockist_price',
                                    '$item_qty',
                                    '$points',
                                    '$total_c_price',
                                    'Pending',
                                    '$date_today'
                                )";
                                $upline_qry = mysqli_query($connect, $insert_order);

                                 // free 2 insert 
                                 $free_2 = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET TWO'");
                                 if(mysqli_num_rows($free_2) > 0) {
                                    $free = $item_qty * 2;
                                    $insert_free_2 = mysqli_query($connect, "INSERT INTO upti_free_2 (f2_number, f2_poid) VALUES ('$free', '$poid')");
                                 }
                
                                echo "<script>window.location='order-list.php'</script>";
                                flash("order", "Item has been added successfully!");
                                header('location: order-list.php');
                                
                            } else {
                                // echo "<script>alert('Insufficient Stocks to Process Your Order!');window.location='order-list.php'</script>";
                                flash("warning", "Insufficient Stocks to Process Your Order!!");
                                header('location: order-list.php');
                            }
                
                        } else {
                            // get new code
                            $get_new_code = "SELECT * FROM upti_code WHERE code_name = '$item_code'";
                            $get_new_code_qry = mysqli_query($connect, $get_new_code);
                            $get_new_code_fetch = mysqli_fetch_array($get_new_code_qry);

                            $new_item_code = $get_new_code_fetch['code_main'];

                            // Single Item Check
                            $check_stock = "SELECT * FROM stockist_inventory WHERE si_item_code = '$new_item_code' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry = mysqli_query($connect, $check_stock);
                            $check_stock_fetch = mysqli_fetch_array($check_stock_qry);
                            $check_stock_num = mysqli_num_rows($check_stock_qry);
                
                            if ($check_stock_num == 0) {
                                $stockist_stock = 0;
                            } else {
                                $stockist_stock = $check_stock_fetch['si_item_stock'];
                            }

                            if ($stockist_stock >= $item_qty) {
                                
                                $check_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                                $check_package_qry = mysqli_query($connect, $check_package);
                                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                                $check_package_num = mysqli_num_rows($check_package_qry);
                
                                if($check_package_num < 1) {
                                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$item_code'";
                                    $check_item_qry = mysqli_query($connect, $check_item);
                                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                                    $check_item_num = mysqli_num_rows($check_item_qry);
                
                                    $description = $check_item_fetch['items_desc'];
                                    $points = $check_item_fetch['items_points'] * $item_qty;
                                } else {
                                    $description = $check_package_fetch['package_desc'];
                                    $points = $check_package_fetch['package_points'] * $item_qty;
                                }
                
                                // check_boga
                            $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET ANY'";
                            $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
                            $check_boga_num = mysqli_num_rows($check_boga_qrys);
                
                            if ($check_boga_num >= 1) {
                                $add_free = mysqli_query($connect, "INSERT INTO upti_free (free_number, free_poid) VALUES ('$item_qty', '$poid')");
                            }

                            $get_country2 = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                            $get_country_qry2 = mysqli_query($connect, $get_country2);
                            $get_country_fetch2 = mysqli_fetch_array($get_country_qry2);

                            $customer_country = $get_country_fetch2['trans_country'];

                            // Change Country if National into Philippines
                            if ($customer_country == 'INTERNATIONAL') {
                             $customer_country = 'PHILIPPINES';
                            }

                                // Get Country Price
                                $get_price = "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'";
                                $get_price_qry = mysqli_query($connect, $get_price);
                                $get_price_fetch = mysqli_fetch_array($get_price_qry);
                
                                $philippines = $get_price_fetch['country_total_php'] * $item_qty;
                                $c_price = $get_price_fetch['country_price'];
                                $stockist_price = $get_price_fetch['country_stockist'];
                                $total_c_price = $get_price_fetch['country_price'] * $item_qty;
                
                                $insert_order = "INSERT INTO upti_order_list (
                                    ol_country,
                                    ol_poid,
                                    ol_code,
                                    ol_seller,
                                    ol_reseller,
                                    ol_admin,
                                    ol_desc,
                                    ol_price,
                                    ol_php,
                                    ol_stockist,
                                    ol_qty,
                                    ol_points,
                                    ol_subtotal,
                                    ol_status,
                                    ol_date
                                ) VALUES (
                                    '$customer_country',
                                    '$poid',
                                    '$item_code',
                                    '$Ucode',
                                    '$Ureseller',
                                    'UPTIMAIN',
                                    '$description',
                                    '$c_price',
                                    '$philippines',
                                    '$stockist_price',
                                    '$item_qty',
                                    '$points',
                                    '$total_c_price',
                                    'Pending',
                                    '$date_today'
                                )";
                                $upline_qry = mysqli_query($connect, $insert_order);

                                // free 2 insert 
                                $free_2 = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET TWO'");
                                if(mysqli_num_rows($free_2) > 0) {
                                   $free = $item_qty * 2;
                                   $insert_free_2 = mysqli_query($connect, "INSERT INTO upti_free_2 (f2_number, f2_poid) VALUES ('$free', '$poid')");
                                }
                
                                flash("order", "Item has been added successfully");
                                header('location: order-list.php');
                            } else {
                                flash("warning", "Insufficient Stocks to Process Your Order!");
                                header('location: order-list.php');
                            }
                        }
                    } else {
                        flash("warning", "This product is already on the Order List, Please choose another product!");
                        header('location: order-list.php');
                    }
                } else {
                    $check_order_list = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = '$item_code'";
                    $check_order_list_sql = mysqli_query($connect, $check_order_list);
                    $check_order_list_num = mysqli_num_rows($check_order_list_sql);
                    
                    if ($check_order_list_num == 0) {

                        $get_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                        $get_package_qry = mysqli_query($connect, $get_package);
                        $get_package_num = mysqli_num_rows($get_package_qry);
                        $get_package_fetch = mysqli_fetch_array($get_package_qry);
                
                        if ($get_package_num > 0) {

                            // Package Check
                            $c1 = $get_package_fetch['package_one_code'];
                            $oq1 = $get_package_fetch['package_one_qty'];
                            $q1 = $item_qty * $oq1;
                
                            $c2 = $get_package_fetch['package_two_code'];
                            $oq2 = $get_package_fetch['package_two_qty'];
                            $q2 = $item_qty * $oq2;
                
                            $c3 = $get_package_fetch['package_three_code'];
                            $oq3 = $get_package_fetch['package_three_qty'];
                            $q3 = $item_qty * $oq3;
                
                            $c4 = $get_package_fetch['package_four_code'];
                            $oq4 = $get_package_fetch['package_four_qty'];
                            $q4 = $item_qty * $oq4;
                
                            $c5 = $get_package_fetch['package_five_code'];
                            $oq5 = $get_package_fetch['package_five_qty'];
                            $q5 = $item_qty * $oq5;
                            
                            // 1
                            $check_stock1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry1 = mysqli_query($connect, $check_stock1);
                            $check_stock_fetch1 = mysqli_fetch_array($check_stock_qry1);
                            $check_stock_num1 = mysqli_num_rows($check_stock_qry1);
                            if ($check_stock_num1 == 0) {
                                $stockist_stock1 = 0;
                            } else {
                                $stockist_stock1 = $check_stock_fetch1['si_item_stock'];
                            }
                            // echo '<br>';
                            // 2
                            $check_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry2 = mysqli_query($connect, $check_stock2);
                            $check_stock_fetch2 = mysqli_fetch_array($check_stock_qry2);
                            $check_stock_num2 = mysqli_num_rows($check_stock_qry2);
                            if ($check_stock_num2 == 0) {
                                $stockist_stock2 = 0;
                            } else {
                                $stockist_stock2 = $check_stock_fetch2['si_item_stock'];
                            }
                            // echo '<br>';
                            // 3
                            $check_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry3 = mysqli_query($connect, $check_stock3);
                            $check_stock_fetch3 = mysqli_fetch_array($check_stock_qry3);
                            $check_stock_num3 = mysqli_num_rows($check_stock_qry3);
                            if ($check_stock_num3 == 0) {
                                $stockist_stock3 = 0;
                            } else {
                                $stockist_stock3 = $check_stock_fetch3['si_item_stock'];
                            }
                            // echo '<br>';
                            // 4
                            $check_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry4 = mysqli_query($connect, $check_stock4);
                            $check_stock_fetch4 = mysqli_fetch_array($check_stock_qry4);
                            $check_stock_num4 = mysqli_num_rows($check_stock_qry4);
                            if ($check_stock_num4 == 0) {
                                $stockist_stock4 = 0;
                            } else {
                                $stockist_stock4 = $check_stock_fetch4['si_item_stock'];
                            }
                            // echo '<br>';
                            // 5
                            $check_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry5 = mysqli_query($connect, $check_stock5);
                            $check_stock_fetch5 = mysqli_fetch_array($check_stock_qry5);
                            $check_stock_num5 = mysqli_num_rows($check_stock_qry5);
                            if ($check_stock_num5 == 0) {
                                $stockist_stock5 = 0;
                            } else {
                                $stockist_stock5 = $check_stock_fetch5['si_item_stock'];
                            }

                            if ($stockist_stock1 >= $q1 && $stockist_stock2 >= $q2 && $stockist_stock3 >= $q3 && $stockist_stock4 >= $q4 && $stockist_stock5 >= $q5) {
                                $check_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                                $check_package_qry = mysqli_query($connect, $check_package);
                                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                                $check_package_num = mysqli_num_rows($check_package_qry);
                
                                if($check_package_num < 1) {
                                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$item_code'";
                                    $check_item_qry = mysqli_query($connect, $check_item);
                                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                                    $check_item_num = mysqli_num_rows($check_item_qry);
                
                                    $description = $check_item_fetch['items_desc'];
                                    $points = $check_item_fetch['items_points'] * $item_qty;
                                } else {
                                    $description = $check_package_fetch['package_desc'];
                                    $points = $check_package_fetch['package_points'] * $item_qty;
                                }
                
                                // check_boga
                            $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET ANY'";
                            $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
                            $check_boga_num = mysqli_num_rows($check_boga_qrys);
                
                            if ($check_boga_num >= 1) {
                                $add_free = mysqli_query($connect, "INSERT INTO upti_free (free_number, free_poid) VALUES ('$item_qty', '$poid')");
                            }

                            $get_country2 = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                            $get_country_qry2 = mysqli_query($connect, $get_country2);
                            $get_country_fetch2 = mysqli_fetch_array($get_country_qry2);

                            $customer_country = $get_country_fetch2['trans_country'];

                                // Change Country if National into Philippines
                                if ($customer_country == 'INTERNATIONAL') {
                                $customer_country = 'PHILIPPINES';
                            }

                                // Get Country Price
                                $get_price = "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'";
                                $get_price_qry = mysqli_query($connect, $get_price);
                                $get_price_fetch = mysqli_fetch_array($get_price_qry);
                
                                $philippines = $get_price_fetch['country_total_php'] * $item_qty;
                                $c_price = $get_price_fetch['country_price'];
                                $stockist_price = $get_price_fetch['country_stockist'];
                                $total_c_price = $get_price_fetch['country_price'] * $item_qty;
                
                                $insert_order = "INSERT INTO upti_order_list (
                                    ol_country,
                                    ol_poid,
                                    ol_code,
                                    ol_seller,
                                    ol_reseller,
                                    ol_admin,
                                    ol_desc,
                                    ol_price,
                                    ol_php,
                                    ol_stockist,
                                    ol_qty,
                                    ol_points,
                                    ol_subtotal,
                                    ol_status,
                                    ol_date
                                ) VALUES (
                                    '$customer_country',
                                    '$poid',
                                    '$item_code',
                                    '$Ucode',
                                    '$Ureseller',
                                    'UPTIMAIN',
                                    '$description',
                                    '$c_price',
                                    '$philippines',
                                    '$stockist_price',
                                    '$item_qty',
                                    '$points',
                                    '$total_c_price',
                                    'Pending',
                                    '$date_today'
                                )";
                                $upline_qry = mysqli_query($connect, $insert_order);

                                // free 2 insert 
                                $free_2 = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET TWO'");
                                if(mysqli_num_rows($free_2) > 0) {
                                   $free = $item_qty * 2;
                                   $insert_free_2 = mysqli_query($connect, "INSERT INTO upti_free_2 (f2_number, f2_poid) VALUES ('$free', '$poid')");
                                }
                
                                echo "<script>window.location='order-list.php'</script>";
                                flash("order", "Item has been added successfully!");
                                header('location: order-list.php');
                                
                            } else {
                                // echo "<script>alert('Insufficient Stocks to Process Your Order!');window.location='order-list.php'</script>";
                                flash("warning", "Insufficient Stocks to Process Your Order!!");
                                header('location: order-list.php');
                            }
                
                        } else {
                            // get new code
                            $get_new_code = "SELECT * FROM upti_code WHERE code_name = '$item_code'";
                            $get_new_code_qry = mysqli_query($connect, $get_new_code);
                            $get_new_code_fetch = mysqli_fetch_array($get_new_code_qry);

                            $new_item_code = $get_new_code_fetch['code_main'];

                            // Single Item Check
                            $check_stock = "SELECT * FROM stockist_inventory WHERE si_item_code = '$new_item_code' AND si_item_country = '$c_country' AND si_item_state = '$c_state'";
                            $check_stock_qry = mysqli_query($connect, $check_stock);
                            $check_stock_fetch = mysqli_fetch_array($check_stock_qry);
                            $check_stock_num = mysqli_num_rows($check_stock_qry);
                
                            if ($check_stock_num == 0) {
                                $stockist_stock = 0;
                            } else {
                                $stockist_stock = $check_stock_fetch['si_item_stock'];
                            }
                
                            if ($stockist_stock >= $item_qty) {
                                
                                $check_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                                $check_package_qry = mysqli_query($connect, $check_package);
                                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                                $check_package_num = mysqli_num_rows($check_package_qry);
                
                                if($check_package_num < 1) {
                                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$item_code'";
                                    $check_item_qry = mysqli_query($connect, $check_item);
                                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                                    $check_item_num = mysqli_num_rows($check_item_qry);
                
                                    $description = $check_item_fetch['items_desc'];
                                    $points = $check_item_fetch['items_points'] * $item_qty;
                                } else {
                                    $description = $check_package_fetch['package_desc'];
                                    $points = $check_package_fetch['package_points'] * $item_qty;
                                }
                
                                // check_boga
                            $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET ANY'";
                            $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
                            $check_boga_num = mysqli_num_rows($check_boga_qrys);
                
                            if ($check_boga_num >= 1) {
                                $add_free = mysqli_query($connect, "INSERT INTO upti_free (free_number, free_poid) VALUES ('$item_qty', '$poid')");
                            }

                            $get_country2 = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                            $get_country_qry2 = mysqli_query($connect, $get_country2);
                            $get_country_fetch2 = mysqli_fetch_array($get_country_qry2);

                            $customer_country = $get_country_fetch2['trans_country'];

                                // Change Country if National into Philippines
                                if ($customer_country == 'INTERNATIONAL') {
                                $customer_country = 'PHILIPPINES';
                            }
                                // Get Country Price
                                $get_price = "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'";
                                $get_price_qry = mysqli_query($connect, $get_price);
                                $get_price_fetch = mysqli_fetch_array($get_price_qry);
                
                                $philippines = $get_price_fetch['country_total_php'] * $item_qty;
                                $c_price = $get_price_fetch['country_price'];
                                $stockist_price = $get_price_fetch['country_stockist'];
                                $total_c_price = $get_price_fetch['country_price'] * $item_qty;
                
                                $insert_order = "INSERT INTO upti_order_list (
                                    ol_country,
                                    ol_poid,
                                    ol_code,
                                    ol_seller,
                                    ol_reseller,
                                    ol_admin,
                                    ol_desc,
                                    ol_price,
                                    ol_php,
                                    ol_stockist,
                                    ol_qty,
                                    ol_points,
                                    ol_subtotal,
                                    ol_status,
                                    ol_date
                                ) VALUES (
                                    '$customer_country',
                                    '$poid',
                                    '$item_code',
                                    '$Ucode',
                                    '$Ureseller',
                                    'UPTIMAIN',
                                    '$description',
                                    '$c_price',
                                    '$philippines',
                                    '$stockist_price',
                                    '$item_qty',
                                    '$points',
                                    '$total_c_price',
                                    'Pending',
                                    '$date_today'
                                )";
                                $upline_qry = mysqli_query($connect, $insert_order);

                                // free 2 insert 
                                $free_2 = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'BUY ONE GET TWO'");
                                if(mysqli_num_rows($free_2) > 0) {
                                   $free = $item_qty * 2;
                                   $insert_free_2 = mysqli_query($connect, "INSERT INTO upti_free_2 (f2_number, f2_poid) VALUES ('$free', '$poid')");
                                }
                
                                flash("order", "Item has been added successfully");
                                header('location: order-list.php');
                            } else {
                                flash("warning", "Insufficient Stocks to Process Your Order!");
                                header('location: order-list.php');
                            }
                        }
                    } else {
                        flash("warning", "This product is already on the Order List, Please choose another product!");
                        header('location: order-list.php');
                    }
                }
        }
    }
?>