<?php
    session_start();
    include 'function.php';
    include 'include/db.php';

    if(isset($_POST['sign-in'])) {
      $us = $_POST['us'];
      $pw = $_POST['pw'];

      if(empty($us) && empty($pw)) {
        flash("warn", "All fields are required.");
        header('location: login.php');
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
            header('Location: system/uptimain.php');
          } elseif($role == 'UPTIMAINS') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/uptimain.php');
          } elseif($role == 'UPTIHR') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/uptimain.php');
          } elseif($role == 'UPTIRESELLER') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/reseller.php');
          } elseif($role == 'UPTIMANAGER') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/manager.php');
          } elseif($role == 'UPTILEADER') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/teamleader.php');
          } elseif($role == 'UPTIOSR') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/osr.php');
          } elseif($role == 'UPTICREATIVES') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: creatives.php');
          } elseif($role == 'UPTICSR') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/branch.php');
          } elseif($role == 'SPECIAL') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/admin-reseller.php');
          } elseif($role == 'UPTIACCOUNTING') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/accounting.php');
          } elseif($role == 'IT/Sr Programmer') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/navskie.php');
          } elseif($role == 'BRANCH') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/branch.php');
          } elseif($role == 'ADS') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/ads.php');
          }  elseif($role == 'LOGISTIC') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/logistic.php');
          }  elseif($role == 'DHL') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/dhl.php');
          }  elseif($role == 'Customer') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: shop.php');
          } elseif($role == 'WEBSITE') {
            $_SESSION['status'] = 'valid';
            $_SESSION['uid'] = $check_account_fetch['users_id'];
            $_SESSION['code'] = $check_account_fetch['users_code'];
            $_SESSION['role'] = $check_account_fetch['users_role'];
            header('Location: system/website.php');
          }

          
        } else {
        flash('warn', 'Username and Password not match.');
        header('location: login.php');
        }
      }
    }

    if (isset($_POST['signup'])) {
      $myuid = uniqid('CS-');
      $us = $_POST['us'];
      $pw = $_POST['pw'];
      $pw2 = $_POST['pw2'];
      $fn = $_POST['fn'];
      $ln = $_POST['ln'];
      $ea = $_POST['ea'];
      $mn = $_POST['mn'];
      $bday = $_POST['bday'];

      $date = date('m-d-Y');

      if ($pw == $pw2) {
        $user_check = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_username = '$us' AND users_status = 'Active'");
        if (mysqli_num_rows($user_check) > 0) {
          flash('warn', 'Username already taken');
          header('location: login.php');
        } else {
          $info_stmt = mysqli_query($connect, "INSERT INTO upti_customer (
            cs_uid,
            cs_fname,
            cs_lname,
            cs_email,
            cs_mobile,
            cs_bday,
            cs_date
          ) VALUES (
            '$myuid',
            '$fn',
            '$ln',
            '$ea',
            '$mn',
            '$bday',
            '$date'
          )
          ");
    
          $fln = $fn.' '.$ln;
    
          $login_stmt = mysqli_query($connect, "INSERT INTO upti_users (
            users_code,
            users_name,
            users_username,
            users_password,
            users_position,
            users_role,
            users_status
          ) VALUES (
            '$myuid',
            '$fln',
            '$us',
            '$pw',
            'Online',
            'Customer',
            'Active'
          )
          ");

          flash('success', 'Account has been registered successfully');
          header('location: login.php');
        }
      } else {
        flash('warn', 'Password not match');
        header('location: login.php');
      }
    }
  ?>