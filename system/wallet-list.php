<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
        </div><!-- /.row -->
        <div class="row">

          <?php
            $reseller_id = $_SESSION['code'];

            $earning_sql = "SELECT reseller_earning FROM upti_reseller WHERE reseller_code = '$reseller_id'";
            $earning_qry = mysqli_query($connect, $earning_sql);
            $earning_fetch = mysqli_fetch_array($earning_qry);
            $earn_ko = $earning_fetch['reseller_earning'];

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-wallet"></i></h2>
              </div>

              <div class="info">
                <h6>Reseller Wallet</h6>
                <h2>₱ <?php echo number_format($earn_ko, '2'); ?></h2>
              </div>
            </div>
          </div>

          <?php
            $walletko_sql = "SELECT SUM(withdraw_amount) AS pending FROM upti_withdraw WHERE withdraw_name = '$reseller_id' AND withdraw_status = 'Pending'";
            $walletko_qry = mysqli_query($connect, $walletko_sql);
            $walletko_fetch = mysqli_fetch_array($walletko_qry);
            $walletko = $walletko_fetch['pending'];
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-primary">
                <h2 class="text-center"><i class="uil uil-money-withdrawal"></i></h2>
              </div>

              <div class="info">
                <h6>Pending Cash Out</h6>
                <h2>₱ <?php echo number_format($walletko, '2'); ?></h2>
              </div>
            </div>
          </div>
          
          <?php
            $earning_sql = "SELECT SUM(earning_deduct) AS earn_deduct FROM upti_earning WHERE earning_code = '$reseller_id' AND earning_status != 'RTS Orders'";
            $earning_qry = mysqli_query($connect, $earning_sql);
            $earning_fetch = mysqli_fetch_array($earning_qry);
            $earn_ko = $earning_fetch['earn_deduct'];
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-money-withdrawal"></i></h2>
              </div>

              <div class="info">
                <h6>Total Cash Out</h6>
                <h2>₱ <?php echo number_format($earn_ko, '2'); ?></h2>
              </div>
            </div>
          </div>
        </div>

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
                <h3 class="card-title"></h3>
                <?php
                    $days = date('l');
                    // $days = 'Friday';

                    $get_pending = "SELECT * FROM upti_withdraw WHERE withdraw_name = '$reseller_id' AND withdraw_status = 'Pending'";
                    $get_pending_qry = mysqli_query($connect, $get_pending);
                    $get_pending_num = mysqli_num_rows($get_pending_qry);

                    if ($days == 'Monday' && $get_pending_num == 0 || $days == 'Tuesday' && $get_pending_num == 0 || $days == 'Wednesday' && $get_pending_num == 0) {
                ?>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#earning">
                  Withdraw Earning
                </button>
                <?php 
                    } else { 
                ?>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#earning" disabled>
                  Withdraw Earning
                </button>
                <?php
                    }
                ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Poid</th>
                    <th>Name</th>
                    <th>Comission Tax</th>
                    <th>Deduction</th>
                    <th>Earning</th>
                    <th>Remarks</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <?php
                    $wallet_sql = "SELECT * FROM upti_earning WHERE earning_code = '$reseller_id'";
                    $wallet_qry = mysqli_query($connect, $wallet_sql);
                    while ($wallet = mysqli_fetch_array($wallet_qry)) {
                      $status = $wallet['earning_status'];
                      $poid = $wallet['earning_poid'];

                      $get_uid = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                      $get_uid_qry = mysqli_query($connect, $get_uid);
                      $get_uid_fetch = mysqli_fetch_array($get_uid_qry);
                      $get_num_uid = mysqli_num_rows($get_uid_qry);

                      if ($get_num_uid >= 1 ) {
                        $uid = $get_uid_fetch['trans_seller'];

                        $get_name = "SELECT * FROM upti_users WHERE users_code = '$uid'";
                        $get_name_qry = mysqli_query($connect, $get_name);
                        $get_name_fetch = mysqli_fetch_array($get_name_qry);
                      } else {
                        $get_uid = "SELECT * FROM upti_reseller WHERE reseller_poid = '$poid'";
                        $get_uid_qry = mysqli_query($connect, $get_uid);
                        $get_uid_fetch = mysqli_fetch_array($get_uid_qry);

                        $uid = $get_uid_fetch['reseller_osr'];

                        if($uid == '') {
                          $uid = $get_uid_fetch['reseller_code'];
                        }

                        $get_name = "SELECT * FROM upti_users WHERE users_code = '$uid'";
                        $get_name_qry = mysqli_query($connect, $get_name);
                        $get_name_fetch = mysqli_fetch_array($get_name_qry);
                      }

                  ?>
                  <tr>
                    <td><?php echo $wallet['earning_date'] ?></td>
                    <td><?php echo $wallet['earning_poid'] ?></td>
                    <td><?php echo $get_name_fetch['users_name'] ?></td>
                    <td><?php echo $wallet['earning_tax'] ?></td>
                    <td><?php echo $wallet['earning_deduct'] ?></td>
                    <td><?php echo $wallet['earning_earnings'] ?></td>
                    <td><?php echo $wallet['earning_remarks'] ?></td>
                    <td>
                      <?php
                        if ($status == 'Withdrawal') {
                      ?>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#receipt<?php echo $wallet['id']; ?>">Receipt</button>
                      <?php
                        } else {
                          echo $status;
                        }
                      ?>
                    </td>
                  </tr>
                  <?php include 'backend/wallet-receipt-modal.php'; } ?>                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include 'backend/withdraw-modal.php'; ?>
  </div>

<?php include 'include/footer.php'; ?>