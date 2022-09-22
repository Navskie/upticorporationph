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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Uptimain Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

    <?php $myid = $_SESSION['code']; ?>
        <!-- START HERE -->
    <div class="container-fluid">

        <div class="row">
          <div class="col-lg-6 col-md-6 col-12">
            <h5 class="mb-2 mt-4">Reseller Sales Ranking</h5>
              <div class="card">
                <div class="card-header">
                  <span class="float-right"><b><?php echo $year ?></b></span>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Ranking</th>
                      <!-- <th>OSR ID</th> -->
                      <th>Name</th>
                      <!-- <th>Sales</th> -->
                    </tr>
                    </thead>
                    <?php
                      $item_sql1 = "SELECT upti_users.users_code, upti_users.users_name, SUM(upti_order_list.ol_php) AS sales FROM upti_users INNER JOIN upti_order_list ON upti_users.users_code = upti_order_list.ol_reseller INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_status = 'Delivered' AND upti_users.users_role = 'UPTIRESELLER' AND upti_order_list.ol_php > 0 AND upti_users.users_employee = '' AND upti_users.users_position = '' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' GROUP BY upti_users.users_code ORDER BY sales DESC LIMIT 15";
                      $item_qry1 = mysqli_query($connect, $item_sql1);
                      $number = 1;
                      while ($item1 = mysqli_fetch_array($item_qry1)) {
                        $sales = $item1['sales'];
                        // echo '<br>';
                        // echo $number.' '.$item1['users_name'];
                        // echo '<br>';
                        $numbers = $number;
                    ?>
                    <tr>
                      
                      <?php if($number < 4) { ?>
                        <td class="text-center"><span class="badge badge-warning"><?php echo $numbers ?></span></td>
                        <td class="text-center"><b><?php echo $item1['users_name']; ?></b></td>
                      <?php } else { ?>
                        <td class="text-center"><span class="badge badge-info"><?php echo $numbers ?></span></td>
                        <td class="text-center"><?php echo $item1['users_name']; ?></td>
                      <?php } ?>
                      
                      <!-- <td><?php //echo $item['users_code']; ?></td> -->
                      
                      <!-- <td><?php //echo number_format($sales) ?></td> -->
                    </tr>
                    <?php
                      $number++;
                      }
                    ?>
                  </table>
                </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-12">
            <h5 class="mb-2 mt-4">Reseller Leadership Ranking</h5>
            <div class="card">
              <div class="card-header">
                  <span class="float-right"><b><?php echo $year ?></b></span>
              </div>
              <div class="card-body">
                <table id="example22" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Ranking</th>
                    <!-- <th>Reseller ID</th> -->
                    <th>Name</th>
                  </tr>
                  </thead>
                  <?php
                    $item_sql = "SELECT upti_users.users_name ,COUNT(upti_reseller.reseller_main) AS reseller_count FROM upti_users INNER JOIN upti_reseller ON upti_users.users_code = upti_reseller.reseller_main WHERE upti_users.users_role = 'UPTIRESELLER' AND upti_users.users_position = '' AND upti_reseller.reseller_date BETWEEN '$date1' AND '$date2' GROUP BY upti_users.users_code ORDER BY reseller_count DESC LIMIT 15";
                    $item_qry = mysqli_query($connect, $item_sql);
                    $number = 1;
                    while ($item = mysqli_fetch_array($item_qry)) {
                  ?>
                  <tr>
                    <?php if ($number < 4) { ?>
                    <td class="text-center"><span class="badge badge-danger"><?php echo $number ?></span></td>
                    
                    <td class="text-center"><b><?php echo $item['users_name']; ?></b></td>

                    <?php } else { ?>
                    <td class="text-center"><span class="badge badge-info"><?php echo $number ?></span></td>
                    
                    <td class="text-center"><?php echo $item['users_name']; ?></td>

                    <?php } ?>
                    
                    
                    
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