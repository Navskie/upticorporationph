<?php include 'include/header.php'; ?>
<?php //include 'include/preloader.php'; ?>
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
            $osr = $_SESSION['code'];

            $earning_sql = "SELECT osc_wallet FROM upti_osc_wallet WHERE osc_code = '$osr'";
            $earning_qry = mysqli_query($connect, $earning_sql);
            $earning_fetch = mysqli_fetch_array($earning_qry);
            $earn_ko = $earning_fetch['osc_wallet'];

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-wallet"></i></h2>
              </div>

              <div class="info">
                <h6>My Wallet</h6>
                <h2>₱ <?php echo number_format($earn_ko, '2'); ?></h2>
              </div>
            </div>
          </div>
          <?php
            $earning_sql = "SELECT SUM(h_credit) AS earn_deduct FROM upti_osc_history WHERE h_code = '$osr'";
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

                    $get_pending = "SELECT * FROM upti_osr_withdraw WHERE withdraw_name = '$osr' AND withdraw_status = 'Pending'";
                    $get_pending_qry = mysqli_query($connect, $get_pending);
                    $get_pending_num = mysqli_num_rows($get_pending_qry);

                    if ($days == 'Friday' && $get_pending_num == 0 || $days == 'Tuesday' && $get_pending_num == 0 || $days == 'Wednesday' && $get_pending_num == 0) {
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
                    <th class="text-center">Number</th>
                    <th class="text-center">Date & Time</th>
                    <th class="text-center">Credit</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Remarks</th>
                  </tr>
                  </thead>
                  <?php
                    $wallet_sql = "SELECT * FROM upti_osc_history WHERE h_code = '$osr'";
                    $wallet_qry = mysqli_query($connect, $wallet_sql);
                    $number = 1;
                    while ($wallet = mysqli_fetch_array($wallet_qry)) {
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $number; ?></td>
                    <td class="text-center"><?php echo $wallet['h_date'] ?> <?php echo $wallet['h_time'] ?></td>
                    <td class="text-center"><?php echo $wallet['h_credit'] ?></td>
                    <td class="text-center"><?php echo $wallet['h_debit'] ?></td>
                    <td class="text-center"><?php echo $wallet['h_remarks'] ?></td>
                  </tr>
                  <?php $number++; } ?>                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include 'backend/osc-withdrawal-modal.php'; ?>
  </div>

<?php include 'include/footer.php'; ?>