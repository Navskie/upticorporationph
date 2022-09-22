<?php
    include '../dbms/conn.php';
    session_start();
    $ucode = $_SESSION['code'];
    $date = date('m-d-Y');

    if (isset($_POST['earnmore'])) {
        $amount = $_POST['amount'];
        $bank = $_POST['bank'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $pass = $_POST['pass'];

        $get_password = "SELECT * FROM upti_users WHERE users_code = '$ucode'";
        $get_password_qry = mysqli_query($connect, $get_password);
        $get_password_fetch = mysqli_fetch_array($get_password_qry);

        $oldpass = $get_password_fetch['users_password'];

        $reseller_sql = "SELECT * FROM upti_reseller WHERE reseller_code = '$ucode'";
        $reseller_qry = mysqli_query($connect, $reseller_sql);
        $reseller_fetch = mysqli_fetch_array($reseller_qry);

        $mymoney = $reseller_fetch['reseller_earning'];
        
        $minus = $mymoney - $amount;

        if ($oldpass == $pass) {
            if ($amount > $mymoney) {
                echo "<script>alert('Insufficient Balance');window.location.href='../wallet-list.php';</script>";
            } else {
                if ($amount < 500) {
                    echo "<script>alert('500 is the minimum withdraw');window.location.href='../wallet-list.php';</script>";
                } else {
                    $kuhapera = "INSERT INTO upti_withdraw (withdraw_name, withdraw_date, withdraw_amount, withdraw_status, withdraw_bank, withdraw_acc_name, withdraw_acc_number) VALUES ('$ucode', '$date', '$amount', 'Pending', '$bank', '$name', '$number')";
                    $kuhapera_qry = mysqli_query($connect, $kuhapera);
                    
                    $bawaspera = "UPDATE upti_reseller SET reseller_earning = '$minus' WHERE reseller_code = '$ucode'";
                    $bawaspera_sql = mysqli_query($connect, $bawaspera);
                    
                    $remarks = 'Withdrawal request has been sent, amount of '.$amount.' (Withdrawal Fee 50.00), Total Balance: '.$minus.'';
                    
                    $earn_history = "INSERT INTO upti_earning (earning_code, earning_remarks, earning_name, earning_status) VALUES ('$ucode', '$remarks', '$ucode', 'Request')";
                    $earn_history_sql = mysqli_query($connect, $earn_history);

                    echo "<script>alert('Request has been sent to admin please wait for the approval');window.location.href='../wallet-list.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Incorrect Password');window.location.href='../wallet-list.php';</script>";
        }



    }

?>