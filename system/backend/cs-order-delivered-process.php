<?php
    include '../dbms/conn.php';
    
    session_start();
    $uid = $_SESSION['uid'];

    $id = $_GET['id'];
    
    $get_poid = "SELECT * FROM web_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);
    
    $poid = $get_poid_fetch['trans_ref'];
    $upline_code = $get_poid_fetch['trans_upline'];
    $country = $get_poid_fetch['trans_country'];
    $state = $get_poid_fetch['trans_state'];

    $users = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$upline_code'");
    $users_fetch = mysqli_fetch_array($users);

    $upline_role = $users_fetch['users_role'];
    // echo '<br>';
    if ($upline_role == 'UPTIRESELLER') {
        // level 1
        $seller_code = $upline_code;
    } elseif ($upline_role == 'UPTIOSR') {
        // level 1
        $seller_code = $users_fetch['users_main'];
    }

    // STOCKIST PERCENTAGE
    if ($country == 'Canada') {
        if ($state !== 'ALBERTA' || $state === '') {
            $state = 'ALL';
        }
    } else {
        $state = 'ALL';
    }
    $stockist_stmt = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_country = '$country' AND stockist_state = '$state'");
    $stockist_f = mysqli_fetch_array($stockist_stmt);
    $stockist = $stockist_f['stockist_code'];

    // level 2
    $level2_stmt = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$seller_code'");
    $level2_fetch = mysqli_fetch_array($level2_stmt);
    $reseller_2 = $level2_fetch['users_main'];

    $getLevel2 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$reseller_2'");
    $getLevel2_fetch = mysqli_fetch_array($getLevel2);
    $reseller2_level = $getLevel2_fetch['users_level'];
    // level 2 end
    
    // level 2
    $level3_stmt = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$reseller_2'");
    $level3_fetch = mysqli_fetch_array($level3_stmt);
    $reseller_3 = $level3_fetch['users_main'];

    $getLevel3 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$reseller_3'");
    $getLevel3_fetch = mysqli_fetch_array($getLevel3);
    $reseller3_level = $getLevel3_fetch['users_level'];
    // level 2 end
    
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];

    if (isset($_POST['delivered'])) {
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');

        $desc = $namex.' Update '.$poid.' set Ordered Status into Delivered';

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'Delivered', '$desc')";
        $act_qry = mysqli_query($connect, $act);

         // INVENTORY REPORT
        $inv_report = "UPDATE stockist_report SET rp_status = 'Delivered' WHERE rp_poid = '$poid'";
        $inv_report_qry = mysqli_query($connect, $inv_report);
        
        // INVENTORY HISTORY
        $inv_history = "UPDATE stockist_history SET history_status = 'Delivered' WHERE history_poid = '$poid'";
        $inv_history_qry = mysqli_query($connect, $inv_history);
        
        $epayment_process = "UPDATE web_transaction SET trans_status = 'Delivered' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        $epayment_process1 = "UPDATE web_cart SET cart_status = 'Delivered' WHERE cart_ref = '$poid'";
        $epayment_process_qry1 = mysqli_query($connect, $epayment_process1);

        // earnings

        $amount_stmt = mysqli_query($connect, "SELECT SUM(cart_earn) AS amount, SUM(cart_price) AS price FROM web_cart WHERE cart_ref = '$poid'");
        $amount_f = mysqli_fetch_array($amount_stmt);

        $amount = $amount_f['amount'];
        $price = $amount_f['price'];

        // added stockist percentage
        $percent = $amount * 0.03;

        $stockist_wallet = "SELECT * FROM stockist_wallet WHERE w_id = '$stockist'";
        $stockist_wallet_qry = mysqli_query($connect, $stockist_wallet);
        $stockist_balance = mysqli_fetch_array($stockist_wallet_qry);

        $s_wallet = $stockist_balance['w_earning'] + $percent;

        $update_stockist_wallet = mysqli_query($connect, "UPDATE stockist_wallet SET w_earning = '$s_wallet' WHERE w_id = '$stockist'");

        $remarks_wallet = "Stockist Percentage for POID ".$poid." amount of ".$percent;

        $history_wallet = mysqli_query($connect, "INSERT INTO stockist_percentage (
          p_poid,
          p_code,
          p_amount,
          p_desc,
          p_time,
          p_date,
          p_pack
        ) VALUES (
          '$poid',
          '$percent',
          '$tax',
          '$remarks_wallet',
          '$time',
          '$datenow',
          'Regular Order'
        )");

        // earning 40%
        $forty = $amount  * 0.40;
        $tax = $forty * 0.05;
        $earnings = $forty - $tax;
        $remarks = 'You Received 40% Comission Product Worth of '.$price.' ['.$country.']';

        $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$seller_code', '$poid', '$earnings', '$tax', '$remarks', 'Sales', '$upline_code')";
        $earn_history_sql = mysqli_query($connect, $earn_history);

        $reseller_stmt = mysqli_query($connect, "SELECT reseller_earning FROM upti_reseller WHERE reseller_code = '$seller_code'");
        $reseller_f = mysqli_fetch_array($reseller_stmt);

        $reseller_earning = $reseller_f['reseller_earning'];

        $updated_earning = $reseller_earning + $earnings;

        $new_earnings = "UPDATE upti_reseller SET reseller_earning = '$updated_earning' WHERE reseller_code = '$seller_code'";
        $new_earnings_qry = mysqli_query($connect, $new_earnings);
        // earning 40% end

        // Level 2 %
        if ($reseller2_level == '2' || $reseller2_level == '3') {
            $getlevelper = "SELECT * FROM upti_level WHERE levels = '2'";
            $getlevelper_qry = mysqli_query($connect, $getlevelper);
            $get_percentage = mysqli_fetch_array($getlevelper_qry);

            $percentage = $get_percentage['percent'];

            $lvl2 = $amount  * $percentage;
            $lvl2_tax = $lvl2 * 0.05;
            $lvl2_earnings = $lvl2 - $lvl2_tax;
            $lvl2_remarks = 'You Received 2% Comission Product Worth of '.$price.' ['.$country.']';

            $lvl2_earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$reseller_2', '$poid', '$lvl2_earnings', '$lvl2_tax', '$lvl2_remarks', 'Level 2', '$seller_code')";
            $lvl2_earn_history_sql = mysqli_query($connect, $lvl2_earn_history);

            $lvl2_reseller_stmt = mysqli_query($connect, "SELECT reseller_earning FROM upti_reseller WHERE reseller_code = '$reseller_2'");
            $lvl2_reseller_f = mysqli_fetch_array($lvl2_reseller_stmt);

            $lvl2_reseller_earning = $lvl2_reseller_f['reseller_earning'];

            $lvl2_updated_earning = $lvl2_reseller_earning + $lvl2_earnings;

            $lvl2_new_earnings = "UPDATE upti_reseller SET reseller_earning = '$lvl2_updated_earning' WHERE reseller_code = '$reseller_2'";
            $lvl2_new_earnings_qry = mysqli_query($connect, $lvl2_new_earnings);
        }
        // Level 2 % end

        // Level 3 %
        if ($reseller3_level == '3') {
            $getlevelper = "SELECT * FROM upti_level WHERE levels = '3'";
            $getlevelper_qry = mysqli_query($connect, $getlevelper);
            $get_percentage = mysqli_fetch_array($getlevelper_qry);

            $percentage = $get_percentage['percent'];

            $lvl3 = $amount  * $percentage;
            $lvl3_tax = $lvl3 * 0.05;
            $lvl3_earnings = $lvl3 - $lvl3_tax;
            $lvl3_remarks = 'You Received 1% Comission Product Worth of '.$price.' ['.$country.']';

            $lvl3_earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$reseller_3', '$poid', '$lvl3_earnings', '$lvl3_tax', '$lvl3_remarks', 'Level 3', '$seller_code')";
            $lvl3_earn_history_sql = mysqli_query($connect, $lvl3_earn_history);

            $lvl3_reseller_stmt = mysqli_query($connect, "SELECT reseller_earning FROM upti_reseller WHERE reseller_code = '$reseller_3'");
            $lvl3_reseller_f = mysqli_fetch_array($lvl3_reseller_stmt);

            $lvl3_reseller_earning = $lvl3_reseller_f['reseller_earning'];

            $lvl3_updated_earning = $lvl3_reseller_earning + $lvl3_earnings;

            $lvl3_new_earnings = "UPDATE upti_reseller SET reseller_earning = '$lvl3_updated_earning' WHERE reseller_code = '$reseller_3'";
            $lvl3_new_earnings_qry = mysqli_query($connect, $lvl3_new_earnings);
        }
        // Level 3 % end
        
        if ($country == 'Canada' && $state == 'ALBERTA') {
            $order_list = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_ref = '$poid'");
          while ($order = mysqli_fetch_array($order_list)) {
            $item_code = $order['cart_code'];
            $item_qty = $order['cart_qty'];
            $item_php = $order['cart_earn'];
            $subtotal = $order['cart_subtotal'];
  
            $pack_stmt = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$item_code'");
            $pack = mysqli_fetch_array($pack_stmt);
            if (mysqli_num_rows($pack_stmt) > 0) {
              // package 1
              $_c1 = $pack['package_one_code'];
              $_q1 = $pack['package_one_qty'];
              // echo '<br>';
                // price
                $price_stmt = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$_c1'");
                $price_f = mysqli_fetch_array($price_stmt);
                $stockist_price = $price_f['country_stockist'];
  
              // package 2
              $_c2 = $pack['package_two_code'];
              $_q2 = $pack['package_two_qty'];
  
                // price
                $price_stmt2 = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$_c2'");
                $price_f2 = mysqli_fetch_array($price_stmt2);
                $stockist_price2 = $price_f2['country_stockist'];
  
              // package 3
              $_c3 = $pack['package_three_code'];
              $_q3 = $pack['package_three_qty'];
  
                // price
                $price_stmt3 = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$_c3'");
                $price_f3 = mysqli_fetch_array($price_stmt3);
                $stockist_price3 = $price_f3['country_stockist'];
  
              // package 4
              $_c4 = $pack['package_four_code'];
              $_q4 = $pack['package_four_qty'];
  
                // price
                $price_stmt4 = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$_c4'");
                $price_f4 = mysqli_fetch_array($price_stmt4);
                $stockist_price4 = $price_f4['country_stockist'];
  
              // package 5
              $_c5 = $pack['package_five_code'];
              $_q5 = $pack['package_five_qty'];
  
                // price
                $price_stmt5 = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$_c5'");
                $price_f5 = mysqli_fetch_array($price_stmt5);
                $stockist_price5 = $price_f5['country_stockist'];
  
                $n_q1 = $_q1 * $item_qty;
                $n_q2 = $_q2 * $item_qty;
                $n_q3 = $_q3 * $item_qty;
                $n_q4 = $_q4 * $item_qty;
                $n_q5 = $_q5 * $item_qty;
  
              $buy = ($stockist_price * $n_q1) + ($stockist_price2 * $n_q2) + ($stockist_price3 * $n_q3) + ($stockist_price4 * $n_q4) + ($stockist_price5 * $n_q5);
  
              $refund = $buy - $item_php;
              // echo '<br>';
  
              if ($_q1 > 0) {
                $desc1 = $_c1.' ['.$_q1.'] <br>';
              } else {
                $desc1 = '';
              }
  
              if ($_q2 > 0) {
                $desc2 = $_c2.' ['.$_q2.'] <br>';
              } else {
                $desc2 = '';
              }
  
              if ($_q3 > 0) {
                $desc3 = $_c3.' ['.$_q3.'] <br>';
              } else {
                $desc3 = '';
              }
  
              if ($_q4 > 0) {
                $desc4 = $_c4.' ['.$_q4.'] <br>';
              } else {
                $desc4 = '';
              }
  
              if ($_q5 > 0) {
                $desc5 = $_c5.' ['.$_q5.']';
              } else {
                $desc5 = '';
              }
  
              $desc = $desc1.$desc2.$desc3.$desc4.$desc5;
  
              $earning_list = mysqli_query($connect, "INSERT INTO stockist_earning (
                e_id,
                e_poid,
                e_code,
                e_desc,
                e_country,
                e_qty,
                e_price,
                e_subtotal,
                e_refund,
                e_date,
                e_time
              ) VALUES (
                '$stockist',
                '$poid',
                '$item_code',
                '$desc',
                '$country',
                '$item_qty',
                '$item_php',
                '$buy',
                '$refund',
                '$datenow',
                '$time'
              )");
  
              $stockist_w_stmt = mysqli_query($connect, "SELECT * FROM stockist_wallet WHERE w_id = '$stockist'");
              $stockist_w_f = mysqli_fetch_array($stockist_w_stmt);
  
              $stockist_wallet = $stockist_w_f['w_earning'] + $refund;
  
              $stockist_w = mysqli_query($connect, "UPDATE stockist_wallet SET w_earning = '$stockist_wallet' WHERE w_id = '$stockist'");
  
            } else {
              $single_stmt = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$item_code'");
              $single_f = mysqli_fetch_array($single_stmt);
  
              $single_code = $single_f['code_main'];
              $category = $single_f['code_category'];
              
              // price
              $single_qry = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$single_code'");
              $single_f = mysqli_fetch_array($single_qry);
  
              if ($category == 'NON-REBATABLE') {
                $stockist_price = $single_f['country_stockist'];
  
                $single_qry2 = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_name = 'PHILIPPINES' AND country_code = '$item_code'");
                $single_f2 = mysqli_fetch_array($single_qry2);
  
                $item_php = $single_f2['country_price'] * $item_qty;
              }
              
              $stockist_price = $single_f['country_stockist'];
  
              $buy = $stockist_price * $item_qty;
  
              $refund = $buy - $item_php;
  
              // echo '<br>';
  
              $earning_list = mysqli_query($connect, "INSERT INTO stockist_earning (
                e_id,
                e_poid,
                e_code,
                e_desc,
                e_country,
                e_qty,
                e_price,
                e_subtotal,
                e_refund,
                e_date,
                e_time
              ) VALUES (
                '$stockist',
                '$poid',
                '$item_code',
                '$single_code',
                '$country',
                '$item_qty',
                '$item_php',
                '$buy',
                '$refund',
                '$datenow',
                '$time'
              )");
  
              $stockist_w_stmt = mysqli_query($connect, "SELECT * FROM stockist_wallet WHERE w_id = '$stockist'");
              $stockist_w_f = mysqli_fetch_array($stockist_w_stmt);
  
              $stockist_wallet = $stockist_w_f['w_earning'] + $refund;
  
              $stockist_w = mysqli_query($connect, "UPDATE stockist_wallet SET w_earning = '$stockist_wallet' WHERE w_id = '$stockist'");
            }
          }
        }
    ?>
        <!-- <script>alert('Order Status has been changed to In Transit Successfully');window.location.href = '../poid-list2.php?id=<?php //echo $id ?>';</script> -->
    <?php
        }
    ?>