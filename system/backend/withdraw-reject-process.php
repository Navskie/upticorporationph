<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['reject'])) {

        $comment = $_POST['comment'];

        $get_withdraw = "SELECT * FROM upti_withdraw WHERE id = '$id'";
        $get_withdraw_qry = mysqli_query($connect, $get_withdraw);
        $get_withdraw_fetch = mysqli_fetch_array($get_withdraw_qry);

        $amount = $get_withdraw_fetch['withdraw_amount'];
        $reseller_id = $get_withdraw_fetch['withdraw_name'];

        $get_earning = "SELECT * FROM upti_reseller WHERE reseller_code = '$reseller_id'";
        $get_earning_qry = mysqli_query($connect, $get_earning);
        $get_earning_fetch = mysqli_fetch_array($get_earning_qry);

        $myearnings = $get_earning_fetch['reseller_earning'];
        
        $total_balance = $amount + $myearnings;

        $remarks = 'Withdrawal Decline '.$amount.' Total Balance: '.$total_balance;
        
        $update_earn = "UPDATE upti_reseller SET reseller_earning = '$total_balance' WHERE reseller_code = '$reseller_id'";
        $update_earn_sql = mysqli_query($connect, $update_earn);

        $d = date('Ym');
        $do = 'W-'.$d;
        
        $earn_history = "INSERT INTO upti_earning (earning_code, earning_remarks, earning_name, earning_status) VALUES ('$reseller_id', '$remarks', '$reseller_id', 'Reject')";
        $earn_history_sql = mysqli_query($connect, $earn_history);

        $update_request = "UPDATE upti_withdraw SET withdraw_status = 'Decline' WHERE id = '$id'";
        $update_request_qry = mysqli_query($connect, $update_request);

        echo "<script>alert('Withdraw has been Decline successfully');window.location.href='../admin-wallet-list.php';</script>";

    }

?>