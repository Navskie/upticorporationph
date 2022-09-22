<?php

    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    $poid = $_GET['mop'];

    if (isset($_POST['payment'])) {
        $mod = $_POST['mod'];

        $payment = mysqli_query($connect, "UPDATE upti_transaction SET trans_mop = '$mod' WHERE trans_poid = '$poid'");
       
        flash("success", "Payment status has been updated successfully");
        header('location: osr-reseller.php');
    }
    
?>