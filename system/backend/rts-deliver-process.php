<?php
    include '../dbms/conn.php';

    session_start();
    $uid = $_SESSION['uid'];

    $id = $_GET['id'];
    
    $get_poid = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);
    
    $poid = $get_poid_fetch['trans_poid'];
    
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);

    $namex = $getnamex_fetch['users_name'];

    if (isset($_POST['convert'])) {
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');

        // EARNING BACK
        $info_sql = mysqli_query($connect, "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'");
        $info_fetch = mysqli_fetch_array($info_sql);
 
        $seller = $info_fetch['trans_seller'];

        $get_level_1 = "SELECT * FROM upti_users WHERE users_code = '$seller'";
        $get_level_1_qry = mysqli_query($connect, $get_level_1);
        $get_level_1_fetch = mysqli_fetch_array($get_level_1_qry);

        $seller_role = $get_level_1_fetch['users_role'];

        $sum_sql = mysqli_query($connect, "SELECT SUM(ol_php) AS php FROM upti_order_list WHERE ol_poid = '$poid'");
        $sum_fetch = mysqli_fetch_array($sum_sql);

        $php = $sum_fetch['php'];

        if($seller_role == 'UPTIRESELLER') {
            $seller_level = $get_level_1_fetch['users_level'];
            $level_1_code = $get_level_1_fetch['users_code'];

            // if ($seller_level == 1) {
                // 35%
                $earning = $php * 0.35;
                // echo '<br>';
                $get_reseller_earning = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_1_code'");
                $get_reseller_earning_fetch = mysqli_fetch_array($get_reseller_earning);

                $level_1_earning = $get_reseller_earning_fetch['reseller_earning'];
                // echo '<br>';
                $new_earnings = $level_1_earning - $earning - 200;

                $update_earning = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings' WHERE reseller_code = '$level_1_code'");
            // } elseif ($seller_level == 2) {
            //     // 35%
            //     $earning = $php * 0.35;
            //     // echo '<br>';
            //     $get_reseller_earning = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_1_code'");
            //     $get_reseller_earning_fetch = mysqli_fetch_array($get_reseller_earning);

            //     $level_1_earning = $get_reseller_earning_fetch['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings = $level_1_earning - $earning - 200;

            //     $update_earning = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings' WHERE reseller_code = '$level_1_code'");

            //     // LEVEL 2

            //     $get_level_2 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$level_1_code'");
            //     $get_level_2_fetch = mysqli_fetch_array($get_level_2);

            //     $level_2_code = $get_level_2_fetch['users_main'];

            //     // 35%
            //     $earning_2 = $php * 0.02;
            //     // echo '<br>';
            //     $get_reseller_earning2 = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_2_code'");
            //     $get_reseller_earning_fetch2 = mysqli_fetch_array($get_reseller_earning2);

            //     $level_2_earning = $get_reseller_earning_fetch2['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings2 = $level_2_earning - $earning_2;

            //     $update_earning2 = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings2' WHERE reseller_code = '$level_2_code'");

            //     // LEVEL 3

            //     $get_level_3 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$level_2_code'");
            //     $get_level_3_fetch = mysqli_fetch_array($get_level_3);

            //     $level_3_code = $get_level_3_fetch['users_main'];

            //     // 35%
            //     $earning_3 = $php * 0.02;
            //     // echo '<br>';
            //     $get_reseller_earning3 = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_3_code'");
            //     $get_reseller_earning_fetch3 = mysqli_fetch_array($get_reseller_earning3);

            //     $level_3_earning = $get_reseller_earning_fetch3['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings3 = $level_3_earning - $earning_3;

            //     $update_earning3 = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings3' WHERE reseller_code = '$level_3_code'");

            // } elseif ($seller_level == 3) {
            //     // 35%
            //     $earning = $php * 0.35;
            //     // echo '<br>';
            //     $get_reseller_earning = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_1_code'");
            //     $get_reseller_earning_fetch = mysqli_fetch_array($get_reseller_earning);

            //     $level_1_earning = $get_reseller_earning_fetch['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings = $level_1_earning - $earning - 200;

            //     $update_earning = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings' WHERE reseller_code = '$level_1_code'");

            //     // LEVEL 2

            //     $get_level_2 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$level_1_code'");
            //     $get_level_2_fetch = mysqli_fetch_array($get_level_2);

            //     $level_2_code = $get_level_2_fetch['users_main'];

            //     // 35%
            //     $earning_2 = $php * 0.02;
            //     // echo '<br>';
            //     $get_reseller_earning2 = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_2_code'");
            //     $get_reseller_earning_fetch2 = mysqli_fetch_array($get_reseller_earning2);

            //     $level_2_earning = $get_reseller_earning_fetch2['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings2 = $level_2_earning - $earning_2;

            //     $update_earning2 = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings2' WHERE reseller_code = '$level_2_code'");

            //     // LEVEL 3

            //     $get_level_3 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$level_2_code'");
            //     $get_level_3_fetch = mysqli_fetch_array($get_level_3);

            //     $level_3_code = $get_level_3_fetch['users_main'];

            //     // 35%
            //     $earning_3 = $php * 0.02;
            //     // echo '<br>';
            //     $get_reseller_earning3 = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_3_code'");
            //     $get_reseller_earning_fetch3 = mysqli_fetch_array($get_reseller_earning3);

            //     $level_3_earning = $get_reseller_earning_fetch3['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings3 = $level_3_earning - $earning_3;

            //     $update_earning3 = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings3' WHERE reseller_code = '$level_3_code'");

            //     // LEVEL 4

            //     $get_level_4 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$level_4_code'");
            //     $get_level_4_fetch = mysqli_fetch_array($get_level_4);

            //     $level_4_code = $get_level_4_fetch['users_main'];

            //     // 35%
            //     $earning_4 = $php * 0.01;
            //     // echo '<br>';
            //     $get_reseller_earning4 = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_4_code'");
            //     $get_reseller_earning_fetch4 = mysqli_fetch_array($get_reseller_earning4);

            //     $level_4_earning = $get_reseller_earning_fetch4['reseller_earning'];
            //     // echo '<br>';
            //     $new_earnings4 = $level_4_earning - $earning_4;

            //     $update_earning4 = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings4' WHERE reseller_code = '$level_4_code'");
            // }
        } else {
            $seller_level = $get_level_1_fetch['users_level'];
            $level_osr_code = $get_level_1_fetch['users_code'];

            $get_osr_main = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$level_osr_code'");
            $get_osr_main_fetch = mysqli_fetch_array($get_osr_main);

            $level_1_code = $get_osr_main_fetch['users_main'];

            // if ($seller_level == 1) {
                // 35%
                $earning = $php * 0.35;
                // echo '<br>';
                $get_reseller_earning = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$level_1_code'");
                $get_reseller_earning_fetch = mysqli_fetch_array($get_reseller_earning);

                $level_1_earning = $get_reseller_earning_fetch['reseller_earning'];
                // echo '<br>';
                $new_earnings = $level_1_earning - $earning - 200;

                $update_earning = mysqli_query($connect, "UPDATE upti_reseller SET reseller_earning = '$new_earnings' WHERE reseller_code = '$level_1_code'");
            // } elseif ($seller_level == 2) {
        }
        // EARNINGS BACK
        
        $desc = $namex.' Convert '.$poid.' set Ordered Status into RTS'; 

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'Deliver to RTS', '$desc')";
        $act_qry = mysqli_query($connect, $act);

        $epayment_process = "UPDATE upti_transaction SET trans_status = 'RTS', trans_stockist = 'Not Received' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        $epayment_process1 = "UPDATE upti_order_list SET ol_status = 'RTS' WHERE poid = '$poid'";
        $epayment_process_qry1 = mysqli_query($connect, $epayment_process1);

    ?>
        <script>alert('Order Status has been convert to RTS Successfully');window.location.href = '../poid-list.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>