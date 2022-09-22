<?php

    session_start();
    include '../dbms/conn.php';
    include '../function.php';
    
    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    $id = $_GET['id'];

    $getcountry = "SELECT * FROM stockist_request WHERE req_reference = '$id'";
    $getcountry_sql = mysqli_query($connect, $getcountry);
    $getcountry_fetch = mysqli_fetch_array($getcountry_sql);

    $country = $getcountry_fetch['req_from'];
    $state = $getcountry_fetch['req_state'];
    $ref = $getcountry_fetch['req_reference'];

    if (isset($_POST['submit'])) {
        $length = $_POST['length'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        
        if ($country != 'KOREA') {
            $get_items = "SELECT * FROM stockist_po WHERE spo_ref = '$id'";
            $get_items_qry = mysqli_query($connect, $get_items);
            while ($get_items_fetch = mysqli_fetch_array($get_items_qry)) {
                
                $code = $get_items_fetch['spo_item_code'];
                $qty = $get_items_fetch['spo_item_qty'];
                
                $warehouse = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$code'";
                $warehouse_qry = mysqli_query($connect, $warehouse);
                $warehouse_fetch = mysqli_fetch_array($warehouse_qry);
                
                $remain_stock = $warehouse_fetch['si_item_stock'];
    
                $warehoouse_stock = $remain_stock - $qty;
    
                $warehouse_update = "UPDATE stockist_inventory SET si_item_stock = '$warehoouse_stock' WHERE si_item_country = '$country' AND si_item_code = '$code'";
                $warehouse_update_qry = mysqli_query($connect, $warehouse_update);
                
            }
        } else {
            $get_items = "SELECT * FROM stockist_po WHERE spo_ref = '$id'";
            $get_items_qry = mysqli_query($connect, $get_items);
            while ($get_items_fetch = mysqli_fetch_array($get_items_qry)) {
                
                $code = $get_items_fetch['spo_item_code'];
                $qty = $get_items_fetch['spo_item_qty'];
                
                $warehouse = "SELECT * FROM stockist_warehouse WHERE warehouse_country = '$country' AND warehouse_code = '$code'";
                $warehouse_qry = mysqli_query($connect, $warehouse);
                $warehouse_fetch = mysqli_fetch_array($warehouse_qry);
    
                $warehoouse_stock = $warehouse_fetch['warehouse_stocks'] - $qty;
    
                $warehouse_update = "UPDATE stockist_warehouse SET warehouse_stocks = '$warehoouse_stock' WHERE warehouse_country = '$country' AND warehouse_code = '$code'";
                $warehouse_update_qry = mysqli_query($connect, $warehouse_update);
    
            }
        }
            
        $update = "UPDATE stockist_request SET req_status = 'On Process' WHERE req_reference = '$id'";
        $update_qry = mysqli_query($connect, $update);

        $insert_dhl = mysqli_query($connect, "INSERT INTO stockist_dhl (dhl_length, dhl_width, dhl_weight, dhl_height, dhl_reference, dhl_date) VALUES ('$length', '$width', '$weight', '$height', '$id', '$date')");

        if ($_SESSION['role'] == 'UPTIMAIN') {
            flash("success", "On Process status successfully");

            header('Location: ../stockist-requestpo.php');
        } else {
            flash("success", "On Process status successfully");

            header('Location: ../logistic.php');
        }
    }

    if (isset($_POST['transfer'])) {
      $s_code = $_SESSION['code'];

      $get_items = "SELECT * FROM stockist_po WHERE spo_ref = '$id'";
      $get_items_qry = mysqli_query($connect, $get_items);
      while ($get_items_fetch = mysqli_fetch_array($get_items_qry)) {
        $code = $get_items_fetch['spo_item_code'];
        // echo '<br>';
        $qty = $get_items_fetch['spo_item_qty'];
        
        $warehouse = "SELECT * FROM stockist_inventory WHERE si_item_country = '$country' AND si_item_code = '$code' AND si_item_state = 'ALL'";
        $warehouse_qry = mysqli_query($connect, $warehouse);
        $warehouse_fetch = mysqli_fetch_array($warehouse_qry);

        $warehoouse_stock = $warehouse_fetch['si_item_stock'] - $qty;

        $deduct_stocks = mysqli_query($connect, "UPDATE stockist_inventory SET si_item_stock = '$warehoouse_stock' WHERE si_item_country = '$country' AND si_item_code = '$code' AND si_item_state = 'ALL'");

        $update = "UPDATE stockist_request SET req_status = 'CND OnProcess' WHERE req_reference = '$id'";
        $update_qry = mysqli_query($connect, $update);

        $history = mysqli_query($connect, "INSERT INTO stockist_history (history_date, history_time, history_poid, history_status) VALUES ('$date', '$time', '$ref', 'Transfered')");

        flash("success", "Stocks has been deducted successfully");

        header('Location: ../incoming-transfer-order.php');
      }

    }

?>