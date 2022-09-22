<?php
    $year = date('Y');
    $years = substr( $year, -2);
    $creator_id = $_SESSION['uid'];

    $creator_code = $_SESSION['code'];

    $get_admin1 = "SELECT * FROM upti_users WHERE users_code = '$creator_code'";
    $get_admin_qry1 = mysqli_query($connect, $get_admin1);
    $get_admin_fetch1 = mysqli_fetch_array($get_admin_qry1);

    $admin_code = $get_admin_fetch1['users_creator'];

    $get_admin1 = "SELECT * FROM upti_users WHERE users_code = '$admin_code'";
    $get_admin_qry1 = mysqli_query($connect, $get_admin1);
    $get_admin_fetch1 = mysqli_fetch_array($get_admin_qry1);

    $admin_code1 = $get_admin_fetch1['users_creator'];

    $series2 = "SELECT * FROM upti_series WHERE remark = 'osr'";
    $series2_qry = mysqli_query($connect, $series2);
    $series2_fetch = mysqli_fetch_array($series2_qry);

    $get_series_2 = $series2_fetch['series'];
    
    $referal_code = 'OSR-'.$creator_id.$get_series_2;

    $today = date('m-d-Y');

    if (isset($_POST['osr'])) {

        $account_name = $_POST['rname'];
        $account_mobile = $_POST['rmobile'];
        $account_email = $_POST['remail'];
        $account_user = $_POST['ruser'];
        $account_address = $_POST['raddress'];

        $get_user = "SELECT * FROM upti_users WHERE users_username = '$account_user'";
        $get_user_qry = mysqli_query($connect, $get_user);
        $get_user_num = mysqli_num_rows($get_user_qry);

        if ($get_user_num == 0) {
            $reseller_account = "INSERT INTO upti_osr (osr_name, osr_mobile, osr_address, osr_code, osr_status, osr_date, osr_main) VALUES ('$account_name', '$account_mobile', '$account_address', '$referal_code', 'Active', '$today', '$creator_code')";
            $reseller_account_qry = mysqli_query($connect, $reseller_account);

            $reseller_users = "INSERT INTO upti_users (users_name, users_username, users_password, users_role, users_status, users_code, users_main, users_creator, users_admin) VALUES ('$account_name', '$account_user', '123456', 'UPTIOSR', 'Active', '$referal_code', '$creator_code', '$creator_code', '$admin_code1')";
            $reseller_users_qry = mysqli_query($connect, $reseller_users);

            $new_series = $get_series_2 + 1;
            $add_series = "UPDATE upti_series SET series = '$new_series' WHERE remark = 'osr'";
            $add_series_qry = mysqli_query($connect, $add_series);

            echo "<script>alert('Data has been Added successfully.');window.location.href = 'account-OSR.php';</script>";
        } else {
            echo "<script>alert('Username Already Exist.');window.location.href = 'account-OSR.php';</script>";
        }

    }
?>
<div class="modal fade" id="osr">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">OSR Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="account-OSR.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Full Name:</label>
                    <input type="text" class="form-control" name="rname" autocomplete="off">
                </div>
                <div class="col-6">
                    <label for="">Mobile:</label>
                    <input type="text" class="form-control" name="rmobile" autocomplete="off">
                </div>
                <div class="col-6">
                    <label for="">Email:</label>
                    <input type="text" class="form-control" name="remail" autocomplete="off">
                </div>
                <div class="col-6">
                    <label for="">Username:</label>
                    <input type="text" class="form-control" name="ruser" autocomplete="off">
                </div>
                <div class="col-6">
                    <label for="">Password:</label>
                    <input type="text" class="form-control" name="rpassword" disabled placeholder="Default Password 123456">
                </div>
                <div class="col-12">
                    <label for="">Address:</label>
                    <textarea name="raddress" id="" cols="10" rows="5" class="form-control" autocomplete="off"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="osr">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>