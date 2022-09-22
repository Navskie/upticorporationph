<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['crit'])) {
        $critical = $_POST['critical']; 

        $paid_sql = "UPDATE stockist_inventory SET si_item_critical = '$critical' WHERE id = '$id'";
        $paid_qry = mysqli_query($connect, $paid_sql);
    }

    flash("submitted", "Critical Level has been updated successfully!");
    header('location: ../critical-ph.php');
?>