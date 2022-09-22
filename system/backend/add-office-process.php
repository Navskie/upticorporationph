<?php
    include '../dbms/conn.php';
    $poid = $_GET['office'];

    $accept = mysqli_query($connect, "UPDATE upti_transaction SET trans_office_status = 'Agreed' WHERE trans_poid = '$poid'");

    // flash("warning", "Please Select Direct Mail or Post Office");
    header('location: ../order-list.php');
?>