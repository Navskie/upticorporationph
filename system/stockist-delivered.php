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
<?php include 'include/navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<?php
    $month = date('m');
    $year = date('Y');
    $date1 = $month.'-01-'.$year;
    $date2 = date('m-d-Y');
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
              <li class="breadcrumb-item active">All Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orders List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Poid</th>
                            <th>Reseller</th>
                            <th>Country</th>
                            <th>Name</th>
                            <th>Date & Time</th>
                            <th>Mode of Payment</th>
                            <th>Image</th>
                            <th class="text-right">Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                        $mycode = $_SESSION['code'];
                        // $order_sql = "SELECT * FROM upti_transaction WHERE trans_status = 'Pending' ORDER BY trans_poid DESC";
                        if ($country == 'CANADA' && $state == 'ALBERTA') {
                          $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Delivered' AND trans_country = '$country' AND trans_state = '$state' AND trans_date BETWEEN '$date1' AND '$date2' ORDER BY trans_poid DESC";
                        } elseif ($country == 'CANADA' && $state == 'ALL') {
                          $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Delivered' AND trans_country = '$country' AND trans_state = '$state' AND trans_date BETWEEN '$date1' AND '$date2' ORDER BY trans_poid DESC";
                        } else {
                          $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Delivered' AND trans_country = '$country' AND trans_date BETWEEN '$date1' AND '$date2' ORDER BY trans_poid DESC";
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
                        <td><?php echo $number; ?></td>
                        <td class="text-center"><a class="btn-sm btn btn-dark" href="poid-list.php?id=<?php echo $order['id']; ?>" target="_blank"><?php echo $order['trans_poid']; ?></a></td>
                        <td>
                            <?php echo $fullname; ?>
                        </td>
                        <td><?php echo $order['trans_country']; ?></td>
                        <td><?php echo $order['trans_fname']; ?> <?php echo $order['trans_cname']; ?> <?php echo $order['trans_lname']; ?></td>
                        <td><?php echo $order['trans_date']; ?></td>
                        <td><?php echo $order['trans_mop']; ?></td>
                        <td class="text-center"><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#image<?php echo $order['id']; ?>"><i class="fas fa-image"></i></button></td>
                        <td class="text-right"><?php echo number_format($total, '2') ?></td>
                        <td class="text-center">
                            <?php
                                if ($status == 'Pending') {
                            ?>
                            <span class="badge badge-primary"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'In Transit') {
                            ?>
                            <span class="badge badge-info"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'On Process') {
                            ?>
                            <span class="badge badge-info"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'Delivered') {
                            ?>
                            <span class="badge badge-success"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'RTS') {
                            ?>
                            <span class="badge badge-warning"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'Canceled') {
                            ?>
                            <span class="badge badge-danger"><?php echo $status ?></span>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        include 'backend/admin-order-image-modal.php';
                        $number++;
                        }
                    ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include 'include/footer.php'; ?>
<?php } else { echo "<script>window.location='../login.php'</script>"; } ?>