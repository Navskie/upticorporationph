<?php

    include '../dbms/conn.php';

    $id = $_GET['id'];

    $update_stats = "UPDATE upti_reseller SET reseller_status = 'Canceled' WHERE reseller_poid = '$id'";
    $update_stats_qyr = mysqli_query($connect, $update_stats);

    $update_stats1 = "UPDATE upti_transaction SET trans_status = 'Canceled' WHERE trans_poid = '$id'";
    $update_stats_qyr1 = mysqli_query($connect, $update_stats1);

    echo "<script>alert('Reseller has been Canceled successfully.');window.location.href = '../account-reseller.php';</script>";

?>