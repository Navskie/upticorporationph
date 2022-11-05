<?php
    include '../dbms/conn.php';
    
    session_start();
    $uid = $_SESSION['uid'];
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];

    $id = $_GET['id'];

    if (isset($_POST['delivered'])) {
        date_default_timezone_set('Asia/Manila'); 
        $time = date("h:i A");
        $datenow = date('m-d-Y');

        $transaction_history = "SELECT * FROM upti_transaction WHERE id = '$id'";
        $transaction_history_sql = mysqli_query($connect, $transaction_history);
        $transaction_fetch = mysqli_fetch_array($transaction_history_sql);

        $seller_id = $transaction_fetch['trans_seller'];
        $poid = $transaction_fetch['trans_poid'];
        $country = $transaction_fetch['trans_country']; 
        $state = $transaction_fetch['trans_state']; 
        $amount = $transaction_fetch['trans_subtotal'];
        $mod = $transaction_fetch['trans_mop'];
        $trans_date = $transaction_fetch['trans_date'];
        $trans_state = $transaction_fetch['trans_state'];
        $csid = $transaction_fetch['trans_csid'];

        // STOCKIST PERCENTAGE
        if ($country == 'CANADA') {
          if ($trans_state !== 'ALBERTA' || $trans_state === '') {
            $trans_state = 'ALL';
          }
        } else {
          $trans_state = 'ALL';
        }
        $stockist_stmt = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_country = '$country' AND stockist_state = '$trans_state'");
        $stockist_f = mysqli_fetch_array($stockist_stmt);
        $stockist = $stockist_f['stockist_code'];

        $april_date = '04-11-2022';

        // EARNINGS 
        $order_sql2 = "SELECT SUM(ol_php) AS EARN FROM upti_order_list WHERE ol_poid = '$poid'";
        $order_qry2 = mysqli_query($connect, $order_sql2);
        $order_fetch2 = mysqli_fetch_array($order_qry2);

        $ol_php = $order_fetch2['EARN'];

        // earnings
        $earning_sql = "SELECT * FROM upti_users WHERE users_code = '$seller_id'";
        $earning_qry = mysqli_query($connect, $earning_sql);
        $earning_fetch = mysqli_fetch_array($earning_qry);

        $get_creator1 = "SELECT * FROM upti_reseller WHERE reseller_poid = '$poid'";
        $get_creator_qry1 = mysqli_query($connect, $get_creator1);
        $get_creator_fetch1 = mysqli_fetch_array($get_creator_qry1);
        $get_creator_num = mysqli_num_rows($get_creator_qry1);

        if ($get_creator_num == 1) {
            $maycode = $get_creator_fetch1['reseller_code'];
        }
        // echo '<br>';
        // UPTIMAIN
        $users_creator = $earning_fetch['users_creator'];
        $users_role = $earning_fetch['users_role'];

        // echo '<br>';
        // RS515
        $users_code = $earning_fetch['users_code'];

        // if ($users_role == 'UPTIRESELLER') {
        //     echo $users_creator = $earning_fetch['users_code'];
        // }

        // POINTS
        $order_sql = "SELECT SUM(ol_points) AS PUNTOS FROM upti_order_list WHERE ol_poid = '$poid'";
        $order_qry = mysqli_query($connect, $order_sql);
        $order_fetch = mysqli_fetch_array($order_qry);

        $seller_points = $order_fetch['PUNTOS'];

        $seller_insert = "INSERT INTO upti_osr_points (op_name, op_reseller, op_poid, op_points, op_date) VALUES ('$seller_id', '$users_creator','$poid', '$seller_points', '$datenow')";
        $seller_insert_qry = mysqli_query($connect, $seller_insert);

        $get_like22 = "SELECT LEFT(users_code, 3) AS code FROM upti_users WHERE users_code = '$seller_id'";
        $get_like_qry22 = mysqli_query($connect, $get_like22);
        $get_like_fetch22 = mysqli_fetch_array($get_like_qry22);

        $osr_id = $get_like_fetch22['code'];
        $osr_id2 = $get_like_fetch22['code'];
        // echo '<br>';
        if($osr_id == 'OSR') {
            $seller_id = $users_creator;
            // echo '<br>';
        }
        $get_points_sql = "SELECT * FROM upti_reseller WHERE reseller_code = '$seller_id'";
        $get_points_qry = mysqli_query($connect, $get_points_sql);
        $get_reseller_fetch = mysqli_fetch_array($get_points_qry);

        $reseller_points = $get_reseller_fetch['reseller_points'];

        $new_points = $reseller_points + $seller_points;

        $update_reseller_points = "UPDATE upti_reseller SET reseller_points = '$new_points' WHERE reseller_code = '$seller_id'";
        $update_reseller_points_qry = mysqli_query($connect, $update_reseller_points);
        // ENDPOINTS
        
        $desc = $namex.' Approve '.$poid.' set Ordered Status into Delivered';

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'Order Delivered', '$desc')";
        $act_qry = mysqli_query($connect, $act);

        $code = "SELECT LEFT(users_code, 3) AS users FROM upti_users WHERE users_id = '$users_creator'";
        $code_qry = mysqli_query($connect, $code);
        $code_fetch = mysqli_fetch_array($code_qry);

        // USERS LEVEL
        $mylevel = "SELECT * FROM upti_users WHERE users_code = '$seller_id'";
        $mylevel_qry = mysqli_query($connect, $mylevel);
        $level_fetch = mysqli_fetch_array($mylevel_qry);
        // echo '<br>';

        $reseller1 = $level_fetch['users_creator'];
        // echo '<br>';
        $get_res_1 = "SELECT * FROM upti_users WHERE users_code = '$reseller1'";
        $get_res_1_qry = mysqli_query($connect, $get_res_1);
        $show_res = mysqli_fetch_array($get_res_1_qry);
        $level1 = $show_res['users_level'];

        $reseller2 = $show_res['users_creator'];
        // echo '<br>';
        $get_res_2 = "SELECT * FROM upti_users WHERE users_code = '$reseller2'";
        $get_res_2_qry = mysqli_query($connect, $get_res_2);
        $show_res2 = mysqli_fetch_array($get_res_2_qry);
        $level2 = $show_res2['users_level'];
        // echo '<br>';
        $reseller3 = $show_res2['users_creator'];
        $get_res_3 = "SELECT * FROM upti_users WHERE users_code = '$reseller3'";
        $get_res_3_qry = mysqli_query($connect, $get_res_3);
        $show_res3 = mysqli_fetch_array($get_res_3_qry);
        $level3 = $show_res3['users_level'];


        if ($users_role != 'UPTIOSR') {
            // SALES
            $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$users_code'";
            $get_creator_qry = mysqli_query($connect, $get_creator);
            $get_creator_fetch = mysqli_fetch_array($get_creator_qry);

            $remain_points = $get_creator_fetch['reseller_earning'];
            
            $get_like = "SELECT LEFT(trans_poid, 1) AS poids FROM upti_transaction WHERE id = '$id'";
            $get_like_qry = mysqli_query($connect, $get_like);
            $get_like_fetch = mysqli_fetch_array($get_like_qry);

            $POID_ID = $get_like_fetch['poids'];
            
            if ($POID_ID === 'R') {
                $tot_earn = $ol_php * 0.10;
                // echo '<br>';
                $tax = $tot_earn * 0.05;
                // echo '<br>';
                $sales_earnings = $tot_earn - $tax;
    
                $remarks = 'You Received 10% Comission Reseller Creation Worth of '.$amount.' ['.$country.']';
    
                $creator_earn = $remain_points + $sales_earnings;
    
                $update_earn = "UPDATE upti_reseller SET reseller_status = 'Approve' WHERE reseller_poid = '$poid'";
                $update_earn_qry = mysqli_query($connect, $update_earn);
    
                $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$users_code', '$poid', '$sales_earnings', '$tax', '$remarks', 'Sales', '$seller_id')";
                $earn_history_sql = mysqli_query($connect, $earn_history);

                $update_earn1 = "UPDATE upti_reseller SET reseller_earning = '$creator_earn' WHERE reseller_code = '$users_code'";
                $update_earn_qry1 = mysqli_query($connect, $update_earn1);

                $update_stats = "UPDATE upti_reseller SET reseller_status = 'Approve' WHERE id = '$users_code'";
                $update_stats_qyr = mysqli_query($connect, $update_stats);
                
                $login_sql = "UPDATE upti_users SET users_status = 'Active' WHERE users_code = '$maycode'";
                $login_qry = mysqli_query($connect, $login_sql);
                // end earnings

                // added stockist percentage
                $percent = $ol_php * 0.05;

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
                  'Reseller Package Order'
                )");

            } elseif ($POID_ID === 'P') {
                if($trans_date <= $april_date) {
                    $tot_earn = $ol_php * 0.30;
                } else {
                    $tot_earn = $ol_php * 0.40;
                }
                // echo $tot_earn;
                // echo '<br>';
                $tax = $tot_earn * 0.05;
                // echo '<br>';
                $sales_earnings = $tot_earn - $tax;
    
                if($trans_date <= $april_date) {
                    $remarks = 'You Received 30% Comission Product Worth of '.$amount.' ['.$country.']';
                } else {
                    $remarks = 'You Received 40% Comission Product Worth of '.$amount.' ['.$country.']';
                }
                
                $creator_earn = $remain_points + $sales_earnings;
                // echo '<br>';
                $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn' WHERE reseller_code = '$users_code'";
                $update_earn_qry = mysqli_query($connect, $update_earn);
                // echo '<br>';
                $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$users_code', '$poid', '$sales_earnings', '$tax', '$remarks', 'Sales', '$seller_id')";
                $earn_history_sql = mysqli_query($connect, $earn_history);
                // end earnings
                // echo '<br>';

                // added stockist percentage
                $percent = $ol_php * 0.03;

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
                  '$stockist',
                  '$percent',
                  '$remarks_wallet',
                  '$time',
                  '$datenow',
                  'Regular Order'
                )");

                if ($users_creator != 'UPTIMAIN') {
                    // echo '<br>';
                // SALES
                $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$users_creator'";
                $get_creator_qry = mysqli_query($connect, $get_creator);
                $get_creator_fetch = mysqli_fetch_array($get_creator_qry);
                    // echo '<br>';
                $remain_points = $get_creator_fetch['reseller_earning'];

                $tot_earn = $ol_php * 0.02;

                // echo '<br>';
                $tax = $tot_earn * 0.05;
                // echo '<br>';
                $sales_earnings = $tot_earn - $tax;

                $remarks = 'You Received 0.02% Comission Reseller Sales Worth of '.$amount.' ['.$country.']';

                $creator_earn = $remain_points + $sales_earnings;
                // echo '<br>';
                $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn', reseller_status = 'Delivered' WHERE reseller_code = '$users_creator'";
                $update_earn_qry = mysqli_query($connect, $update_earn);
                // echo '<br>';
                $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$users_creator', '$poid', '$sales_earnings', '$tax', '$remarks', 'Sales', '$seller_id')";
                $earn_history_sql = mysqli_query($connect, $earn_history);
                // end earnings

                    // level 2
                    if ($level2 == '2' || $level2 == '3' && $reseller2 != 'UPTIMAIN') {
                        // echo '<br>';
                        $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller2'";
                        $get_creator_qry = mysqli_query($connect, $get_creator);
                        $get_creator_fetch = mysqli_fetch_array($get_creator_qry);

                        $remain_points = $get_creator_fetch['reseller_earning'];

                        $getlevelper = "SELECT * FROM upti_level WHERE levels = '$level2'";
                        $getlevelper_qry = mysqli_query($connect, $getlevelper);
                        $get_percentage = mysqli_fetch_array($getlevelper_qry);

                        $percentage = $get_percentage['percent'];

                        $tot_earn = $ol_php * $percentage;

                        // echo '<br>';
                        $tax = $tot_earn * 0.05;
                        // echo '<br>';
                        $sales_earnings = $tot_earn - $tax;

                        $remarks = 'You Received '.$percentage.'% Comission Reseller Sales Worth of '.$amount.' ['.$country.']';

                        $creator_earn = $remain_points + $sales_earnings;
                        // echo '<br>';
                        $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn', reseller_status = 'Delivered' WHERE reseller_code = '$reseller2'";
                        $update_earn_qry = mysqli_query($connect, $update_earn);
                        // echo '<br>';
                        $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$reseller2', '$poid', '$sales_earnings', '$tax', '$remarks', 'Level 2', '$seller_id')";
                        $earn_history_sql = mysqli_query($connect, $earn_history);
                        // end earnings

                    }

                    // level 3
                    if ($level3 == '3' && $reseller3 != 'UPTIMAIN') {
                        // echo '<br>';
                        $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller3'";
                        $get_creator_qry = mysqli_query($connect, $get_creator);
                        $get_creator_fetch = mysqli_fetch_array($get_creator_qry);

                        $remain_points = $get_creator_fetch['reseller_earning'];

                        $getlevelper = "SELECT * FROM upti_level WHERE levels = '$level3'";
                        $getlevelper_qry = mysqli_query($connect, $getlevelper);
                        $get_percentage = mysqli_fetch_array($getlevelper_qry);

                        $percentage = $get_percentage['percent'];

                        $tot_earn = $ol_php * $percentage;

                        $tax = $tot_earn * 0.05;
                        // echo '<br>';
                        $sales_earnings = $tot_earn - $tax;

                        $remarks = 'You Received '.$percentage.'% Comission Reseller Sales Worth of '.$amount.' ['.$country.']';

                        $creator_earn = $remain_points + $sales_earnings;
                        // echo '<br>';
                        $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn', reseller_status = 'Delivered' WHERE reseller_code = '$reseller3'";
                        $update_earn_qry = mysqli_query($connect, $update_earn);
                        // echo '<br>';
                        $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$reseller3', '$poid', '$sales_earnings', '$tax', '$remarks', 'Level 3', '$seller_id')";
                        $earn_history_sql = mysqli_query($connect, $earn_history);
                        // end earnings

                    }

            }
        }

        } else {
            // SALES
            $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$users_creator'";
            $get_creator_qry = mysqli_query($connect, $get_creator);
            $get_creator_fetch = mysqli_fetch_array($get_creator_qry);

            $remain_points = $get_creator_fetch['reseller_earning'];
            
            $get_like = "SELECT LEFT(trans_poid, 1) AS poids FROM upti_transaction WHERE id = '$id'";
            $get_like_qry = mysqli_query($connect, $get_like);
            $get_like_fetch = mysqli_fetch_array($get_like_qry);

            $POID_ID = $get_like_fetch['poids'];
            
            if ($POID_ID == 'R') {
                $tot_earn = $ol_php * 0.10;
                // echo '<br>';
                $tax = $tot_earn * 0.05;
                // echo '<br>';
                $sales_earnings = $tot_earn - $tax;
    
                $remarks = 'You Received 10% Comission Reseller Creation Worth of '.$amount.' ['.$country.']';
    
                $creator_earn = $remain_points + $sales_earnings;
    
                $update_earn = "UPDATE upti_reseller SET reseller_status = 'Approved' WHERE reseller_poid = '$poid'";
                $update_earn_qry = mysqli_query($connect, $update_earn);
                
                $login_sql = "UPDATE upti_users SET users_status = 'Active' WHERE users_code = '$maycode'";
                $login_qry = mysqli_query($connect, $login_sql);

                $update_earn1 = "UPDATE upti_reseller SET reseller_earning = '$creator_earn' WHERE reseller_code = '$users_code'";
                $update_earn_qry1 = mysqli_query($connect, $update_earn1);
    
                $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$users_code', '$poid', '$sales_earnings', '$tax', '$remarks', 'Sales', '$seller_id')";
                $earn_history_sql = mysqli_query($connect, $earn_history);

                // added stockist percentage
                $percent = $ol_php * 0.05;

                $stockist_wallet = "SELECT * FROM stockist_wallet WHERE w_id = '$stockist'";
                $stockist_wallet_qry = mysqli_query($connect, $stockist_wallet);
                $stockist_balance = mysqli_fetch_array($stockist_wallet_qry);

                $s_wallet = $stockist_balance['w_earning'] + $percent;

                $update_stockist_wallet = mysqli_query($connect, "UPDATE stockist_wallet SET w_earning = '$s_wallet' WHERE w_id = '$stockist'");

                $remarks_wallet = "Stockist Percentage for POID ".$poid." amount of ".$tax;

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
                  '$stockist',
                  '$percent',
                  '$remarks_wallet',
                  '$time',
                  '$datenow',
                  'Reseller Package Order'
                )");
                // end earnings
            } elseif ($POID_ID == 'P') {
                if($trans_date <= $april_date) {
                    $tot_earn = $ol_php * 0.30;
                } else {
                    $tot_earn = $ol_php * 0.40;
                }
                // echo '<br>';
                $tax = $tot_earn * 0.05;
                // echo '<br>';
                $sales_earnings = $tot_earn - $tax;
                // echo '<br>';
                if($trans_date <= $april_date) {
                    $remarks = 'You Received 30% Comission Product Worth of '.$amount.' ['.$country.']';
                } else {
                    $remarks = 'You Received 40% Comission Product Worth of '.$amount.' ['.$country.']';
                }
                // echo '<br>';
                $creator_earn = $remain_points + $sales_earnings;
                // echo '<br>';
                $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn' WHERE reseller_code = '$users_creator'";
                $update_earn_qry = mysqli_query($connect, $update_earn);
                // echo '<br>';
                $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$users_creator', '$poid', '$sales_earnings', '$tax', '$remarks', 'OSR Sales', '$seller_id')";
                $earn_history_sql = mysqli_query($connect, $earn_history);
                // end earnings
    
                $earning_sql2 = "SELECT * FROM upti_users WHERE users_code = '$users_creator'";
                $earning_qry2 = mysqli_query($connect, $earning_sql2);
                $earning_fetch2 = mysqli_fetch_array($earning_qry2);
    
                $mycreator = $earning_fetch2['users_creator'];

                // added stockist percentage
                $percent = $ol_php * 0.03;

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
                  '$stockist',
                  '$percent',
                  '$remarks_wallet',
                  '$time',
                  '$datenow',
                  'Regular Order'
                )");
    
                if ($mycreator != 'UPTIMAIN') {
    
                    // SALES
                    $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$mycreator'";
                    $get_creator_qry = mysqli_query($connect, $get_creator);
                    $get_creator_fetch = mysqli_fetch_array($get_creator_qry);
    
                    $remain_points = $get_creator_fetch['reseller_earning'];
    
                    $tot_earn = $ol_php * 0.02;
                    // echo '<br>';
                    $tax = $tot_earn * 0.05;
                    // echo '<br>';
                    $sales_earnings = $tot_earn - $tax;
    
                    $remarks = 'You Received 0.02% Comission Reseller Sales Worth of '.$amount.' ['.$country.']';
    
                    $creator_earn = $remain_points + $sales_earnings;
                    // echo '<br>';
                    $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn' WHERE reseller_code = '$mycreator'";
                    $update_earn_qry = mysqli_query($connect, $update_earn);
    
                    $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$mycreator', '$poid', '$sales_earnings', '$tax', '$remarks', 'OSR Sales', '$seller_id')";
                    $earn_history_sql = mysqli_query($connect, $earn_history);
                    // end earnings
                }
                // level 2
                if ($level2 == '2' || $level2 == '3' && $reseller2 != 'UPTIMAIN') {
                    // echo '<br>';
                    $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller2'";
                    $get_creator_qry = mysqli_query($connect, $get_creator);
                    $get_creator_fetch = mysqli_fetch_array($get_creator_qry);

                    $remain_points = $get_creator_fetch['reseller_earning'];

                    $getlevelper = "SELECT * FROM upti_level WHERE levels = '$level2'";
                    $getlevelper_qry = mysqli_query($connect, $getlevelper);
                    $get_percentage = mysqli_fetch_array($getlevelper_qry);

                    $percentage = $get_percentage['percent'];

                    $tot_earn = $ol_php * $percentage;

                    // echo '<br>';
                    $tax = $tot_earn * 0.05;
                    // echo '<br>';
                    $sales_earnings = $tot_earn - $tax;

                    $remarks = 'You Received '.$percentage.'% Comission Reseller Sales Worth of '.$amount.' ['.$country.']';

                    $creator_earn = $remain_points + $sales_earnings;
                    // echo '<br>';
                    $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn', reseller_status = 'Delivered' WHERE reseller_code = '$reseller2'";
                    $update_earn_qry = mysqli_query($connect, $update_earn);
                    // echo '<br>';
                    $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$reseller2', '$poid', '$sales_earnings', '$tax', '$remarks', 'Level 2', '$seller_id')";
                    $earn_history_sql = mysqli_query($connect, $earn_history);
                    // end earnings

                }

                // level 3
                if ($level3 == '3' && $reseller3 != 'UPTIMAIN') {
                    // echo '<br>';
                    $get_creator = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller3'";
                    $get_creator_qry = mysqli_query($connect, $get_creator);
                    $get_creator_fetch = mysqli_fetch_array($get_creator_qry);

                    $remain_points = $get_creator_fetch['reseller_earning'];

                    $getlevelper = "SELECT * FROM upti_level WHERE levels = '$level3'";
                    $getlevelper_qry = mysqli_query($connect, $getlevelper);
                    $get_percentage = mysqli_fetch_array($getlevelper_qry);

                    $percentage = $get_percentage['percent'];

                    $tot_earn = $ol_php * $percentage;

                    $tax = $tot_earn * 0.05;
                    // echo '<br>';
                    $sales_earnings = $tot_earn - $tax;

                    $remarks = 'You Received '.$percentage.'% Comission Reseller Sales Worth of '.$amount.' ['.$country.']';

                    $creator_earn = $remain_points + $sales_earnings;
                    // echo '<br>';
                    $update_earn = "UPDATE upti_reseller SET reseller_earning = '$creator_earn', reseller_status = 'Delivered' WHERE reseller_code = '$reseller3'";
                    $update_earn_qry = mysqli_query($connect, $update_earn);
                    // echo '<br>';
                    $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$reseller3', '$poid', '$sales_earnings', '$tax', '$remarks', 'Level 3', '$seller_id')";
                    $earn_history_sql = mysqli_query($connect, $earn_history);
                    // end earnings

                }
            }
        }

        if ($country == 'OMAN') {
            $country = 'UNITED ARAB EMIRATES';
        } elseif ($country == 'KUWAIT') {
            $country = 'UNITED ARAB EMIRATES';
        } elseif ($country == 'QATAR') {
            $country = 'UNITED ARAB EMIRATES';
        } elseif ($country == 'BAHRAIN') {
            $country = 'UNITED ARAB EMIRATES';
        }

        if ($mod == 'Cash On Pick Up') {
            // Inventory Check Qty
            $get_qty_code = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid'";
            $get_qty_code_qry = mysqli_query($connect, $get_qty_code);
            while ($get_qty_code_fetch = mysqli_fetch_array($get_qty_code_qry)) {
                $code_code = $get_qty_code_fetch['ol_code'];
                $code_qty = $get_qty_code_fetch['ol_qty'];

                // COP Deduction
                $check_package = "SELECT * FROM upti_package WHERE package_code = '$code_code'";
                $check_package_sql = mysqli_query($connect, $check_package);
                $check_package_num = mysqli_num_rows($check_package_sql);
                $check_package_fetch = mysqli_fetch_array($check_package_sql);
                
                if ($check_package_num > 0) {
                    // 1
                    $c1 = $check_package_fetch['package_one_code'];
                    $oq1 = $check_package_fetch['package_one_qty'];
                    $q1 = $oq1 * $code_qty;

                    $inv_stock = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$c1' AND si_item_state = '$state'";
                    $inv_stock_qry = mysqli_query($connect, $inv_stock);
                    $inv_stock_fetch = mysqli_fetch_array($inv_stock_qry);

                    $total_stock = $inv_stock_fetch['si_item_stock'];

                    if ($total_stock != 0) {
                        $new_total_stock = $total_stock - $q1;

                        $update_inventory = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock' WHERE si_item_country = '$country' AND si_item_code = '$c1' AND si_item_state = '$state'";
                        $update_inventory_qry = mysqli_query($connect, $update_inventory);
                    }

                    // 2
                    $c2 = $check_package_fetch['package_two_code'];
                    $oq2 = $check_package_fetch['package_two_qty'];
                    $q2 = $oq2 * $code_qty;

                    $inv_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$c2' AND si_item_state = '$state'";
                    $inv_stock_qry2 = mysqli_query($connect, $inv_stock2);
                    $inv_stock_fetch2 = mysqli_fetch_array($inv_stock_qry2);

                    $total_stock2 = $inv_stock_fetch2['si_item_stock'];

                    if ($total_stock2 != 0) {
                        $new_total_stock2 = $total_stock2 - $q2;

                        $update_inventory2 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock2' WHERE si_item_country = '$country' AND si_item_code = '$c2' AND si_item_state = '$state'";
                        $update_inventory_qry2 = mysqli_query($connect, $update_inventory2);
                    }

                    // 3
                    $c3 = $check_package_fetch['package_three_code'];
                    $oq3 = $check_package_fetch['package_three_qty'];
                    $q3 = $oq3 * $code_qty;

                    $inv_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$c3' AND si_item_state = '$state'";
                    $inv_stock_qry3 = mysqli_query($connect, $inv_stock3);
                    $inv_stock_fetch3 = mysqli_fetch_array($inv_stock_qry3);

                    $total_stock3 = $inv_stock_fetch3['si_item_stock'];

                    if ($total_stock3 != 0) {
                        $new_total_stock3 = $total_stock3 - $q3;

                        $update_inventory3 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock3' WHERE si_item_country = '$country' AND si_item_code = '$c3' AND si_item_state = '$state'";
                        $update_inventory_qry3 = mysqli_query($connect, $update_inventory3);
                    }

                    // 4
                    $c4 = $check_package_fetch['package_four_code'];
                    $oq4 = $check_package_fetch['package_four_qty'];
                    $q4 = $oq4 * $code_qty;

                    $inv_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$c4' AND si_item_state = '$state'";
                    $inv_stock_qry4 = mysqli_query($connect, $inv_stock4);
                    $inv_stock_fetch4 = mysqli_fetch_array($inv_stock_qry4);

                    $total_stock4 = $inv_stock_fetch4['si_item_stock'];

                    if ($total_stock4 != 0) {
                        $new_total_stock4 = $total_stock4 - $q4;

                        $update_inventory4 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock4' WHERE si_item_country = '$country' AND si_item_code = '$c4' AND si_item_state = '$state'";
                        $update_inventory_qry4 = mysqli_query($connect, $update_inventory4);
                    }

                    // 5
                    $c5 = $check_package_fetch['package_five_code'];
                    $oq5 = $check_package_fetch['package_five_qty'];
                    $q5 = $oq5 * $code_qty;

                    $inv_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$c5' AND si_item_state = '$state'";
                    $inv_stock_qry5 = mysqli_query($connect, $inv_stock5);
                    $inv_stock_fetch5 = mysqli_fetch_array($inv_stock_qry5);

                    $total_stock5 = $inv_stock_fetch5['si_item_stock'];

                    if($total_stock5 != 0) {
                        $new_total_stock5 = $total_stock5 - $q5;

                        $update_inventory5 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock5' WHERE si_item_country = '$country' AND si_item_code = '$c5' AND si_item_state = '$state'";
                        $update_inventory_qry5 = mysqli_query($connect, $update_inventory5);
                    }
                } else {
                    // get new code
                    $get_new_code = "SELECT * FROM upti_code WHERE code_name = '$code_code'";
                    $get_new_code_qry = mysqli_query($connect, $get_new_code);
                    $get_new_code_fetch = mysqli_fetch_array($get_new_code_qry);

                    $code_codes = $get_new_code_fetch['code_main'];

                    $inv_stock = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$code_codes' AND si_item_state = '$state'";
                    $inv_stock_qry = mysqli_query($connect, $inv_stock);
                    $inv_stock_fetch = mysqli_fetch_array($inv_stock_qry);

                    $total_stock = $inv_stock_fetch['si_item_stock'];

                    $new_total_stock = $total_stock - $code_qty;

                    $update_inventory = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock' WHERE si_item_country = '$country' AND si_item_code = '$code_codes' AND si_item_state = '$state'";
                    $update_inventory_qry = mysqli_query($connect, $update_inventory);
                }
            }
        }

        // INVENTORY HISTORY
        $inv_history = "UPDATE stockist_history SET history_status = 'Delivered' WHERE history_poid = '$poid'";
        $inv_history_qry = mysqli_query($connect, $inv_history);
        
        // INVENTORY REPORT
        $inv_report = "UPDATE stockist_report SET rp_status = 'Delivered' WHERE rp_poid = '$poid'";
        $inv_report_qry = mysqli_query($connect, $inv_report);

        $epayment_process = "UPDATE upti_transaction SET trans_status = 'Delivered' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);
        
        $ol_sql = "UPDATE upti_order_list SET ol_status = 'Delivered' WHERE ol_poid = '$poid'";
        $ol_qry = mysqli_query($connect, $ol_sql);

        $account_process = mysqli_query($connect, "UPDATE upti_users SET users_status = 'Active' WHERE users_poid = '$poid'");
        
        $loyalty_stmt = mysqli_query($connect, "SELECT * FROM upti_loyalty WHERE loyalty_code = '$csid'");
        $fetching_loyalty = mysqli_fetch_array($loyalty_stmt);
        if (mysqli_num_rows($loyalty_stmt) > 0) {
          $number_of_loyalty = $fetching_loyalty['loyalty_number'] + 1;
          $update_loyalty = mysqli_query($connect, "UPDATE upti_loyalty SET loyalty_number = '$number_of_loyalty' WHERE loyalty_code = '$csid'");
        } else {
          $add_loyalty = mysqli_query($connect, "INSERT INTO upti_loyalty (loyalty_code, loyalty_number) VALUES ('$csid', '1')");
        }

        $check_boga_sql =  "SELECT * FROM upti_code INNER JOIN upti_order_list ON ol_code = code_name WHERE code_category = 'LOYALTY' AND ol_poid = '$poid'";
        $check_boga = mysqli_query($connect, $check_boga_sql);

        if (mysqli_num_rows($check_boga) > 0) {
          $update_loyalty = mysqli_query($connect, "UPDATE upti_loyalty SET loyalty_number = '0' WHERE loyalty_code = '$csid'");
        }
        // stockist commision
        
        if ($country == 'CANADA' && $state == 'ALBERTA') {
          $order_list = mysqli_query($connect, "SELECT * FROM upti_order_list WHERE ol_poid = '$poid'");
        while ($order = mysqli_fetch_array($order_list)) {
          $item_code = $order['ol_code'];
          $item_qty = $order['ol_qty'];
          $item_php = $order['ol_php'];
          $subtotal = $order['ol_subtotal'];

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


        // stockist end
        }
?>
    <script>alert('Order Status has been changed to Delivered Successfully');window.location.href = '../poid-list.php?id=<?php echo $id ?>';</script>
<?php
    }
?>