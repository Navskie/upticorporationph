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
        $myrole = $_SESSION['role'];

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

            if (empty($res)) {

                echo "<script>alert('All fields are required');window.location.href = 'osr-reseller-sales.php';</script>";

            } else {

                $info = "SELECT * FROM upti_users WHERE users_code = '$res'";
                $info_sql = mysqli_query($connect, $info);
                $info_fetch = mysqli_fetch_array($info_sql);

                $reseller = $info_fetch['users_name'];
                $code = $info_fetch['users_code'];


               if ($newDate1 == '' && $newDate2 == '') {
                    $sales_sql = "SELECT SUM(ol_php) AS sales FROM upti_order_list WHERE ol_reseller = '$code'";
                    $sales_qry = mysqli_query($connect, $sales_sql);
                    $sales_fetch = mysqli_fetch_array($sales_qry);

                    $sales = $sales_fetch['sales'];
               } else {
                    $sales_sql = "SELECT SUM(ol_php) AS sales FROM upti_order_list WHERE ol_reseller = '$code' AND ol_status = 'Delivered' AND ol_date BETWEEN '$date1' AND '$date2'";
                    $sales_qry = mysqli_query($connect, $sales_sql);
                    $sales_fetch = mysqli_fetch_array($sales_qry);

                    $sales = $sales_fetch['sales'];
               }

            }

        } else {
            $sales = 0;
            $reseller = 'Reseller Name';
            $wholedate = 'mm/dd/yyyy - mm/dd/yyyy';
        }

    ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
          
        <form action="" method="post">
        
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                <label>Generate Reseller Sales</label>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        
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
                                            $product_sql = "SELECT upti_reseller.reseller_name, upti_reseller.reseller_code FROM upti_reseller INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_reseller.reseller_osr = '$mycode'";
                                            $product_qry = mysqli_query($connect, $product_sql);
                                            while ($product = mysqli_fetch_array($product_qry)) {
                                            ?>
                                            <option value="<?php echo $product['reseller_code']; ?>">
                                                <?php echo $product['reseller_name'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-sm btn-success form-control" name="reseller">Generate</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </form>
                <div class="col-lg-6 col-md-6 col-sm-12">
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
        </div>
    </section>
  </div>

<?php include 'include/footer.php'; ?>