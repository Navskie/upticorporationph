<?php
    include '../dbms/conn.php';

    session_start();

    $id = $_GET['id'];

    $uid = $_SESSION['uid'];
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];

    date_default_timezone_set('Asia/Manila');
    $time = date("h:m:i");
    $datenow = date('m-d-Y');

    if (isset($_POST['country'])) {

        $code = $_POST['code'];
        $country = $_POST['countrys'];
        $prices = $_POST['price'];
        $php = $_POST['php'];
        $stats = $_POST['stats'];

        $check_country = "SELECT * FROM upti_country WHERE id = '$id'";
        $check_country_qry = mysqli_query($connect, $check_country);
        $check_fetch = mysqli_fetch_array($check_country_qry);

        $real_country = $check_fetch['country_name'];
        $real_code = $check_fetch['country_code'];
        $current_price = $check_fetch['country_price'];
        $php_current_price = $check_fetch['country_total_php'];

        if ($real_country != $country && $real_code != $code) {
            $check_country = "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$code'";
            $check_country_qry = mysqli_query($connect, $check_country);
            $check_num = mysqli_num_rows($check_country_qry);

            if ($check_num == 0) {
                $epayment_process = "UPDATE upti_country SET country_total_php = '$php', country_name = '$country', country_code = '$code', country_price = '$prices' WHERE id = '$id'";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);

                $desc = $namex.' Update Information and price ['.$current_price.']'.$real_country.' change to ['.$prices.'] and ['.$php_current_price.']PHILIPPINES change to ['.$php.'] item code of '.$code;

                // HISTORY
                $act = "INSERT INTO upti_activities (activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$time', '$datenow', '$namex', 'Update Country Price', '$desc')";
                $act_qry = mysqli_query($connect, $act);

                echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-country.php';</script>";
            } else {
                echo "<script>alert('Invalid Country.');window.location.href = '../item-country.php';</script>";
            }
        } else {
            $desc = $namex.' Update Information and price ['.$current_price.']'.$real_country.' change to ['.$prices.'] and ['.$php_current_price.']PHILIPPINES change to ['.$php.'] item code of '.$code;

            // HISTORY
            $act = "INSERT INTO upti_activities (activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$time', '$datenow', '$namex', 'Update Country Price', '$desc')";
            $act_qry = mysqli_query($connect, $act);

            $epayment_process = "UPDATE upti_country SET country_total_php = '$php', country_name = '$country', country_code = '$code', country_price = '$prices' WHERE id = '$id'";
            $epayment_process_qry = mysqli_query($connect, $epayment_process);

            echo "<script>alert('Data has been Updated successfully.');window.location.href = '../item-country.php';</script>";
        }

    }
?>