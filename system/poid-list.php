<?php include 'include/header.php'; ?>
<?php
    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    $usercode = $_SESSION['code'];
    $id = $_GET['id'];
    $name = $get_info_fetch['users_name'];

    $transact_sql = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $transact_qry = mysqli_query($connect, $transact_sql);
    $transact = mysqli_fetch_array($transact_qry);

    $mypoid = $transact['trans_poid'];

    $order_sql = "SELECT * FROM upti_order_list WHERE ol_poid = '$mypoid'"; 
    $order_qry = mysqli_query($connect, $order_sql);
    $order = mysqli_fetch_array($order_qry);
    
    $myid = $_SESSION['uid'];
    $phpprice = $order['ol_php'];

    $get_country_sql = "SELECT * FROM upti_users WHERE users_id = '$myid'";
    $get_country_qrys = mysqli_query($connect, $get_country_sql);
    $get_country_fetch = mysqli_fetch_array($get_country_qrys);

    $employee = $get_country_fetch['users_employee'];

    $cc = $transact['trans_country'];

    $stock_pending2 = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$usercode' AND stockist_country = '$cc'");
    $counts2 = mysqli_num_rows($stock_pending2);
    if ($counts2 == 0) {
?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<?php
 } else {
?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/stockist-navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<?php
 }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid"> 
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Account List</h1> --> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Order List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> 
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- START HERE -->
    <section class="content">
        <div class="container-fluid">             
              <!-- /.card-header -->
            <div class="card-body"> 
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Order Information
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Reference Number:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_poid'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Customer Name:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_fname'] ?> <?php echo $transact['trans_cname'] ?> <?php echo $transact['trans_lname'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Mobile Number:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_contact'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Complete Address:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_address'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Delivery Options:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_office'] ?> (<?php echo $transact['trans_office_status'] ?>)</p>
                                    </div>
                                    <br><br>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Order Date & Time:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_date'] ?> <?php echo $transact['trans_time'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Payment Method:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php echo $transact['trans_mop'] ?><br>
                                    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#image<?php echo $id; ?>"><i class="fas fa-image"></i>&nbsp;&nbsp; Receipt</button>
                                    </div>
                                </div>
                                <hr>
                                <span>Transaction Information:</span>
                                <br><br>
                                <div class="row">
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Country:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $cc ?></p>
                                    </div>
                                </div>
                                <hr>
                                <span class="">Transaction Information:</span>
                                <?php if ($role == 'BRANCH' || $role == 'UPTIMAIN' || $role == 'UPTICSR' && $cc == 'INTERNATIONAL' || $transact['trans_ship'] == 0 && $role == 'UPTICSR' || $role == 'BRANCH' || $role == 'UPTIMAIN') { ?>
                                <span class="float-right"><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#shipfee<?php echo $id; ?>" title="Add Shipping Fee"><i class="fa fa-truck pt-2"></i></button></span>
                                <?php } ?>
                                <br><br>
                                <div class="row">
                                    <?php if ($transact['trans_country'] == 'HONGKONG' && $transact['trans_mop'] == 'Cash On Delivery') { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Surcharge: </b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php $surcharge = $order['ol_subtotal'] * 0.025 ; echo number_format($surcharge) ?></p>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Less Shipping Fee:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php $less = $transact['trans_less_ship']; echo number_format($less) ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Shipping Fee:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php echo $transact['trans_ship'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Subtotal:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php echo $transact['trans_subtotal'] ?></p>
                                    </div>
                                    <?php if ($_SESSION['uid'] == '774') { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Peso Kier:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <!-- <p class="text-right"><?php //echo $phpprice ?></p> -->
                                        <?php 
                                          $ph_price = mysqli_query($connect, "SELECT * FROM upti_order_list WHERE ol_poid = '$mypoid'");
                                          echo '<p class="text-right">';  
                                          echo '=';
                                          foreach ($ph_price as $data) {
                                            
                                            $codedata =  $data['ol_code'];
                                            $codeqty =  $data['ol_qty'];
                                            // echo ' ';
                                            $sum_price = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$codedata' AND country_name = 'PHILIPPINES'");
                                            $sum_fetch = mysqli_fetch_array($sum_price);
                                            $php = $sum_fetch['country_price'] * $codeqty;
                                            echo $php.'+';
                                            // echo '<br>';
                                            // $total = 
                                          }
                                          echo '</p>';
                                          // echo $php;
                                        ?>
                                    </div>
                                    <?php } ?>
                                    <div class="col-12">
                                        <span>Order Status:</span>
                                        <br><br>
                                        <?php
                                            $status = $transact['trans_status'];
                                            if ($status == 'Pending') {
                                        ?>
                                        <img src="images/process/pending.png" alt="" class="image-responsive" width="100%">
                                        <?php } elseif ($status == 'In Transit') { ?>
                                        <img src="images/process/intransit.png" alt="" class="image-responsive" width="100%">
                                        <?php } elseif ($status == 'Delivered') { ?>
                                        <img src="images/process/delivered.png" alt="" class="image-responsive" width="100%">
                                        <?php } elseif ($status == 'Canceled') { ?>
                                        <img src="images/process/canceled.png" alt="" class="image-responsive" width="100%">
                                        <?php } elseif ($status == 'On Process') { ?>
                                        <img src="images/process/onprocess.png" alt="" class="image-responsive" width="100%">
                                        <?php } elseif ($status == 'RTS') { ?>
                                        <img src="images/process/rts.png" alt="" class="image-responsive" width="100%">
                                        <?php } ?>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <span>Inclusions</span>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Description</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $items_sql = "SELECT * FROM upti_order_list WHERE ol_poid = '$mypoid'";
                                        $items_qry = mysqli_query($connect, $items_sql);
                                        while ($items = mysqli_fetch_array($items_qry)) {
                                            $presyo = $items['ol_price'];
                                            $buo = $items['ol_subtotal'];
                                            $code = $items['ol_code'];
                                            $country_pack = $items['ol_country'];

                                            $realme = "SELECT * FROM upti_package WHERE package_code = '$code'";
                                            $realme_qry = mysqli_query($connect, $realme);
                                            $realme_num_row = mysqli_num_rows($realme_qry);
                                            
                                            if ($realme_num_row == 1) {
                                                $get_country = "SELECT * FROM upti_country WHERE country_code = '$code' AND country_name = '$country_pack'";
                                                $get_country_sql = mysqli_query($connect, $get_country);
                                                $get_pack_price = mysqli_fetch_array($get_country_sql);
                                                
                                                $presyo = $get_pack_price['country_price'];

                                            }
                                            
                                            
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                                if ($realme_num_row == 1) {
                                            ?>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pack<?php echo $items['id']; ?>"><?php echo $code; ?></button>
                                            <?php
                                                } else {
                                                    echo $code;
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $items['ol_desc'] ?></td>
                                        <td class="text-center"><?php echo number_format($presyo, '2', '.', ',') ?></td>
                                        <td class="text-center"><?php echo $items['ol_qty'] ?></td>
                                        <td class="text-center"><?php echo number_format($buo, '2', '.', ',') ?></td>
                                    </tr>
                                    <?php include 'backend/poid-pack-modal.php'; } ?>
                                </table>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <span>ORDER TRACKING</span>
                                
                                    <span class="float-right">
                                        <?php
                                            if ($cc == 'OMAN') {
                                                $cc = 'UNITED ARAB EMIRATES';
                                            } elseif ($cc == 'KUWAIT') {
                                                $cc = 'UNITED ARAB EMIRATES';
                                            } elseif ($cc == 'QATAR') {
                                                $cc = 'UNITED ARAB EMIRATES';
                                            } elseif ($cc == 'BAHRAIN') {
                                                $cc = 'UNITED ARAB EMIRATES';
                                            }
                                            $stock_pending = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$usercode' AND stockist_country = '$cc'");
                                            $counts = mysqli_num_rows($stock_pending);
                                            if ($status == 'Pending' && $counts > 0 || $cc == 'PHILIPPINES' && $status == 'Pending' && $role == 'BRANCH') {
                                        ?>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#onprocess<?php echo $id; ?>" title="On Process">On Process</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel<?php echo $id; ?>" title="Cancel">Cancel</button>
                                        <?php
                                            } elseif ($status == 'On Process' && $counts > 0) {
                                        ?>
                                             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#intransit<?php echo $id; ?>" title="In Transit">In Transit</button>
                                             <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel<?php echo $id; ?>" title="Cancel">Cancel</button>
                                        <?php
                                            }
                                            $role = $_SESSION['role'];
                                            if ($role == 'UPTICSR' || $role == 'UPTIMAIN' || $role == 'BRANCH') {
                                        ?> 
                                        <?php if ($status == 'In Transit') { ?>

                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#delivered<?php echo $id; ?>" title="Delivered">Delivered</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rts<?php echo $id; ?>" title="RTS">RTS</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel<?php echo $id; ?>" title="Cancel">Cancel</button>
                                        
                                        <?php } elseif ($status == 'Delivered') { ?>

                                        <span class="badge badge-success">Delivered Orders</span>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#convert<?php echo $id; ?>" title="Convert to RTS">Convert to RTS</button>
                                        
                                        <?php } elseif ($status == 'Canceled') { ?>

                                        <span class="badge badge-danger">Cancel Orders</span>
                                           
                                        <?php } elseif ($status == 'RTS') { ?>

                                        <span class="badge badge-danger">RTS Orders</span>
                                        
                                        <?php } elseif ($status == 'On Process' && $cc == 'PHILIPPINES' && $role == 'BRANCH') { ?>

                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#intransit<?php echo $id; ?>" title="In Transit">In Transit</button>

                                        <?php } elseif ($status == 'On Order') { ?>

                                        <span class="badge badge-dark">No data available in Inclusions</span>
                                        
                                    <?php } ?>
                                    </span>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="card-body">
                                <?php
                                    if (isset($_POST['comment'])) {
                                        $comment_mo = $_POST['comment_text'];

                                        $role = $_SESSION['role'];
                                        
                                        if ($role == 'BRANCH' || $role == 'UPTIMAIN') {
                                            $remarks_sql = "INSERT INTO upti_remarks (remark_time, remark_date, remark_poid, remark_name, remark_content, remark_reseller) VALUES ('$time', '$date', '$mypoid', '$name', '$comment_mo', 'Unread')";
                                            $remarks_qry = mysqli_query($connect, $remarks_sql);
                                        } else {
                                            $remarks_sql = "INSERT INTO upti_remarks (remark_time, remark_date, remark_poid, remark_name, remark_content, remark_csr) VALUES ('$time', '$date', '$mypoid', '$name', '$comment_mo', 'Unread')";
                                            $remarks_qry = mysqli_query($connect, $remarks_sql);
                                        }

                                        ?>
                                            <script>window.location='poid-list.php?id=<?php echo $id; ?>'</script>";
                                        <?php

                                    }
                                ?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <textarea name="comment_text" id="" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success btn-sm" name="comment">Submit</button>
                                            </div>
                                        </div>
                                </form>
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div class="card p-3" style="border: 1px solid #333">
                                                <div class="row">
                                                <?php

                                                    $id = $_GET['id'];

                                                    $transact_sql = "SELECT * FROM upti_transaction WHERE id = '$id'";
                                                    $transact_qry = mysqli_query($connect, $transact_sql);
                                                    $transact = mysqli_fetch_array($transact_qry);

                                                    $mypoid = $transact['trans_poid'];

                                                    $comment_sql = "SELECT * FROM upti_remarks WHERE remark_poid = '$mypoid' ORDER BY id DESC";
                                                    $comment_qry = mysqli_query($connect, $comment_sql);
                                                    $comment_num = mysqli_num_rows($comment_qry);
                                                    if ($comment_num > 0) {
                                                    while ($comment = mysqli_fetch_array($comment_qry)) {
                                                ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                        <b><?php echo $comment['remark_name'] ?></b> <br>
                                                        <i><?php echo $comment['remark_date'] ?> <?php echo $comment['remark_time'] ?></i>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                                        <?php echo $comment['remark_content'] ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                <?php } ?>
                                                <?php } else { ?>
                                                    <div class="col-12">
                                                        <i>No Comment</i>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- <?php //echo $status ?> -->
        </div>
    </section>
  </div>
<?php
    if ($status == 'Pending') {
        include 'backend/order-cancel-modal.php';
    } else {
        include 'backend/order-cancels-modal.php';
    }

    if ($status == 'On Process' && $counts > 0) {
      include 'backend/order-cancels-modal.php';
    }
    
    include 'backend/admin-order-rts-modal.php';
    include 'backend/admin-order-images-modal.php';
    include 'backend/admin-order-delivered-modal.php';
    if ($cc == 'PHILIPPINES') {
        include 'backend/admin-order-in-transit-modal.php';
        include 'backend/admin-order-on-process-modal.php';
    } else {
        include 'backend/admin-order-in-transit2-modal.php';
        include 'backend/admin-order-on-process2-modal.php';
    }
    include 'backend/ship-add-modal.php';
    include 'backend/rts-deliver-modal.php';
?>
<?php include 'include/footer.php'; ?>
<script type="text/javascript">
    <?php if (isset($_SESSION['success'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
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

    toastr.error("<?php echo flash('success'); ?>");

    <?php } ?>
</script>