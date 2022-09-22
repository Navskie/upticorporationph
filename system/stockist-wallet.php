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
  $reseller_id = $_SESSION['code'];

  $get_country_sql = "SELECT * FROM stockist WHERE stockist_code = '$reseller_id'";
  $get_country_qry = mysqli_query($connect, $get_country_sql);
  $get_country_fetch = mysqli_fetch_array($get_country_qry);

  $employee = $get_country_fetch['stockist_country'];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row"> 
          <?php
            $days = date('l');
            // $days = 'Friday';

            $wallet_stmt = mysqli_query($connect, "SELECT * FROM stockist_wallet WHERE w_id = '$reseller_id'");
            $wallet = mysqli_fetch_array($wallet_stmt);

            // wallet
            if (mysqli_num_rows($wallet_stmt) > 0) {
              $available_balance = $wallet['w_earning'];
            } else {  
              $available_balance = '0.00';
            }


          ?>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="course">
                <div class="preview bg-success">
                  <h2 class="text-center"><i class="uil uil-wallet"></i></h2>
                </div>

                <div class="info">
                  <h6>Stockist Wallet</h6>
                  <h2>₱ <?php echo number_format($available_balance, '2') ?></h2>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="course">
                <div class="preview bg-primary">
                  <h2 class="text-center"><i class="uil uil-money-withdrawal"></i></h2>
                </div>

                <div class="info">
                  <h6>Pending Cash Out</h6>
                  <h2>₱ 0.00</h2>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="course">
                <div class="preview bg-danger">
                  <h2 class="text-center"><i class="uil uil-money-withdrawal"></i></h2>
                </div>

                <div class="info">
                  <h6>Total Cash Out</h6>
                  <h2>₱ 0.00</h2>
                </div>
              </div>
            </div>
        </div>
        <br>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <?php

                date_default_timezone_set("Asia/Manila"); 
                $today = date('Y-m-d');
                $date = date('m-d-Y', strtotime($today.'-7 days'));
                //echo $date;

                $get_pending = "SELECT * FROM upti_withdraw WHERE withdraw_name = '$reseller_id' AND withdraw_status = 'Pending'";
                $get_pending_qry = mysqli_query($connect, $get_pending);
                $get_pending_num = mysqli_num_rows($get_pending_qry);

              ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-md-12 col-sm-12 pr-2">
                    <div class="border border-info p-4 h-100">
                      <h5 class="text-center">Wallet Withdraw</h5>
                      <p class="text-center text-danger">minimum of 500.00</p>
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="">Bank</label>
                          <input type="text" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label for="">Amount</label>
                          <input type="text" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                          <hr>
                          <p class="text-center text-danger">Available Monday - Wednesday</p>
                          <?php if ($days != 'Monday' || $days != 'Tuesday' || $days != 'Wednesday') { ?>
                            <button class="btn btn-success form-control rounded-0">Submit</button>
                          <?php } else { ?>
                            <button class="btn btn-success form-control rounded-0" disabled>Submit</button>
                          <?php } ?>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="col-lg-9 col-md-12 col-sm-12 pl-2">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th class="text-center">Date</th>
                        <th class="text-center">Poid</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Stockist Total</th>
                        <th class="text-center">Refund</th>
                      </tr>
                      </thead>
                      <?php
                        $wallet_sql = "SELECT * FROM stockist_earning WHERE e_id = '$reseller_id' AND e_country = '$employee' AND e_status = 'Sales' AND e_date BETWEEN '$date' AND '$today'";
                        $wallet_qry = mysqli_query($connect, $wallet_sql);
                        while ($wallet = mysqli_fetch_array($wallet_qry)) {
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $wallet['e_date'] ?> - <?php echo $wallet['e_time'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_poid'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_code'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_desc'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_qty'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_price'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_subtotal'] ?></td>
                        <td class="text-center"><?php echo $wallet['e_refund'] ?></td>
                      </tr>
                      <?php } ?>                  
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include 'backend/withdraw-modal.php'; ?>
  </div>

<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>