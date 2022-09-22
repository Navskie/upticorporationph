<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_GET['price'];

    $get_code = mysqli_query($connect, "SELECT * FROM upti_country WHERE id = '$id'");
    $fetch = mysqli_fetch_array($get_code);

    $code = $fetch['country_code'];
    
    if (isset($_POST['price_update'])) {
        $country = $_POST['country'];
        $price = $_POST['price'];
        $earn = $_POST['earn'];
        $stockist = $_POST['stockist'];

        $update = mysqli_query($connect, "UPDATE upti_country SET
            country_total_php = '$earn',
            country_name = '$country',
            country_price = '$price',
            country_stockist = '$stockist' WHERE id = '$id'
        ");

        flash("success", "Bundle has been updated successfully");
        header('location: ../creatives-update-bundle.php?code='.$code.'');
    }

    if (isset($_POST['price_sg_update'])) {
        $country = $_POST['country'];
        $price = $_POST['price'];
        $earn = $_POST['earn'];
        $stockist = $_POST['stockist'];

        $update = mysqli_query($connect, "UPDATE upti_country SET
            country_total_php = '$earn',
            country_name = '$country',
            country_price = '$price',
            country_stockist = '$stockist' WHERE id = '$id'
        ");

        flash("success", "Bundle has been updated successfully");
        header('location: ../creatives-update.php?code='.$code.'');
    }
?>
