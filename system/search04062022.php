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
              <li class="breadcrumb-item active">Search Poid Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
        if (isset($_POST['search-poid'])) {
            $poid_number = $_POST['sp'];
            $order_sql = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid_number'";
            $order_qry = mysqli_query($connect, $order_sql);

            if (mysqli_num_rows($order_qry) < 1) {
                $order_qry = mysqli_query($connect, "SELECT * FROM upti_transaction WHERE trans_fname LIKE '%".$poid_number."%'");
            }
        } else {
            $order_sql = "SELECT * FROM upti_transaction WHERE trans_poid = 'Ronnel C. Navarro'";
            $order_qry = mysqli_query($connect, $order_sql);
        }
    ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <form action="" method="post">
            <div class="row">
                <div class="col-7"></div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="form-group">
                                <input type="text" name="sp" class="form-control" placeholder="Search Poid / Customer Name" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <button class="btn btn-success form-control" name="search-poid">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
          <div class="col-12">
          <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">List of My Order</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Poid</th>
                            <th>Reseller</th>
                            <th>Country</th>
                            <th>Name</th>
                            <th>Date & Time</th>
                            <th>Mode of Payment</th>
                            <th>Image</th>
                            <th class="text-right">Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                        $number =1;
                        while ($order = mysqli_fetch_array($order_qry)) {
                            $total = $order['trans_subtotal'];
                            $status = $order['trans_status'];
                            $reseller = $order['trans_seller'];
                            $get_name = "SELECT * FROM upti_users WHERE users_code = '$reseller'";
                            $get_name_qry = mysqli_query($connect, $get_name);
                            $get_name_fetch = mysqli_fetch_array($get_name_qry);
                            
                            $res_role = $get_name_fetch['users_role'];
                            $res_code = $get_name_fetch['users_main'];
                            $reseller_name = $get_name_fetch['users_name'];
                            
                            if($res_role != 'UPTIRESELLER') {
                                $get_name1 = "SELECT * FROM upti_users WHERE users_code = '$res_code'";
                                $get_name_qry1 = mysqli_query($connect, $get_name1);
                                $get_name_fetch1 = mysqli_fetch_array($get_name_qry1);
                                
                                $reseller_name = $get_name_fetch1['users_name']; 
                            }
                    ?>
                    <tr>
                        <td><?php echo $number; ?></td>
                        <td class="text-center"><a target="_blank" class="btn-sm btn btn-dark" href="poid-list.php?id=<?php echo $order['id']; ?>"><?php echo $order['trans_poid']; ?></a></td>
                        <td>
                            <?php echo $reseller_name; ?>
                        </td>
                        <td><?php echo $order['trans_country']; ?></td>
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
                            <span class="badge badge-primary"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'Canceled') {
                            ?>
                            <span class="badge badge-danger"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'Delivered') {
                            ?>
                            <span class="badge badge-success"><?php echo $status ?></span>
                            <?php
                                } elseif ($status == 'RTS') {
                            ?>
                            <span class="badge badge-warning"><?php echo $status ?></span>
                            <?php
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if ($status == 'Pending') {
                            ?>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel<?php echo $order['id']; ?>">Cancel</button>
                            <?php
                                } else {
                            ?>
                            <span class="badge badge-warning">is not available</span>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        include 'backend/admin-order-image-modal.php';
                        include 'backend/order-cancel-modal.php';
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
