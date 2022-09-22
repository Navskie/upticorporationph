<?php
    session_start();
  include 'function.php';
  include 'dbms/conn.php';

    if(isset($_POST['sign-in'])) {
      $us = $_POST['us'];
      $pw = $_POST['pw'];

      if(empty($us) && empty($pw)) {
        flash("alert", "All fields are required.");
        header('location: index.php');
      } else {
        $check_account = "SELECT * FROM upti_users WHERE users_username = '$us' AND users_password = '$pw' AND users_status = 'Active'";
        $check_account_qry = mysqli_query($connect, $check_account);
        $check_account_fetch = mysqli_fetch_array($check_account_qry);
        $check_account_num = mysqli_num_rows($check_account_qry);

        if($check_account_num == 1) {
          $role = $check_account_fetch['users_role'];
          if($role == 'UPTIMAIN') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: uptimain.php');
          } elseif($role == 'UPTIRESELLER') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: reseller.php');
          } elseif($role == 'UPTIMANAGER') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: manager.php');
          } elseif($role == 'UPTILEADER') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: teamleader.php');
          } elseif($role == 'UPTIOSR') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: osr.php');
          } elseif($role == 'UPTICREATIVES') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: ma-announcement.php');
          } elseif($role == 'UPTICSR') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: branch.php');
          } elseif($role == 'SPECIAL') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: admin-reseller.php');
          } elseif($role == 'UPTIACCOUNTING') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: accounting.php');
          } elseif($role == 'IT/Sr Programmer') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: navskie.php');
          } elseif($role == 'BRANCH') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: branch.php');
          } elseif($role == 'ADS') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: ads.php');
          }  elseif($role == 'LOGISTIC') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: logistic.php');
          }  elseif($role == 'DHL') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: dhl.php');
          }
        } else {
        flash('warn', 'Username and Password not match.');
        header('location: index.php');
        }
      }
    }
  ?>