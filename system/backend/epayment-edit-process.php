<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['updatepayment'])) {

        $country = $_POST['country'];
        $branch = $_POST['branch'];
        $name = $_POST['name'];
        $number = $_POST['number'];

        $epayment_process = "UPDATE upti_mod SET mod_country = '$country', mod_branch = '$branch', mod_name = '$name', mod_number = '$number' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../order-epayment.php';</script>";

    }
?>