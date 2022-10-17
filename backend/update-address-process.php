<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_GET['id'];

    $date = date('m-d-Y');

    if (isset($_POST['address'])) {
        $house = $_POST['house'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $state = $_POST['state'];

        $trans_cancel_stmt = mysqli_query($connect, "UPDATE web_address SET 
            add_house = '$house',
            add_barangay = '$barangay',
            add_city = '$city',
            add_province = '$province',
            add_state = '$state'
        WHERE id = '$id'");

        flash("success", "Address has been updated successfully");
        header('location: ../profile.php');
    }

?>