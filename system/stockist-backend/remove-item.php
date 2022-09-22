<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    $id = $_GET['order'];

    $delete_item = "DELETE FROM stockist_vendor_order WHERE id = '$id'";
    $delete_qry = mysqli_query($connect, $delete_item);

    flash("vendormissing", "Item has been deleted successfully");
    header('location: ../warehouse-po.php');
?>