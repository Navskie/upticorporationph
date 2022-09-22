<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    $delete_info = "DELETE FROM stockist WHERE id = '$id'";
    $delete_qry = mysqli_query($connect, $delete_info);

    echo "<script>alert('Data has been deleted successfully');window.location.href='../stock-branch.php';</script>";
?>