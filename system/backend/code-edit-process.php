<?php
    include '../dbms/conn.php';
    
    date_default_timezone_set('Asia/Manila');
    $date = date('m-d-Y');
    $time = time();
    
    session_start();
    
    $my_name = $_SESSION['code'];

    $id = $_GET['id'];

    if (isset($_POST['code'])) {

        $name = $_POST['name'];
        $status = $_POST['status'];
        $category = $_POST['category'];
        $main = $_POST['maincode'];
        $combo = $_POST['combo'];

        $check_fee = "SELECT * FROM upti_code WHERE id = '$id'";
        $check_fee_qry = mysqli_query($connect, $check_fee);
        $check_fetch = mysqli_fetch_array($check_fee_qry);

        $remain_code = $check_fetch['code_name'];

        if($remain_code == $name) {
            $status_change = "UPDATE upti_code SET code_status = '$status', code_category = '$category', code_main = '$main', code_exclusive = '$combo' WHERE id = '$id'";
            $status_qry = mysqli_query($connect, $status_change);

            echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-code.php';</script>";
        } else {
            $code_check = "SELECT * FROM upti_code WHERE code_name = '$name'";
            $code_check_qry = mysqli_query($connect, $code_check);
            $code_num = mysqli_num_rows($code_check_qry);

            if ($code_num == 1) {
                echo "<script>alert('Duplicate Code is not allowed.');window.location.href = '../item-code.php';</script>";
            } else {
                $status_change = "UPDATE upti_code SET code_status = '$status', code_name = '$name', code_category = '$category', code_main = '$main', code_exclusive = '$combo' WHERE id = '$id'";
                $status_qry = mysqli_query($connect, $status_change);
            }

            echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-code.php';</script>";
        }
        
        $remarks = "CODE ".$name." HAS BEEN UPDATE BY ".$my_name;
            
        $history = "INSERT INTO upti_activities 
        (
        activities_poid,
        activities_time,
        activities_date,
        activities_name,
        activities_caption,
        activities_desc
        ) VALUES (
        '$name',
        '$time',
        '$date',
        '$my_name',
        'UPDATE',
        '$remarks'
        )";
        $history_qry = mysqli_query($connect, $history);

    }
?>