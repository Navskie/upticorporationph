<?php
    include '../dbms/conn.php';

    session_start();

    $creator_id = $_SESSION['uid'];
    $today_now = date('m-d-Y');

    $get_mythings = "SELECT * FROM upti_users WHERE users_id = '$creator_id'";
    $get_mythings_qry = mysqli_query($connect, $get_mythings);
    $get_mythings_fetch = mysqli_fetch_array($get_mythings_qry);

    $series = $get_mythings_fetch['users_count'];

    $year = date('Y');

    $csid = $year.$creator_id.$series;
    $poid = 'PD'.$creator_id.'-'.$series;

    $GET_ID = $_GET['id'];

    $get_data = "SELECT * FROM upti_transaction WHERE id = '$GET_ID'";
    $get_data_sql = mysqli_query($connect, $get_data);
    $get_data_fetch = mysqli_fetch_array($get_data_sql);

    $firstname = $get_data_fetch['trans_fname'];
    $middlename = $get_data_fetch['trans_cname'];
    $lastname = $get_data_fetch['trans_lname'];
    $fb = $get_data_fetch['trans_fb'];
    $email = $get_data_fetch['trans_email'];
    $mobile = $get_data_fetch['trans_contact'];
    $address = $get_data_fetch['trans_address'];
    $country = $get_data_fetch['trans_country'];
    $reseller = $get_data_fetch['trans_my_reseller'];
    $admin = $get_data_fetch['trans_admin'];
    $manager = $get_data_fetch['trans_manager'];
    $leader = $get_data_fetch['trans_leader'];
    $seller = $get_data_fetch['trans_seller'];
    $customer_id = $get_data_fetch['trans_csid'];

    if ($customer_id === '') {
      $customer_id = $csid;
    } else {
      $customer_id = $get_data_fetch['trans_csid'];
    }

    $get_data1 = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
    $get_data_sql1 = mysqli_query($connect, $get_data1);
    $get_num_rows = mysqli_fetch_array($get_data_sql1);
    if ($get_num_rows >= 1) {
      echo "<script>alert('Please clear your new order information first');window.location.href = '../order-list.php';</script>";
    } else {
      $epayment_process = "INSERT INTO upti_transaction (trans_csid, trans_status, trans_fname, trans_cname, trans_lname, trans_fb, trans_email, trans_contact, trans_address, trans_country, trans_poid, trans_date, trans_my_reseller, trans_admin, trans_manager, trans_leader, trans_seller) VALUES ('$customer_id', 'On Order', '$firstname', '$middlename', '$lastname', '$fb', '$email', '$mobile', '$address', '$country', '$poid', '$today_now', '$reseller', '$admin', '$manager', '$leader', '$seller')";
      $epayment_process_qry = mysqli_query($connect, $epayment_process);

      $trans_update = mysqli_query($connect, "UPDATE upti_transaction SET trans_csid = '$customer_id' WHERE trans_fname = '$firstname'");

      echo "<script>window.location.href = '../order-list.php';</script>";
    }

?>