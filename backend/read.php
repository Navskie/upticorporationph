<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    // $profile = $_SESSION['code'];
    // $role = $_SESSION['role'];
    $id = $_GET['id'];
    // echo $ref = $_GET['ref'];
    // $stamp = $today.' '.$time;

    $ref_stmt = mysqli_query($connect, "SELECT * FROM upti_remarks WHERE id = '$id'");
    $reference = mysqli_fetch_array($ref_stmt);

    $ref = $reference['remark_poid'];

    if(isset($_POST['read'])) {
        $name_stmt = mysqli_query($connect, "UPDATE upti_remarks SET remark_reseller = '' WHERE id = '$id'");

        // flash("success", "Address has been added successfully");
        header('location: ../ref-details.php?ref='.$ref.'');
    }
?>