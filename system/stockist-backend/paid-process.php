<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['PAID'])) {
        $bansa = $_POST['bansa'];

        $paid_sql = "UPDATE stockist_vendor SET vendor_status = 'PAID', vendor_location = '$bansa' WHERE vendor_po = '$id'";
        $paid_qry = mysqli_query($connect, $paid_sql);
    }

    flash("paid", $id." has been updated successfully!");
    header('location: ../accounting-po.php');
?>