<?php include 'include/header.php'; ?>
<?php
    $SCode = $_SESSION['code'];
    
    if ($_SESSION['role'] == 'WEBSITE') {
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
                            <h4 class="float-left text-info">Website Incoming Delivered Orders</h4>
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Poid</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Date & Time</th>
                                        <th class="text-center">Mode of Payment</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <?php
                                    
                                    $order_sql = "SELECT * FROM web_transaction WHERE trans_status= 'Delivered' ORDER BY trans_date ASC";
                                    
                                    $order_qry = mysqli_query($connect, $order_sql);
                                    $number =1;
                                    while ($order = mysqli_fetch_array($order_qry)) {
                                        $total = $order['trans_subtotal'];
                                        $status = $order['trans_status'];
                                        $poid = $order['trans_ref'];
                                        
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $number ?></td>
                                    <td class="text-center"><a class="btn-sm rounded-0 btn btn-dark" href="poid-list2.php?id=<?php echo $order['id']; ?>" target="_blank"><?php echo $order['trans_ref']; ?></a></td>

                                    <td class="text-center"><?php echo $order['trans_country']; ?></td>
                                    <td class="text-center"><?php echo $order['trans_name']; ?></td>
                                    <td class="text-center"><?php echo $order['trans_date']; ?></td>
                                    <td class="text-center"><?php echo $order['trans_mop']; ?></td>
                                    <td class="text-right"><?php echo number_format($total) ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-primary"><?php echo $status ?></span>
                                    </td>
                                </tr>
                                <?php
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