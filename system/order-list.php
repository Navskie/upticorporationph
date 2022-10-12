<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<style>
    .select2-container--bootstrap4 .select2-selection {
        border-radius: 0px !important;
    }
    .select2-search--dropdown .select2-search__field {
        border-radius: 0px !important;
    }
    .modal-content {
        border-radius: 0px !important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: steelblue">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">  
        <div class="row mb-2"> 
        
        </div><!-- /.row -->     
        <?php 
        
            date_default_timezone_set("Asia/Manila");   
            $date_today = date('m-d-Y');

            $Uid = $_SESSION['uid'];
            $Urole = $_SESSION['role'];
            $Ucode = $_SESSION['code'];
            $Ureseller = $_SESSION['code'];

            $count_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
            $count_qry = mysqli_query($connect, $count_sql);
            $count_fetch = mysqli_fetch_array($count_qry);

            $Ucount = $count_fetch['users_count'];

            if($Urole == 'UPTIOSR') {
                $upline_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
                $upline_qry = mysqli_query($connect, $upline_sql);
                $upline_fetch = mysqli_fetch_array($upline_qry);

                $Ucode = $upline_fetch['users_code'];
                $Ureseller = $upline_fetch['users_main'];
                $Ucount = $upline_fetch['users_count'];
            }
            // Get Users Code & Users Upline Code

            $year = date('Y');

            $poid = 'PD'.$Uid.'-'.$Ucount;
            // Poid Number / Reference Number

            $get_transaction = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
            $get_transaction_qry = mysqli_query($connect, $get_transaction);
            $get_transaction_fetch = mysqli_fetch_array($get_transaction_qry);
            $get_transaction_num = mysqli_num_rows($get_transaction_qry);

            if ($get_transaction_num == 1) {
                $name = $get_transaction_fetch['trans_fname'];
                $address = $get_transaction_fetch['trans_address'];
                $contact = $get_transaction_fetch['trans_contact'];
                $mode_of_payment = $get_transaction_fetch['trans_mop'];
                $customer_country = $get_transaction_fetch['trans_country'];
                $office_check = $get_transaction_fetch['trans_office'];
                $office_state = $get_transaction_fetch['trans_state'];
                $terms = $get_transaction_fetch['trans_terms'];
                $office_check_status = $get_transaction_fetch['trans_office_status'];
                $csid = $get_transaction_fetch['trans_csid'];
            } else {
                $mode_of_payment = '';
                $customer_country = '';
                $name = '';
                $address = '';
                $contact = '';
                $office_check = '';
                $office_state = '';
                $terms = '';
                $office_check_status = '';
                $csid = '';
            }

            if ($csid === '') {
              $csid = $year.$Uid.$Ucount;
            }

            $get_order_list = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid'";
            $get_order_list_qry = mysqli_query($connect, $get_order_list);
            $get_order_list_num = mysqli_num_rows($get_order_list_qry);            
            
        ?>
        <!-- START HERE -->
        <div class="row">
            <!-- First Column Start -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <!-- Customer Information Start -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <h5 class="text-info">Information<span class="float-right">CSID: <?php echo $csid; ?></span></h5>
                        
                        <hr>
                        <form action="order-information.php" method="post">
                            <?php
                                if ($get_transaction_num < 1) {
                            ?>
                            <!-- If Information is NULL -->
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" name="fullname" style="border-radius: 0 !important" required autocomplete="off" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" class="form-control" name="email" style="border-radius: 0 !important" required autocomplete="off" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <label for="">Contact Number</label>
                                <input type="text" class="form-control" name="phone" style="border-radius: 0 !important" required autocomplete="off" placeholder="Mobile/Telephone Number">
                            </div>
                            <div class="form-group">
                                <label for="">Complete Address</label>
                                <textarea id="" cols="30" name="address" rows="2" class="form-control" style="border-radius: 0 !important" placeholder="Complete Address"></textarea>
                            </div>
                            <style>
                                
                            </style>
                            <br>
                            <label for="">Delivery Options</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="asd" id="flexRadioDefault1" value="Direct Mail Box">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Direct Mail Box
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="asd" id="flexRadioDefault1" value="Post Office Pick Up">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Post Office Pick Up
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                              <label>State - <small>[For Canada Order Only]</small></label>
                              <select class="form-control select2bs4" style="width: 100%;" name="state">
                              <option  value="">Select State</option>
                              <?php
                                  $lugar = "SELECT * FROM upti_state";
                                  $lugar_qry = mysqli_query($connect, $lugar);
                                  while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                              ?>
                              <option value="<?php echo $lugar_fetch['state_name'] ?>"><?php echo $lugar_fetch['state_name'] ?></option>
                              <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="country">
                                <option value="">Select Country</option>
                                <?php
                                    $lugar = "SELECT DISTINCT cc_country FROM upti_country_currency";
                                    $lugar_qry = mysqli_query($connect, $lugar);
                                    while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                                ?>
                                <option value="<?php echo $lugar_fetch['cc_country'] ?>"><?php echo $lugar_fetch['cc_country'] ?></option>
                                <?php } ?>
                                </select>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-danger" style="border-radius: 0 !important" name="delete_information" disabled>Delete</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-dark" style="border-radius: 0 !important" name="saveinformation">Save Information</button>
                                    </div>
                                </div>
                            </div>
                            <!-- NULL END -->
                            <?php } else { ?>
                            <!-- If Information is NOT NULL -->
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="fullname" class="form-control" style="border-radius: 0 !important" required autocomplete="off" value="<?php echo $get_transaction_fetch['trans_fname']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control" style="border-radius: 0 !important" required autocomplete="off" value="<?php echo $get_transaction_fetch['trans_email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Contact Number</label>
                                <input type="text" name="phone" class="form-control" style="border-radius: 0 !important" required autocomplete="off" value="<?php echo $get_transaction_fetch['trans_contact']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Complete Address</label>
                                <textarea name="address" id="" cols="30" rows="2" class="form-control" style="border-radius: 0 !important" placeholder="Complete Address"><?php echo $get_transaction_fetch['trans_address']; ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Delivery Options</label>
                                <input type="text" disabled class="form-control" style="border-radius: 0 !important" required autocomplete="off" value="<?php echo $get_transaction_fetch['trans_office']; ?>">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="asd" id="flexRadioDefault1" value="Direct Mail Box">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Direct Mail Box
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="asd" id="flexRadioDefault1" value="Post Office Pick Up">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        Post Office Pick Up
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label>State</label>
                              <select class="form-control select2bs4" style="width: 100%;" name="state">
                              <option  value="<?php echo $get_transaction_fetch['trans_state']; ?>"><?php echo $get_transaction_fetch['trans_state']; ?></option>
                              <?php
                                  $lugar = "SELECT * FROM upti_state";
                                  $lugar_qry = mysqli_query($connect, $lugar);
                                  while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                              ?>
                              <option value="<?php echo $lugar_fetch['state_name'] ?>"><?php echo $lugar_fetch['state_name'] ?></option>
                              <?php } ?>
                              </select>
                            </div>
                            <!-- Change Country Selection base on Order List Count -->  
                            <?php
                                if ($get_order_list_num == 0) {
                            ?>
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="country">
                                <option  value="<?php echo $get_transaction_fetch['trans_country']; ?>"><?php echo $get_transaction_fetch['trans_country']; ?></option>
                                <?php
                                    $lugar = "SELECT DISTINCT cc_country FROM upti_country_currency";
                                    $lugar_qry = mysqli_query($connect, $lugar);
                                    while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                                ?>
                                <option value="<?php echo $lugar_fetch['cc_country'] ?>"><?php echo $lugar_fetch['cc_country'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <?php
                               } else {
                            ?>
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="country">
                                    <option  value="<?php echo $get_transaction_fetch['trans_country']; ?>"><?php echo $get_transaction_fetch['trans_country']; ?></option>
                                </select>
                            </div>
                            <?php
                                }
                            ?>
                            <!-- Order list count End -->
                            
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-info" style="border-radius: 0 !important" name="update_info">Update Information</button>
                                    </div>
                                </div>
                                <?php include 'delete-modal-information.php'; ?>
                                <div class="col-6">
                                    <div class="form-group">
                                        <!-- Disable Delete if order list is greather than 1 -->
                                        <?php if ($get_order_list_num == 0) { ?>
                                        <a class="form-control btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $get_transaction_fetch['id']; ?>" style="border-radius: 0 !important">Delete</a>
                                        <?php } else { ?>
                                        <buttom class="form-control btn btn-danger" style="border-radius: 0 !important" disabled>Delete</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- NOT NULL END -->
                        </form>
                    </div>
                </div>
                <!-- Customer Information End -->
                
            </div>
            <!-- First Column End -->
        
            <!-- Second Column Start -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <!-- Order List Card Start -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php if ($customer_country != '') { ?>
                        <!-- Add Item Start -->
                        <div class="card">
                            <div class="card-body login-card-body">
                                <form action="order-item.php" method="post">
                                <div class="form-group">
                                        <h5 class="text-info">Choose Item</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-9">
                                                <?php if ($get_order_list_num > 0) { ?>
                                                <select class="form-control select2bs4" style="width: 100%;" name="item_code">
                                                    <?php
                                                        $product_sql = "SELECT upti_items.items_code, upti_items.items_desc FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE
                                                        upti_items.items_status = 'Active' AND upti_code.code_category = 'PROMO' OR
                                                        upti_items.items_status = 'Active' AND upti_code.code_category = 'REBATABLE' OR
                                                        upti_items.items_status = 'Active' AND upti_code.code_category = 'BUY ONE GET ANY' OR
                                                        upti_items.items_status = 'Active' AND upti_code.code_category = 'BUY ONE GET TWO' OR
                                                        upti_items.items_status = 'Active' AND upti_code.code_category = 'NON-REBATABLE'
                                                        UNION
                                                        SELECT upti_package.package_code, upti_package.package_desc FROM upti_package INNER JOIN upti_code ON upti_package.package_code = upti_code.code_name WHERE
                                                        upti_package.package_category != 'RESELLER' AND upti_package.package_status = 'Active' OR
                                                        upti_code.code_category = 'PROMO' AND upti_package.package_status = 'Active' OR
                                                        upti_code.code_category = 'REBATABLE' AND upti_package.package_status = 'Active' OR
                                                        upti_code.code_category = 'BUY ONE GET ANY' AND upti_package.package_status = 'Active' OR
                                                        upti_code.code_category = 'BUY ONE GET TWO' AND upti_package.package_status = 'Active' OR
                                                        upti_code.code_category = 'NON-REBATABLE' AND upti_package.package_status = 'Active'
                                                        ";
                                                        $product_qry = mysqli_query($connect, $product_sql);
                                                    ?>
                                                    <option selected="selected">Select Items</option>
                                                    <?php
                                                        while ($product = mysqli_fetch_array($product_qry)) {
                                                    ?>
                                                    <option value="<?php echo $product['items_code'] ?>">[<?php echo $product['items_code'] ?>] → <?php echo $product['items_desc'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php } else { ?>
                                                    <select class="form-control select2bs4" style="width: 100%;" name="item_code">
                                                        <?php
                                                            $product_sql = "SELECT items_code, items_desc, code_category FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE 
                                                            upti_items.items_status = 'Active' AND upti_code.code_category = 'PROMO' OR 
                                                            upti_items.items_status = 'Active' AND upti_code.code_category = 'REBATABLE' OR
                                                            upti_items.items_status = 'Active' AND upti_code.code_category = 'BUY ONE GET ANY' OR
                                                            upti_items.items_status = 'Active' AND upti_code.code_category = 'BUY ONE GET TWO' 
                                                            UNION 
                                                            SELECT package_code, package_desc, code_category FROM upti_package INNER JOIN upti_code ON upti_package.package_code = upti_code.code_name 
                                                            WHERE 
                                                            upti_package.package_category != 'RESELLER' AND upti_code.code_category = 'PROMO' AND upti_package.package_status = 'Active' OR 
                                                            upti_package.package_category != 'RESELLER' AND upti_code.code_category = 'REBATABLE' AND upti_package.package_status = 'Active' OR 
                                                            upti_package.package_category != 'RESELLER' AND upti_code.code_category = 'BUY ONE GET ANY' AND upti_package.package_status = 'Active' OR 
                                                            upti_package.package_category != 'RESELLER' AND upti_code.code_category = 'BUY ONE GET TWO' AND upti_package.package_status = 'Active'";
                                                            $product_qry = mysqli_query($connect, $product_sql);
                                                        ?>
                                                        <option selected="selected">Select Items</option>
                                                        <?php
                                                            while ($product = mysqli_fetch_array($product_qry)) {
                                                        ?>
                                                        <option value="<?php echo $product['items_code'] ?>">[<?php echo $product['items_code'] ?>] → <?php echo $product['items_desc'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="qty" class="form-control" style="border-radius: 0 !important" required autocomplete="off" placeholder="Qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="add_items" class="form-control btn btn-success" style="border-radius: 0 !important">Add Item</button>
                                    </div>
                                </form>
                                <!-- GET FREE -->
                                <?php
                                    $check_boga = "SELECT * FROM upti_free WHERE free_poid = '$poid'";
                                    $check_boga_sql = mysqli_query($connect, $check_boga);
                                    $check_boga_fetch = mysqli_fetch_array($check_boga_sql);
                                    $check_num_boga = mysqli_num_rows($check_boga_sql);
                                    
                                    if ($check_num_boga == 0) {
                                        $num_boga = 0;
                                    } else {
                                        $num_boga = $check_boga_fetch['free_number'];
                                    }

                                    if ($num_boga > 0) {
                                ?>
                                <form action="order-free.php" method="post">
                                    <div class="row">
                                        <div class="col-9">
                                            <select class="form-control select2bs4" style="width: 100%;" name="free">
                                                <?php 
                                                    $product_sql = "SELECT * FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE items_status = 'Active' AND code_category = 'FREE'";
                                                    $product_qry = mysqli_query($connect, $product_sql);
                                                ?>
                                                <option value="">Select Free Item</option>
                                                <?php
                                                    while ($product = mysqli_fetch_array($product_qry)) {
                                                ?>
                                                <option value="<?php echo $product['items_code'] ?>">[<?php echo $product['items_code'] ?>] → <?php echo $product['items_desc'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-danger rounded-0 form-control" name="get_free">GET ANY ONE</button>
                                        </div>
                                    </div>
                                </form>
                                <?php } ?>
                                <!-- GET FREE END -->
                                <!-- GET FREE -->
                                <?php
                                    $check_free2 = "SELECT * FROM upti_free_2 WHERE f2_poid = '$poid'";
                                    $check_free2_sql = mysqli_query($connect, $check_free2);
                                    $check_free2_fetch = mysqli_fetch_array($check_free2_sql);
                                    $check_num_free2 = mysqli_num_rows($check_free2_sql);
                                    
                                    if ($check_num_free2 == 0) {
                                        $num_free2 = 0;
                                    } else {
                                        $num_free2 = $check_free2_fetch['f2_number'];
                                    }

                                    if ($num_free2 > 0) {
                                ?>
                                <form action="order-two.php" method="post">
                                    <div class="row">
                                        <div class="col-9">
                                            <select class="form-control select2bs4" style="width: 100%;" name="free2">
                                                <?php 
                                                    $product_sql = "SELECT * FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE items_status = 'Active' AND code_category = 'FREE TWO'";
                                                    $product_qry = mysqli_query($connect, $product_sql);
                                                ?>
                                                <option value="">Select Tie-Up Item</option>
                                                <?php
                                                    while ($product = mysqli_fetch_array($product_qry)) {
                                                ?>
                                                <option value="<?php echo $product['items_code'] ?>">[<?php echo $product['items_code'] ?>] → <?php echo $product['items_desc'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-danger rounded-0 form-control" name="get_free2">GET ANY TWO</button>
                                        </div>
                                    </div>
                                </form>
                                <?php } ?>
                                <!-- GET FREE END -->
                                <!-- LOYALTY -->
                                <?php
                                    $check_free2 = "SELECT * FROM upti_loyalty WHERE loyalty_code = '$csid'";
                                    $check_free2_sql = mysqli_query($connect, $check_free2);
                                    $check_free2_fetch = mysqli_fetch_array($check_free2_sql);
                                    $check_num_free2 = mysqli_num_rows($check_free2_sql);
                                    
                                    if ($check_num_free2 == 0) {
                                        $num_free2 = 0;
                                    } else {
                                        $num_free2 = $check_free2_fetch['loyalty_number'];
                                    }

                                    if ($num_free2 >= 5 && $Urole == 'UPTIOSR') {
                                ?>
                                <form action="loyalty.php" method="post">
                                    <div class="row">
                                        <div class="col-9">
                                            <select class="form-control select2bs4" style="width: 100%;" name="free2">
                                                <?php 
                                                    $product_sql = "SELECT * FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE items_status = 'Active' AND code_category = 'LOYALTY'";
                                                    $product_qry = mysqli_query($connect, $product_sql);
                                                ?>
                                                <option value="">Select Loyalty Item</option>
                                                <?php
                                                    while ($product = mysqli_fetch_array($product_qry)) {
                                                ?>
                                                <option value="<?php echo $product['items_code'] ?>">[<?php echo $product['items_code'] ?>] → <?php echo $product['items_desc'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-danger rounded-0 form-control" name="get_free2">LOYALTY</button>
                                        </div>
                                    </div>
                                </form>
                                <?php } ?>
                                <!-- LOYALTY END -->
                            </div>
                        </div>
                        <!-- Add item End -->
                <?php } ?>
                        <div class="card">
                            <div class="card-body login-card-body">
                                <h5 class="text-info">Order List</h5>
                                <hr>
                                <!-- Order List Table Start -->
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <?php
                                    $ol = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid'";
                                    $ol_qry = mysqli_query($connect, $ol);
                                    while ($ol_fetch = mysqli_fetch_array($ol_qry)) {
                                        $price = $ol_fetch['ol_price'];
                                        $price_subtotal = $ol_fetch['ol_subtotal'];
                                ?>
                                        <tr>
                                            <td class="text-center">
                                            <?php
                                                $codengitem = $ol_fetch['ol_code']; 
                                                $check_pack = "SELECT * FROM upti_package WHERE package_code = '$codengitem'";
                                                $check_pack_num = mysqli_query($connect, $check_pack);
                                                $pack_check = mysqli_num_rows($check_pack_num);

                                                if ($pack_check == 1) {
                                            ?>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pack<?php echo $ol_fetch['id']; ?>" style="border-radius: 0px !important;"><?php echo $ol_fetch['ol_code']; ?></button>
                                            <?php
                                                } else {
                                            ?>
                                                <?php echo $ol_fetch['ol_code']; ?>
                                            <?php
                                                }
                                            ?>
                                            </td>
                                            <td><?php echo $ol_fetch['ol_desc']; ?></td>
                                            <td class="text-center"><?php echo number_format($price); ?></td>
                                            <td class="text-center"><?php echo $ol_fetch['ol_qty']; ?></td>
                                            <td class="text-center"><?php echo number_format($price_subtotal); ?></td>
                                            <td class="text-center">
                                                <?php
                                                    $test = "SELECT * FROM upti_code WHERE code_name = '$codengitem' AND code_category = 'FREE'";
                                                    $test_qry = mysqli_query($connect, $test);
                                                    $test_2 = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$codengitem' AND code_category = 'BUY ONE GET ANY'");
                                                    if (mysqli_num_rows($test_qry) == 0) {
                                                ?>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#void<?php echo $ol_fetch['id']; ?>" style="border-radius: 0 !important">Remove</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php
                                    include 'backend/void-item-modal.php';
                                    include 'backend/void-pack-modal.php';
                                    }
                                ?>
                                </table>
                                <!-- Order List Table End -->
                            </div>
                        </div>
                    </div>
                    <!-- Order List Card End -->
                    
                    <!-- Checkout Details Start -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Show Payment method if order list is greater than 0 -->
                        <?php if ($get_order_list_num > 0) { ?>
                        <div class="card">
                            <div class="card-body login-card-body">
                                <h5 class="text-info">Other Details<i class="text-danger float-right">Choose Payment Method</i></h5>
                                <hr>
                                <div class="row">
                                    <!-- Promo Code Start -->
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <form action="" method="post">
                                            <!-- <h6>Activate Promo Code</h6>
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" style="border-radius: 0 !important" required autocomplete="off" placeholder="Promo Code">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <button type="submit" name="tree" class="form-control btn btn-dark" style="border-radius: 0 !important">Activate</button>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                    <!-- Promo Code End -->

                                    <!-- Payment Method Start -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <form action="order-payment.php" method="post">
                                            <h6><i class="text-danger">(Select Payment Method to Enable CHECKOUT)</i></h6>
                                           
                                            <div class="row">
                                                 <!-- CANADA no COP -->
                                            <?php if ($customer_country != 'CANADA') { ?>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="cod" class="form-control btn btn-success" style="border-radius: 0 !important">Cash On Delivery</button>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            <!-- CANADA no COP END -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="cop" class="form-control btn btn-success" style="border-radius: 0 !important">Cash On Pick Up</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" name="epayment" class="form-control btn btn-info" style="border-radius: 0 !important">Electronic Payment</button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="bank" class="form-control btn btn-primary" style="border-radius: 0 !important">Bank Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Payment Method End -->
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- greater than 0 End -->

                        <!-- payment method details show defend on MOP -->
                        <?php if ($mode_of_payment != '') { ?>
                        <div class="card">
                            <div class="card-body login-card-body">
                                <!-- Payment Method Show Start -->
                                <div class="row">
                                    <!-- View Image of Payment -->
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <h5 class="text-info">Payment Details</h5>
                                        <hr>
                                
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <th class="text-center">Bank</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Number</th>
                                            </thead>
                                            <?php
                                                if ($mode_of_payment == 'Cash On Delivery' || $mode_of_payment == 'Cash On Pick Up') {
                                                    $get_mode_of_payment = ' ';
                                                } elseif ($mode_of_payment == 'E-Payment') {
                                                    $get_mode_of_payment = 'epayment';
                                                } elseif ($mode_of_payment == 'Bank') {
                                                    $get_mode_of_payment = 'bank';
                                                }

                                                if ($customer_country == 'CANADA' && $office_state != 'ALBERTA') {
                                                  $office_state = 'ALL';
                                                }

                                                $mop_details_sql = "SELECT * FROM upti_mod WHERE mod_country = '$customer_country' AND mod_status = '$get_mode_of_payment' AND mod_state = '$office_state'";
                                                $mod_details_qry = mysqli_query($connect, $mop_details_sql);
                                                while ($mod_details_fetch = mysqli_fetch_array($mod_details_qry)) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $mod_details_fetch['mod_branch'] ?></td>
                                                <td class="text-center"><?php echo $mod_details_fetch['mod_name'] ?></td>
                                                <td class="text-center"><?php echo $mod_details_fetch['mod_number'] ?></td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    <!-- Form Checkout -->
                                    <form action="order-checkout.php" method="post" enctype="multipart/form-data">
                                        <?php if ($mode_of_payment == 'E-Payment' || $mode_of_payment == 'Bank') { ?>
                                        <hr>
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fileupload" name="file" id="fileupload">
                                                <label class="custom-file-label" for="b_input" style="border-radius: 0 !important">Click Here to Upload Receipt</label>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <!-- Image Preview -->
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <img src="template.png" alt="" class="img-fluid" id="upload-img">
                                        <br><br>
                                        <h6 class="text-dark text-center text-uppercase"><b><?php echo $mode_of_payment; ?></b></h6>
                                    </div>
                                    
                                </div>
                                <!-- Payment Method Show End -->
                            </div>
                        </div>
                        <?php } ?>
                        <!-- Payment Method Details End -->

                    </div>
                    <!-- Checkout Details End -->
                </div>
            </div>
            <!-- Second Column End -->
            
            <!-- Third Column Start -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body login-card-body">
                        <div class="row">
                            <!-- Uptimised Logo -->
                            <div class="col-12">
                                <img src="images/logo.png" alt="" class="img-fluid px-3">
                            </div>

                            <div class="col-12"><hr></div>

                            <!-- Poid Number -->
                            <div class="col-8">
                                <h5>Reference Number: </h5>
                            </div>
                            <div class="col-4">
                                <span class="float-right text-primary"><b><?php echo $poid; ?></b></span>
                            </div>
                            <br><br>

                            <!-- Customer Information -->
                            <div class="col-12">
                                <h6>Customer Information: </h6>
                            </div>
                            <div class="col-6">
                                <span><b><?php echo $name ?></b></span>
                            </div>
                            <div class="col-6">
                                <span class="float-right"><b><?php echo $contact ?></b></span>
                            </div>
                            <div class="col-12">
                                <span><i><?php echo $address ?></i></span>
                            </div>

                            <div class="col-12"><hr></div>

                            <!-- Looping Items -->
                            <?php
                                if ($get_order_list_num > 0) {
                                    while($get_order_show = mysqli_fetch_array($get_order_list_qry)) {
                            ?>
                                <div class="col-7">
                                <span><?php echo $get_order_show['ol_desc']; ?></span>
                                </div>
                                <div class="col-2">
                                    <span class="float-right"><?php echo $get_order_show['ol_qty']; ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="float-right"><?php echo $get_order_show['ol_subtotal']; ?></span>
                                </div>
                            <?php
                                } } else {
                            ?>
                                <div class="col-7">
                                <span class="text-center">Order List Empty</span>
                                </div>
                            <?php } ?>
                            <!-- Looping End -->

                            <div class="col-12"><hr></div>

                            <!-- Computation -->
                            <?php
                                // SUBTOTAL
                                $subtotal_sql = "SELECT SUM(ol_subtotal) AS subtotal FROM upti_order_list WHERE ol_poid = '$poid'";
                                $subtotal_qry = mysqli_query($connect, $subtotal_sql);
                                $subtotal_fetch = mysqli_fetch_array($subtotal_qry);

                                $subtotal = $subtotal_fetch['subtotal'];

                                // LESS SHIPPING FEE
                                $less_shipping_sql = "SELECT SUM(ol_qty) AS less_shipping FROM upti_order_list WHERE ol_poid = '$poid'";
                                $less_shipping_qry = mysqli_query($connect, $less_shipping_sql);
                                $less_shipping_fetch = mysqli_fetch_array($less_shipping_qry);

                                $order_qtys = $less_shipping_fetch['less_shipping'];

                                // ADDED non-rebatable
                                $rebatable_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'NON-REBATABLE'";
                                $rebatable_qry = mysqli_query($connect, $rebatable_sql);
                                $rebatable_num = mysqli_num_rows($rebatable_qry);

                                if ($rebatable_num != 0) {
                                    while ($rebatable = mysqli_fetch_array($rebatable_qry)) {
                                        $codeitem = $rebatable['code_name'];
                                        $rebate_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitem' AND ol_poid = '$poid'";
                                        $rebate_shipping_qry = mysqli_query($connect, $rebate_shipping_sql);
                                        $rebate_shipping_fetch = mysqli_fetch_array($rebate_shipping_qry);
        
                                        $rebate_less += $rebate_shipping_fetch['rebate_shipping'];
                                        //echo $rebate_less++;
                                    }
                                }

                                // ADDED FREE
                                $free_sql = "SELECT * FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'FREE'";
                                $free_qry = mysqli_query($connect, $free_sql);
                                while ($rebatable = mysqli_fetch_array($free_qry)) {
                                    $codeitemfree = $rebatable['code_name'];
                                    $rebatefree_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitemfree' AND ol_poid = '$poid'";
                                    $rebatefree_shipping_qry = mysqli_query($connect, $rebatefree_shipping_sql);
                                    $rebatefree_shipping_fetch = mysqli_fetch_array($rebatefree_shipping_qry);
    
                                    $free_less += $rebatefree_shipping_fetch['rebate_shipping'];
                                    //echo $rebate_less++;
                                }

                                // ADDED FREE
                                $free2_sql = "SELECT DISTINCT ol_code, code_name FROM upti_code INNER JOIN upti_order_list ON upti_code.code_name = upti_order_list.ol_code WHERE upti_order_list.ol_poid = '$poid' AND upti_code.code_category = 'FREE TWO'";
                                $free2_qry = mysqli_query($connect, $free2_sql);
                                while ($rebatable = mysqli_fetch_array($free2_qry)) {
                                    $codeitemfree2 = $rebatable['code_name'];
                                    $rebatefree2_shipping_sql = "SELECT SUM(ol_qty) AS rebate_shipping FROM upti_order_list WHERE ol_code = '$codeitemfree2' AND ol_poid = '$poid'";
                                    $rebatefree2_shipping_qry = mysqli_query($connect, $rebatefree2_shipping_sql);
                                    $rebatefree2_shipping_fetch = mysqli_fetch_array($rebatefree2_shipping_qry);
    
                                    $free_less2 += $rebatefree2_shipping_fetch['rebate_shipping'];
                                    //echo $rebate_less++;
                                }

                                $order_qty = $order_qtys - $rebate_less - $free_less - $free_less2;
                                $customer_country;
                                // FOR CANADA PART
                                if ($customer_country == 'CANADA' || $customer_country == 'UNITED ARAB EMIRATES') {
                                    $get_less_shipping_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                                    $get_less_shipping_fee_qry = mysqli_query($connect, $get_less_shipping_fee);
                                    $get_less_shipping_fee_num = mysqli_num_rows($get_less_shipping_fee_qry);
                                    $get_less_shipping_fee_fetch = mysqli_fetch_array($get_less_shipping_fee_qry);

                                    if ($get_less_shipping_fee_num == 0) {
                                        $less_shipping_fee = 0;
                                    } else {
                                        if ($order_qty > 2) {
                                            $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'];
                                        } else {
                                            $less_shipping_fee = 0;
                                        }
                                    }
                                }
                                // FOR JAPAN PART
                                elseif ($customer_country == 'JAPAN') {
                                    $get_less_shipping_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                                    $get_less_shipping_fee_qry = mysqli_query($connect, $get_less_shipping_fee);
                                    $get_less_shipping_fee_num = mysqli_num_rows($get_less_shipping_fee_qry);
                                    $get_less_shipping_fee_fetch = mysqli_fetch_array($get_less_shipping_fee_qry);

                                    if ($get_less_shipping_fee_num == 0) {
                                        $less_shipping_fee = 0;
                                    } else {
                                        if ($order_qty > 1) {
                                            $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'];
                                        } else {
                                            $less_shipping_fee = 0;
                                        }
                                    }
                                }
                                // FOR OTHER COUNTRY ONLY
                                elseif ($order_qty > 1) {
                                    $get_less_shipping_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                                    $get_less_shipping_fee_qry = mysqli_query($connect, $get_less_shipping_fee);
                                    $get_less_shipping_fee_num = mysqli_num_rows($get_less_shipping_fee_qry);
                                    $get_less_shipping_fee_fetch = mysqli_fetch_array($get_less_shipping_fee_qry);

                                    if ($get_less_shipping_fee_num == 0) {
                                        $less_shipping_fee = 0;
                                    } else {
                                        if($order_qty > 3) {
                                            $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'] * 2;
                                        } else {
                                            $less_shipping_fee = $get_less_shipping_fee_fetch['shipping_less'];    
                                        }
                                    }
                                } else {
                                    $less_shipping_fee = 0;
                                }
                                // LESS SHIPPING FEE END

                                // SHIPPING FEE START
                                $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$customer_country'";
                                $shipping_qry = mysqli_query($connect, $shipping_sql);
                                $shipping_fetch = mysqli_fetch_array($shipping_qry);
                                $shipping_num = mysqli_num_rows($shipping_qry);

                                $remove_shipping = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid' AND ol_code = 'JN04'";
                                $remove_shipping_sql = mysqli_query($connect, $remove_shipping);
                                $remove_num = mysqli_num_rows($remove_shipping_sql);

                                if ($shipping_num <= 0 || $mode_of_payment == 'Cash On Pick Up' || $order_qty <= 2 && $customer_country == 'PHILIPPINES' && $remove_num == 1) {
                                    $shipping = 0;
                                } else {
                                    $shipping = $shipping_fetch['shipping_price'];
                                }

                                if($customer_country == 'HONGKONG' AND $mode_of_payment == 'Cash On Delivery') {
                                    // echo 'try';
                                    $surcharge = $subtotal * 0.025;
                                } else {
                                    $surcharge = 0;
                                }

                                // Total Amount
                                $total_amount = $subtotal + $surcharge + $shipping - $less_shipping_fee ;

                                echo $customer_country;
                            ?>

                            <!-- Subtotal -->
                            <div class="col-8">
                                <span class="float-right">Subtotal : </span>
                            </div>
                            <div class="col-4">
                                <span class="float-right"><?php echo number_format($subtotal, 2)?></span>
                            </div>

                            <!-- Promo Code Discount -->
                            <!--<div class="col-8">-->
                            <!--    <span class="float-right">Promo Code Discount : </span>-->
                            <!--</div>-->
                            <!--<div class="col-4">-->
                            <!--    <span class="float-right">0.00</span>-->
                            <!--</div>-->

                            <?php if($customer_country == 'HONGKONG' AND $mode_of_payment == 'Cash On Delivery') { ?>
                            <!-- Less Shipping -->
                            <div class="col-8">
                                <span class="float-right">Surcharge : </span>
                            </div>
                            <div class="col-4">
                                <span class="float-right"><?php echo number_format($surcharge, 2)?></span>
                            </div>
                            <?php } ?>

                            <!-- Less Shipping -->
                            <div class="col-8">
                                <span class="float-right">Less Shipping Fee : </span>
                            </div>
                            <div class="col-4">
                                <span class="float-right"><?php echo number_format($less_shipping_fee, 2)?></span>
                            </div>

                            <!-- Shipping Fee -->
                            <div class="col-8">
                                <span class="float-right">Shipping Fee : </span>
                            </div>
                            <div class="col-4">
                                <span class="float-right"><?php echo number_format($shipping, 2)?></span>
                            </div>

                            <div class="col-12"><hr></div>

                            <!-- Total Amount -->
                            <div class="col-8">
                                <span class="float-right">Total Amount : </span>
                            </div>
                            <div class="col-4">
                                <span class="float-right"><b><?php echo number_format($total_amount, 2)?></b></span>
                            </div>

                            <div class="col-12"><hr></div>

                            <div class="col-12 text-center text-uppercase"><h2><b><?php if ($mode_of_payment == '') { echo 'Payment Method'; } else { echo $mode_of_payment; } ?></b></h2></div>

                            <div class="col-12"><hr></div>

                            <div class="col-12 text-center">======== Thank You! ========</div>

                            <div class="col-12"><hr></div>
                            
                            <?php
                                // echo $office_check;
                                // echo $office_check_status;
                                if ($customer_country == 'CANADA' && $office_check == 'DIRECT MAIL BOX' && $office_check_status == '') {
                            ?>
                            <a href="#" class="btn btn-info form-control rounded-0" data-toggle="modal" data-target="#office<?php echo $get_transaction_fetch['trans_poid']; ?>">PROCEED</a>
                            <?php
                                } else {
                            ?>
                            <div class="col-12">
                                <?php if ($mode_of_payment == '' || $get_order_list_num == '') { ?>
                                <button type="submit" name="checkouts" class="form-control btn btn-success" style="border-radius: 0 !important" disabled>CHECK OUT</button>
                                <?php } else { ?>
                                  <?php 
                                    if ($terms == '') {
                                  ?>
                                    <a href="#" class="btn btn-info form-control rounded-0" data-toggle="modal" data-target="#terms<?php echo $get_transaction_fetch['trans_poid']; ?>">OFFICIAL STATEMENT</a>
                                  <?php
                                    } else {
                                  ?>
                                    <button type="submit" name="checkouts" class="form-control btn btn-success" style="border-radius: 0 !important">CHECK OUT</button>
                                  <?php
                                    }
                                  ?>
                                <?php } ?>
                            </div>
                            <?php
                                }
                            ?>
                            </form>
                            <!-- End Form Checkout -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Third Column End -->
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php include 'backend/add-office-modal.php'; ?>
<?php include 'backend/add-terms-modal.php'; ?>
<?php include 'include/footer.php'; ?>
<script>
	$(function(){
		$("#fileupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
    <?php if (isset($_SESSION['save_info'])) { ?>

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.success("<?php echo flash('save_info'); ?>");
        
    <?php } ?>

    <?php if (isset($_SESSION['order'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success("<?php echo flash('order'); ?>");

    <?php } ?>

    <?php if (isset($_SESSION['warning'])) { ?>

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.error("<?php echo flash('warning'); ?>");

    <?php } ?>
</script>
