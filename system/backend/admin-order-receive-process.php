<?php
    include '../dbms/conn.php';

    session_start();
    $uid = $_SESSION['code'];
    
    $date = date('m-d-Y');

    $id = $_GET['id'];

    if (isset($_POST['receive'])) {
        $get_order_list = "SELECT * FROM upti_order_list WHERE ol_poid = '$id'";
        $get_order_list_sql = mysqli_query($connect, $get_order_list);
        while ($get_order_list_fetch = mysqli_fetch_array($get_order_list_sql)) {
            $code = $get_order_list_fetch['ol_code'];
            $qty = $get_order_list_fetch['ol_qty'];
            $country = $get_order_list_fetch['ol_country'];
            $date_order = $get_order_list_fetch['ol_date'];

            $check_package = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$code'");
            $pack_fetch = mysqli_fetch_array($check_package);
            $check_package_sql = mysqli_num_rows($check_package);
            
            if ($date_order > '07-03-2022') {
                if ($check_package_sql == 0) {
                    // echo '<br>';
                    $get_remain_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$code' AND si_item_country = '$country'";
                    $get_remain_qry = mysqli_query($connect, $get_remain_sql);
                    $get_remain_fetch = mysqli_fetch_array($get_remain_qry);
                    
                    $remain_stock_code = $get_remain_fetch['si_item_code'];
                    $remain_stock_qty = $get_remain_fetch['si_item_stock'];
                    // echo '<br>';
                    
                    $new_stocks = $remain_stock_qty + $qty;
                    
                    $receive_sql = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$code' AND si_item_country = '$country'";
                    $receive_qry = mysqli_query($connect, $receive_sql);
                } else {
                    $q1 = $pack_fetch['package_one_qty'] * $qty;
                    $c1 = $pack_fetch['package_one_code'];

                    $q2 = $pack_fetch['package_two_qty'] * $qty;
                    $c2 = $pack_fetch['package_two_code'];

                    $q3 = $pack_fetch['package_three_qty'] * $qty;
                    $c3 = $pack_fetch['package_three_code'];

                    $q4 = $pack_fetch['package_four_qty'] * $qty;
                    $c4 = $pack_fetch['package_four_code'];

                    $q5 = $pack_fetch['package_five_qty'] * $qty;
                    $c5 = $pack_fetch['package_five_code'];

                    // 1

                    $get_remain_sql1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$country'";
                    $get_remain_qry1 = mysqli_query($connect, $get_remain_sql1);
                    $get_remain_fetch1 = mysqli_fetch_array($get_remain_qry1);
                    
                    $remain_stock_qty1 = $get_remain_fetch1['si_item_stock'];
                    // echo '<br>';
                    
                    $new_stocks1 = $remain_stock_qty1 + $q1;
                    
                    $receive_sql1 = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks1' WHERE si_item_code = '$c1' AND si_item_country = '$country'";
                    $receive_qry1 = mysqli_query($connect, $receive_sql1);

                    // 2

                    $get_remain_sql2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$country'";
                    $get_remain_qry2 = mysqli_query($connect, $get_remain_sql2);
                    $get_remain_fetch2 = mysqli_fetch_array($get_remain_qry2);
                    
                    $remain_stock_qty2 = $get_remain_fetch2['si_item_stock'];
                    // echo '<br>';
                    
                    $new_stocks2 = $remain_stock_qty2 + $q2;
                    
                    $receive_sql2 = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks2' WHERE si_item_code = '$c2' AND si_item_country = '$country'";
                    $receive_qry2 = mysqli_query($connect, $receive_sql2);

                    // // 3

                    $get_remain_sql3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$country'";
                    $get_remain_qry3 = mysqli_query($connect, $get_remain_sql3);
                    $get_remain_fetch3 = mysqli_fetch_array($get_remain_qry3);
                    
                    $remain_stock_qty3 = $get_remain_fetch3['si_item_stock'];
                    // echo '<br>';
                    
                    $new_stocks3 = $remain_stock_qty3 + $q3;
                    
                    $receive_sql3 = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks3' WHERE si_item_code = '$c3' AND si_item_country = '$country'";
                    $receive_qry3 = mysqli_query($connect, $receive_sql3);

                    // 4

                    $get_remain_sql4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$country'";
                    $get_remain_qry4 = mysqli_query($connect, $get_remain_sql4);
                    $get_remain_fetch4 = mysqli_fetch_array($get_remain_qry4);
                    
                    $remain_stock_qty4 = $get_remain_fetch4['si_item_stock'];
                    // echo '<br>';
                    
                    $new_stocks4 = $remain_stock_qty4 + $q4;
                    
                    $receive_sql4 = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks4' WHERE si_item_code = '$c4' AND si_item_country = '$country'";
                    $receive_qry4 = mysqli_query($connect, $receive_sql4);

                    // 5

                    $get_remain_sql5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$country'";
                    $get_remain_qry5 = mysqli_query($connect, $get_remain_sql5);
                    $get_remain_fetch5 = mysqli_fetch_array($get_remain_qry5);
                    
                    $remain_stock_qty5 = $get_remain_fetch5['si_item_stock'];
                    // echo '<br>';
                    
                    $new_stocks5 = $remain_stock_qty5 + $q5;
                    
                    $receive_sql5 = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks5' WHERE si_item_code = '$c5' AND si_item_country = '$country'";
                    $receive_qry5 = mysqli_query($connect, $receive_sql5);
                }
            }
            $re_sql = "INSERT INTO stockist_return (re_poid, re_code, re_qty, re_date, re_status) VALUES ('$id', '$remain_stock_code', '$qty', '$date', 'Received')";
            $re_qry = mysqli_query($connect, $re_sql);
            
            $change_status = "UPDATE upti_transaction SET trans_stockist = 'Received' WHERE trans_poid = '$id'";
            $change_status_qry = mysqli_query($connect, $change_status);
        }
    
        if ($_SESSION['role'] != 'LOGISTIC') {
            echo "<script>alert('Transfered Successfully');window.location.href = '../incoming-rts-order.php';</script>";
        } else {
            echo "<script>alert('Transfered Successfully');window.location.href = '../ph-rts.php';</script>";
        }
    }
?>