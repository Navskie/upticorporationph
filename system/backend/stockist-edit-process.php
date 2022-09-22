<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['stockist'])) {

        $reseller = $_POST['reseller'];
        $status = $_POST['stats'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $role = $_POST['role'];

        if ($reseller == '' || $status == '' || $country == '') {
            echo "<script>alert('All fields are required');window.location.href='../stock-branch.php';</script>";
        } else {
            $insert_stockist = "UPDATE stockist SET stockist_role = '$role', stockist_state = '$state', stockist_code = '$reseller', stockist_country = '$country', stockist_status = '$status' WHERE id = '$id'";
            $insert_stockist_qry = mysqli_query($connect, $insert_stockist);

            echo "<script>alert('Data has been updated successfully');window.location.href='../stock-branch.php';</script>";
        }

    }
?>