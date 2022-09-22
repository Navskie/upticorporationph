<?php
    include '../dbms/conn.php';

    session_start();

    $id = $_GET['id'];
    $uid = $_SESSION['uid'];

    $get_password = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $get_password_qry = mysqli_query($connect, $get_password);
    $get_password_fetch = mysqli_fetch_array($get_password_qry);

    $mypassword = $get_password_fetch['users_password'];

    if(isset($_POST['deletelevel'])) {
        $pass = $_POST['pass'];

        if ($pass == $mypassword) {
            $delete_info = "DELETE FROM upti_level WHERE id = '$id'";
            $delete_qry = mysqli_query($connect, $delete_info);

            echo "<script>alert('Data has been Deleted successfully.');window.location.href = '../level2203.php';</script>";
        } else {
            echo "<script>alert('Incorrect Password.');window.location.href = '../level2203.php';</script>";
        }
    }
?>