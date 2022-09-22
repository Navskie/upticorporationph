<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    $id = $_GET['id'];

    $paid_sql = "UPDATE stockist_vendor SET vendor_status = 'CANCEL' WHERE vendor_po = '$id'";
    $paid_qry = mysqli_query($connect, $paid_sql);

    flash("paid", $id." has been updated successfully!");
    header('location: ../accounting-po.php');
?>