<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['employeeedit'])) {

        $fname = $_POST['fname'];
        $status = $_POST['status'];
        $position = $_POST['position'];
        $us = $_POST['us'];
        $pw = $_POST['pw'];

        $check_fee1 = "SELECT * FROM upti_users WHERE users_id = '$id'";
        $check_fee1_qry = mysqli_query($connect, $check_fee1);
        $check_fetch1 = mysqli_fetch_array($check_fee1_qry);

        $remain_user = $check_fetch1['users_username'];

        if($remain_user != $us) {
            $check_fee = "SELECT * FROM upti_users WHERE users_username = '$us'";
            $check_fee_qry = mysqli_query($connect, $check_fee);
            $check_num_row = mysqli_num_rows($check_fee_qry);

            if ($check_num_row == 0) {
                $epayment_process = "UPDATE upti_users SET users_name = '$fname', users_position = '$position', users_status = '$status', users_username = '$us', users_password = '$pw' WHERE users_id = '$id'";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);

                echo "<script>alert('Data has been Updated successfully.');window.location.href = '../main-employee.php';</script>";
            } else {
                echo "<script>alert('Duplicate Username.');window.location.href = '../main-employee.php';</script>";
            }
        } else {
            $epayment_process = "UPDATE upti_users SET users_name = '$fname', users_position = '$position', users_status = '$status', users_username = '$us', users_password = '$pw' WHERE users_id = '$id'";
            $epayment_process_qry = mysqli_query($connect, $epayment_process);

            echo "<script>alert('Data has been Updated successfully.');window.location.href = '../main-employee.php';</script>";
        }
    }
?>