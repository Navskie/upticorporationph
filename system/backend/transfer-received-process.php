<?php

    session_start();
    include '../dbms/conn.php';
    include '../function.php';
    
    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    $id = $_GET['id'];
    $s_code = $_SESSION['code'];

    $get_info = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$s_code'");
    $get_info_fetch = mysqli_fetch_array($get_info);
    $s_country = $get_info_fetch['stockist_country'];
    $s_state = $get_info_fetch['stockist_state'];

    $getcountry = "SELECT * FROM stockist_request WHERE req_reference = '$id'";
    $getcountry_sql = mysqli_query($connect, $getcountry);
    $getcountry_fetch = mysqli_fetch_array($getcountry_sql);

    $country = $getcountry_fetch['req_from'];
    $state = $getcountry_fetch['req_state'];
    $ref = $getcountry_fetch['req_reference'];
    

    if (isset($_POST['receive_it'])) {
      

      $get_items = "SELECT * FROM stockist_po WHERE spo_ref = '$id'";
      $get_items_qry = mysqli_query($connect, $get_items);
      while ($get_items_fetch = mysqli_fetch_array($get_items_qry)) {
        $code = $get_items_fetch['spo_item_code'];
        // echo '<br>';
        $qty = $get_items_fetch['spo_item_qty'];

        $desc = $get_items_fetch['spo_item_desc'];

        $onehundred = $qty * 100;

        $transfer_stocks = mysqli_query($connect, "INSERT INTO stockist_inventory (
          si_code,
          si_item_code,
          si_item_desc,
          si_item_stock,
          si_item_date,
          si_item_added,
          si_item_country,
          si_item_state
        ) VALUES (
          '$s_code',
          '$code',
          '$desc',
          '$qty',
          '$date',
          '$time',
          '$s_country',
          '$s_state'
        )");

        $update = "UPDATE stockist_request SET req_status = 'CND Transfered' WHERE req_reference = '$id'";
        $update_qry = mysqli_query($connect, $update);

        $history = mysqli_query($connect, "INSERT INTO stockist_history (history_date, history_time, history_poid, history_status) VALUES ('$date', '$time', '$ref', 'Transfered')");

        $get_stockist = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_country = '$country' AND stockist_state = 'ALL' AND stockist_role = 'MAIN'");
        $get_stockist_f = mysqli_fetch_array($get_stockist);

        $main_stockist = $get_stockist_f['stockist_code'];

        $transfer_comission = mysqli_query($connect, "INSERT INTO stockist_earning (
          e_id,
          e_poid,
          e_code,
          e_country,
          e_subtotal,
          e_refund,
          e_status,
          e_date,
          e_time
        ) VALUES (
          '$main_stockist',
          '$ref',
          '$code',
          '$s_country',
          '$qty',
          '$onehundred',
          'P100',
          '$date',
          '$time'
        )");

        $get_stockist_money = mysqli_query($connect, "SELECT * FROM stockist_wallet WHERE w_id = '$main_stockist'");
        $get_stockist_money_f = mysqli_fetch_array($get_stockist_money);

        $remain_balance = $get_stockist_money_f['w_earning'] + $onehundred;

        $stockist_comission = mysqli_query($connect, "UPDATE stockist_wallet SET w_earning = '$remain_balance' WHERE w_id = '$main_stockist'");

        flash("success", "stock added successfully");

        header('Location: ../incoming-transfer-order.php');
      }

    }

?>