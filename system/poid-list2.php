<?php include 'include/header.php'; ?>
<?php
    $usercode = $_SESSION['code'];
    $id = $_GET['id'];
    $name = $get_info_fetch['users_name'];

    date_default_timezone_set("Asia/Manila"); 
    $date = date('m-d-Y');
    $time = date('h:i A');

    $transact_sql = "SELECT * FROM web_transaction WHERE id = '$id'";
    $transact_qry = mysqli_query($connect, $transact_sql);
    $transact = mysqli_fetch_array($transact_qry);

    $mypoid = $transact['trans_ref'];

    $order_sql = "SELECT * FROM web_cart WHERE cart_ref = '$mypoid'";
    $order_qry = mysqli_query($connect, $order_sql);
    $order = mysqli_fetch_array($order_qry);
    
    $myid = $_SESSION['uid'];
    $role = $_SESSION['role'];

    $get_country_sql = "SELECT * FROM upti_users WHERE users_id = '$myid'";
    $get_country_qrys = mysqli_query($connect, $get_country_sql);
    $get_country_fetch = mysqli_fetch_array($get_country_qrys);

    $employee = $get_country_fetch['users_employee'];

    $cc = $transact['trans_country'];

    $stock_pending2 = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$usercode' AND stockist_country = '$cc'");
    $counts2 = mysqli_num_rows($stock_pending2);
    if ($counts2 == 0 && $role != 'WEBSITE') {
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
                                        <p><?php echo $transact['trans_ref'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Customer Name:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_name'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Mobile Number:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_mobile'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Complete Address:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_address'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Country State:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p><?php echo $transact['trans_state'] ?></p>
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
                                        <p><?php echo $transact['trans_date'] ?></p>
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
                                <?php if ($role == 'BRANCH' || $role == 'UPTIMAIN' || $role == 'UPTICSR' && $cc == 'INTERNATIONAL' || $transact['trans_shipping'] == 0 && $role == 'UPTICSR' || $role == 'BRANCH' || $role == 'UPTIMAIN') { ?>
                                <span class="float-right"><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#shipfee<?php echo $id; ?>" title="Add Shipping Fee"><i class="fa fa-truck pt-2"></i></button></span>
                                <?php } ?>
                                <br><br>
                                <div class="row">
                                    <?php if ($transact['trans_country'] == 'HONGKONG' && $transact['trans_mop'] == 'Cash On Delivery') { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Surcharge: </b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php $surcharge = $order['cart_subtotal'] * 0.025 ; echo number_format($surcharge) ?></p>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Discount :</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php $less = $transact['trans_discount']; echo number_format($less) ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Less Shipping Fee:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php $less = $transact['trans_less_shipping']; echo number_format($less) ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Shipping Fee:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php echo $transact['trans_shipping'] ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <b>Subtotal:</b>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <p class="text-right"><?php echo $transact['trans_subtotal'] ?></p>
                                    </div>
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
                                        $items_sql = "SELECT * FROM web_cart WHERE cart_ref = '$mypoid'";
                                        $items_qry = mysqli_query($connect, $items_sql);
                                        while ($items = mysqli_fetch_array($items_qry)) {
                                            $presyo = $items['cart_price'];
                                            $buo = $items['cart_subtotal'];
                                            $code = $items['cart_code'];
                                            $country_pack = $items['cart_country'];

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
                                        <td><?php echo $items['cart_desc'] ?></td>
                                        <td class="text-center"><?php echo number_format($presyo, '2', '.', ',') ?></td>
                                        <td class="text-center"><?php echo $items['cart_qty'] ?></td>
                                        <td class="text-center"><?php echo number_format($buo, '2', '.', ',') ?></td>
                                    </tr>
                                    <?php include 'backend/poid-pack-modal2.php'; } ?>
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
                                        ?>
                                        <?php if ($status == 'Pending' && $counts > 0 || $role == 'BRANCH' && $cc == 'Philippines' && $status == 'Pending' || $role == 'BRANCH' && $cc == 'PHILIPPINES' && $status == 'Pending') { ?>

                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#onprocess<?php echo $id; ?>" title="On Process">On Process</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel<?php echo $id; ?>" title="Cancel">Cancel</button>
                                        
                                        <?php } elseif ($status == 'On Process' && $counts > 0 || $role == 'BRANCH' && $cc == 'PHILIPPINES' && $status == 'On Process' || $role == 'BRANCH' && $cc == 'Philippines' && $status == 'On Process') { ?>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#intransit<?php echo $id; ?>" title="In Transit">In Transit</button>
                                        <?php } elseif ($status == 'In Transit' && $role == 'BRANCH') { ?>

                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#delivered<?php echo $id; ?>" title="Delivered">Delivered</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rts<?php echo $id; ?>" title="RTS">RTS</button>
                                        

                                        <?php } elseif ($status == 'Delivered' && $role == 'BRANCH') { ?>
                                            <span class="badge badge-success">Delivered Order</span>
                                        <?php } elseif ($status == 'RTS' && $role == 'BRANCH') { ?>
                                            <span class="badge badge-danger">RTS Order</span>
                                        <?php } elseif ($status == 'Canceled' && $role == 'BRANCH') { ?>
                                            <span class="badge badge-danger">Cancel Order</span>
                                        <?php } ?>
                                    </span>
                            </div>
                            <div class="card-body">
                                <?php
                                    if (isset($_POST['comment'])) {
                                        $comment_mo = $_POST['comment_text'];

                                        date_default_timezone_set('Asia/Manila');
                                        $today = date("m-d-Y");
                                        $time = date('h:i:sa');
                                        $stamp = $today.' '.$time;

                                        $role = $_SESSION['role'];
                                        
                                        $remarks_sql = "INSERT INTO upti_remarks (remark_date, remark_time, remark_poid, remark_name, remark_content, remark_reseller, remark_code, remark_stamp) VALUES ('$date', '$time', '$mypoid', '$name', '$comment_mo', 'Unread', 'Uptimised Corporation', '$stamp')";
                                        $remarks_qry = mysqli_query($connect, $remarks_sql);

                                        ?>
                                            <script>window.location='poid-list2.php?id=<?php echo $id; ?>'</script>";
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

                                                    $transact_sql = "SELECT * FROM web_transaction WHERE id = '$id'";
                                                    $transact_qry = mysqli_query($connect, $transact_sql);
                                                    $transact = mysqli_fetch_array($transact_qry);

                                                    $mypoid = $transact['trans_ref'];

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
        </div>
    </section>
  </div>
<?php
    include 'backend/cs-cancel-modal.php';
    include 'backend/admin-order-images2-modal.php';
    include 'backend/cs-order-rts-modal.php';
    include 'backend/cs-order-delivered-modal.php';
    include 'backend/cs-order-intransit-modal.php';
    include 'backend/cs-order-onprocess-modal.php';
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