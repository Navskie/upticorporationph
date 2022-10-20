<?php include 'include/header.php'; ?>
<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    $check_stockist_f = mysqli_fetch_array($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
      $code = $check_stockist_f['stockist_code'];
      $country = $check_stockist_f['stockist_country'];
      $state = $check_stockist_f['stockist_state']; 
?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/stockist-navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="float-left text-info">RTS Orders</h4>
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                    <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">Poid</th>
                                      <th class="text-center">Reseller</th>
                                      <th class="text-center">Country</th>
                                      <th class="text-center">Name</th>
                                      <th class="text-center">Date & Time</th>
                                      <th class="text-center">Mode of Payment</th>
                                      <th class="text-center">Image</th>
                                      <th class="text-center">Total</th>
                                      <th class="text-center">Status</th>
                                      <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    if($country == 'UNITED ARAB EMIRATES') {
                                      $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'RTS' AND trans_country = '$country' OR trans_status= 'RTS' AND trans_country = 'OMAN' AND trans_stockist = '' OR trans_status= 'RTS' AND trans_country = 'KUWAIT' AND trans_stockist = '' OR trans_status= 'RTS' AND trans_country = 'BAHRAIN' AND trans_state = '' OR trans_status= 'RTS' AND trans_country = 'QATAR' AND trans_stockist = '' ORDER BY trans_date ASC";
                                    } elseif ($state == 'ALBERTA' && $country == 'CANADA') {
                                        $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'RTS' AND trans_country = '$country' AND trans_stockist = '' AND trans_state = '$state' ORDER BY trans_date ASC";
                                    } elseif ($state == 'ALL' && $country == 'CANADA') {
                                        $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'RTS' AND trans_country = '$country' AND trans_stockist = '' AND trans_state != 'ALBERTA' ORDER BY trans_date ASC";
                                    } else {
                                        $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'RTS' AND trans_stockist = '' AND trans_country = '$country' ORDER BY trans_date DESC";
                                    }
                                    $order_qry = mysqli_query($connect, $order_sql);
                                    $number =1;
                                    while ($order = mysqli_fetch_array($order_qry)) {
                                        $total = $order['trans_subtotal'];
                                        $status = $order['trans_status'];
                                        $reseller = $order['trans_my_reseller'];
                                        $seller = $order['trans_seller'];
                                        
                                        $get_name = "SELECT * FROM upti_users WHERE users_code = '$seller' AND users_employee = '' AND users_role = 'UPTIRESELLER'";
                                        $get_name_qry = mysqli_query($connect, $get_name);
                                        $get_num_name = mysqli_num_rows($get_name_qry);
                                        $get_name_fetch = mysqli_fetch_array($get_name_qry);
                                        
                                        if ($get_num_name >= 1) {
                                            $fullname = $get_name_fetch['users_name'];
                                        } else {
                                            if ($reseller == 'UPTIMAIN') {
                                                $fullname = 'Uptimised Corporation';
                                            } else {
                                                $get_name1 = "SELECT * FROM upti_users WHERE users_code = '$reseller' AND users_role = 'UPTIRESELLER'";
                                                $get_name_qry1 = mysqli_query($connect, $get_name1);
                                                $get_name_fetch1 = mysqli_fetch_array($get_name_qry1);
                                                
                                                $fullname = $get_name_fetch1['users_name'];
                                            }
                                            // $fullname = $reseller;
                                        }
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number ?></td>
                                  <td class="text-center"><a class="btn-sm rounded-0 btn btn-dark" href="poid-list.php?id=<?php echo $order['id']; ?>" target="_blank"><?php echo $order['trans_poid']; ?></a></td>
                                  <td class="text-center">
                                      <?php echo $fullname; ?>
                                  </td>
                                  <td class="text-center"><?php echo $order['trans_country']; ?></td>
                                  <td class="text-center"><?php echo $order['trans_fname']; ?> <?php echo $order['trans_cname']; ?> <?php echo $order['trans_lname']; ?></td>
                                  <td class="text-center"><?php echo $order['trans_date']; ?></td>
                                  <td class="text-center"><?php echo $order['trans_mop']; ?></td>
                                  <td class="text-center"><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#image<?php echo $order['id']; ?>"><i class="fas fa-image"></i></button></td>
                                  <td class="text-right"><?php echo number_format($total) ?></td>
                                  <td class="text-center">
                                      <span class="badge badge-danger"><?php echo $status ?></span>
                                  </td>
                                  <td class="text-center"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#receive<?php echo $order['trans_poid']; ?>" title="Receive"><i class="fas fa-reply"></i></button></td>
                                </tr>
                                <?php
                                  include 'backend/admin-order-receive-modal.php';
                                  $number++;
                                  }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>