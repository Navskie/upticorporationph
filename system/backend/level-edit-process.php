<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['leveledit'])) {

        $lvl = $_POST['lvl'];
        $per = $_POST['per'];

        $epayment_process = "UPDATE upti_level SET levels = '$lvl', percent = '$per' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);
        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../level2203.php';</script>";

    }
?>