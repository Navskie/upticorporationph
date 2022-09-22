<?php

    session_start();
    include '../dbms/conn.php';
    include '../function.php';

    $date = date('m-d-Y');

    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
        $country = $_POST['bansa'];
            
        if ($country == 'CND Transfer') {
          $update = "UPDATE stockist_request SET req_from = 'CANADA', req_status = 'CND Transfer' WHERE req_reference = '$id'";
        } else {
          $update = "UPDATE stockist_request SET req_from = '$country', req_status = 'To Pack' WHERE req_reference = '$id'";
        }
        $update_qry = mysqli_query($connect, $update);

        if ($_SESSION['role'] == 'UPTIMAIN') {
            flash("success", "On Process status successfully");

            header('Location: ../stockist-requestpo.php');
        } else {
            flash("success", "On Process status successfully");

            header('Location: ../stockist-orders.php');
        }

    }

?>