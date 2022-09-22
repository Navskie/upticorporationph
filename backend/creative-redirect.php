<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $code = $_GET['id'];

    $package_stmt = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$code'");
    if (mysqli_num_rows($package_stmt) == 1) {
        header("location: ../creatives-update-bundle.php?code=$code");
    } else {
        header("location: ../creatives-update.php?code=$code");
    }
?>