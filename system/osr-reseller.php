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

<?php
  date_default_timezone_set("Asia/Manila");   
  $date_today = date('m-d-Y');

  $Uid = $_SESSION['uid'];
  $Ucode = $_SESSION['code'];

  $count_sql = "SELECT users_reseller FROM upti_users WHERE users_code = '$Ucode'";
  $count_qry = mysqli_query($connect, $count_sql);
  $count_fetch = mysqli_fetch_array($count_qry);

  $Ucount = $count_fetch['users_reseller'];

  $poid = 'RS'.$Uid.'-'.$Ucount;

  $transaction_stmt = mysqli_query($connect, "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'");
  $transaction = mysqli_fetch_array($transaction_stmt);

  if (mysqli_num_rows($transaction_stmt) > 0) {
    $country = $transaction['trans_country'];
    $fname = $transaction['trans_fname'];
    $email = $transaction['trans_email'];
    $mobile = $transaction['trans_contact'];
    $address = $transaction['trans_address'];
    $mode_of_payment = $transaction['trans_mop'];
    $state = $transaction['trans_state'];
  } else {
    $state = '';
    $country = '';
    $fname = '';
    $email = '';
    $mobile = '';
    $address = '';
    $mode_of_payment = '';
  }

  $get_order_list = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid'";
  $get_order_list_qry = mysqli_query($connect, $get_order_list);
  $get_order_list_num = mysqli_num_rows($get_order_list_qry);

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: steelblue">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">  
        <div class="row mb-2"> 
        
        </div><!-- /.row -->     
        
        <!-- START HERE -->
        <div class="row">
            <!-- First Column Start -->
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card">
                <div class="card-body login-card-body">
                  <?php
                    if (mysqli_num_rows($transaction_stmt) < 1) {
                  ?>
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <form action="reseller-information.php" method="post">
                      <div class="form-group">
                        <label for="">Reseller Information</label>
                        <input type="text" class="form-control" name="fullname" style="border-radius: 0 !important" required autocomplete="off" placeholder="Full Name">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="email" style="border-radius: 0 !important" required autocomplete="off" placeholder="Email Address">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="mobile" style="border-radius: 0 !important" required autocomplete="off" placeholder="Mobile Number">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <textarea id="" cols="30" name="address" rows="2" class="form-control" style="border-radius: 0 !important" placeholder="Complete Address"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
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
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
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
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <br>
                      <button class="btn btn-dark form-control rounded-0" name="save">Save Information</button>
                      </form>
                    </div>
                    <div class="col-12">
                      <br>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <form action="" method="post">
                        <label for="">Reseller Account&nbsp;&nbsp; - &nbsp;&nbsp;<i class="text-danger" style="font-weight: 300;">Password Default is 123456</i></label>
                        <input type="text" class="form-control" name="fullname" style="border-radius: 0 !important" required autocomplete="off" placeholder="Username">
                        <p class="text-center text-danger"><i>Username is not available</i></p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <button class="btn btn-success form-control rounded-0">Check Username</button>
                      </form>
                    </div>
                  </div>
                  <?php
                    } else {
                  ?>
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <form action="reseller-information.php" method="post">
                      <div class="form-group">
                        <label for="">Reseller Information</label>
                        <input type="text" class="form-control" name="fullname" style="border-radius: 0 !important" required autocomplete="off" placeholder="Full Name" value="<?php echo $fname ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="email" style="border-radius: 0 !important" required autocomplete="off" placeholder="Email Address" value="<?php echo $email ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="mobile" style="border-radius: 0 !important" required autocomplete="off" placeholder="Mobile Number" value="<?php echo $mobile ?>">
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <textarea id="" cols="30" name="address" rows="2" class="form-control" style="border-radius: 0 !important" placeholder="Complete Address"><?php echo $address ?></textarea>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <select class="form-control select2bs4" style="width: 100%;" name="state">
                        <option value="<?php echo $state ?>"><?php echo $state ?></option>
                        <?php
                            $lugar = "SELECT * FROM upti_state";
                            $lugar_qry = mysqli_query($connect, $lugar);
                            while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                        ?>
                        <option value="<?php echo $lugar_fetch['state_name'] ?>"><?php echo $lugar_fetch['state_name'] ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <select class="form-control select2bs4" style="width: 100%;" name="country">
                      <option value="<?php echo $country ?>"><?php echo $country ?></option>
                      <?php if ($get_order_list_num == 0) { ?>
                      <?php
                          $lugar = "SELECT DISTINCT cc_country FROM upti_country_currency";
                          $lugar_qry = mysqli_query($connect, $lugar);
                          while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                      ?>
                      <option value="<?php echo $lugar_fetch['cc_country'] ?>"><?php echo $lugar_fetch['cc_country'] ?></option>
                      <?php } ?>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <br>
                      <div class="row">
                        <div class="col-6">
                        <button class="btn btn-danger form-control rounded-0" name="delete">Delete</button>
                        </div>
                        <div class="col-6">
                        <button class="btn btn-warning form-control rounded-0" name="update">Update</button>
                        </div>
                      </div>
                      </form>
                    </div>
                    <div class="col-12">
                      <br>
                    </div>
                    <?php
                      $user_check = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_poid = '$poid'");
                      $username_f = mysqli_fetch_array($user_check);
                      if (mysqli_num_rows($user_check) < 1) {
                    ?>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <form action="reseller-information.php" method="post">
                        <label for="">Reseller Account&nbsp;&nbsp; - &nbsp;&nbsp;<i class="text-danger" style="font-weight: 300;">Password Default is 123456</i></label>
                        <input type="text" class="form-control" name="username" style="border-radius: 0 !important" required autocomplete="off" placeholder="Username">
                        <!-- <p class="text-center text-danger"><i>Username is not available</i></p> -->
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <button class="btn btn-success form-control rounded-0" name="check">Check Username</button>
                    </div>
                    </form>
                    <?php } else { ?>
                      <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <form action="reseller-information.php" method="post">
                        <label for="">Reseller Account&nbsp;&nbsp; - &nbsp;&nbsp;<i class="text-danger" style="font-weight: 300;">Password Default is 123456</i></label>
                        <input type="text" class="form-control" name="username" style="border-radius: 0 !important" required autocomplete="off" placeholder="Username" disabled value="<?php echo $username_f['users_username'] ?>">
                        <p class="text-center text-success"><i>Username available</i></p>
                        </form>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  <?php
                    }
                  ?>
                </div>
              </div>
              <div class="card">
                <div class="card-body login-card-body">
                  <div class="row">
                    <div class="col-12">
                      <label for="">Payment Method</label>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                      <form action="payment-method.php?mop=<?php echo $poid ?>" method="post">
                      <select class="form-control select2bs4" style="width: 100%;" name="mod">
                        <option value="<?php echo $mode_of_payment ?>"><?php echo $mode_of_payment ?></option>
                        <option value="Cash On Delivery">Cash On Delivery</option>
                        <option value="Cash On Pick Up">Cash On Pick Up</option>
                        <option value="Payment First">Payment First</option>
                        <option value="Bank">Bank</option>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3">
                      <button class="btn btn-dark form-control rounded-0" name="payment">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- First Column End -->
            <?php if($country != '') { ?>
            <!-- Second Column Start -->
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-body login-card-body">
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <label for="">Select Reseller Package</label>
                    </div>
                    <?php 
                      $check_ol = mysqli_query($connect, "SELECT * FROM upti_order_list INNER JOIN upti_package ON upti_package.package_code = upti_order_list.ol_code WHERE ol_poid = '$poid'");
                      if (mysqli_num_rows($check_ol) < 1) {
                    ?>
                    <?php
                      $reseller_P = mysqli_query($connect, "
                          SELECT * FROM upti_package
                          INNER JOIN upti_code ON upti_code.code_name = upti_package.package_code
                          INNER JOIN upti_product ON upti_product.p_code = upti_package.package_code
                          WHERE code_category = 'RESELLER' AND package_status = 'Active'
                      ");
                      while ($row = mysqli_fetch_array($reseller_P)) {
                        $packcode = $row['package_code'];

                        $c1 = $row['package_one_code'];
                        $q1 = $row['package_one_qty'];
            
                        $c2 = $row['package_two_code'];
                        $q2 = $row['package_two_qty'];
            
                        $c3 = $row['package_three_code'];
                        $q3 = $row['package_three_qty'];
            
                        $c4 = $row['package_four_code'];
                        $q4 = $row['package_four_qty'];
            
                        $c5 = $row['package_five_code'];
                        $q5 = $row['package_five_qty'];
                        
                        // 1
                        $check_stock1 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$country'";
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
                        $check_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$country'";
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
                        $check_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$country'";
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
                        $check_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$country'";
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
                        $check_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$country'";
                        $check_stock_qry5 = mysqli_query($connect, $check_stock5);
                        $check_stock_fetch5 = mysqli_fetch_array($check_stock_qry5);
                        $check_stock_num5 = mysqli_num_rows($check_stock_qry5);
                        if ($check_stock_num5 == 0) {
                            $stockist_stock5 = 0;
                        } else {
                            $stockist_stock5 = $check_stock_fetch5['si_item_stock'];
                        }
                    ?>
                    <div class="col-sm-4 col-md-3 col-lg-2">
                      <?php if ($row['p_m_img'] != '') { ?>
                      <img src="../assets/images/product/<?php echo $row['p_m_img'] ?>" alt="" class="img-responsive w-100 border border-info">
                      <?php } else { ?>
                      <img src="../assets/images/main/default.jpg" alt="" class="img-responsive w-100 border border-info">
                      <?php } ?>
                      <p class="text-center"><?php echo $row['package_desc'] ?></p>
                        <?php if ($stockist_stock1 >= $q1 && $stockist_stock2 >= $q2 && $stockist_stock3 >= $q3 && $stockist_stock4 >= $q4 && $stockist_stock5 >= $q5) { ?>
                          <a href="reseller-package.php?code=<?php echo $packcode ?>" class="btn btn-danger form-control rounded-0"><?php echo $row['package_code'] ?></a>
                        <?php } else { ?>
                          <button class="btn btn-warning form-control rounded-0" disabled>NO STOCK</button>
                        <?php } ?>
                      <br>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <?php
                      $reseller_P = mysqli_query($connect, "
                          SELECT * FROM upti_package
                          INNER JOIN upti_code ON upti_code.code_name = upti_package.package_code
                          INNER JOIN upti_product ON upti_product.p_code = upti_package.package_code
                          WHERE code_category = 'RESELLER' AND package_status = 'Active'
                      ");
                      while ($row = mysqli_fetch_array($reseller_P)) {
                        $packcode = $row['package_code'];
                    ?>
                    <div class="col-sm-4 col-md-3 col-lg-2">
                      <?php if ($row['p_m_img'] != '') { ?>
                      <img src="../assets/images/product/<?php echo $row['p_m_img'] ?>" alt="" class="img-responsive w-100 border border-info">
                      <?php } else { ?>
                      <img src="../assets/images/main/default.jpg" alt="" class="img-responsive w-100 border border-info">
                      <?php } ?>
                      <p class="text-center"><?php echo $row['package_desc'] ?></p>
                    </div>
                    <?php } ?>
                    <?php } ?>
                  </div>
                  </form>
                </div>
              </div>
              <div class="card">
                <div class="card-body login-card-body">
                  <br>
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-7">
                      <form action="tie-up.php?poid=<?php echo $poid ?>" method="post">
                      <select class="form-control select2bs4" style="width: 100%;" name="item_code">
                        <?php
                            $product_sql = "SELECT items_code, items_desc, code_category FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE 
                            upti_items.items_status = 'Active' AND upti_code.code_category = 'NON-REBATABLE' 
                            UNION 
                            SELECT package_code, package_desc, code_category FROM upti_package INNER JOIN upti_code ON upti_package.package_code = upti_code.code_name 
                            WHERE 
                            upti_code.code_category = 'NON-REBATABLE' AND upti_package.package_status = 'Active'";
                            $product_qry = mysqli_query($connect, $product_sql);
                        ?>
                        <option selected="selected">Select Items</option>
                        <?php
                            while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['items_code'] ?>">[<?php echo $product['items_code'] ?>] → <?php echo $product['items_desc'] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2">
                      <div class="form-group">
                        <input type="text" class="form-control" name="qty" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3">
                      <button class="btn btn-success form-control rounded-0" name="add">ADD TIE UP</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

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
                                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#void<?php echo $ol_fetch['id']; ?>" style="border-radius: 0 !important">Remove</button>
                                </td>
                            </tr>
                    <?php
                        include 'backend/void-item-modal2.php';
                        include 'backend/void-pack-modal.php';
                        }
                    ?>
                    </table>
                    <!-- Order List Table End -->
                </div>
              </div>
              <!-- payment method details show defend on MOP -->
              <?php if ($mode_of_payment == 'Payment First' || $mode_of_payment == 'Bank') { ?>
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
                                      } elseif ($mode_of_payment == 'E-Payment' || $mode_of_payment == 'Payment First') {
                                          $get_mode_of_payment = 'epayment';
                                      } elseif ($mode_of_payment == 'Bank') {
                                          $get_mode_of_payment = 'bank';
                                      }

                                      $mop_details_sql = "SELECT * FROM upti_mod WHERE mod_country = '$country' AND mod_status = '$get_mode_of_payment'";
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
                          <form action="reseller-checkout.php" method="post" enctype="multipart/form-data">
                              <?php if ($mode_of_payment == 'E-Payment'|| $mode_of_payment == 'Payment First' || $mode_of_payment == 'Bank') { ?>
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
              <?php } else { ?>
                <form action="reseller-checkout.php" method="post" enctype="multipart/form-data">
              <?php } ?>
              <!-- Payment Method Details End -->
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
                                <span><b><?php echo $fname ?></b></span>
                            </div>
                            <div class="col-6">
                                <span class="float-right"><b><?php echo $mobile ?></b></span>
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

                                // SHIPPING FEE START
                                $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$country'";
                                $shipping_qry = mysqli_query($connect, $shipping_sql);
                                $shipping_fetch = mysqli_fetch_array($shipping_qry);
                                $shipping_num = mysqli_num_rows($shipping_qry);

                                if ($shipping_num <= 0 || $mode_of_payment == 'Cash On Pick Up') {
                                    $shipping = 0;
                                } else {
                                    $shipping = $shipping_fetch['shipping_price'];
                                }

                                if($country == 'HONGKONG' AND $mode_of_payment == 'Cash On Delivery') {
                                    // echo 'try';
                                    $surcharge = $subtotal * 0.025;
                                } else {
                                    $surcharge = 0;
                                }

                                // Total Amount
                                $total_amount = $subtotal + $surcharge + $shipping;
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

                            <?php if($country == 'HONGKONG' AND $mode_of_payment == 'Cash On Delivery') { ?>
                            <!-- Less Shipping -->
                            <div class="col-8">
                                <span class="float-right">Surcharge : </span>
                            </div>
                            <div class="col-4">
                                <span class="float-right"><?php echo number_format($surcharge, 2)?></span>
                            </div>
                            <?php } ?>

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
                            
                            <div class="col-12">
                                <?php
                                  $account = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_poid = '$poid'");
                                ?>
                                <?php if ($mode_of_payment == '' || $get_order_list_num == '' || mysqli_num_rows($account) < 1) { ?>
                                <button type="submit" name="checkouts" class="form-control btn btn-success" style="border-radius: 0 !important" disabled>CHECK OUT</button>
                                <?php } else { ?>
                                <button type="submit" name="checkouts" class="form-control btn btn-success" style="border-radius: 0 !important">CHECK OUT</button>
                                <?php } ?>
                            </div>
                            </form>
                            <!-- End Form Checkout -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Third Column End -->
            <?php } ?>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php include 'include/footer.php'; ?>
<script>
	$(function(){
		$("#fileupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
    <?php if (isset($_SESSION['success'])) { ?>

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

        toastr.success("<?php echo flash('success'); ?>");
        
    <?php } ?>

    <?php if (isset($_SESSION['failed'])) { ?>

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

        toastr.error("<?php echo flash('failed'); ?>");

    <?php } ?>
</script>
