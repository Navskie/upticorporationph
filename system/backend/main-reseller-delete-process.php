<?php
    include '../dbms/conn.php';

    session_start();

    $id = $_GET['id'];
    $uid = $_SESSION['uid'];

    $get_password = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $get_password_qry = mysqli_query($connect, $get_password);
    $get_password_fetch = mysqli_fetch_array($get_password_qry);

    $mypassword = $get_password_fetch['users_password'];

    if(isset($_POST['deletemain'])) {
        $pass = $_POST['pass'];

        if ($pass == $mypassword) {
            $get_code = "SELECT * FROM upti_reseller WHERE id = '$id'";
            $get_code_qry = mysqli_query($connect, $get_code);
            $get_code_fetch = mysqli_fetch_array($get_code_qry);

            $delete_code = $get_code_fetch['reseller_code'];

            $delete_reseller = "DELETE FROM upti_users WHERE users_code = '$delete_code'";
            $delete_reseller_qry = mysqli_query($connect, $delete_reseller);

            $delete_info = "DELETE FROM upti_reseller WHERE id = '$id'";
            $delete_qry = mysqli_query($connect, $delete_info);

            echo "<script>alert('Data has been Deleted successfully.');window.location.href = '../reseller-main-list.php';</script>";
        } else {
            echo "<script>alert('Incorrect Password.');window.location.href = '../reseller-main-list.php';</script>";
        }
    }
?>