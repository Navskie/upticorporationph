<?php
    include '../dbms/conn.php';
    session_start();
    $ucode = $_SESSION['code'];
    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    if (isset($_POST['oscwallet'])) {
        $amount = $_POST['amount'];
        $bank = $_POST['bank'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $pass = $_POST['pass'];

        $get_password = "SELECT * FROM upti_users WHERE users_code = '$ucode'";
        $get_password_qry = mysqli_query($connect, $get_password);
        $get_password_fetch = mysqli_fetch_array($get_password_qry);

        $oldpass = $get_password_fetch['users_password'];

        $reseller_sql = "SELECT * FROM upti_osc_wallet WHERE osc_code = '$ucode'";
        $reseller_qry = mysqli_query($connect, $reseller_sql);
        $reseller_fetch = mysqli_fetch_array($reseller_qry);

        $mymoney = $reseller_fetch['osc_wallet'];
        
        $minus = $mymoney - $amount;

        if ($oldpass == $pass) {
            if ($amount > $mymoney) {
                echo "<script>alert('Insufficient Balance');window.location.href='../osr-wallet';</script>";
            } else {
                if ($amount < 500) {
                    echo "<script>alert('500 is the minimum withdraw');window.location.href='../osr-wallet';</script>";
                } else {
                    $kuhapera = "INSERT INTO upti_osr_withdraw 
                    (
                      withdraw_name, 
                      withdraw_date,
                      withdraw_time,
                      withdraw_amount, 
                      withdraw_status, 
                      withdraw_bank, 
                      withdraw_acc_name, 
                      withdraw_number
                    ) VALUES 
                    (
                      '$ucode', 
                      '$date', 
                      '$time', 
                      '$amount', 
                      'Pending',
                      '$bank', 
                      '$name', 
                      '$number'
                    )";
                    $kuhapera_qry = mysqli_query($connect, $kuhapera);
                    
                    $bawaspera = "UPDATE upti_osc_wallet SET osc_wallet = '$minus' WHERE osc_code = '$ucode'";
                    $bawaspera_sql = mysqli_query($connect, $bawaspera);
                    
                    $remarks = 'Withdrawal request has been sent, amount of '.$amount.', Total Balance: '.$minus.'';
                    
                    $earn_history = "INSERT INTO upti_osc_history (
                      h_code, 
                      h_time, 
                      h_date, 
                      h_credit, 
                      h_debit, 
                      h_remarks
                    ) VALUES (
                      '$ucode', 
                      '$time',
                      '$date',
                      '$amount', 
                      '', 
                      '$remarks'
                    )";
                    $earn_history_sql = mysqli_query($connect, $earn_history);

                    echo "<script>alert('Request has been sent to admin please wait for the approval');window.location.href='../osr-wallet.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Incorrect Password');window.location.href='../osr-wallet.php';</script>";
        }



    }

?>