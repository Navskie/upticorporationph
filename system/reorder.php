<?php include 'include/header.php'; ?>
<?php //include 'include/preloader.php'; ?>
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
                            <h4 class="float-left text-info">My Customer List</h4>
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Customer ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Loyalty</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php
                                  $mycode = $_SESSION['code'];
                                  $order_sql = "SELECT DISTINCT trans_fname, trans_lname, trans_country, trans_address, trans_contact, id, trans_csid FROM upti_transaction WHERE trans_seller = '$mycode' GROUP BY trans_csid, trans_fname ORDER BY id DESC";
                                  $order_qry = mysqli_query($connect, $order_sql);
                                  $number =1;
                                  while ($order = mysqli_fetch_array($order_qry)) {
                                    $csid = $order['trans_csid'];
                                    $loyalty_stmt = mysqli_query($connect, "SELECT * FROM upti_loyalty WHERE loyalty_code = '$csid'");
                                    $loyalty_fetch = mysqli_fetch_array($loyalty_stmt);
                                    if (mysqli_num_rows($loyalty_stmt) > 0) {
                                      $loyalty = $loyalty_fetch['loyalty_number'];
                                    } else {
                                      $loyalty = 0;
                                    }
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number; ?></td>         
                                  <td class="text-center"><?php echo $order['trans_csid'] ?></td>               
                                  <td class="text-center"><?php echo $order['trans_fname']; ?> <?php echo $order['trans_lname']; ?></td>
                                  <td class="text-center"><?php echo $order['trans_contact'] ?></td>
                                  <td class="text-center"><?php echo $order['trans_address'] ?></td>
                                  <td class="text-center"><?php echo $order['trans_country'] ?></td>
                                  <td class="text-center"><?php echo $loyalty ?></td>
                                  <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm rounded-0" data-toggle="modal" data-target="#reorder<?php echo $order['id']; ?>">Re Order</button>
                                  </td>
                                </tr>
                                <?php
                                  include 'backend/cus-reorder-modal.php';
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

<?php include 'include/footer.php'; ?>