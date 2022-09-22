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
        
    ?>
        <script>alert('Order Status has been changed to In Transit Successfully');window.location.href = '../poid-list2.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>