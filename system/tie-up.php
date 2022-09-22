<?php

    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');

    $Uid = $_SESSION['uid'];
    $Ucode = $_SESSION['code'];

    $count_sql = "SELECT users_reseller, users_role, users_main, users_code FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);

    $reseller = $count_fetch['users_main'];

    $poid = $_GET['poid'];

    $get_country = mysqli_query($connect, "SELECT trans_country FROM upti_transaction WHERE trans_poid = '$poid'");
    $get_country_f = mysqli_fetch_array($get_country);

    $country = $get_country_f['trans_country'];

    if (isset($_POST['add'])) {
        $code = $_POST['item_code'];
        $qty = $_POST['qty'];

        $get_package_info = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$code'");
        $packfetch = mysqli_fetch_array($get_package_info);

        $pack_desc = $packfetch['items_desc'];
        $pack_points = $packfetch['items_points'];

        $price_stmt = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$code' AND country_name = '$country'");
        $price_fetch = mysqli_fetch_array($price_stmt);

        $price = $price_fetch['country_price'];
        $php = $price_fetch['country_total_php'];

        $subtotal = $qty * $price;

        // get new code
        $get_new_code = "SELECT * FROM upti_code WHERE code_name = '$code'";
        $get_new_code_qry = mysqli_query($connect, $get_new_code);
        $get_new_code_fetch = mysqli_fetch_array($get_new_code_qry);

        $new_item_code = $get_new_code_fetch['code_main'];

        // Single Item Check
        $check_stock = "SELECT * FROM stockist_inventory WHERE si_item_code = '$new_item_code' AND si_item_country = '$country'";
        $check_stock_qry = mysqli_query($connect, $check_stock);
        $check_stock_fetch = mysqli_fetch_array($check_stock_qry);
        $check_stock_num = mysqli_num_rows($check_stock_qry);

        if ($check_stock_num == 0) {
            $stockist_stock = 0;
        } else {
            $stockist_stock = $check_stock_fetch['si_item_stock'];
        }

        if ($stockist_stock > $qty) {
            $order_list = mysqli_query($connect, "INSERT INTO upti_order_list 
            (
                ol_country,
                ol_poid,
                ol_code,
                ol_seller,
                ol_reseller,
                ol_desc,
                ol_price,
                ol_php,
                ol_qty,
                ol_points,
                ol_subtotal,
                ol_status,
                ol_date
            ) VALUES (
                '$country',
                '$poid',
                '$code',
                '$Ucode',
                '$reseller',
                '$pack_desc',
                '$price',
                '$php',
                '$qty',
                '$pack_points',
                '$subtotal',
                'Pending',
                '$date_today'
            )");

            flash("success", "Tie Up has been added successfully");
            header('location: osr-reseller.php');
        } else {
            flash("failed", "Insufficient stocks to process your order");
            header('location: osr-reseller.php');
        }
    }
    
?>