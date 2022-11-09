<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php
    $myid = $_SESSION['uid'];

    $get_country_sql = "SELECT * FROM upti_users WHERE users_id = '$myid'";
    $get_country_qrys = mysqli_query($connect, $get_country_sql);
    $get_country_fetch = mysqli_fetch_array($get_country_qrys);

    $employee = $get_country_fetch['users_employee'];
?>
<?php include 'include/sidebar.php'; ?>
<?php
  date_default_timezone_set('Asia/Manila');
  $month = date('m');
  $monthName = date("F", mktime(0, 0, 0, $month, 10));
  $year = date('Y');
  $day = date('d');
  $date1 = $month.'-01-'.$year;
  $date2 = date('m-d-Y');
  
  $_SESSION['role'];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- START HERE -->
    <div class="container-fluid">
        <div class="row">
          <?php
            $total = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_country = '$employee'";
            $total_sql = mysqli_query($connect, $total);
            $total_fetch = mysqli_fetch_array($total_sql);

            $total1 = "SELECT COUNT(trans_ref) AS total FROM web_transaction WHERE trans_country = '$employee'";
            $total1_sql = mysqli_query($connect, $total1);
            $total1_fetch = mysqli_fetch_array($total1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-warning">
                <h2 class="text-center"><i class="uil uil-shopping-cart-alt"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> TOTAL ORDERS</h6>
                <h2><b><?php echo $total_sales = $total_fetch['total'] + $total1_fetch['total']?></b></h2>
                <a href="branch-all-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $pending = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Pending' AND  trans_country = '$employee'";
            $pending_sql = mysqli_query($connect, $pending);
            $pending_fetch = mysqli_fetch_array($pending_sql);

            $pending1 = "SELECT COUNT(trans_ref) AS total FROM web_transaction WHERE trans_status = 'Pending' AND  trans_country = '$employee'";
            $pending1_sql = mysqli_query($connect, $pending1);
            $pending1_fetch = mysqli_fetch_array($pending1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-secondary">
                <h2 class="text-center"><i class="uil uil-clock-five"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> PENDING ORDERS</h6>
                <h2><b><?php echo $total_pending = $pending_fetch['total'] + $pending1_fetch['total']?></b></h2>
                <a href="branch-pending-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $process = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'On Process' AND  trans_country = '$employee'";
            $process_sql = mysqli_query($connect, $process);
            $process_fetch = mysqli_fetch_array($process_sql);

            $process1 = "SELECT COUNT(trans_ref) AS total FROM web_transaction WHERE trans_status = 'On Process' AND  trans_country = '$employee'";
            $process1_sql = mysqli_query($connect, $process1);
            $process1_fetch = mysqli_fetch_array($process1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-info">
                <h2 class="text-center"><i class="uil uil-process"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> ON PROCESS ORDERS</h6>
                <h2><b><?php echo $total_process = $process_fetch['total'] + $process1_fetch['total'] ?></b></h2>
                <a href="branch-on-process-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $transit = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'In Transit' AND  trans_country = '$employee'";
            $transit_sql = mysqli_query($connect, $transit);
            $transit_fetch = mysqli_fetch_array($transit_sql);

            $transit1 = "SELECT COUNT(trans_ref) AS total FROM upti_transaction WHERE trans_status = 'In Transit' AND  trans_country = '$employee'";
            $transit1_sql = mysqli_query($connect, $transit1);
            $transit1_fetch = mysqli_fetch_array($transit1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-primary">
                <h2 class="text-center"><i class="uil uil-truck"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> IN TRANSIT ORDERS</h6>
                <h2><b><?php echo $total_sales = $transit_fetch['total'] + $transit1_fetch['total']?></b></h2>
                <a href="branch-in-transit-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $delivered = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Delivered' AND  trans_country = '$employee'";
            $delivered_sql = mysqli_query($connect, $delivered);
            $delivered_fetch = mysqli_fetch_array($delivered_sql);

            $delivered1 = "SELECT COUNT(trans_ref) AS total FROM upti_transaction WHERE trans_status = 'Delivered' AND  trans_country = '$employee'";
            $delivered1_sql = mysqli_query($connect, $delivered1);
            $delivered1_fetch = mysqli_fetch_array($delivered1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-check-circle"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> DELIVERED ORDERS</h6>
                <h2><b><?php echo $total_delivered = $delivered_fetch['total'] + $delivered1_fetch['total']?></b></h2>
                <a href="branch-delivered-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $canceled = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Canceled' AND  trans_country = '$employee'";
            $canceled_sql = mysqli_query($connect, $canceled);
            $canceled_fetch = mysqli_fetch_array($canceled_sql);

            $canceled1 = "SELECT COUNT(trans_ref) AS total FROM upti_transaction WHERE trans_status = 'Canceled' AND  trans_country = '$employee'";
            $canceled1_sql = mysqli_query($connect, $canceled1);
            $canceled1_fetch = mysqli_fetch_array($canceled1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-times-circle"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> CANCELED ORDERS</h6>
                <h2><b><?php echo $total_cancel = $canceled_fetch['total'] + $canceled1_fetch['total']?></b></h2>
                <a href="branch-cancel-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $rts = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'RTS' AND  trans_country = '$employee'";
            $rts_sql = mysqli_query($connect, $rts);
            $rts_fetch = mysqli_fetch_array($rts_sql);

            $rts1 = "SELECT COUNT(trans_ref) AS total FROM upti_transaction WHERE trans_status = 'RTS' AND  trans_country = '$employee'";
            $rts1_sql = mysqli_query($connect, $rts1);
            $rts1_fetch = mysqli_fetch_array($rts1_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-corner-up-left-alt"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> RTS ORDERS</h6>
                <h2><b><?php echo $total_rts = $rts_fetch['total'] + $rts1_fetch['total']?></b></h2>
                <a href="branch-rts-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

        </div>
        <!-- /.row -->

        
    </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <div class="container-fluid">
      <div class="container-fluid">
        
      </div>
    </div>

  </div>
<!-- /.login-box -->

<?php include 'include/footer.php'; ?>
<script>
  <?php if (isset($_SESSION['country'])) { ?>

  toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-center",
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

  toastr.success("<?php echo flash('country'); ?>");

  <?php } ?>
</script>