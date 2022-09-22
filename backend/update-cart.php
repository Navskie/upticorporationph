<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_GET['id'];

    if (isset($_POST['update_qty'])) {
        $qty = $_POST['qtys'];

        $cart_stmt = mysqli_query($connect, "SELECT * FROM web_cart WHERE id = '$id'");
        $cart_fetch = mysqli_fetch_array($cart_stmt);

        $price = $cart_fetch['cart_price'];

        $subtotal = $price * $qty;

        $update_qty = mysqli_query($connect, "UPDATE web_cart SET cart_qty = '$qty', cart_subtotal = '$subtotal' WHERE id = '$id'");

        header('location: ../cart.php');
    }

    if (isset($_POST['delete_item'])) {

        $update_qty = mysqli_query($connect, "DELETE FROM web_cart WHERE id = '$id'");

        header('location: ../cart.php');
    }

?>