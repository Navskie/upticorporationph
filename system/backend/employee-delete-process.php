<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    $delete_info = "DELETE FROM upti_users WHERE users_id = '$id'";
    $delete_qry = mysqli_query($connect, $delete_info);

    echo "<script>alert('Data has been Deleted successfully.');window.location.href = '../main-employee.php';</script>";
?>