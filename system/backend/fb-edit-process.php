<?php
    include '../dbms/conn.php';

    $id = $_GET['id'];

    if (isset($_POST['fb'])) {

      $page_name = $_POST['page_name'];
      $newassign = $_POST['newassign'];
      $oldassign = $_POST['oldassign'];

      date_default_timezone_set("Asia/Manila"); 
      $date = date('m-d-Y');
      $time = date('h:i A');

      if ($newassign == '') {
          echo "<script>alert('New Assigned Missing');window.location.href = 'fb-page.php';</script>";
      } else {
          $epayment_process = "UPDATE upti_page SET 
          page_name = '$page_name', 
          page_new = '$newassign', 
          page_old = '$oldassign', 
          page_date = '$date', 
          page_time = '$time' WHERE id = '$id'";
          $epayment_process_qry = mysqli_query($connect, $epayment_process);
          echo "<script>alert('Page has been Updated successfully.');window.location.href = '../fb-page.php';</script>";
      }

    }
?>