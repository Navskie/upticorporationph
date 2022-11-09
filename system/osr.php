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
        <?php
          $months = date('m'); 
          $year = date('Y');
          $date1 = $months.'-01-'.$year;
          $date2 = date('m-d-Y');
          $month = date("F", mktime(0, 0, 0, $months, 10));
          $osrID = $_SESSION['code'];
        
          $total_points_sql_0 = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osrID' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '10-31-2022'";
          $total_sql_points_sql_0 = mysqli_query($connect, $total_points_sql_0);
          $total_fetch_points_sql_0 = mysqli_fetch_array($total_sql_points_sql_0);
    
          $reward_sales = $total_fetch_points_sql_0['total'];
        ?>
        <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-primary">
                <h2 class="text-center text-light"><i class="uil uil-user-exclamation"></i></h2>
              </div>

              <div class="info">
                <h6>OSR Seller Code</h6>
                <h2><b><?php echo $osrID ?></b></h2>
                <div class="copy-text">
                  <input type="text" id="myInput" value="https://system.uptimised-hris.com/replicate.php?id=<?php echo $_SESSION['code'] ?>" style="display: none">
                  <button class="btn btn-success" onclick="myFunction()"><i class="uil uil-copy"></i> Get Link</button>
                  <br><br>
                </div>
              </div>
            </div>
            <br>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview" style="background: #2771D0;">
                <h2 class="text-center text-light"><i class="uil uil-plane-departure"></i></h2>
              </div>

              <div class="info">
                <h6>Boracay Travel Incentive</h6>
                <h2><b><?php echo number_format($reward_sales) ?> / 1,600,000</b></h2>
                <p class="text-danger pt-2">1 Ticket for every 1,600,000 sales (April - October)</p>
              </div>
            </div>
            <br>
          </div>
        </div>
        <hr>
        <?php

          $get_saless = "SELECT SUM(upti_order_list.ol_php) AS php FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$osrID' AND upti_transaction.trans_date = '$date2' AND upti_transaction.trans_status = 'Pending' OR upti_order_list.ol_seller = '$osrID' AND upti_transaction.trans_date = '$date2' AND upti_transaction.trans_status = 'In Transit' OR upti_order_list.ol_seller = '$osrID' AND upti_transaction.trans_date = '$date2' AND upti_transaction.trans_status = 'On Process' OR  upti_order_list.ol_seller = '$osrID' AND upti_transaction.trans_date = '$date2' AND upti_transaction.trans_status = 'Delivered'";
          $get_saless_qry = mysqli_query($connect, $get_saless);
          $get_saless_fetch = mysqli_fetch_array($get_saless_qry);
          $saless223 = mysqli_num_rows($get_saless_qry);
          
          $saless = $get_saless_fetch['php'];

          $get_sales = "SELECT SUM(upti_order_list.ol_php) AS totphp FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_seller = '$osrID' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
          $get_sales_qry = mysqli_query($connect, $get_sales);
          $get_sales_fetch = mysqli_fetch_array($get_sales_qry);
          $sales223 = mysqli_num_rows($get_sales_qry);

          $totsales = $get_sales_fetch['totphp'];

          $delivered = "SELECT SUM(ol_php) AS deliveredsales FROM upti_activities INNER JOIN upti_order_list ON upti_activities.activities_poid = upti_order_list.ol_poid WHERE activities_caption = 'Order Delivered' AND ol_seller = '$osrID' AND activities_date BETWEEN '$date1' AND '$date2'";
          $delivered_sql = mysqli_query($connect, $delivered);
          $delivered_fetch = mysqli_fetch_array($delivered_sql);

          $delivered_ngayon = $delivered_fetch['deliveredsales'];

          $spent = "SELECT SUM(inq_ads) AS spent FROM upti_inquiries WHERE inq_date = '$date2' AND inq_osr = '$osrID'";
          $spent_sql = mysqli_query($connect, $spent);
          $spent_fetch = mysqli_fetch_array($spent_sql);

          $spent_ngayon = $spent_fetch['spent'];

          $mtd = "SELECT SUM(inq_mtd) AS mtd FROM upti_inquiries WHERE inq_date = '$date2' AND inq_osr = '$osrID'";
          $mtd_sql = mysqli_query($connect, $mtd);
          $mtd_fetch = mysqli_fetch_array($mtd_sql);

          $mtd_ngayon = $mtd_fetch['mtd'];
          
          $get_number_rts = "SELECT COUNT(trans_status) AS RTSs FROM upti_transaction WHERE trans_status = 'RTS' AND trans_seller = '$osrID' AND trans_date BETWEEN '$date1' AND '$date2'";
        $get_number_rts_qry = mysqli_query($connect, $get_number_rts);
        $get_number_rts_fetch = mysqli_fetch_array($get_number_rts_qry);

        $RTSs = $get_number_rts_fetch['RTSs'];

        $total_rts = $get_number_rts_fetch['RTSs'] * 500;

        if ($RTSs <= 19 && $RTSs >= 10) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 1000;
        } elseif ($RTSs >= 20 && $RTSs <= 29) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 2000;
        } elseif ($RTSs >= 30 && $RTSs <= 39) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 3000;
        } elseif ($RTSs >= 40 && $RTSs <= 49) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 4000;
        } elseif ($RTSs >= 50 && $RTSs <= 59) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 5000;
        } elseif ($RTSs >= 60 && $RTSs <= 69) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 6000;
        } elseif ($RTSs >= 70 && $RTSs <= 79) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 7000;
        } elseif ($RTSs >= 80 && $RTSs <= 89) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 8000;
        } elseif ($RTSs >= 90 && $RTSs <= 99) {
            $total_rts = $get_number_rts_fetch['RTSs'] * 500 + 9000;
        }
        
        if ($sales223 == 0) {
            echo '0';
        } else {
            $sales = $get_sales_fetch['totphp'] - $total_rts;
            
        } 

          if($saless == 0 && $spent_ngayon != 0) {
                $DailyROAS = 0;
            } elseif ($saless != 0 && $spent_ngayon == 0) {
                $DailyROAS = 0;
            } elseif ($saless == 0 && $spent_ngayon == 0) {
                $DailyROAS = 0;
            } else {
                $DailyROAS = $saless / $spent_ngayon;
            }

            if($totsales == 0 && $mtd_ngayon != 0) {
                $MtdROAS = 0;
            } elseif ($totsales != 0 && $mtd_ngayon == 0) {
                $MtdROAS = 0;
            } elseif ($totsales == 0 && $mtd_ngayon == 0) {
                $MtdROAS = 0;
            } else {
                $MtdROAS = $totsales / $mtd_ngayon;
            }

            if($mtd_ngayon == 0 && $sales != 0) {
                $DeliveredROAS = 0;
            } elseif ($mtd_ngayon != 0 && $sales == 0) {
                $DeliveredROAS = 0;
            } elseif ($mtd_ngayon == 0 && $sales == 0) {
                $DeliveredROAS = 0;
            } else {
                $DeliveredROAS = $sales / $mtd_ngayon;
            }

        ?>
        <br>
        <div class="row">

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-dark">
                <h2 class="text-center"><i class="uil uil-dollar-alt"></i></h2>
              </div>

              <div class="info">
                <h6>Today Sales</h6>
                <h2><b>
                  <?php 
                    if ($saless223 == 0) {
                        echo '0';
                    } else {
                        echo '₱ '.number_format($saless);
                    } 
                  ?>
                </b></h2>
                <!-- <a href="admin-rts-order.php" class="text-info">MORE INFO </a> -->
              </div>
            </div>
            <br>
          </div>

          <?php

            $get_saless = "SELECT SUM(inq_number) AS inq FROM upti_inquiries WHERE inq_date = '$date2' AND inq_osr = '$osrID'";
            $get_saless_qry = mysqli_query($connect, $get_saless);
            $get_saless_fetch = mysqli_fetch_array($get_saless_qry);
            $saless223 = mysqli_num_rows($get_saless_qry);
            
            $saless = $get_saless_fetch['inq'];

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-user-plus"></i></h2>
              </div>

              <div class="info">
                <h6>Total Inquiries</h6>
                <h2><b>
                <?php      
                  if ($saless223 == 0) {
                      echo '0';
                  } else {
                      echo number_format($saless);
                  } 
                ?>
                </b></h2>
                <!-- <a href="admin-rts-order.php" class="text-info">MORE INFO </a> -->
              </div>
            </div>
            <br>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-percentage"></i></h2>
              </div>

              <div class="info">
                <h6>Today ROAS</h6>
                <h2><b>
                <?php 
                  if ($saless223 == 0) {
                      echo '0';
                  } else {
                      echo number_format($DailyROAS, 2, '.', '');
                  } 
                ?>
                </b></h2>
                <!-- <a href="admin-rts-order.php" class="text-info">MORE INFO </a> -->
              </div>
            </div>
            <br>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-percentage"></i></h2>
              </div>

              <div class="info">
                <h6>Delivered ROAS</h6>
                <h2><b>
                <?php 
                  if ($saless223 == 0) {
                      echo '0';
                  } else {
                      echo number_format($DeliveredROAS, 2, '.', '');
                  } 
                ?>
                </b></h2>
                <!-- <a href="admin-rts-order.php" class="text-info">MORE INFO </a> -->
              </div>
            </div>
            <br>
          </div>
            
        </div>
        <hr>
        <div class="row">

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-success">
                <h2 class="text-center"><i class="uil uil-percentage"></i></h2>
              </div>
              <?php
                $website_del = "SELECT SUM(cart_earn) AS website_sales FROM web_cart INNER JOIN upti_activities ON activities_poid = cart_ref WHERE cart_upper = '$osrID' AND cart_status = 'Delivered' AND activities_date BETWEEN '$date1' AND '$date2'";
                $website_test = mysqli_query($connect, $website_del);
                $website_del_fetch = mysqli_fetch_array($website_test);
    
                $website_sales4 = $website_del_fetch['website_sales'] + $sales;
              ?>
              <div class="info">
                <h6>Total Delivered Sales</h6>
                <h2><b>
                <?php 
                  echo '₱ '.number_format($website_sales4);
                ?>
                </b></h2>
                <p class="text-info">For the month of <?php echo $month ?> </p>
              </div>
            </div>
            <br>
          </div>

          <?php

            $get_sales1 = "SELECT SUM(upti_order_list.ol_php) AS php FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_seller = '$osrID' AND upti_order_list.ol_date BETWEEN '$date1' AND '$date2'";
            $get_sales_qry1 = mysqli_query($connect, $get_sales1);
            $get_sales_fetch1 = mysqli_fetch_array($get_sales_qry1);

            $website_transit = mysqli_query($connect, "SELECT SUM(cart_earn) AS website_sales FROM web_cart WHERE cart_upper = '$osrID' AND cart_status = 'In Transit'");
            $website_transit_fetch = mysqli_fetch_array($website_transit);

            $website_sales3 = $website_transit_fetch['website_sales'];

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-info">
                <h2 class="text-center"><i class="uil uil-truck"></i></h2>
              </div>

              <div class="info">
                <h6>Total In Transit Sales</h6>
                <h2><b>
                <?php 
                  $sales22 = mysqli_num_rows($get_sales_qry1);
                  if ($sales22 == 0) {
                      echo '0';
                  } else {
                      $sales1 = $get_sales_fetch1['php'] + $website_sales3;
                      echo '₱ '.number_format($sales1);
                  } 
                ?>
                </b></h2>
                <p class="text-info">For the month of <?php echo $month ?> </p>
              </div>
            </div>
            <br>
          </div>

          <?php

            $get_sales1 = "SELECT SUM(upti_order_list.ol_php) AS php FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_seller = '$osrID' AND upti_order_list.ol_date BETWEEN '$date1' AND '$date2'";
            $get_sales_qry1 = mysqli_query($connect, $get_sales1);
            $get_sales_fetch1 = mysqli_fetch_array($get_sales_qry1);

            $website_process = mysqli_query($connect, "SELECT SUM(cart_earn) AS website_sales FROM web_cart WHERE cart_upper = '$osrID' AND cart_status = 'On Process'");
            $website_process_fetch = mysqli_fetch_array($website_process);

            $website_sales2 = $website_process_fetch['website_sales'];

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-primary">
                <h2 class="text-center"><i class="uil uil-process"></i></h2>
              </div>

              <div class="info">
                <h6>Total On Process Sales</h6>
                <h2><b>
                <?php 
                  $sales22 = mysqli_num_rows($get_sales_qry1);
                  if ($sales22 == 0) {
                      echo '0';
                  } else {
                      $sales1 = $get_sales_fetch1['php'] + $website_sales2;
                      echo '₱ '.number_format($sales1);
                  } 
                ?>
                </b></h2>
                <p class="text-info">For the month of <?php echo $month ?> </p>
              </div>
            </div>
            <br>
          </div>

          <?php

            $get_sales1 = "SELECT SUM(upti_order_list.ol_php) AS php FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osrID' AND upti_order_list.ol_date BETWEEN '$date1' AND '$date2'";
            $get_sales_qry1 = mysqli_query($connect, $get_sales1);
            $get_sales_fetch1 = mysqli_fetch_array($get_sales_qry1);

            $website_pending = mysqli_query($connect, "SELECT SUM(cart_earn) AS website_sales FROM web_cart WHERE cart_upper = '$osrID' AND cart_status = 'Pending'");
            $website_pending_fetch = mysqli_fetch_array($website_pending);

            $website_sales = $website_pending_fetch['website_sales'];

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-secondary">
                <h2 class="text-center"><i class="uil uil-elipsis-double-v-alt"></i></h2>
              </div>

              <div class="info">
                <h6>Total Pending Sales</h6>
                <h2><b>
                <?php 
                  $sales22 = mysqli_num_rows($get_sales_qry1);
                  if ($sales22 == 0) {
                      echo '0';
                  } else { 
                      $sales1 = $get_sales_fetch1['php'] + $website_sales;
                      echo '₱ '.number_format($sales1);
                  } 
                ?>
                </b></h2>
                <p class="text-info">For the month of <?php echo $month ?> </p>
              </div>
            </div>
            <br>
          </div>

          <?php

            $get_sales12 = "SELECT COUNT(DISTINCT trans_poid) AS rtss FROM upti_transaction INNER JOIN upti_activities ON upti_transaction.trans_poid = upti_activities.activities_poid WHERE activities_caption = 'RTS' AND trans_seller = '$osrID' AND trans_date BETWEEN '$date1' AND '$date2'";
            $get_sales_qry12 = mysqli_query($connect, $get_sales12);
            $get_sales_fetch12 = mysqli_fetch_array($get_sales_qry12);

            $get_sales_rts = "SELECT COUNT(DISTINCT trans_poid) AS deliver_rts FROM upti_transaction INNER JOIN upti_activities ON upti_transaction.trans_poid = upti_activities.activities_poid WHERE activities_caption = 'Deliver to RTS' AND trans_seller = '$osrID' AND activities_date BETWEEN '$date1' AND '$date2'";
            $get_sales_qry_rts = mysqli_query($connect, $get_sales_rts);
            $get_sales_fetch_rts = mysqli_fetch_array($get_sales_qry_rts);

          ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="course">
              <div class="preview bg-danger">
                <h2 class="text-center"><i class="uil uil-corner-up-left-alt"></i></h2>
              </div>

              <div class="info">
                <h6>Total RTS</h6>
                <h2><b>
                <?php 
                  $sales12 = $get_sales_fetch12['rtss'] + $get_sales_fetch_rts['deliver_rts'];
                  if ($sales12 == '') {
                      echo '0';
                  } else {
                      echo number_format($sales12);
                  } 
                ?>
                </b></h2>
                <p class="text-info">For the month of <?php echo $month ?> </p>
              </div>
            </div>
            <br>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- START HERE -->
    

  </div>

<?php include 'include/footer.php'; ?>
<script>
function myFunction() {
  // Get the text field
  var copyText = document.getElementById("myInput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
}
</script>