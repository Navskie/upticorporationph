<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_SESSION['uid'];
    $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
    $fetch_count = mysqli_fetch_array($user_info);
    $user_count = $fetch_count['users_count'];
    $ref = 'CS'.$id.'-22'.$user_count;

    $profile = $_SESSION['code'];

    if (isset($_POST['COD'])) {

        $cod_stmt = mysqli_query($connect, "SELECT * FROM web_transaction WHERE trans_ref = '$ref'");
        if (mysqli_num_rows($cod_stmt) > 0) {
            $update_cod = mysqli_query($connect, "UPDATE web_transaction SET trans_mop = 'Cash On Delivery' WHERE trans_ref = '$ref'");

            flash("success", "Payment Method has been updated successfully");
            header('location: ../cart.php');
        } else {
            $cs_info = mysqli_query($connect, "SELECT * FROM upti_customer WHERE cs_uid = '$profile'");
            $cs_fetch = mysqli_fetch_array($cs_info);

            $fname = $cs_fetch['cs_fname'];
            $lname = $cs_fetch['cs_lname'];
            $name = $fname.' '.$lname;
            $email = $cs_fetch['cs_email'];
            $mobile = $cs_fetch['cs_mobile'];

            $add_info = mysqli_query($connect, "INSERT INTO web_transaction (
                trans_ref,
                trans_id,
                trans_name,
                trans_email,
                trans_country,
                trans_mobile,
                trans_mop
            ) VALUES (
                '$ref',
                '$profile',
                '$name',
                '$email',
                '$customer_country',
                '$mobile',
                'Cash On Delivery'
            )");

            flash("success", "Payment Method has been added successfully");
            header('location: ../cart.php');
        }
    }

    if (isset($_POST['COP'])) {

        $cod_stmt = mysqli_query($connect, "SELECT * FROM web_transaction WHERE trans_ref = '$ref'");
        if (mysqli_num_rows($cod_stmt) > 0) {
            $update_cod = mysqli_query($connect, "UPDATE web_transaction SET trans_mop = 'Cash On Pick Up' WHERE trans_ref = '$ref'");

            flash("success", "Payment Method has been updated successfully");
            header('location: ../cart.php');
        } else {
            $cs_info = mysqli_query($connect, "SELECT * FROM upti_customer WHERE cs_uid = '$profile'");
            $cs_fetch = mysqli_fetch_array($cs_info);

            $fname = $cs_fetch['cs_fname'];
            $lname = $cs_fetch['cs_lname'];
            $name = $fname.' '.$lname;
            $email = $cs_fetch['cs_email'];
            $mobile = $cs_fetch['cs_mobile'];

            $add_info = mysqli_query($connect, "INSERT INTO web_transaction (
                trans_ref,
                trans_id,
                trans_name,
                trans_email,
                trans_country,
                trans_mobile,
                trans_mop
            ) VALUES (
                '$ref',
                '$profile',
                '$name',
                '$email',
                '$customer_country',
                '$mobile',
                'Cash On Pick Up'
            )");

            flash("success", "Payment Method has been added successfully");
            header('location: ../cart.php');
        }
    }

    if (isset($_POST['BANK'])) {

        $cod_stmt = mysqli_query($connect, "SELECT * FROM web_transaction WHERE trans_ref = '$ref'");
        if (mysqli_num_rows($cod_stmt) > 0) {
            $update_cod = mysqli_query($connect, "UPDATE web_transaction SET trans_mop = 'Payment First' WHERE trans_ref = '$ref'");

            flash("success", "Payment Method has been updated successfully");
            header('location: ../cart.php');
        } else {
            $cs_info = mysqli_query($connect, "SELECT * FROM upti_customer WHERE cs_uid = '$profile'");
            $cs_fetch = mysqli_fetch_array($cs_info);

            $fname = $cs_fetch['cs_fname'];
            $lname = $cs_fetch['cs_lname'];
            $name = $fname.' '.$lname;
            $email = $cs_fetch['cs_email'];
            $mobile = $cs_fetch['cs_mobile'];

            $add_info = mysqli_query($connect, "INSERT INTO web_transaction (
                trans_ref,
                trans_id,
                trans_name,
                trans_email,
                trans_country,
                trans_mobile,
                trans_mop
            ) VALUES (
                '$ref',
                '$profile',
                '$name',
                '$email',
                '$customer_country',
                '$mobile',
                'Payment First'
            )");

            flash("success", "Payment Method has been added successfully");
            header('location: ../cart.php');
        }
    }
?>
