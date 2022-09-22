<?php
    include 'dbms/conn.php';

    session_start();

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');

    $Uid = $_SESSION['uid'];
    $Urole = $_SESSION['role'];
    $Ucode = $_SESSION['code'];
    $Ureseller = $_SESSION['code']; 

    $count_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);

    $Ucount = $count_fetch['users_count'];

    if($Urole == 'UPTIOSR') {
        $upline_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
        $upline_qry = mysqli_query($connect, $upline_sql);
        $upline_fetch = mysqli_fetch_array($upline_qry);

        $Ucode = $upline_fetch['users_code'];
        $Ureseller = $upline_fetch['users_main'];
        $Ucount = $upline_fetch['users_count'];
    }
    // Get Users Code & Users Upline Code

    $poid = 'PD'.$Uid.'-'.$Ucount;
    // Poid Number / Reference Number

    if (isset($_POST['cod'])) {
        $cod_sql = "UPDATE upti_transaction SET trans_mop = 'Cash On Delivery' WHERE trans_poid = '$poid'";
        $cod_qry = mysqli_query($connect, $cod_sql);
        echo "<script>window.location='order-list.php'</script>";
    }

    if (isset($_POST['cop'])) {
        $cop_sql = "UPDATE upti_transaction SET trans_mop = 'Cash On Pick Up' WHERE trans_poid = '$poid'";
        $cop_qry = mysqli_query($connect, $cop_sql);
        echo "<script>window.location='order-list.php'</script>";
    }

    if (isset($_POST['epayment'])) {
        $epayment_sql = "UPDATE upti_transaction SET trans_mop = 'E-Payment' WHERE trans_poid = '$poid'";
        $epayment_qry = mysqli_query($connect, $epayment_sql);
        echo "<script>window.location='order-list.php'</script>";
    }

    if (isset($_POST['bank'])) {
        $bank_sql = "UPDATE upti_transaction SET trans_mop = 'Bank' WHERE trans_poid = '$poid'";
        $bank_qry = mysqli_query($connect, $bank_sql);
        echo "<script>window.location='order-list.php'</script>";
    }

?>