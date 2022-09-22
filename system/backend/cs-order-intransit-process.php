<?php
    include '../dbms/conn.php';
    
    session_start();
    $uid = $_SESSION['uid'];

    $id = $_GET['id'];
    
    $get_poid = "SELECT * FROM web_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);
    
    $poid = $get_poid_fetch['trans_ref'];
    
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];

    if (isset($_POST['intransit'])) {
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');
        $track = $_POST['tracking'];
        
        $desc = $namex.' Update '.$poid.' set Ordered Status into In Transit';

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'In Transit', '$desc')";
        $act_qry = mysqli_query($connect, $act);

         // INVENTORY REPORT
        $inv_report = "UPDATE stockist_report SET rp_status = 'In Transit' WHERE rp_poid = '$poid'";
        $inv_report_qry = mysqli_query($connect, $inv_report);
        
        // INVENTORY HISTORY
        $inv_history = "UPDATE stockist_history SET history_status = 'In Transit' WHERE history_poid = '$poid'";
        $inv_history_qry = mysqli_query($connect, $inv_history);
        
        $epayment_process = "UPDATE web_transaction SET trans_status = 'In Transit', trans_tracking = '$track' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        $epayment_process1 = "UPDATE web_cart SET cart_status = 'In Transit' WHERE cart_ref = '$poid'";
        $epayment_process_qry1 = mysqli_query($connect, $epayment_process1);
        
        $remarks_sql2 = "INSERT INTO upti_remarks (remark_poid, remark_content, remark_name, remark_reseller) VALUES ('$poid', 'TRACKING NUMBER: $track', '$namex', 'Unread')";
        $remarks_qry2 = mysqli_query($connect, $remarks_sql2);
    ?>
        <script>alert('Order Status has been changed to In Transit Successfully');window.location.href = '../poid-list2.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>