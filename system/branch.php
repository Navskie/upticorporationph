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
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-warning">
                <h2 class="text-center"><i class="uil uil-shopping-cart-alt"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> TOTAL ORDERS</h6>
                <h2><b><?php echo $total_fetch['total'] ?></b></h2>
                <a href="branch-all-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $pending = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Pending' AND  trans_country = '$employee'";
            $pending_sql = mysqli_query($connect, $pending);
            $pending_fetch = mysqli_fetch_array($pending_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-secondary">
                <h2 class="text-center"><i class="uil uil-clock-five"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> PENDING ORDERS</h6>
                <h2><b><?php echo $pending_fetch['total'] ?></b></h2>
                <a href="branch-pending-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $process = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'On Process' AND  trans_country = '$employee'";
            $process_sql = mysqli_query($connect, $process);
            $process_fetch = mysqli_fetch_array($process_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-info">
                <h2 class="text-center"><i class="uil uil-process"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> ON PROCESS ORDERS</h6>
                <h2><b><?php echo $process_fetch['total'] ?></b></h2>
                <a href="branch-on-process-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $transit = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'In Transit' AND  trans_country = '$employee'";
            $transit_sql = mysqli_query($connect, $transit);
            $transit_fetch = mysqli_fetch_array($transit_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-primary">
                <h2 class="text-center"><i class="uil uil-truck"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> IN TRANSIT ORDERS</h6>
                <h2><b><?php echo $transit_fetch['total'] ?></b></h2>
                <a href="branch-in-transit-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $delivered = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Delivered' AND  trans_country = '$employee'";
            $delivered_sql = mysqli_query($connect, $delivered);
            $delivered_fetch = mysqli_fetch_array($delivered_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-check-circle"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> DELIVERED ORDERS</h6>
                <h2><b><?php echo $delivered_fetch['total'] ?></b></h2>
                <a href="branch-delivered-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $canceled = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Canceled' AND  trans_country = '$employee'";
            $canceled_sql = mysqli_query($connect, $canceled);
            $canceled_fetch = mysqli_fetch_array($canceled_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-times-circle"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> CANCELED ORDERS</h6>
                <h2><b><?php echo $canceled_fetch['total'] ?></b></h2>
                <a href="branch-cancel-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $rts = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'RTS' AND  trans_country = '$employee'";
            $rts_sql = mysqli_query($connect, $rts);
            $rts_fetch = mysqli_fetch_array($rts_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-corner-up-left-alt"></i></h2>
              </div>

              <div class="info">
                <h6><?php echo $employee ?> RTS ORDERS</h6>
                <h2><b><?php echo $rts_fetch['total'] ?></b></h2>
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