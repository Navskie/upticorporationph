<?php include 'include/header.php'; ?>
<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<?php
  $myid = $_SESSION['code'];

  $get_country_sql = "SELECT * FROM stockist WHERE stockist_code = '$myid'";
  $get_country_qry = mysqli_query($connect, $get_country_sql);
  $get_country_fetch = mysqli_fetch_array($get_country_qry);

  echo $employee = $get_country_fetch['stockist_country'];
  echo $state = $get_country_fetch['stockist_state'];

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <span class="text-center">Extract Pending Orders into Excel File</span>
                        </div>
                        <div class="col-6">
                            <form action="cs-excel.php" method="post">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date1">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date2">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button class="btn btn-dark form-control rounded-0" name="export">EXPORT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->


        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="float-left text-info">Incoming Orders</h4>
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
                                      <th class="text-center">PDF</th>
                                    </tr>
                                </thead>
                                <?php
                                    if ($employee == 'CANADA') {
                                      if ($state != 'ALBERTA') {
                                        $order_sql = "SELECT * FROM web_transaction WHERE trans_status = 'Pending' AND trans_state != 'ALBERTA' AND trans_country = '$employee' ORDER BY trans_date ASC";
                                      } else {
                                        $order_sql = "SELECT * FROM web_transaction WHERE trans_status = 'Pending' AND trans_state = '$state' AND trans_country = '$employee' ORDER BY trans_date ASC";
                                      }
                                    }
                                    else 
                                    {
                                      if($employee == 'UNITED ARAB EMIRATES') {
                                        echo $order_sql = "SELECT * FROM web_transaction WHERE trans_status= 'Pending' AND trans_country = '$employee' OR trans_status= 'Pending' AND trans_country = 'OMAN' OR trans_status= 'Pending' AND trans_country = 'KUWAIT' OR trans_status= 'Pending' AND trans_country = 'BAHRAIN' OR trans_status= 'Pending' AND trans_country = 'QATAR' ORDER BY trans_date ASC";
                                      } else {
                                          echo $order_sql = "SELECT * FROM web_transaction WHERE trans_status= 'Pending' AND trans_country = '$employee' ORDER BY trans_date ASC";
                                      }
                                    }
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
                                  <td class="text-center"><a href="generate-poid-cs.php?poidgenerate=<?php echo $poid ?>" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i></a></td>
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