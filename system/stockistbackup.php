<?php include 'include/header.php'; ?>
<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    $check_stockist_f = mysqli_fetch_array($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
      $code = $check_stockist_f['stockist_code'];
      $country = $check_stockist_f['stockist_country'];
      $state = $check_stockist_f['stockist_state']; 
?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<style>
  .accordion {
    padding-left: 10 !important;
    /* background: #ccc; */
    padding: 10px;
    padding-top: 10px;
  }

  .accordion li {
    list-style: none;
    width: 100%;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    background-color: #fff;
    padding: 0 10px;
    border-radius: 10px;
    background: #f2f2f2;
  }
  .accordion li label{
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 600 !important;
    cursor: pointer;
    color: #333;
  }
  .accordion li label .rotate {
    transform: rotate(90deg);
    font-size: 22px;
  }

  .accordion label + input[type="radio"] {
    display: none;
  }

  .accordion .content {
    padding: 0 20px;
    line-height: 26px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s;
  }

  .accordion label + input[type="radio"]:checked + .content {
    max-height: 400px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <span class="text-center">Extract Pending Orders into Excel File</span>
                        </div>
                        <div class="col-6">
                            <form action="stockist-excel.php" method="post">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date1">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date2">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button class="btn btn-dark form-control rounded-0" name="export">EXPORT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->


        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-info">Incoming Orders</h4>
                            <hr>
                             <!-- Order List Table Start -->
                            <ul class="accordion">
                              <?php
                                if($country == 'UNITED ARAB EMIRATES') {
                                  $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Pending' AND trans_country = '$country' OR trans_status= 'Pending' AND trans_country = 'OMAN' OR trans_status= 'Pending' AND trans_country = 'KUWAIT' OR trans_status= 'Pending' AND trans_country = 'BAHRAIN' OR trans_status= 'Pending' AND trans_country = 'QATAR' ORDER BY trans_date ASC LIMIT 15";
                                } elseif ($state == 'ALBERTA' && $country == 'CANADA') {
                                    $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Pending' AND trans_country = '$country' AND trans_state = '$state' ORDER BY trans_date ASC LIMIT 15";
                                } elseif ($state == 'ALL' && $country == 'CANADA') {
                                    $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Pending' AND trans_country = '$country' AND trans_state != 'ALBERTA' ORDER BY trans_date ASC LIMIT 15";
                                } else {
                                    $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= 'Pending' AND trans_country = '$country' ORDER BY trans_date ASC LIMIT 15";
                                }
                                $order_qry = mysqli_query($connect, $order_sql);
                                $number =1;
                                while ($order = mysqli_fetch_array($order_qry)) {
                                  $total = $order['trans_subtotal'];
                                  $status = $order['trans_status'];
                                  $reseller = $order['trans_my_reseller'];
                                  $seller = $order['trans_seller'];
                                  $poid = $order['trans_poid'];
                                  
                                  $get_name = "SELECT * FROM upti_users WHERE users_code = '$seller' AND users_employee = '' AND users_role = 'UPTIRESELLER'";
                                  $get_name_qry = mysqli_query($connect, $get_name);
                                  $get_num_name = mysqli_num_rows($get_name_qry);
                                  $get_name_fetch = mysqli_fetch_array($get_name_qry);
                                  
                                  if ($get_num_name >= 1) {
                                      $fullname = $get_name_fetch['users_name'];
                                  } else {
                                      if ($reseller == 'UPTIMAIN') {
                                          $fullname = 'Uptimised Corporation';
                                      } else {
                                          $get_name1 = "SELECT * FROM upti_users WHERE users_code = '$reseller' AND users_role = 'UPTIRESELLER'";
                                          $get_name_qry1 = mysqli_query($connect, $get_name1);
                                          $get_name_fetch1 = mysqli_fetch_array($get_name_qry1);
                                          
                                          $fullname = $get_name_fetch1['users_name'];
                                      }
                                      // $fullname = $reseller;
                                  }
                              ?>
                              <li>
                                <label for="<?php echo $order['trans_poid']; ?>" class="text-center">
                                  <?php echo $order['trans_date']; ?> - <?php echo $order['trans_time']; ?>
                                  <span><?php echo $order['trans_poid']; ?> </span> 
                                  <span class="rotate">&#x3e;</span>
                                </label>

                                <input type="radio" name="accordion" id="<?php echo $order['trans_poid']; ?>">
                                <div class="content">
                                  <table class="table table-sm">
                                    <thead>
                                      <th>Test</th>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>test</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </li>
                              <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>