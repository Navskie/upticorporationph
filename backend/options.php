<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_SESSION['uid'];
    $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
    $fetch_count = mysqli_fetch_array($user_info);
    $user_count = $fetch_count['users_count'];
    $ref = 'CS'.$id.'-22'.$user_count;

    $profile = $_SESSION['code'];

    if (isset($_POST['POPU'])) {

        $update_cod = mysqli_query($connect, "UPDATE web_transaction SET trans_office = 'Post Office Pick Up' WHERE trans_ref = '$ref'");

        flash("success", "Delivery Option has been updated successfully");
        header('location: ../cart.php');
        
    }

    if (isset($_POST['DMB'])) {

        $update_cod = mysqli_query($connect, "UPDATE web_transaction SET trans_office = 'Direct Mail Box' WHERE trans_ref = '$ref'");

        flash("success", "Delivery Option has been updated successfully");
        header('location: ../cart.php');
        
    }
?>
