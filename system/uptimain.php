<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIMAINS' || $_SESSION['role'] == 'UPTIHR') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<?php
   date_default_timezone_set('Asia/Manila');
   $month = date('m');
   $monthName = date("F", mktime(0, 0, 0, $month, 10));
   $year = date('Y');
   $day = date('d');
   $date1 = $month.'-01-'.$year;
   $date2 = date('m-d-Y');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <div class="container-fluid">
      <br>
      <?php $myid = $_SESSION['code']; ?> 
      <!-- START HERE -->
      <div class="container-fluid">
        <div class="row">

          <?php
            $total = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction";
            $total_sql = mysqli_query($connect, $total);
            $total_fetch = mysqli_fetch_array($total_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-warning">
                <h2 class="text-center"><i class="uil uil-shopping-cart-alt"></i></h2>
              </div>

              <div class="info">
                <h6>TOTAL ORDERS</h6>
                <h2><b><?php echo $total_fetch['total'] ?></b></h2>
                <a href="admin-all-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $pending = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Pending'";
            $pending_sql = mysqli_query($connect, $pending);
            $pending_fetch = mysqli_fetch_array($pending_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-secondary">
                <h2 class="text-center"><i class="uil uil-clock-five"></i></h2>
              </div>

              <div class="info">
                <h6>PENDING ORDERS</h6>
                <h2><b><?php echo $pending_fetch['total'] ?></b></h2>
                <a href="admin-pending-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $process = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'On Process'";
            $process_sql = mysqli_query($connect, $process);
            $process_fetch = mysqli_fetch_array($process_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-info">
                <h2 class="text-center"><i class="uil uil-process"></i></h2>
              </div>

              <div class="info">
                <h6>ON PROCESS ORDERS</h6>
                <h2><b><?php echo $process_fetch['total'] ?></b></h2>
                <a href="admin-on-process-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $transit = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'In Transit'";
            $transit_sql = mysqli_query($connect, $transit);
            $transit_fetch = mysqli_fetch_array($transit_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-primary">
                <h2 class="text-center"><i class="uil uil-truck"></i></h2>
              </div>

              <div class="info">
                <h6>IN TRANSIT ORDERS</h6>
                <h2><b><?php echo $transit_fetch['total'] ?></b></h2>
                <a href="admin-in-transit-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $delivered = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Delivered'";
            $delivered_sql = mysqli_query($connect, $delivered);
            $delivered_fetch = mysqli_fetch_array($delivered_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-check-circle"></i></h2>
              </div>

              <div class="info">
                <h6>DELIVERED ORDERS</h6>
                <h2><b><?php echo $delivered_fetch['total'] ?></b></h2>
                <a href="admin-delivered-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $canceled = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'Canceled'";
            $canceled_sql = mysqli_query($connect, $canceled);
            $canceled_fetch = mysqli_fetch_array($canceled_sql);
          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-times-circle"></i></h2>
              </div>

              <div class="info">
                <h6>CANCELED ORDERS</h6>
                <h2><b><?php echo $canceled_fetch['total'] ?></b></h2>
                <a href="admin-cancel-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

          <?php
            $rts = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_status = 'RTS'";
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
                <a href="admin-rts-order.php" class="text-info">MORE INFO </a>
              </div>
            </div>
            <br>
          </div>

        </div>
        <!-- /.row -->
         
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
</div>
<?php include 'include/footer.php'; ?>
<?php } else { echo "<script>window.location='../login.php'</script>"; } ?>