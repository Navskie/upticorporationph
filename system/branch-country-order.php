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
              <li class="breadcrumb-item active">Country Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
        $mycode = $_SESSION['uid'];
        
        $get_country_sql = "SELECT * FROM upti_users WHERE users_id = '$mycode'";
        $get_country_qry = mysqli_query($connect, $get_country_sql);
        $get_country_fetch = mysqli_fetch_array($get_country_qry);

        $employee = $get_country_fetch['users_employee'];

        if (isset($_POST['country'])) {
            $newDate1 = $_POST['date1'];
            $date1 = date("m-d-Y", strtotime($newDate1));
            $newDate2 = $_POST['date2'];
            $date2 = date("m-d-Y", strtotime($newDate2));
            $status = $_POST['status'];

            if ($status != 'Delivered') {
                $order_sql = "SELECT * FROM upti_transaction WHERE trans_country = '$employee', trans_status = '$status' AND trans_date BETWEEN '$date1' AND '$date2' ORDER BY trans_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(ol_php) AS total FROM upti_order_list WHERE ol_status = '$status' AND ol_date BETWEEN '$date1' AND '$date2'";
                // $total = "SELECT SUM(trans_subtotal) AS total FROM upti_transaction WHERE trans_status = '$status' AND trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
            } elseif ($status == 'Delivered') {
                $order_sql = "SELECT * FROM upti_transaction INNER JOIN upti_activities ON upti_transaction.trans_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_transaction.trans_country = '$employee' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_country = '$employee' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                // $total = "SELECT SUM(trans_subtotal) AS total FROM upti_transaction WHERE trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
            } elseif (empty($status)) {
                $order_sql = "SELECT * FROM upti_transaction WHERE trans_date BETWEEN '$date1' AND '$date2' ORDER BY trans_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(ol_php) AS total FROM upti_order_list WHERE ol_date BETWEEN '$date1' AND '$date2'";
                // $total = "SELECT SUM(trans_subtotal) AS total FROM upti_transaction WHERE trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);
            }

            $sum = $total_fetch['total'];
        } else {
            $order_sql = "SELECT * FROM upti_transaction WHERE trans_status= '[uptimised]'";
            $order_qry = mysqli_query($connect, $order_sql);

            $sum = 0;
        }

    ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
          
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo number_format($sum) ?></h3>

                    <p>Total Sales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" name="date1" class="form-control" min="1997-01-01" max="2300-12-31">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" name="date2" class="form-control" min="1997-01-01" max="2300-12-31">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="status">
                                    <option value=""></option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Transit">In Transit</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Canceled">Canceled</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Action</label><br>
                        <button class="btn btn-success form-control" name="country">Generate Country Report</button>
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
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Poid</th>
                            <th>Name</th>
                            <th>Date & Time</th>
                            <th>Mode of Payment</th>
                            <th>Image</th>
                            <th class="text-right">Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                        $number =1;
                        while ($order = mysqli_fetch_array($order_qry)) {
                            $total = $order['trans_subtotal'];
                            $status = $order['trans_status'];
                    ?>
                    <tr>
                        <td><?php echo $number; ?></td>
                        <td class="text-center"><a class="btn-sm btn btn-dark" href="poid-list.php?id=<?php echo $order['id']; ?>"><?php echo $order['trans_poid']; ?></a></td>
                        <td><?php echo $order['trans_fname']; ?> <?php echo $order['trans_cname']; ?> <?php echo $order['trans_lname']; ?></td>
                        <td><?php echo $order['trans_date']; ?></td>
                        <td><?php echo $order['trans_mop']; ?></td>
                        <td class="text-center"><button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#image<?php echo $order['id']; ?>"><i class="fas fa-image"></i></button></td>
                        <td class="text-right"><?php echo number_format($total) ?></td>
                        <td class="text-center">
                            <?php
                                if ($status == 'Pending') {
                            ?>
                            <span class="badge badge-primary"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'In Transit') {
                            ?>
                            <span class="badge badge-info"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'On Process') {
                            ?>
                            <span class="badge badge-info"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'Delivered') {
                            ?>
                            <span class="badge badge-success"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'RTS') {
                            ?>
                            <span class="badge badge-warning"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'Canceled') {
                            ?>
                            <span class="badge badge-danger"><?php echo $status ?></span>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        include 'backend/admin-order-image-modal.php';
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