<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['shipping'])) {

        $country = $_POST['country'];
        $price = $_POST['price'];
        $less = $_POST['less'];

        $epayment_process = "UPDATE upti_shipping SET shipping_country = '$country', shipping_less = '$less', shipping_price = '$price' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../order-shipping.php';</script>";

    }
?>