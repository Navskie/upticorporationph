<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $profile = $_SESSION['code'];
    $role = $_SESSION['role'];
    $ref = $_GET['ref'];
    $stamp = $date.' '.$time;

    if(isset($_POST['submit'])) {
        $remarks = $_POST['remarks'];
        
        $name_stmt = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$profile'");
        $name_fetch = mysqli_fetch_array($name_stmt);
        $name = $name_fetch['users_name'];

        if ($role == 'Customer') {
            $remarks = "INSERT INTO upti_remarks (
                remark_poid,
                remark_content,
                remark_name,
                remark_code,
                remark_stamp,
                remark_csr,
                remark_date,
                remark_time
            ) VALUES (
                '$ref',
                '$remarks',
                '$name',
                '$profile',
                '$stamp',
                'Unread',
                '$date',
                '$time'
            )";
            $remarks_qry = mysqli_query($connect, $remarks);
        }

        flash("success", "Address has been added successfully");  
        header('location: ../ref-details.php?ref='.$ref.'');
    }
?>