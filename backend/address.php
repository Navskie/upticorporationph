<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $profile = $_SESSION['code'];

    if(isset($_POST['address'])) {
        $house = $_POST['house'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $province = $_POST['province'];

        $address_stmt = mysqli_query($connect, "INSERT INTO web_address (
            add_uid,
            add_house,
            add_city,
            add_province,
            add_barangay,
            add_date
        ) VALUES (
            '$profile',
            '$house',
            '$city',
            '$province',
            '$barangay',
            '$date'
        )");

        flash("success", "Address has been added successfully");
        header('location: ../cart.php');
    }
?>