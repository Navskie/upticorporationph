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
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Account List</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reseller Sales Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php 
        $mycode = $_SESSION['code'];       

        if(isset($_POST['reseller'])) {

            $newDate1 = $_POST['date1'];
            $date1 = date("m-d-Y", strtotime($newDate1));
            $newDate2 = $_POST['date2'];
            $date2 = date("m-d-Y", strtotime($newDate2));
            $res = $_POST['res'];
            if ($newDate1 == '' && $newDate2 == '') {
                $wholedate = 'All sales generated';
            } else {
                $wholedate = $date1.' - '.$date2;
            }


            $info = "SELECT * FROM upti_users WHERE users_code = '$res'";
            $info_sql = mysqli_query($connect, $info);
            $info_fetch = mysqli_fetch_array($info_sql);

            $reseller = $info_fetch['users_name'];
            $code = $info_fetch['users_code'];


            if ($newDate1 != '' && $newDate2 != '' && $res == '') {
                $get_data_sql = "SELECT upti_reseller.reseller_code, upti_reseller.reseller_name, SUM(upti_order_list.ol_php) AS TOTAL_SALES FROM upti_reseller
                INNER JOIN
                upti_order_list ON upti_reseller.reseller_code = upti_order_list.ol_seller
                INNER JOIN
                upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid
                WHERE upti_activities.activities_caption = 'Order Delivered' AND
                upti_activities.activities_date BETWEEN '$date1' AND '$date2' GROUP BY upti_reseller.reseller_code ORDER BY TOTAL_SALES DESC";
                $get_data_qry = mysqli_query($connect, $get_data_sql);

                $get_total_sales = "SELECT SUM(upti_order_list.ol_php) AS pinakatotal FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $get_total_qry = mysqli_query($connect, $get_total_sales);
                $get_fetch = mysqli_fetch_array($get_total_qry);

                $pera = $get_fetch['pinakatotal'];

                $fdate = 'Date From '.$date1.' to '.$date2;
                $labas_sales = 'Total Sales: <b>'. number_format($pera, 2, '.', ',').'</b>';

                $number = 1;
                $sales = 0;
                $reseller = 'Reseller Name';
                $wholedate = 'mm/dd/yyyy - mm/dd/yyyy';

            } elseif ($newDate1 == '' && $newDate2 == '') {
                $sales_sql = "SELECT SUM(upti_order_list.ol_php) AS sales FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_reseller = '$code' AND upti_activities.activities_caption = 'Order Delivered'";
                $sales_qry = mysqli_query($connect, $sales_sql);
                $sales_fetch = mysqli_fetch_array($sales_qry);


                $sales = $sales_fetch['sales'];

                $labas_sales = '';
            $fdate = '';

            $get_data_sql = "SELECT * FROM upti_reseller WHERE id = '0'";
            $get_data_qry = mysqli_query($connect, $get_data_sql);
            $number = 1;
            } else {
                $sales_sql = "SELECT SUM(upti_order_list.ol_php) AS sales FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid  WHERE upti_order_list.ol_reseller = '$code' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $sales_qry = mysqli_query($connect, $sales_sql);
                $sales_fetch = mysqli_fetch_array($sales_qry);


                // echo $sales_fetch1['saless'];
                // echo '<br>';
                // echo $sales_fetch['sales'];

                $sales = $sales_fetch['sales'];

                $labas_sales = '';
                $fdate = '';

                $get_data_sql = "SELECT * FROM upti_reseller WHERE id = '0'";
                $get_data_qry = mysqli_query($connect, $get_data_sql);
                $number = 1;
            }


        } else {
            $sales = 0;
            $reseller = 'Reseller Name';
            $wholedate = 'mm/dd/yyyy - mm/dd/yyyy';

            $labas_sales = '';
            $fdate = '';

            $get_data_sql = "SELECT * FROM upti_reseller WHERE id = '0'";
            $get_data_qry = mysqli_query($connect, $get_data_sql);
            $number = 1;
        }

    ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">

            <div class="row">
            
                <div class="col-lg-4 col-md-4 col-sm-6">
                <label>Export Reseller Sales</label>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="excel-file.php" method="post">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="date" name="date1" id="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="date" name="date2" id="" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="res">
                                            <option value="">Select Reseller Name</option>
                                            <?php
                                            $product_sql = "SELECT * FROM upti_users WHERE users_role = 'UPTIRESELLER' AND users_status = 'Active' ORDER BY users_id DESC";
                                            $product_qry = mysqli_query($connect, $product_sql);
                                            while ($product = mysqli_fetch_array($product_qry)) {
                                            ?>
                                            <option value="<?php echo $product['users_code'] ?>"><?php echo $product['users_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="stats">
                                            <option value="">Select Status</option>
                                            <option value="Order Delivered">Delivered</option>
                                            <option value="RTS">RTS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <button class="btn btn-sm btn-dark form-control" name="export_reseller_sales">Export</button>
                                    </form>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <form action="excel-file.php" method="post">
                                    <button class="btn btn-sm btn-primary form-control" name="export_reseller_info">Information</button>
                                    </form>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                <label>Generate Reseller Sales</label>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="" method="post">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="date" name="date1" id="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="date" name="date2" id="" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="res">
                                            <option value="">Select Reseller Name</option>
                                            <?php
                                            $product_sql = "SELECT * FROM upti_users WHERE users_role = 'UPTIRESELLER' AND users_status = 'Active' ORDER BY users_id DESC";
                                            $product_qry = mysqli_query($connect, $product_sql);
                                            while ($product = mysqli_fetch_array($product_qry)) {
                                            ?>
                                            <option value="<?php echo $product['users_code'] ?>"><?php echo $product['users_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-sm btn-success form-control" name="reseller">Generate</button>
                                </div>
                                </form>
                                
                            </div>

                        </div>
                    </div>
                </div>
        
                <div class="col-lg-4 col-md-4 col-sm-12">
                <label>Total Sales</label>
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo number_format($sales) ?></h3>

                            <p><?php echo $reseller ?></p>
                            <p><?php echo $wholedate ?></p>
                            
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <h3><?php echo $labas_sales ?></h3>
            <span><?php echo $fdate ?></span>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <?php 
                    while ($rows_count = mysqli_fetch_array($get_data_qry)) {
                ?>

                    <tr>
                        <td><?php echo $number ?></td>
                        <td class="text-center"><span class="badge badge-info"><?php echo $rows_count['reseller_code'] ?></span> </td>
                        <td><?php echo $rows_count['reseller_name'] ?></td>
                        <td class="text-center"><?php $bentako = $rows_count['TOTAL_SALES']; echo number_format($bentako) ?></td>
                    </tr>

                <?php $number++; } ?>
            </table>
        </div>
    </section>
  </div>

<?php include 'include/footer.php'; ?>