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
      
    </section>
  </div>

<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>