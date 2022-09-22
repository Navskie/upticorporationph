<?php
    include '../dbms/conn.php';
    
    date_default_timezone_set('Asia/Manila');
    $date = date('m-d-Y');

    $osr = $_GET['osr'];

    if (isset($_POST['adsteam'])) {

        $inquiries = $_POST['inquiries'];
        $spent = $_POST['spent'];
        $mtd = $_POST['mtd'];

        $check_ads = "SELECT * FROM upti_inquiries WHERE inq_osr = '$osr' AND inq_date = '$date'";
        $check_ads_qry = mysqli_query($connect, $check_ads);
        $check_ads_fetch = mysqli_fetch_array($check_ads_qry);
        $check_ads_num = mysqli_num_rows($check_ads_qry);

        if ($check_ads_num == 1) {
            if ($spent == '') {
                $spent = $check_ads_fetch['inq_ads'];
            }
            if ($inquiries == '') {
                $inquiries = $check_ads_fetch['inq_number'];
            }
            if ($mtd == '') {
                $mtd = $check_ads_fetch['inq_mtd'];
            }
            
            $history = "UPDATE upti_inquiries SET inq_number = '$inquiries', inq_ads = '$spent', inq_mtd = '$mtd' WHERE inq_osr = '$osr' AND inq_date = '$date'";
            $history_qry = mysqli_query($connect, $history);
        } else {
            $history = "INSERT INTO upti_inquiries (inq_number, inq_ads, inq_osr, inq_mtd, inq_date) VALUES ('$inquiries', '$spent', '$osr', '$mtd', '$date')";
            $history_qry = mysqli_query($connect, $history);
        }
        echo "<script>alert('Data has been Added successfully.');window.location.href = '../ads.php';</script>";
    }
?>