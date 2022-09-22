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
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Account List</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
        $mycode = $_SESSION['code'];       

        if (isset($_POST['country'])) {
            $newDate1 = $_POST['date1'];
            $date1 = date("m-d-Y", strtotime($newDate1));
            $newDate2 = $_POST['date2'];
            $date2 = date("m-d-Y", strtotime($newDate2));
            $country = $_POST['bansa'];
            $status = $_POST['status'];
 
            if (!empty($country) AND empty($status)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);
                
                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
                
                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];

            } elseif (empty($country) AND $status == 'Order Delivered') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);
                // echo '<br>';
                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_caption = '$status' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
                // echo '<br>';
                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];

            } elseif (empty($country) AND $status == 'Pending') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'Pending' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);
                // echo '<br>';
                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'Pending' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
                // echo '<br>';
                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'Pending' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
            } elseif (empty($country) AND $status == 'In Transit') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'In Transit' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);
                // echo '<br>';
                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'In Transit' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
                // echo '<br>';
                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'In Transit' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
            } elseif (empty($country) AND $status == 'RTS') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'RTS' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);
                // echo '<br>';
                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'RTS' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
                // echo '<br>';
                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'In Transit' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
            } elseif (empty($country) AND $status == 'On Process') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'On Process' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);
                // echo '<br>';
                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'On Process' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
                // echo '<br>';
                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_transaction.trans_status = 'On Process' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
            } elseif (!empty($country) AND $status == 'Order Delivered') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_country = '$country' AND upti_activities.activities_caption = '$status' AND upti_order_list.ol_seller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$mycode' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_caption = '$status' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                
            } elseif ($country == '' AND $status == '') {
                $order_sql = "SELECT * FROM upti_order_list WHERE ol_seller = '$mycode' AND ol_date BETWEEN '$date1' AND '$date2' ORDER BY ol_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(ol_php) AS total FROM upti_order_list WHERE ol_seller = '$mycode' AND ol_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $totals = "SELECT SUM(ol_points) AS points FROM upti_order_list WHERE ol_seller = '$mycode' AND ol_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                
            }

            $sum = $total_fetch['total'];
            
        } else {
            $order_sql = "SELECT * FROM upti_order_list WHERE ol_status= '[uptimised]'";
            $order_qry = mysqli_query($connect, $order_sql);

            $sum = 0;
            $puntos = '';
            $country = '';
            $status = '';
            $date1 = '';
            $date2 = '';
        }

    ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
          
      <form action="osr-reports.php" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo number_format($sum) ?></h3>

                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php if ($puntos == '') {echo '0';} else {echo $puntos;}?></h3>

                            <p>Point Sales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" name="date1" class="form-control" min="1997-01-01" max="2300-12-31">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" name="date2" class="form-control" min="1997-01-01" max="2300-12-31">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="bansa">
                                    <option value="">Select Country</option>
                                    <?php
                                    $product_sql = "SELECT * FROM upti_country_currency";
                                    $product_qry = mysqli_query($connect, $product_sql);
                                    while ($product = mysqli_fetch_array($product_qry)) {
                                    ?>
                                    <option value="<?php echo $product['cc_country'] ?>"><?php echo $product['cc_country'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Transit">In Transit</option>
                                    <option value="On Process">On Process</option>
                                    <option value="RTS">RTS</option>
                                    <option value="Order Delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Action</label><br>
                        <button class="btn btn-success form-control" name="country">Generate Report</button>
                    </div>
                </div>
            </div>
        
        <div class="row">
          <div class="col-12">
            
            <div class="card">                    
                <div class="card-header">
                    <!--<button class="btn btn-success float-right" name="export-excel" title="Export Excel File">-->
                    <!--    <i class="fas fa-file-excel"></i>-->
                    <!--</button>-->
                </div>
            </form>
              <!-- /.card-header -->
              <div class="card-body">
                  <?php
                    if ($date2 != '' && $date1 != '') {
                        echo '<b>From '.$date1.' to '.$date2.'<br>'.$country.'<br>'.$status.'</b>';
                    }
                  ?>
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Poid</th>
                            <th class="text-center">Country</th>
                            <th class="text-center">Date Ordered</th>
                            <th class="text-center">Date Trigered</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Points</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <?php
                        $number =1;
                        while ($order = mysqli_fetch_array($order_qry)) {
                            $total = $order['ol_php'];
                            if ($status != 'Order Delivered' AND $status != '') {
                                $statuss = $order['trans_status'];
                                $date_tri = '-----';
                            } else {
                                $statuss = $order['activities_caption'];
                                $date_tri = $order['activities_date'];
                            }
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $number; ?></td>
                        <td class="text-center"><?php echo $order['ol_poid']; ?></td>
                        <td class="text-center"><?php echo $order['ol_country']; ?></td>
                        <td class="text-center"><?php echo $order['ol_date']; ?></td>
                        <td class="text-center"><?php echo $date_tri ?></td>
                        <td class="text-right"><?php echo number_format($total) ?></td>
                        <td class="text-center"><?php echo $order['ol_points']; ?></td>
                        <td class="text-center">
                            <?php
                                if ($statuss == 'Pending') {
                            ?>
                            <span class="badge badge-primary"><?php echo 'Pending' ?></span>
                            <?php
                                } elseif ($statuss == 'Order Delivered') {
                            ?>
                            <span class="badge badge-success"><?php echo 'Delivered' ?></span>
                            <?php
                                } elseif ($statuss == 'RTS') {
                            ?>
                            <span class="badge badge-danger"><?php echo 'RTS' ?></span>
                            <?php
                                } elseif ($statuss == 'In Transit') {
                            ?>
                            <span class="badge badge-info"><?php echo 'In Transit' ?></span>
                            <?php
                                } elseif ($statuss == 'On Process') {
                            ?>
                            <span class="badge badge-warning"><?php echo 'On Process' ?></span>
                            <?php
                                }
                            ?>
                        </td>
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
    </section>
  </div>

<?php include 'include/footer.php'; ?>