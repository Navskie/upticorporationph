<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['category'])) {

        $cat = $_POST['cat'];

        $epayment_process = "UPDATE upti_category SET category_name = '$cat' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-category.php';</script>";
    }
?>