<?php

    include '../dbms/conn.php';
    include '../function.php';

    session_start();

    $id = $_GET['id'];
    $role = $_SESSION['role'];

    $uid = $_SESSION['uid'];
    $uicode = $_SESSION['code'];
    date_default_timezone_set('Asia/Manila');
    $time = date("h:m:i");
    $datenow = date('m-d-Y');

    $get_poid = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);

    $poid = $get_poid_fetch['trans_poid'];
    $csid = $get_poid_fetch['trans_csid'];

    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);

    $namex = $getnamex_fetch['users_name'];
    $desc = $namex.' Update '.$poid.' set Ordered Status into Cancel';

    // HISTORY
    $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', $time', '$datenow', '$namex', 'Canceled', '$desc')";
    $act_qry = mysqli_query($connect, $act);

    // INVENTORY REPORT
    $inv_report = "UPDATE stockist_report SET rp_status = 'Canceled' WHERE rp_poid = '$poid'";
    $inv_report_qry = mysqli_query($connect, $inv_report);
    
    // INVENTORY HISTORY
    $inv_history = "UPDATE stockist_history SET history_status = 'Canceled' WHERE history_poid = '$poid'";
    $inv_history_qry = mysqli_query($connect, $inv_history);

    $update_stats = "UPDATE upti_transaction SET trans_status = 'Canceled' WHERE id = '$id'";
    $update_stats_qyr = mysqli_query($connect, $update_stats);

    $update_stats1 = "UPDATE upti_order_list SET ol_status = 'Canceled' WHERE ol_poid = '$poid'";
    $update_stats_qyr1 = mysqli_query($connect, $update_stats1);

    $remove_free = mysqli_query($connect, "SELECT * FROM upti_loyalty WHERE loyalty_code = '$csid'");
    $loyalty_fetch = mysqli_fetch_array($remove_free);
    if(mysqli_num_rows($remove_free) > 0) {
      $remain_loyalty = $loyalty_fetch['loyalty_number'] - 1;
      $removefreelist = mysqli_query($connect, "UPDATE upti_loyalty SET loyalty_number = '$remain_loyalty' WHERE loyalty_code = '$csid'");
    }

    flash("success", "Order Status has been changed to Cancel Successfully");

    $stockist = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$uicode'");
    if (mysqli_num_rows($stockist) > 0 || $role == 'BRANCH') {
        header('Location: ../poid-list.php?id='. $id.'');
    } else {
        header('Location: ../my-order.php');
    }
   
    
?>