<?php
    include '../dbms/conn.php';
    

    $id = $_GET['id'];

    if (isset($_POST['check'])) {

        $comment = $_POST['comment'];

        $wfile = $_FILES['wfile']['name'];
        $img_size = $_FILES['wfile']['size'];
        $img_tmp = $_FILES['wfile']['tmp_name'];

        $img_ex = pathinfo($wfile, PATHINFO_EXTENSION);
        // echo ($img_ex);
        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png");


            $new_name = uniqid("W-", true).'.'.$img_ex_lc;
            $img_path_sa_buhay_niya = '../images/withdraw/'.$new_name;
            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);

            $get_withdraw = "SELECT * FROM upti_withdraw WHERE id = '$id'";
            $get_withdraw_qry = mysqli_query($connect, $get_withdraw);
            $get_withdraw_fetch = mysqli_fetch_array($get_withdraw_qry);

            $amounts = $get_withdraw_fetch['withdraw_amount'];
            $amount = $amounts;
            $reseller_id = $get_withdraw_fetch['withdraw_name'];

            $get_earning = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller_id'";
            $get_earning_qry = mysqli_query($connect, $get_earning);
            $get_earning_fetch = mysqli_fetch_array($get_earning_qry);

            $myearnings = $get_earning_fetch['reseller_earning'];

            $balance = $myearnings - $amount;
        // echo '<br>';

            $remarks = 'Withdrawal request has been approve, amount of '.$amounts.' (Withdrawal Fee 50.00), Total Balance: '.$myearnings;

            $history = "INSERT INTO upti_earning (earning_img, earning_comment, earning_code, earning_poid, earning_deduct, earning_remarks, earning_status, earning_name) VALUES ('$new_name', '$remarks', '$reseller_id', '', '$amounts', '$remarks', 'Withdrawal', '$reseller_id')";
            $history_sql = mysqli_query($connect, $history);
            

            $update_request = "UPDATE upti_withdraw SET withdraw_status = 'Approve', withdraw_remarks = '$comment' WHERE id = '$id'";
            $update_request_qry = mysqli_query($connect, $update_request);

            echo "<script>alert('Withdraw has been approved successfully');window.location.href='../admin-wallet-list.php';</script>";


    }

?>