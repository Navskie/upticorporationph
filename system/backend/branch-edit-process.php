<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['editbranch'])) {
        $fname = $_POST['fname'];
        $status = $_POST['status'];
        $country = $_POST['country'];
        $us = $_POST['us'];
        $pw = $_POST['pw'];

        $check_us = "SELECT * FROM upti_users WHERE users_id = '$id'";
        $check_us_qry = mysqli_query($connect, $check_us);
        $check_us_fetch = mysqli_fetch_array($check_us_qry);

        $old_username = $check_us_fetch['users_username'];

        if ($us == $old_username) {
            $update_sql = "UPDATE upti_users SET users_name = '$fname', users_password = '$pw', users_position = '$country', users_status = '$status' WHERE users_id = '$id'";
            $update_qry = mysqli_query($connect, $update_sql);

            echo "<script>alert('Data has been Updated successfully.');window.location.href = '../admin-branch.php';</script>";
        } else {
            $check_us_1 = "SELECT * FROM upti_users WHERE users_username = '$us'";
            $check_us_qry1 = mysqli_query($connect, $check_us_1);
            $check_us_num = mysqli_num_rows($check_us_qry1);

            if ($check_us_num == 0) {
                $update_sql = "UPDATE upti_users SET users_username = '$us', users_name = '$fname', users_position = '$country', users_password = '$pw', users_status = '$status' WHERE users_id = '$id'";
                $update_qry = mysqli_query($connect, $update_sql);

                echo "<script>alert('Data has been Updated successfully.');window.location.href = '../admin-branch.php';</script>";
            } else {
                echo "<script>alert('Duplicate Username.');window.location.href = '../admin-branch.php';</script>";
            }
        }

    }
?>