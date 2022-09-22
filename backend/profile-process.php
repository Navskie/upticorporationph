<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_SESSION['code'];

    $date = date('m-d-Y');

    if (isset($_POST['info'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $bday = $_POST['bday'];

        $trans_cancel_stmt = mysqli_query($connect, "UPDATE upti_customer SET 
            cs_fname = '$fname',
            cs_lname = '$lname',
            cs_email = '$email',
            cs_mobile = '$mobile',
            cs_bday = '$bday'
        WHERE cs_uid = '$id'");

        flash("success", "Information has been updated successfully");
        header('location: ../profile.php');
    }

?>