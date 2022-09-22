<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_GET['id'];

    $date = date('m-d-Y');

    if (isset($_POST['cancel'])) {
        $trans_cancel_stmt = mysqli_query($connect, "UPDATE web_transaction SET trans_status = 'Canceled' WHERE trans_ref = '$id'");

        $cart_cancel_stmt = mysqli_query($connect, "UPDATE web_cart SET cart_status = 'Canceled' WHERE cart_ref = '$id'");

        flash("success", $id."has been canceled successfully");
        header('location: ../checkout-list.php');
    }

?>