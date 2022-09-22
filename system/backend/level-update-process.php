<?php

    include '../dbms/conn.php';

    session_start();

    $uid = $_SESSION['uid'];

    $id = $_GET['id'];

    if (isset($_POST['upgradereseller'])) {
        $lvl = $_POST['lvl'];
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');

        $update_lvl = "UPDATE upti_users SET users_level = '$lvl' WHERE users_id = '$id'";
        $update_qry = mysqli_query($connect, $update_lvl);

        $desc = $uid.' has been Upgrade Account into Level '.$lvl;

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$time', '$datenow', '$uid', 'Upgrade Account', '$desc')";
        $act_qry = mysqli_query($connect, $act);

        echo "<script>alert('Upgrade Account Successfully');window.location.href = '../225290563.php';</script>";
    }

?>