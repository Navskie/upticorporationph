<?php
    include '../dbms/conn.php';

    $date = date('m-d-Y');

    $id = $_GET['id'];

    $delete = "UPDATE stockist_request SET req_status = 'Canceled', ref_checked = '$date' WHERE id = '$id'";
    $delete_qry = mysqli_query($connect, $delete);

    echo "<script>window.location.href='../stockist-po-list.php';</script>";

?>