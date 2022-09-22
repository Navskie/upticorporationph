<?php

    include '../dbms/conn.php';

    session_start();

    $id = $_GET['id'];
    $role = $_SESSION['role'];
    $datenow = date('m-d-Y');

    $get_info = "SELECT * FROM upti_reseller WHERE id = '$id'";
    $get_info_sql = mysqli_query($connect, $get_info);
    $info_fetch = mysqli_fetch_array($get_info_sql);

    $reseller_codex = $info_fetch['reseller_code'];
    $reseller_main = $info_fetch['reseller_main'];
    $total_package = $info_fetch['reseller_amount'];
    $poid = $info_fetch['reseller_poid'];
    $reseller_name = $info_fetch['reseller_name'];
    $reseller_osr = $info_fetch['reseller_osr'];
    $codeitem = $info_fetch['reseller_package'];

    if ($reseller_osr != '') {
        $seller_id = $_SESSION['code'];

        // POINTS
        $order_sql = "SELECT package_points AS PUNTOS FROM upti_package WHERE package_code = '$codeitem'";
        $order_qry = mysqli_query($connect, $order_sql);
        $order_fetch = mysqli_fetch_array($order_qry);

        $seller_points = $order_fetch['PUNTOS'];

        $seller_insert = "INSERT INTO upti_osr_points (op_name, op_poid, op_points, op_date) VALUES ('$reseller_osr', '$poid', '$seller_points', '$datenow')";
        $seller_insert_qry = mysqli_query($connect, $seller_insert);
        // ENDPOINTS
    }

    $get_php = "SELECT * FROM upti_country WHERE country_code = '$codeitem'";
    $get_php_qry = mysqli_query($connect, $get_php);
    $get_php_fetch = mysqli_fetch_array($get_php_qry);

    $php = $get_php_fetch['country_total_php'];
    $count_php = $get_php_fetch['country_price'];
    $count_name = $get_php_fetch['country_name'];

    $get_info2 = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller_main'";
    $get_info2_sql = mysqli_query($connect, $get_info2);
    $info2_fetch = mysqli_fetch_array($get_info2_sql);

    $reseller_earnings = $info2_fetch['reseller_earning'];

    // Compute 10%
    $earning_ten_percent = $php * 0.10;
    $earn = number_format($earning_ten_percent, '2', '.', ',');
    $new_earnings = $reseller_earnings + $earning_ten_percent;

    $update_earning = "UPDATE upti_reseller SET reseller_earning = '$new_earnings' WHERE reseller_code = '$reseller_main'";
    $update_earning_qry = mysqli_query($connect, $update_earning);

    // Earnings History
    $remarks = "You Received 10% Commission Reseller Creation Worth of ".$php." [".$count_name."]";

    $history = "INSERT INTO upti_earning (earning_code, earning_poid, earning_earnings, earning_remarks, earning_status, earning_name) VALUES ('$reseller_main', '$poid', '$earn', '$remarks', 'Approve', '$reseller_name')";
    $history_qry = mysqli_query($connect, $history);

    $update_stats = "UPDATE upti_reseller SET reseller_status = 'Approve' WHERE id = '$id'";
    $update_stats_qyr = mysqli_query($connect, $update_stats);
    
    $login_sql = "UPDATE upti_users SET users_status = 'Active' WHERE users_code = '$reseller_codex'";
    $login_qry = mysqli_query($connect, $login_sql);

    echo "<script>alert('Reseller has been Approve successfully.');window.location.href = '../reseller-list.php';</script>";

?>