<?php
    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    $Uid = $_SESSION['uid'];
    $Ucode = $_SESSION['code'];

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');

    $count_sql = "SELECT users_reseller, users_role, users_main, users_code FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);

    $Ucount = $count_fetch['users_reseller'];
    $reseller = $count_fetch['users_main'];

    $poid = 'RS'.$Uid.'-'.$Ucount;

    $packcode = $_GET['code'];

    $get_country = mysqli_query($connect, "SELECT trans_country FROM upti_transaction WHERE trans_poid = '$poid'");
    $get_country_f = mysqli_fetch_array($get_country);

    $country = $get_country_f['trans_country'];

    $get_package_info = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$packcode'");
    $packfetch = mysqli_fetch_array($get_package_info);

    $pack_desc = $packfetch['package_desc'];
    $pack_points = $packfetch['package_points'];

    $price_stmt = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$packcode' AND country_name = '$country'");
    $price_fetch = mysqli_fetch_array($price_stmt);

    $price = $price_fetch['country_price'];
    $php = $price_fetch['country_total_php'];

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
        '$packcode',
        '$Ucode',
        '$reseller',
        '$pack_desc',
        '$price',
        '$php',
        '1',
        '$pack_points',
        '$price',
        'Pending',
        '$date_today'
    )");

    flash("success", "Package has been added successfully");
    header('location: osr-reseller.php');
?>