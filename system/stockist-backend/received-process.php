<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    date_default_timezone_set('Asia/Manila');
    $date = date('m-d-Y');

    $Ucode = $_SESSION['code'];

    if ($Ucode != 'UPTIMAIN') {
        $Ucode = 'UPTIMAIN';
    }

    $Urole = $_SESSION['role'];

    $id = $_GET['id'];

    if (isset($_POST['po-received'])) {

        $get_vendor_location = mysqli_query($connect, "SELECT * FROM stockist_vendor WHERE vendor_po = '$id'");
        $location = mysqli_fetch_array($get_vendor_location);

        $bansa = $location['vendor_location'];

        $get_items = "SELECT * FROM stockist_vendor_order WHERE vo_po = '$id'";
        $get_items_qry = mysqli_query($connect, $get_items);
        while ($get_items_fetch = mysqli_fetch_array($get_items_qry)) {
            $item_code = $get_items_fetch['vo_code'];
            $item_desc = $get_items_fetch['vo_details'];
            $item_qty = $get_items_fetch['vo_qty'];

            if ($bansa == 'PHILIPPINES') {
                $check_reseller_inv = "SELECT * FROM stockist_inventory WHERE si_code = '$Ucode' AND si_item_code = '$item_code'";
                $check_reseller_inv_qry = mysqli_query($connect, $check_reseller_inv);
                $check_reseller_inv_fetch = mysqli_fetch_array($check_reseller_inv_qry);
                $check_reseller_inv_num = mysqli_num_rows($check_reseller_inv_qry);

                if ($check_reseller_inv_num == 0) {
                    $insert_stock = "INSERT INTO stockist_inventory (si_code, si_item_code, si_item_desc, si_item_stock, si_item_date, si_item_added, si_item_country) VALUES ('$Ucode', '$item_code', '$item_desc', '$item_qty', '$date', '$date', '$bansa')";
                    $insert_stock_qry = mysqli_query($connect, $insert_stock);
                } else {
                    $new_stock = $item_qty + $check_reseller_inv_fetch['si_item_stock'];

                    $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stock' WHERE si_code = '$Ucode' AND si_item_code = '$item_code'";
                    $update_stock_qry = mysqli_query($connect, $update_stock);
                }
            } else {
                $history_sql = "INSERT INTO stockist_w_history (
                    wh_code, 
                    wh_desc, 
                    wh_qty, 
                    wh_po, 
                    wh_date, 
                    wh_country
                ) VALUES (
                    '$item_code',
                    '$item_desc',
                    '$item_qty',
                    '$id',
                    '$date',
                    '$bansa'
                    )";
                $history_qry = mysqli_query($connect, $history_sql);
    
                $check_warehouse = "SELECT * FROM stockist_warehouse WHERE warehouse_code = '$item_code' AND warehouse_country = '$bansa'";
                $check_warehouse_qry = mysqli_query($connect, $check_warehouse);
                $check_warehouse_fetch = mysqli_fetch_array($check_warehouse_qry);
                $check_warehouse_num = mysqli_num_rows($check_warehouse_qry);
    
                if ($check_warehouse_num == 0) {
                    $new_stocks = "INSERT INTO stockist_warehouse (
                        warehouse_code,
                        warehouse_details,
                        warehouse_country,
                        warehouse_stocks
                    ) VALUES (
                        '$item_code',
                        '$item_desc',
                        '$bansa',
                        '$item_qty'
                    )";
                    $new_stocks_qry = mysqli_query($connect, $new_stocks);
                } else {
                    $new_stockss = $check_warehouse_fetch['warehouse_stocks'] + $item_qty;
                    $add_stocks = "UPDATE stockist_warehouse SET warehouse_stocks = '$new_stockss' WHERE warehouse_country = '$bansa' AND warehouse_code = '$item_code'";
                    $add_stocks_qry = mysqli_query($connect, $add_stocks);
                }
            }
            
        }

    }
    
    $status_sql = "UPDATE stockist_vendor SET vendor_date_trigger = '$date', vendor_remarks = 'Received', vendor_status = 'Received' WHERE vendor_po = '$id'";
    $status_qry = mysqli_query($connect, $status_sql);

    if ($Urole == 'UPTIMAIN') {
        flash("submitted", "All stock has been added to ".$bansa." warehouse!");
        header('Location: ../warehouse.php');
    } else {
        flash("submitted", "All stock has been added to ".$bansa." warehouse!");
        header('Location: ../logistic-supplier.php');
    }

?>