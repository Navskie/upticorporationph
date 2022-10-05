<?php

  session_start(); 
  include 'function.php'; 
  include 'include/db.php';

  $id = $_SESSION['uid'];

  $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
  $fetch_count = mysqli_fetch_array($user_info);
  $user_count = $fetch_count['users_count'];
  $ref = 'CS'.$id.'-22'.$user_count;

  if (isset($_POST['discount'])) {
    echo $dis_code = $_POST['reseller'];

    // $check_reseller = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$dis_code'");
    // $num = mysqli_num_rows($check_reseller);
    // if ($num > 0) {
    //   flash("warn", "Invalid Discount Code");
    //   header('location: cart.php');
    // } else {
    //   $added_discount = mysqli_query($connect, "UPDATE web_transaction SET trans_cdiscount = 'Discounted' WHERE trans_ref = '$ref'");

    //   flash("success", "Discount Code has been added");
    //   header('location: cart.php');
    // }

  }
?>