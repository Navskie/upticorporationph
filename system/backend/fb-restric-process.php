<?php
    include '../dbms/conn.php';
    
    session_start();
    $uid = $_SESSION['uid'];

    $id = $_GET['id'];

    if (isset($_POST['restrict'])) {
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');

         // INVENTORY REPORT
        $inv_report = "UPDATE upti_page SET page_status = 'Restrict', page_time = '$time', page_date = '$datenow' WHERE id = '$id'";
        $inv_report_qry = mysqli_query($connect, $inv_report);
    ?>
        <script>alert('Facebook Page has been set to Restrict');window.location.href = '../fb-page.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>