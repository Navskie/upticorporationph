<?php
    include '../dbms/conn.php';

    session_start();

    $id = $_GET['id'];

    $uid = $_SESSION['uid'];

    $get_pass = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $get_pass_qry = mysqli_query($connect, $get_pass);
    $get_password = mysqli_fetch_array($get_pass_qry);

    $my_password = $get_password['users_password'];

    $get_stock = "SELECT * FROM upti_items WHERE id = '$id'";
    $get_stock_qry = mysqli_query($connect, $get_stock);
    $get_stock_fetch = mysqli_fetch_array($get_stock_qry);

    $my_stock = $get_stock_fetch['items_stock'];
    $my_code = $get_stock_fetch['items_code'];
    // echo '<br>';

    if (isset($_POST['stock'])) {

        $stk = $_POST['stocks'];
        // echo '<br>';
        $pass = $_POST['password'];

        if ($pass == $my_password) {
            $total_stock = (int)$my_stock + (int)$stk;
            // echo '<br>';
            $update_stock = "UPDATE upti_items SET items_stock = '$total_stock' WHERE id = '$id'";
            $update_qry = mysqli_query($connect, $update_stock);

            $date_today = date("m-d-Y");
            $time = date("h:m:i");
            $name = $_SESSION['code'];
            $desc = $name.' has been added '.$stk.'pcs '.$my_code. ' <b>Total Stocks of ['.$total_stock.']</b>';

            // HISTORY
            $act = "INSERT INTO upti_activities (activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$time', '$date_today', '$name', 'Added Stock', '$desc')";
            $act_qry = mysqli_query($connect, $act);
            
            echo "<script>alert('Stock has been added Successfully.');window.location.href = '../item-list.php';</script>";
        } else {
            echo "<script>alert('Incorrect Password Please try again.');window.location.href = '../item-list.php';</script>";
        }
        
    }
?>