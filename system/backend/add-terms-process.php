<?php
    include '../dbms/conn.php';
    $poid = $_GET['terms'];

    $accept = mysqli_query($connect, "UPDATE upti_transaction SET trans_terms = 'Agreed' WHERE trans_poid = '$poid'");

    // flash("warning", "Please Select Direct Mail or Post Office");
    header('location: ../order-list.php');
?>