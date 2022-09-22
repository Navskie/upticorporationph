<?php

    include '../dbms/conn.php';

    session_start();

    $date = date('m-d-Y');

    $role = $_SESSION['role'];

    $id = $_GET['id'];

    $get_product = "SELECT * FROM stockist_po WHERE spo_ref = '$id'";
    $get_product_qry = mysqli_query($connect, $get_product);
    while ($product = mysqli_fetch_array($get_product_qry)) {
        $p_code = $product['spo_item_code'];
        $p_desc = $product['spo_item_desc'];
        $p_qty = $product['spo_item_qty'];
        $p_country = $product['spo_country'];
        $p_state = $product['spo_state'];
        $Ucode = $product['spo_code'];

        $check_reseller_inv = "SELECT * FROM stockist_inventory WHERE si_code = '$Ucode' AND si_item_code = '$p_code'";
        $check_reseller_inv_qry = mysqli_query($connect, $check_reseller_inv);
        $check_reseller_inv_fetch = mysqli_fetch_array($check_reseller_inv_qry);
        $check_reseller_inv_num = mysqli_num_rows($check_reseller_inv_qry);

        if ($check_reseller_inv_num == 0) {
            $insert_stock = "INSERT INTO stockist_inventory (si_code, si_item_code, si_item_desc, si_item_stock, si_item_date, si_item_added, si_item_country, si_item_state) VALUES ('$Ucode', '$p_code', '$p_desc', '$p_qty', '$date', '$date', '$p_country', '$p_state')";
            $insert_stock_qry = mysqli_query($connect, $insert_stock);
        } else {
            $new_stock = $p_qty + $check_reseller_inv_fetch['si_item_stock'];

            $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stock' WHERE si_code = '$Ucode' AND si_item_code = '$p_code'";
            $update_stock_qry = mysqli_query($connect, $update_stock);
        }

    }
 
    $update = "UPDATE stockist_request SET req_status = 'Received', ref_checked = '$date' WHERE req_reference = '$id'";
    $update_qry = mysqli_query($connect, $update);

    $update_2 = "UPDATE stockist_po SET spo_status = 'Received' WHERE spo_ref = '$id'";
    $update_qry_2 = mysqli_query($connect, $update_2);

    if ($role != 'LOGISTIC') {
        echo "<script>window.location.href='../stockist-po-list.php';</script>";
    } else {
        echo "<script>window.location.href='../warehouse-ph-main.php';</script>";
    }
    

?>