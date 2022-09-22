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

    if (isset($_POST['rts'])) {
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');

        $desc = $namex.' Update '.$poid.' set Ordered Status into RTS';

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'RTS', '$desc')";
        $act_qry = mysqli_query($connect, $act);

         // INVENTORY REPORT
        $inv_report = "UPDATE stockist_report SET rp_status = 'RTS' WHERE rp_poid = '$poid'";
        $inv_report_qry = mysqli_query($connect, $inv_report);
        
        // INVENTORY HISTORY
        $inv_history = "UPDATE stockist_history SET history_status = 'RTS' WHERE history_poid = '$poid'";
        $inv_history_qry = mysqli_query($connect, $inv_history);
        
        $epayment_process = "UPDATE web_transaction SET trans_status = 'RTS' WHERE trans_ref = '$poid'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        $epayment_process1 = "UPDATE web_cart SET cart_status = 'RTS' WHERE cart_ref = '$poid'";
        $epayment_process_qry1 = mysqli_query($connect, $epayment_process1);
        
    ?>
        <script>alert('Order Status has been changed to In Transit Successfully');window.location.href = '../poid-list2.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>