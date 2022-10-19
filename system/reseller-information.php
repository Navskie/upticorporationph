<?php
    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    $Uid = $_SESSION['uid'];
    $Ucode = $_SESSION['code'];
    $Urole = $_SESSION['role'];

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');

    $count_sql = "SELECT users_reseller, users_role, users_main, users_code, users_main FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);

    $Ucount = $count_fetch['users_reseller'];

    if ($Urole == 'UPTIOSR') {
      $Ureseller = $count_fetch['users_main'];
    } else {
      $Ureseller = $Ucode;
    }

    $poid = 'RS'.$Uid.'-'.$Ucount;

    $month = date('m');

    $reseller_code = 'RS'.$Uid.'-'.$month.$Ucount;

    if (isset($_POST['save'])) {
        $fname = $_POST['fullname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $country = $_POST['country'];

        $reseller_earning = mysqli_query($connect, "INSERT INTO upti_reseller (
          reseller_poid,
          reseller_name,
          reseller_code,
          reseller_email,
          reseller_osr,
          reseller_main,
          reseller_address,
          reseller_mobile,
          reseller_date
        ) VALUES (
          '$poid',
          '$fname',
          '$reseller_code',
          '$email',
          '$Ucode',
          '$Ureseller',
          '$address',
          '$mobile',
          '$date_today'
        )");

        $info = mysqli_query($connect, "INSERT INTO upti_transaction 
            (
                trans_poid,
                trans_fname,
                trans_contact,
                trans_email,
                trans_address,
                trans_country,
                trans_state
            ) VALUES (
                '$poid',
                '$fname',
                '$mobile',
                '$email',
                '$address',
                '$country',
                '$state'
            )
        ");

        flash("success", "Information have been save successfully");
        header('location: osr-reseller.php');
    }
    
    if (isset($_POST['update'])) {
        $fname = $_POST['fullname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $state = $_POST['state'];

        $info = mysqli_query($connect, "UPDATE upti_transaction SET
                trans_fname = '$fname',
                trans_contact ='$mobile',
                trans_email = '$email',
                trans_state = '$state',
                trans_address = '$address',
                trans_country = '$country'
            WHERE trans_poid = '$poid'
        ");

        flash("success", "Information have been updated successfully");
        header('location: osr-reseller.php');
    }
    if (isset($_POST['delete'])) {
        $info = mysqli_query($connect, "DELETE FROM upti_transaction WHERE trans_poid = '$poid'");
        $account = mysqli_query($connect, "DELETE FROM upti_users WHERE users_poid = '$poid'");

        flash("success", "Information have been deleted successfully");
        header('location: osr-reseller.php');
    }
    if (isset($_POST['check'])) {
        $username = $_POST['username'];

        $username_check = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_username = '$username'");
        if (mysqli_num_rows($username_check) < 1) {
            $user_info = mysqli_query($connect, "SELECT trans_fname FROM upti_transaction WHERE trans_poid = '$poid'");
            $user = mysqli_fetch_array($user_info);

            $name = $user['trans_fname'];

            $creator_role = $count_fetch['users_role'];
            if ($creator_role == 'UPTIRESELLER') {
                $code = $count_fetch['users_code'];
            } else {
                $code = $count_fetch['users_main'];
            }

            $account = mysqli_query($connect, "INSERT INTO upti_users (
                users_poid,
                users_code,
                users_level,
                users_username,
                users_password,
                users_inviter,
                users_name,
                users_role,
                users_status,
                users_main,
                users_creator
            ) VALUES (
                '$poid',
                '$reseller_code',
                '1',
                '$username',
                '123456',
                '$Ucode',
                '$name',
                'UPTIRESELLER',
                'Deactive',
                '$code',
                '$code'
            )");

            flash("success", "Information have been deleted successfully");
            header('location: osr-reseller.php');
        } else {
            flash("failed", "Username is not available, please try again");
            header('location: osr-reseller.php');
        }
    }
?>