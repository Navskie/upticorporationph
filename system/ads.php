<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'ADS') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                        <span class="float-left text-primary"><b>OSR Reports</b></span>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-striped table-sm table-hover border border-info"> 
                                <thead>
                                    <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">OSR Name</th>
                                      <th class="text-center">Today</th>
                                      <th class="text-center">Pending</th>
                                      <th class="text-center">In Transit</th>
                                      <th class="text-center">On Process</th>
                                      <th class="text-center">Delivered</th>
                                      <th class="text-center">Total Sales</th>
                                      <th class="text-center bg-dark">INQUIRIES</th>
                                      <th class="text-center bg-info">ADS SPENT</th>
                                      <th class="text-center bg-primary">ADS MTD</th>
                                      <th class="text-center">ROAS DAILY</th>
                                      <th class="text-center">ROAS MTD</th>
                                      <th class="text-center">ROAS DELIVERED</th>
                                      <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $now = date('m-d-Y');
                                    $months = date('m'); 
                                    $year = date('Y');
                                    $date1 = $months.'-01-'.$year;
                                    $date2 = $months.'-31-'.$year;  
                                    $name = $_SESSION['code'];

                                    $account = "SELECT * FROM upti_users WHERE 
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS111' AND users_position = '$name' OR 
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS112' AND users_position = '$name' OR 
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS113' AND users_position = '$name' OR
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS114' AND users_position = '$name' OR
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'S2111' AND users_position = '$name'
                                    ORDER BY users_name ASC";
                                    $account_qry = mysqli_query($connect, $account);
                                    $number = 1;
                                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                                        $osrcode = $account_fetch['users_code']
                                ?>
                                  <tr>
                                    <td class="text-center"><?php echo $number ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_name'] ?></td>

                                    <!-- Today Sales -->
                                    <td class="text-center">
                                        <?php
                                            $today = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$osrcode' AND upti_transaction.trans_date = '$now' AND upti_transaction.trans_status = 'Pending' OR upti_order_list.ol_seller = '$osrcode' AND upti_transaction.trans_date = '$now' AND upti_transaction.trans_status = 'In Transit' OR upti_order_list.ol_seller = '$osrcode' AND upti_transaction.trans_date = '$now' AND upti_transaction.trans_status = 'On Process' OR  upti_order_list.ol_seller = '$osrcode' AND upti_transaction.trans_date = '$now' AND upti_transaction.trans_status = 'Delivered'";
                                            $today_sql = mysqli_query($connect, $today);
                                            $today_fetch = mysqli_fetch_array($today_sql);

                                            $benta_ngayon = $today_fetch['total'];

                                            echo number_format($benta_ngayon);
                                        ?>
                                    </td>

                                    <!-- Pending Sales -->
                                    <td class="text-center">
                                        <?php
                                            $pending = "SELECT SUM(ol_php) AS pendingsales FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_status = 'Pending' AND trans_seller = '$osrcode'";
                                            $pending_sql = mysqli_query($connect, $pending);
                                            $pending_fetch = mysqli_fetch_array($pending_sql);

                                            $pending_ngayon = $pending_fetch['pendingsales'];

                                            echo number_format($pending_ngayon);
                                        ?>
                                    </td>

                                    <!-- In Transit Sales -->
                                    <td class="text-center">
                                        <?php
                                            $intransit = "SELECT SUM(ol_php) AS intransitsales FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_status = 'In Transit' AND trans_seller = '$osrcode'";
                                            $intransit_sql = mysqli_query($connect, $intransit);
                                            $intransit_fetch = mysqli_fetch_array($intransit_sql);

                                            $intransit_ngayon = $intransit_fetch['intransitsales'];

                                            echo number_format($intransit_ngayon);
                                        ?>
                                    </td>

                                    <!-- On Process Sales -->
                                    <td class="text-center">
                                        <?php
                                            $onprocess = "SELECT SUM(ol_php) AS onprocesssales FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_status = 'On Process' AND trans_seller = '$osrcode'";
                                            $onprocess_sql = mysqli_query($connect, $onprocess);
                                            $onprocess_fetch = mysqli_fetch_array($onprocess_sql);

                                            $onprocess_ngayon = $onprocess_fetch['onprocesssales'];

                                            echo number_format($onprocess_ngayon);
                                        ?>
                                    </td>

                                    <!-- Delivered Sales -->
                                    <td class="text-center">
                                        <?php

                                            $delivered = "SELECT SUM(ol_php) AS deliveredsales FROM upti_activities INNER JOIN upti_order_list ON upti_activities.activities_poid = upti_order_list.ol_poid WHERE activities_caption = 'Order Delivered' AND ol_seller = '$osrcode' AND activities_date BETWEEN '$date1' AND '$date2'";
                                            $delivered_sql = mysqli_query($connect, $delivered);
                                            $delivered_fetch = mysqli_fetch_array($delivered_sql);

                                            $delivered_ngayon = $delivered_fetch['deliveredsales'];

                                            echo number_format($delivered_ngayon);
                                        ?>
                                    </td>

                                    <!-- Total Sales -->
                                    <td class="text-center">
                                        <?php
                                            $total_na_benta = $pending_ngayon + $onprocess_ngayon + $intransit_ngayon + $delivered_ngayon;

                                            echo number_format($total_na_benta);
                                        ?>
                                    </td>

                                    <!-- Inquiries -->
                                    <td class="text-center">
                                        <?php

                                            $inqui = "SELECT SUM(inq_number) AS inq FROM upti_inquiries WHERE inq_date = '$now' AND inq_osr = '$osrcode'";
                                            $inqui_sql = mysqli_query($connect, $inqui);
                                            $inqui_fetch = mysqli_fetch_array($inqui_sql);

                                            $inqui_ngayon = $inqui_fetch['inq'];

                                            if ($inqui_ngayon == 0) {
                                                echo ' ';
                                            } else {
                                                echo $inqui_ngayon = $inqui_fetch['inq'];
                                            }
                                            
                                        ?>
                                    </td>

                                    <!-- Daily Ads Spent -->
                                    <td class="text-center">
                                        <?php

                                            $spent = "SELECT SUM(inq_ads) AS spent FROM upti_inquiries WHERE inq_date = '$now' AND inq_osr = '$osrcode'";
                                            $spent_sql = mysqli_query($connect, $spent);
                                            $spent_fetch = mysqli_fetch_array($spent_sql);

                                            $spent_ngayon = $spent_fetch['spent'];

                                            if ($spent_ngayon == 0) {
                                                echo ' ';
                                            } else {
                                                echo number_format($spent_ngayon, 2);
                                            }
                                        ?>
                                    </td>

                                    <!-- Ads MTD -->
                                    <td class="text-center">
                                        <?php

                                            $mtd = "SELECT SUM(inq_mtd) AS mtd FROM upti_inquiries WHERE inq_osr = '$osrcode' AND inq_date = '$now'";
                                            $mtd_sql = mysqli_query($connect, $mtd);
                                            $mtd_fetch = mysqli_fetch_array($mtd_sql);

                                            $mtd_ngayon = $mtd_fetch['mtd'];

                                            if ($mtd_ngayon == 0) {
                                                echo ' ';
                                            } else {
                                                echo number_format($mtd_ngayon, 2);
                                            }
                                        ?>
                                    </td>

                                    <?php
                                        if($benta_ngayon == 0 && $spent_ngayon != 0) {
                                            $DailyROAS = 0;
                                        } elseif ($benta_ngayon != 0 && $spent_ngayon == 0) {
                                            $DailyROAS = 0;
                                        } elseif ($benta_ngayon == 0 && $spent_ngayon == 0) {
                                            $DailyROAS = 0;
                                        } else {
                                            $DailyROAS = $benta_ngayon / $spent_ngayon;
                                        }

                                        if($total_na_benta == 0 && $mtd_ngayon != 0) {
                                            $MtdROAS = 0;
                                        } elseif ($total_na_benta != 0 && $mtd_ngayon == 0) {
                                            $MtdROAS = 0;
                                        } elseif ($total_na_benta == 0 && $mtd_ngayon == 0) {
                                            $MtdROAS = 0;
                                        } else {
                                            $MtdROAS = $total_na_benta / $mtd_ngayon;
                                        }

                                        if($mtd_ngayon == 0 && $delivered_ngayon != 0) {
                                            $DeliveredROAS = 0;
                                        } elseif ($mtd_ngayon != 0 && $delivered_ngayon == 0) {
                                            $DeliveredROAS = 0;
                                        } elseif ($mtd_ngayon == 0 && $delivered_ngayon == 0) {
                                            $DeliveredROAS = 0;
                                        } else {
                                            $DeliveredROAS = $delivered_ngayon / $mtd_ngayon;
                                        }

                                        if ($DailyROAS < 5) {
                                            $class = 'bg-danger';
                                        } else {
                                            $class = 'background: #44b4e5 !important; color: #fff;';
                                        }

                                        if ($MtdROAS < 5) {
                                            $class2 = 'bg-danger';
                                        } else {
                                            $class2 = 'background: #44b4e5 !important; color: #fff;';
                                        }

                                        if ($DeliveredROAS < 5) {
                                            $class3 = 'bg-danger';
                                        } else {
                                            $class3 = 'background: #44b4e5 !important; color: #fff;';
                                        }
                                    ?>

                                    <!-- ROAS DAILY -->
                                    <td class="text-center <?php echo $class ?>" style="<?php echo $class ?>">
                                        <?php
                                            echo number_format($DailyROAS, 2, '.', '');
                                        ?>
                                    </td>

                                    <!-- Roas MTD -->
                                    <td class="text-center <?php echo $class2 ?>" style="<?php echo $class2 ?>">
                                        <?php
                                            echo number_format($MtdROAS, 2, '.', '');
                                        ?>
                                    </td>

                                    <!-- Roas Delivered -->
                                    <td class="text-center <?php echo $class3 ?>" style="<?php echo $class3 ?>">
                                        <?php
                                            echo number_format($DeliveredROAS, 2, '.', '');
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add<?php echo $account_fetch['users_code'] ?>"><i class="fas fa-plus-circle"></i></button>
                                    </td>
                                  </tr>
                                  <?php
                                    include 'backend/ads-modal.php';
                                    $number++;
                                    }
                                  ?>
                            </table>
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