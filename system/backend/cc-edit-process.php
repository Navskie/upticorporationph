<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['editbansa'])) {

        $country = $_POST['country'];

        $epayment_process = "UPDATE upti_country_currency SET cc_country = '$country' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-country-currency.php';</script>";
    }
?>