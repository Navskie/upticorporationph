<?php
    include '../dbms/conn.php';

    session_start();

    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];

    $get_id_info = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $get_id_info_qry = mysqli_query($connect, $get_id_info);
    $get_info_fetch = mysqli_fetch_array($get_id_info_qry);

    $userID = $get_info_fetch['trans_seller'];
    $Country = $get_info_fetch['trans_country'];
    $poid = $get_info_fetch['trans_poid'];

    $users_sql = "SELECT * FROM upti_users WHERE users_code = '$userID'";
    $users_qry = mysqli_query($connect, $users_sql);
    $users = mysqli_fetch_array($users_qry);

    $role = $users['users_role'];

    if ($role == 'UPTIRESELLER') {
        $creator = $users['users_code'];
    } elseif ($role == 'UPTIOSR') {
        $creator = $users['users_creator'];
    }

    if (isset($_POST['rts'])) {
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');
        
        $desc = $namex.' Update '.$poid.' set Ordered Status into RTS';

        $reseller = "SELECT * FROM upti_reseller WHERE reseller_code = '$creator'";
        $reseller_sql = mysqli_query($connect, $reseller);
        $reseller_fetch = mysqli_fetch_array($reseller_sql);

        $remain_earnings = $reseller_fetch['reseller_earning'];

        if ($Country == 'CANADA' || $Country == 'JAPAN') {
            $RTS = 600;
        } else {
            $RTS = 200;
        }

        $update_earning = $remain_earnings - $RTS;

        $remarks = $RTS.'.00 from your earnings has been deducted  for your RTS order';

        $update_sql = "UPDATE upti_reseller SET reseller_earning = '$update_earning' WHERE reseller_code = '$creator'";
        $update_qry = mysqli_query($connect, $update_sql);

        $earn_history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_deduct, earning_tax, earning_remarks, earning_status, earning_name) VALUES ('$creator', '$poid', '$RTS', '', '$remarks', 'RTS Orders', '$userID')";
        $earn_history_sql = mysqli_query($connect, $earn_history);

        $epayment_process = "UPDATE upti_transaction SET trans_status = 'RTS', trans_stockist = 'Not Received' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);
        
        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'RTS', '$desc')";
        $act_qry = mysqli_query($connect, $act);
        
        // INVENTORY REPORT
        $inv_report = "UPDATE stockist_report SET rp_status = 'RTS' WHERE rp_poid = '$poid'";
        $inv_report_qry = mysqli_query($connect, $inv_report);
        
        // INVENTORY HISTORY
        $inv_history = "UPDATE stockist_history SET history_status = 'RTS' WHERE history_poid = '$poid'";
        $inv_history_qry = mysqli_query($connect, $inv_history);
        
        $ol_sql = "UPDATE upti_order_list SET ol_status = 'RTS' WHERE ol_poid = '$poid'";
        $ol_qry = mysqli_query($connect, $ol_sql);

    ?>
        <script>alert('Order Status has been changed to RTS Successfully');window.location.href = '../poid-list.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>