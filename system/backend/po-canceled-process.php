<?php
    include '../dbms/conn.php';

    $date = date('m-d-Y');

    $id = $_GET['id'];

    $update = "UPDATE stockist_request SET req_status = 'Canceled', ref_checked = '$date' WHERE id = '$id'";
    $update_qry = mysqli_query($connect, $update);

    echo "<script>window.location.href='../stockist-orders.php';</script>";

?>