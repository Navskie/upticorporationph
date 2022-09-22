<?php
    $year = date('Y');
    $month = date('m');
    $years = substr( $year, -2);

    $uid = $_SESSION['uid'];
    $creator_code = $_SESSION['code'];
    
    $get_admin = "SELECT * FROM upti_users WHERE users_code = '$creator_code'";
    $get_admin_qry = mysqli_query($connect, $get_admin);
    $get_admin_fetch = mysqli_fetch_array($get_admin_qry);

    $admin_code = $get_admin_fetch['users_creator'];
    $counting = $get_admin_fetch['users_count'];

    // $series2 = "SELECT * FROM upti_series WHERE remark = 'referal'";
    // $series2_qry = mysqli_query($connect, $series2);
    // $series2_fetch = mysqli_fetch_array($series2_qry);

    // $get_series_2 = $series2_fetch['series'];
    // Referal Code
    $referal_code = 'S'.$uid.$counting;
    $referal_code2 = 'R'.$uid.$counting;

    $get_admin1 = "SELECT * FROM upti_users WHERE users_code = '$admin_code'";
    $get_admin_qry1 = mysqli_query($connect, $get_admin1);
    $get_admin_fetch1 = mysqli_fetch_array($get_admin_qry1);

    $admin_code1 = $get_admin_fetch1['users_admin'];

    $today = date('m-d-Y');

    if (isset($_POST['resellemainlist'])) {

        $account_name = $_POST['rname'];
        $account_mobile = $_POST['rmobile'];
        $account_email = $_POST['remail'];
        $account_user = $_POST['ruser'];
        $account_address = $_POST['raddress'];
        $pack = $_POST['pack'];
        $countryniya = $_POST['country'];
        $fb = $_POST['fb'];
        $mod = $_POST['mods'];
        $rfile = $_FILES['rfile']['name'];
        $img_size = $_FILES['rfile']['size'];
        $img_tmp = $_FILES['rfile']['tmp_name'];

        $img_ex = pathinfo($rfile, PATHINFO_EXTENSION);
        // echo ($img_ex);
        $img_ex_lc = strtolower($img_ex);

        $allow_ex = array("jpg", "jpeg", "png");

            $new_name = uniqid("W-", true).'.'.$img_ex_lc;
            $img_path_sa_buhay_niya = 'images/payment/'.$new_name;
            move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);
        
        $check_un = "SELECT * FROM upti_users WHERE users_code = '$referal_code' OR users_username = '$account_user'";
        $check_un_qry = mysqli_query($connect, $check_un);
        $check_un_num = mysqli_num_rows($check_un_qry);
        
        if ($check_un_num >= 1) {

            echo "<script>alert('Duplicate Username Please Try Again');window.location.href = 'reseller-main-list.php';</script>";

        } else {
        if ($countryniya == '' || $pack == '' || $account_address == '' || $mod == '') {
            echo "<script>alert('All fields are required.');window.location.href = 'reseller-main-list.php';</script>";
        } else {

            $get_package = "SELECT * FROM upti_package WHERE package_code = '$pack'";
            $get_package_qry = mysqli_query($connect, $get_package);
            $get_package_fetch = mysqli_fetch_array($get_package_qry);
    
            $pack_code = $get_package_fetch['package_code'];
            $pack_desc = $get_package_fetch['package_desc'];
            $pack_point = $get_package_fetch['package_points'];

            $get_pack_price = "SELECT * FROM upti_country WHERE country_code = '$pack_code' AND country_name = '$countryniya'";
            $get_price_qry = mysqli_query($connect, $get_pack_price);
            $get_price = mysqli_fetch_array($get_price_qry);

            $presyo = $get_price['country_price'];
            
            $get_country_sql = "SELECT * FROM upti_country WHERE country_code = '$pack_code'";
            $get_country_qry = mysqli_query($connect, $get_country_sql);
            $get_price = mysqli_fetch_array($get_country_qry);
            
            $country_price = $get_price['country_price'];
            $country_php = $get_price['country_total_php'];
    
            $reseller_account = "INSERT INTO upti_reseller (reseller_fb, reseller_country, reseller_poid, reseller_package, reseller_desc, reseller_amount, reseller_name, reseller_mobile, reseller_address, reseller_code, reseller_status, reseller_date, reseller_main) VALUES ('$fb', '$countryniya', '$referal_code2', '$pack_code', '$pack_desc', '$country_price', '$account_name', '$account_mobile', '$account_address', '$referal_code', 'Pending', '$today', '$creator_code')";
            $reseller_account_qry = mysqli_query($connect, $reseller_account);
    
            $reseller_users = "INSERT INTO upti_users (users_level, users_name, users_username, users_password, users_role, users_status, users_code, users_main, users_creator, users_admin) VALUES ('1', '$account_name', '$account_user', '123456', 'UPTIRESELLER', 'Active', '$referal_code', '$creator_code', '$creator_code', '$admin_code1')";
            $reseller_users_qry = mysqli_query($connect, $reseller_users);

            $res_trans = "INSERT INTO upti_transaction (trans_mop, trans_date, trans_seller, trans_my_reseller, trans_admin, trans_poid, trans_subtotal, trans_fname, trans_fb, trans_contact, trans_email, trans_address, trans_country, trans_status, trans_img) VALUES ('$mod', '$today', '$creator_code', '$admin_code', '$admin_code1', '$referal_code2', '$presyo', '$account_name', '$fb', '$account_mobile', '$account_email', '$account_address', '$countryniya', 'Pending', '$new_name')";
            $res_trans_qyr = mysqli_query($connect, $res_trans);

            $res_trans1 = "INSERT INTO upti_order_list (ol_country, ol_poid, ol_code, ol_seller, ol_reseller, ol_admin, ol_desc, ol_price, ol_php, ol_qty, ol_points, ol_subtotal, ol_status, ol_date) VALUES ('$countryniya', '$referal_code2', '$pack_code', '$creator_code', '$admin_code', '$admin_code1', '$pack_desc', '$country_price', '$country_php', '1', '$pack_point', '$country_price', 'Pending', '$today')";
            $res_trans_qyr1 = mysqli_query($connect, $res_trans1);
    
            $new_series = $get_series_2 + 1;
            $add_series = "UPDATE upti_series SET series = '$new_series' WHERE remark = 'referal'";
            $add_series_qry = mysqli_query($connect, $add_series);

            $new_series = $counting + 1;

            $count_series = "UPDATE upti_users SET users_count = '$new_series' WHERE users_id = '$uid'";
            $countr_series_qry = mysqli_query($connect, $count_series);
    
            echo "<script>alert('Uptimain Reseller has been Added successfully.');window.location.href = 'reseller-main-list.php';</script>";
        }
        
    }

    }
?>
<div class="modal fade" id="reseller">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Reseller Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="reseller-main-list.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Reseller Package</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="pack">
                            <option value="">Select Package</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_package WHERE package_category = 'RESELLER'";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['package_code'] ?>"><?php echo $product['package_desc'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Reseller Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option value="">Select Country</option>
                            <?php
                            $category_sql = "SELECT DISTINCT country_name FROM upti_country";
                            $category_qry = mysqli_query($connect, $category_sql);
                            while ($category = mysqli_fetch_array($category_qry)) {
                            ?>
                            <option value="<?php echo $category['country_name'] ?>"><?php echo $category['country_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="">Full Name:</label>
                    <input type="text" class="form-control" name="rname" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Mobile:</label>
                    <input type="text" class="form-control" name="rmobile" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Email:</label>
                    <input type="text" class="form-control" name="remail" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Username:</label>
                    <input type="text" class="form-control" name="ruser" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Password:</label>
                    <input type="text" class="form-control" name="rpassword" disabled placeholder="Default Password 123456">
                </div>
                <div class="col-12">
                    <label for="">Address:</label>
                    <textarea name="raddress" id="" cols="10" rows="5" class="form-control" autocomplete="off"></textarea>
                </div>
                <div class="col-6">
                    <label for="">Facebook:</label>
                    <input type="text" class="form-control" name="fb" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Mode of Payment</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="mods">
                            <option value="">Select Country</option>
                            <option value="Cash on Pick Up">Cash on Pick Up</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="Payment First">Payment First</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <br>
                    <div class="form-group">
                        <label for="">Upload Receipt</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileuploads" name="rfile">
                            <label class="custom-file-label" for="fileupload">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="resellemainlist">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>
<script src="./js/jquery-latest.min.js"></script>
<script>
	$(function(){
		$("#fileuploads").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
</script>