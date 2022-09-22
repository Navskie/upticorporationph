<?php

    $role = $_SESSION['role'];

    if ($role == 'UPTIRESELLER') {

?>
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
 
    if (isset($_POST['reseller'])) {

        $account_name = $_POST['rname'];
        $account_mobile = $_POST['rmobile'];
        $account_email = $_POST['remail'];
        $account_user = $_POST['ruser'];
        $address = $_POST['raddress'];
        $account_address = str_replace("'", "\'", $address);
        $pack_code = $_POST['pack'];
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

            echo "<script>alert('Duplicate Username Please Try Again');window.location.href = 'account-reseller.php';</script>";

        } else {
            if ($countryniya == '' || $pack_code == '' || $account_address == '' || $mod == '') {
                echo "<script>alert('All fields are required.');window.location.href = 'account-reseller.php';</script>";
            } else {

                $get_package = "SELECT * FROM upti_package WHERE package_code = '$pack_code'";
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

                $get_package = "SELECT * FROM upti_package WHERE package_code = '$pack_code'";
                $get_package_qry = mysqli_query($connect, $get_package);
                $get_package_num = mysqli_num_rows($get_package_qry);
                $get_package_fetch = mysqli_fetch_array($get_package_qry);
            
                    if ($get_package_num > 0) {
                        // Package Check
                        $c1 = $get_package_fetch['package_one_code'];
                        $oq1 = $get_package_fetch['package_one_qty'];
                        $q1 = 1 * $oq1;
            
                        $c2 = $get_package_fetch['package_two_code'];
                        $oq2 = $get_package_fetch['package_two_qty'];
                        $q2 = 1 * $oq2;
            
                        $c3 = $get_package_fetch['package_three_code'];
                        $oq3 = $get_package_fetch['package_three_qty'];
                        $q3 = 1 * $oq3;
            
                        $c4 = $get_package_fetch['package_four_code'];
                        $oq4 = $get_package_fetch['package_four_qty'];
                        $q4 = 1 * $oq4;
            
                        $c5 = $get_package_fetch['package_five_code'];
                        $oq5 = $get_package_fetch['package_five_qty'];
                        $q5 = 1 * $oq5;
                    
                        // 1
                        $check_stock1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$countryniya'";
                        $check_stock_qry1 = mysqli_query($connect, $check_stock1);
                        $check_stock_fetch1 = mysqli_fetch_array($check_stock_qry1);
                        $check_stock_num1 = mysqli_num_rows($check_stock_qry1);
                        if ($check_stock_num1 == 0) {
                            $stockist_stock1 = 0;
                        } else {
                            $stockist_stock1 = $check_stock_fetch1['si_item_stock'];
                        }
                        // echo '<br>';
                        // 2
                        $check_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$countryniya'";
                        $check_stock_qry2 = mysqli_query($connect, $check_stock2);
                        $check_stock_fetch2 = mysqli_fetch_array($check_stock_qry2);
                        $check_stock_num2 = mysqli_num_rows($check_stock_qry2);
                        if ($check_stock_num2 == 0) {
                            $stockist_stock2 = 0;
                        } else {
                            $stockist_stock2 = $check_stock_fetch2['si_item_stock'];
                        }
                        // echo '<br>';
                        // 3
                        $check_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$countryniya'";
                        $check_stock_qry3 = mysqli_query($connect, $check_stock3);
                        $check_stock_fetch3 = mysqli_fetch_array($check_stock_qry3);
                        $check_stock_num3 = mysqli_num_rows($check_stock_qry3);
                        if ($check_stock_num3 == 0) {
                            $stockist_stock3 = 0;
                        } else {
                            $stockist_stock3 = $check_stock_fetch3['si_item_stock'];
                        }
                        // echo '<br>';
                        // 4
                        $check_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$countryniya'";
                        $check_stock_qry4 = mysqli_query($connect, $check_stock4);
                        $check_stock_fetch4 = mysqli_fetch_array($check_stock_qry4);
                        $check_stock_num4 = mysqli_num_rows($check_stock_qry4);
                        if ($check_stock_num4 == 0) {
                            $stockist_stock4 = 0;
                        } else {
                            $stockist_stock4 = $check_stock_fetch4['si_item_stock'];
                        }
                        // echo '<br>';
                        // 5
                        $check_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$countryniya'";
                        $check_stock_qry5 = mysqli_query($connect, $check_stock5);
                        $check_stock_fetch5 = mysqli_fetch_array($check_stock_qry5);
                        $check_stock_num5 = mysqli_num_rows($check_stock_qry5);
                        if ($check_stock_num5 == 0) {
                            $stockist_stock5 = 0;
                        } else {
                            $stockist_stock5 = $check_stock_fetch5['si_item_stock'];
                        }
                        
                        if ($stockist_stock1 >= $q1 && $stockist_stock2 >= $q2 && $stockist_stock3 >= $q3 && $stockist_stock4 >= $q4 && $stockist_stock5 >= $q5) {
                            // SHIPPING FEE START
                            $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$countryniya'";
                            $shipping_qry = mysqli_query($connect, $shipping_sql);
                            $shipping_fetch = mysqli_fetch_array($shipping_qry);
                            $shipping_num = mysqli_num_rows($shipping_qry);

                            if ($shipping_num < 0 || $mod == 'Cash On Pick Up') {
                                $shipping = 0;
                            } else {
                                $shipping = $shipping_fetch['shipping_price'];
                            }

                            $presyoko = $shipping + $presyo;

                            if ($mod != 'Cash on Pick Up') {

                                if ($stockist_stock1 != 0) {
                                    $new_total_stock = $stockist_stock1 - $q1;

                                    $update_inventory = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock' WHERE si_item_country = '$countryniya' AND si_item_code = '$c1'";
                                    $update_inventory_qry = mysqli_query($connect, $update_inventory);
                                }

                                if ($stockist_stock2 != 0) {
                                    $new_total_stock2 = $stockist_stock2 - $q2;

                                    $update_inventory2 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock' WHERE si_item_country = '$countryniya' AND si_item_code = '$c2'";
                                    $update_inventory_qry2 = mysqli_query($connect, $update_inventory2);
                                }

                                if ($stockist_stock3 != 0) {
                                    $new_total_stock3 = $stockist_stock3 - $q3;

                                    $update_inventory3 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock3' WHERE si_item_country = '$countryniya' AND si_item_code = '$c3'";
                                    $update_inventory_qry3 = mysqli_query($connect, $update_inventory3);
                                }

                                if ($stockist_stock4 != 0) {
                                    $new_total_stock4 = $stockist_stock4 - $q4;

                                    $update_inventory4 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock4' WHERE si_item_country = '$countryniya' AND si_item_code = '$c4'";
                                    $update_inventory_qry4 = mysqli_query($connect, $update_inventory4);
                                }

                                if($stockist_stock5 != 0) {
                                    $new_total_stock5 = $stockist_stock5 - $q5;

                                    $update_inventory5 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock5' WHERE si_item_country = '$customer_country' AND si_item_code = '$c5'";
                                    $update_inventory_qry5 = mysqli_query($connect, $update_inventory5);
                                }
                            }

                            $reseller_account = "INSERT INTO upti_reseller (reseller_fb, reseller_country, reseller_poid, reseller_package, reseller_desc, reseller_amount, reseller_name, reseller_mobile, reseller_address, reseller_code, reseller_status, reseller_date, reseller_main) VALUES ('$fb', '$countryniya', '$referal_code2', '$pack_code', '$pack_desc', '$country_price', '$account_name', '$account_mobile', '$account_address', '$referal_code', 'Pending', '$today', '$creator_code')";
                            $reseller_account_qry = mysqli_query($connect, $reseller_account);
                    
                            $reseller_users = "INSERT INTO upti_users (users_level, users_name, users_username, users_password, users_role, users_status, users_code, users_main, users_creator, users_admin) VALUES ('1', '$account_name', '$account_user', '123456', 'UPTIRESELLER', 'Deactive', '$referal_code', '$creator_code', '$creator_code', '$admin_code1')";
                            $reseller_users_qry = mysqli_query($connect, $reseller_users);

                            $res_trans = "INSERT INTO upti_transaction (trans_ship, trans_mop, trans_date, trans_seller, trans_my_reseller, trans_admin, trans_poid, trans_subtotal, trans_fname, trans_fb, trans_contact, trans_email, trans_address, trans_country, trans_status, trans_img) VALUES ('$shipping', '$mod', '$today', '$creator_code', '$admin_code', '$admin_code1', '$referal_code2', '$presyoko', '$account_name', '$fb', '$account_mobile', '$account_email', '$account_address', '$countryniya', 'Pending', '$new_name')";
                            $res_trans_qyr = mysqli_query($connect, $res_trans);

                            $res_trans1 = "INSERT INTO upti_order_list (ol_country, ol_poid, ol_code, ol_seller, ol_reseller, ol_admin, ol_desc, ol_price, ol_php, ol_qty, ol_points, ol_subtotal, ol_status, ol_date) VALUES ('$countryniya', '$referal_code2', '$pack_code', '$creator_code', '$admin_code', '$admin_code1', '$pack_desc', '$presyo', '$country_php', '1', '$pack_point', '$country_price', 'Pending', '$today')";
                            $res_trans_qyr1 = mysqli_query($connect, $res_trans1);
                    
                            $new_series = $get_series_2 + 1;
                            $add_series = "UPDATE upti_series SET series = '$new_series' WHERE remark = 'referal'";
                            $add_series_qry = mysqli_query($connect, $add_series);

                            $new_series = $counting + 1;

                            $count_series = "UPDATE upti_users SET users_count = '$new_series' WHERE users_id = '$uid'";
                            $countr_series_qry = mysqli_query($connect, $count_series);
                            
                            echo "<script>alert('Data has been Added successfully.');window.location.href = 'account-reseller.php';</script>";
                        } else {
                            echo "<script>alert('Insufficient Stocks to Process Your Order.');window.location.href = 'account-reseller.php';</script>";
                        }
                    }
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
        <form action="account-reseller.php" method="post" enctype="multipart/form-data">
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
                             <option value="<?php echo $product['package_code'] ?>">[<?php echo $product['package_code'] ?>] - <?php echo $product['package_desc'] ?></option>
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
                <div class="col-6">
                    <label for="">Facebook:</label>
                    <input type="text" class="form-control" name="fb" autocomplete="off">
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
                <div class="col-3">
                    <img src="template.png" alt="" class="img-fluid" id="upload-img">
                </div>
                <div class="col-9">
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
        <button class="btn btn-primary" name="reseller">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>
<?php } else { ?>
    <?php
    $year = date('Y');
    $month = date('m');
    $years = substr( $year, -2);

    $uid = $_SESSION['uid'];
    $creator_code = $_SESSION['code'];

    $get_create = "SELECT * FROM upti_users WHERE users_code = '$creator_code'";
    $get_create_qry = mysqli_query($connect, $get_create);
    $get_create_fetch = mysqli_fetch_array($get_create_qry);

    $resellerko = $get_create_fetch['users_creator'];

    $series2 = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $series2_qry = mysqli_query($connect, $series2);
    $series2_fetch = mysqli_fetch_array($series2_qry);

    $get_series_2 = $series2_fetch['users_count'];
    // Referal Code
    $referal_code = 'RS'.$uid.$get_series_2;

    $get_admin1 = "SELECT * FROM upti_users WHERE users_code = '$resellerko'";
    $get_admin_qry1 = mysqli_query($connect, $get_admin1);
    $get_admin_fetch1 = mysqli_fetch_array($get_admin_qry1);

    $admin_code = $get_admin_fetch1['users_admin'];

    $today = date('m-d-Y');

    if (isset($_POST['reseller'])) {

        $account_name = $_POST['rname'];
        $account_mobile = $_POST['rmobile'];
        $account_email = $_POST['remail'];
        $account_user = $_POST['ruser'];
        $address = $_POST['raddress'];
        $account_address = str_replace("'", "\'", $address);
        $pack_code = $_POST['pack'];
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

        $get_package = "SELECT * FROM upti_package WHERE package_code = '$pack_code'";
        $get_package_qry = mysqli_query($connect, $get_package);
        $get_package_fetch = mysqli_fetch_array($get_package_qry);

        $pack_code = $get_package_fetch['package_code'];
        $pack_desc = $get_package_fetch['package_desc'];
        $pack_point = $get_package_fetch['package_points'];

        $check_un = "SELECT * FROM upti_users WHERE users_code = '$referal_code' OR users_username = '$account_user'";
        $check_un_qry = mysqli_query($connect, $check_un);
        $check_un_num = mysqli_num_rows($check_un_qry);

        if ($check_un_num >= 1) {
            echo "<script>alert('Duplicate Username Please Try Again');window.location.href = 'osr-reseller.php';</script>";
        } else {
            if ($countryniya == '' || $pack_code == '' || $account_address == '' || $mod == '') {
                echo "<script>alert('All fields are required.');window.location.href = 'account-reseller.php';</script>";
            } else {

            $get_package = "SELECT * FROM upti_package WHERE package_code = '$pack_code'";
            $get_package_qry = mysqli_query($connect, $get_package);
            $get_package_num = mysqli_num_rows($get_package_qry);
            $get_package_fetch = mysqli_fetch_array($get_package_qry);
        
            if ($get_package_num > 0) {
                // Package Check
                $c1 = $get_package_fetch['package_one_code'];
                $oq1 = $get_package_fetch['package_one_qty'];
                $q1 = 1 * $oq1;
    
                $c2 = $get_package_fetch['package_two_code'];
                $oq2 = $get_package_fetch['package_two_qty'];
                $q2 = 1 * $oq2;
    
                $c3 = $get_package_fetch['package_three_code'];
                $oq3 = $get_package_fetch['package_three_qty'];
                $q3 = 1 * $oq3;
    
                $c4 = $get_package_fetch['package_four_code'];
                $oq4 = $get_package_fetch['package_four_qty'];
                $q4 = 1 * $oq4;
    
                $c5 = $get_package_fetch['package_five_code'];
                $oq5 = $get_package_fetch['package_five_qty'];
                $q5 = 1 * $oq5;
            
                // 1
                $check_stock1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$countryniya'";
                $check_stock_qry1 = mysqli_query($connect, $check_stock1);
                $check_stock_fetch1 = mysqli_fetch_array($check_stock_qry1);
                $check_stock_num1 = mysqli_num_rows($check_stock_qry1);
                if ($check_stock_num1 == 0) {
                    $stockist_stock1 = 0;
                } else {
                    $stockist_stock1 = $check_stock_fetch1['si_item_stock'];
                }
                // echo '<br>';
                // 2
                $check_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$countryniya'";
                $check_stock_qry2 = mysqli_query($connect, $check_stock2);
                $check_stock_fetch2 = mysqli_fetch_array($check_stock_qry2);
                $check_stock_num2 = mysqli_num_rows($check_stock_qry2);
                if ($check_stock_num2 == 0) {
                    $stockist_stock2 = 0;
                } else {
                    $stockist_stock2 = $check_stock_fetch2['si_item_stock'];
                }
                // echo '<br>';
                // 3
                $check_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$countryniya'";
                $check_stock_qry3 = mysqli_query($connect, $check_stock3);
                $check_stock_fetch3 = mysqli_fetch_array($check_stock_qry3);
                $check_stock_num3 = mysqli_num_rows($check_stock_qry3);
                if ($check_stock_num3 == 0) {
                    $stockist_stock3 = 0;
                } else {
                    $stockist_stock3 = $check_stock_fetch3['si_item_stock'];
                }
                // echo '<br>';
                // 4
                $check_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$countryniya'";
                $check_stock_qry4 = mysqli_query($connect, $check_stock4);
                $check_stock_fetch4 = mysqli_fetch_array($check_stock_qry4);
                $check_stock_num4 = mysqli_num_rows($check_stock_qry4);
                if ($check_stock_num4 == 0) {
                    $stockist_stock4 = 0;
                } else {
                    $stockist_stock4 = $check_stock_fetch4['si_item_stock'];
                }
                // echo '<br>';
                // 5
                $check_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$countryniya'";
                $check_stock_qry5 = mysqli_query($connect, $check_stock5);
                $check_stock_fetch5 = mysqli_fetch_array($check_stock_qry5);
                $check_stock_num5 = mysqli_num_rows($check_stock_qry5);
                if ($check_stock_num5 == 0) {
                    $stockist_stock5 = 0;
                } else {
                    $stockist_stock5 = $check_stock_fetch5['si_item_stock'];
                }
                

                if ($stockist_stock1 >= $q1 && $stockist_stock2 >= $q2 && $stockist_stock3 >= $q3 && $stockist_stock4 >= $q4 && $stockist_stock5 >= $q5) {
                    $get_pack_price = "SELECT * FROM upti_country WHERE country_code = '$pack_code' AND country_name = '$countryniya'";
                    $get_price_qry = mysqli_query($connect, $get_pack_price);
                    $get_price = mysqli_fetch_array($get_price_qry);

                    $presyo = $get_price['country_price'];
                    $presyos = $get_price['country_total_php'];

                    // SHIPPING FEE START
                    $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$countryniya'";
                    $shipping_qry = mysqli_query($connect, $shipping_sql);
                    $shipping_fetch = mysqli_fetch_array($shipping_qry);
                    $shipping_num = mysqli_num_rows($shipping_qry);

                    if ($shipping_num < 0 || $mod == 'Cash On Pick Up') {
                        $shipping = 0;
                    } else {
                        $shipping = $shipping_fetch['shipping_price'];
                    }

                    $presyoko = $shipping + $presyo;

                        $reseller_account = "INSERT INTO upti_reseller (reseller_country, reseller_osr, reseller_poid, reseller_package, reseller_desc, reseller_amount, reseller_name, reseller_mobile, reseller_address, reseller_code, reseller_status, reseller_date, reseller_main) VALUES ('$countryniya', '$creator_code', '$referal_code', '$pack_code', '$pack_desc', '$presyos', '$account_name', '$account_mobile', '$account_address', '$referal_code', 'Pending', '$today', '$resellerko')";
                    $reseller_account_qry = mysqli_query($connect, $reseller_account);

                    $reseller_users = "INSERT INTO upti_users (users_level, users_name, users_username, users_password, users_role, users_status, users_code, users_main, users_creator, users_admin, users_inviter) VALUES ('1', '$account_name', '$account_user', '123456', 'UPTIRESELLER', 'Deactive', '$referal_code', '$resellerko', '$resellerko', '$admin_code', '$creator_code')";
                    $reseller_users_qry = mysqli_query($connect, $reseller_users);

                    $res_trans = "INSERT INTO upti_transaction (trans_ship, trans_mop, trans_date, trans_seller, trans_my_reseller, trans_admin, trans_poid, trans_subtotal, trans_fname, trans_fb, trans_contact, trans_email, trans_address, trans_country, trans_status, trans_img) VALUES ('$shipping','$mod', '$today', '$creator_code', '$resellerko', '$admin_code', '$referal_code', '$presyo', '$account_name', '$fb', '$account_mobile', '$account_email', '$account_address', '$countryniya', 'Pending', '$new_name')";
                    $res_trans_qyr = mysqli_query($connect, $res_trans);

                    $res_trans1 = "INSERT INTO upti_order_list (ol_country, ol_poid, ol_code, ol_seller, ol_reseller, ol_admin, ol_desc, ol_price, ol_php, ol_qty, ol_points, ol_subtotal, ol_status, ol_date) VALUES ('$countryniya', '$referal_code', '$pack_code', '$creator_code', '$resellerko', '$admin_code', '$pack_desc', '$presyo', '$presyos', '1', '$pack_point', '$presyo', 'Pending', '$today')";
                    $res_trans_qyr1 = mysqli_query($connect, $res_trans1);

                    $new_series = $get_series_2 + 1;
                    $add_series = "UPDATE upti_users SET users_count = '$new_series' WHERE users_id = '$uid'";
                    $add_series_qry = mysqli_query($connect, $add_series);

                    echo "<script>alert('OSR Reseller Data has been Added successfully.');window.location.href = 'osr-reseller.php';</script>";
                } else {
                    echo "<script>alert('Insufficient Stocks to Process Your Order.');window.location.href = 'osr-reseller.php';</script>";
                }
            }
        }
    }
        
    }
?>
<div class="modal fade" id="reseller">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">OSR Reseller Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="osr-reseller.php" method="post" enctype="multipart/form-data">
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
                            <option value="<?php echo $product['package_code'] ?>">[<?php echo $product['package_code'] ?>] - <?php echo $product['package_desc'] ?></option>
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
                <div class="col-6">
                    <label for="">Facebook:</label>
                    <input type="text" class="form-control" name="fb" autocomplete="off">
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
                <div class="col-3">
                    <img src="template.png" alt="" class="img-fluid" id="upload-img">
                </div>
                <div class="col-9">
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
        <button class="btn btn-primary" name="reseller">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>
<?php } ?>
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