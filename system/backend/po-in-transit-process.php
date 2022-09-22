<?php

    session_start();
    include '../dbms/conn.php';
    include '../function.php';

    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    $id = $_GET['id'];

    $getcountry = "SELECT * FROM stockist_request WHERE id = '$id'";
    $getcountry_sql = mysqli_query($connect, $getcountry);
    $getcountry_fetch = mysqli_fetch_array($getcountry_sql);

    $country = $getcountry_fetch['req_from'];
    $state = $getcountry_fetch['req_state'];
    $ref = $getcountry_fetch['req_reference'];

    if (isset($_POST['tracking'])) {
        $track = $_POST['track'];
        $link = $_POST['link'];
        
        if ($_SESSION['role'] == 'UPTIACCOUNTING') {
            $update = "UPDATE stockist_request SET req_status = 'In Transit' , req_link = '$link', ref_checked = '$date', req_tracking = '$track' WHERE req_reference = '$id'";
        } else {
            $update = "UPDATE stockist_request SET req_status = 'In Transit' , req_link = '$link', ref_checked = '$date', req_tracking = '$track' WHERE id = '$id'";
        }
        $update_qry = mysqli_query($connect, $update);

        if ($_SESSION['role'] == 'UPTIMAIN') {
            flash("success", "Purchase Order has been successfully updated into In Transit");

            header('Location: ../stockist-requestpo.php');
        } elseif ($_SESSION['role'] == 'UPTIACCOUNTING') {
            flash("success", "Purchase Order has been successfully updated into In Transit");

            header('Location: ../stockist-orders.php');
        } else {
            flash("success", "Purchase Order has been successfully updated into In Transit");

            header('Location: ../dhl.php');
        }
    }

    if (isset($_POST['transfered'])) {
      // echo 'transfer';
      $update = "UPDATE stockist_request SET req_status = 'CND InTransit' WHERE id = '$id'";
      $update_qry = mysqli_query($connect, $update);

      $history = mysqli_query($connect, "INSERT INTO stockist_history (history_date, history_time, history_poid, history_status) VALUES ('$date', '$time', '$ref', 'Transfered')");

      flash("success", "Status has been changed to In Transit");

      header('Location: ../incoming-transfer-order.php');
    }

?>