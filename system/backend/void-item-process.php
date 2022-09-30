<?php

    session_start();
    include '../dbms/conn.php';
    include '../function.php';

    $id = $_GET['id'];

    $get_ol = mysqli_query($connect, "SELECT * FROM upti_order_list WHERE id = '$id'");
    $ol_fetch = mysqli_fetch_array($get_ol);

    $ol_code = $ol_fetch['ol_code'];
    $ol_poid = $ol_fetch['ol_poid'];

    $transaction = mysqli_query($connect, "SELECT * FROM upti_transaction WHERE trans_poid = '$ol_poid'");
    $trans_fetch = mysqli_fetch_array($transaction);

    $csid = $trans_fetch['trans_csid'];

    // remove free
    $remove_free = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE code_category = 'BUY ONE GET TWO' AND ol_poid = '$ol_poid' AND code_name = '$ol_code'");
    if(mysqli_num_rows($remove_free) > 0) {
        $removefreelist = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE code_category = 'FREE TWO' AND ol_poid = '$ol_poid'");
        while($code = mysqli_fetch_array($removefreelist)) {
            $codes = $code['ol_code'];

            $delete_free = mysqli_query($connect, "DELETE FROM upti_order_list WHERE ol_poid = '$ol_poid' AND ol_code = '$codes'");
            $delete_free2 = mysqli_query($connect, "DELETE FROM upti_free_2 WHERE f2_poid = '$ol_poid'");
        }
    }

    // loyalty free
    // $remove_free = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE code_category = 'LOYALTY' AND ol_poid = '$ol_poid' AND code_name = '$ol_code'");
    // if(mysqli_num_rows($remove_free) > 0) {
    //     $removefreelist = mysqli_query($connect, "UPDATE upti_loyalty SET loyalty_number = '6' WHERE loyalty_code = '$csid'");
    // }

    // remove free
    $free2 = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE code_category = 'FREE TWO' AND ol_poid = '$ol_poid' AND code_name = '$ol_code'");
    if(mysqli_num_rows($free2) > 0) {
        $get_remain_poid = mysqli_query($connect, "SELECT * FROM upti_free_2 WHERE f2_poid = '$ol_poid'");
        $fetch_f2 = mysqli_fetch_array($get_remain_poid);
        $remain_free = $fetch_f2['f2_number'] + 1;
        $update_number = mysqli_query($connect, "UPDATE upti_free_2 SET f2_number = '$remain_free' WHERE f2_poid = '$ol_poid'");
    }

    // remove free
    $remove_free1 = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE code_category = 'BUY ONE GET ANY' AND ol_poid = '$ol_poid' AND code_name = '$ol_code'");
    if(mysqli_num_rows($remove_free1) > 0) {
        $removefreelist1 = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE code_category = 'FREE' AND ol_poid = '$ol_poid'");
        while($code = mysqli_fetch_array($removefreelist1)) {
            $codes = $code['ol_code'];

            $delete_free = mysqli_query($connect, "DELETE FROM upti_order_list WHERE ol_poid = '$ol_poid' AND ol_code = '$codes'");
            $delete_free2 = mysqli_query($connect, "DELETE FROM upti_free WHERE free_poid = '$ol_poid'");
        }
    }

    $check_code = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$ol_code'");
    $check_code_fetch = mysqli_fetch_array($check_code);

    $exc = $check_code_fetch['code_exclusive'];

    $delete_ex = mysqli_query($connect, "DELETE FROM upti_order_list WHERE ol_code = '$exc' AND ol_poid = '$ol_poid'");

    $delete = "DELETE FROM upti_order_list WHERE id = '$id'";
    $delete_qry = mysqli_query($connect, $delete);

    flash("warning", "Item has been removed successfully");
    header('location: ../order-list.php');

?>