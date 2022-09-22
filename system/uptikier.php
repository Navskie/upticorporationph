<?php include 'include/header.php'; ?>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

    <?php 
        $myids = $_SESSION['code']; 
        $get_main_sql = "SELECT * FROM upti_users WHERE users_code = '$myids'";
        $get_main_qry = mysqli_query($connect, $get_main_sql);
        $get_main = mysqli_fetch_array($get_main_qry);
        
        $myid = $get_main['users_creator'];
    ?>
        <!-- START HERE -->
    <div class="container-fluid">
    <h5 class="mb-2 mt-4">Number of Orders</h5>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $total = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid'";
              $total_sql = mysqli_query($connect, $total);
              $total_fetch = mysqli_fetch_array($total_sql);
            ?>
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_fetch['total'] ?></h3>

                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-all-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $pending = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid' AND trans_status = 'Pending'";
              $pending_sql = mysqli_query($connect, $pending);
              $pending_fetch = mysqli_fetch_array($pending_sql);
            ?>
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo $pending_fetch['total'] ?></h3>

                <p>Pending Order</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-pending-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $process = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid' AND trans_status = 'On Process'";
              $process_sql = mysqli_query($connect, $process);
              $process_fetch = mysqli_fetch_array($process_sql);
            ?>
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $process_fetch['total'] ?></h3>

                <p>On Process Order</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-on-process-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $transit = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid' AND trans_status = 'In Transit'";
              $transit_sql = mysqli_query($connect, $transit);
              $transit_fetch = mysqli_fetch_array($transit_sql);
            ?>
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $transit_fetch['total'] ?></h3>

                <p>In Transit Order</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-in-transit-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $delivered = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid' AND trans_status = 'Delivered'";
              $delivered_sql = mysqli_query($connect, $delivered);
              $delivered_fetch = mysqli_fetch_array($delivered_sql);
            ?>
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $delivered_fetch['total'] ?></h3>

                <p>Delivered Order</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-delivered-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $canceled = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid' AND trans_status = 'Canceled'";
              $canceled_sql = mysqli_query($connect, $canceled);
              $canceled_fetch = mysqli_fetch_array($canceled_sql);
            ?>
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $canceled_fetch['total'] ?></h3>

                <p>Cancel Orders</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-cancel-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <?php
              $rts = "SELECT COUNT(trans_my_reseller) AS total FROM upti_transaction WHERE trans_admin = '$myid' AND trans_status = 'RTS'";
              $rts_sql = mysqli_query($connect, $rts);
              $rts_fetch = mysqli_fetch_array($rts_sql);
            ?>
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $rts_fetch['total'] ?></h3>

                <p>RTS Orders</p>
              </div>
              <div class="icon">
              <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="admin-rts-order.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
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

<?php include 'include/footer.php'; ?>