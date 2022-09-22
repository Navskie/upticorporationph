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
              <li class="breadcrumb-item active">Withdrawal Request</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Date Request</th>
                    <th>Amount</th>
                    <th>Account Branch</th>
                    <th>Account Name</th>
                    <th>Account Number</th>
                    <th>Remarks</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <?php
                    $uid = $_SESSION['code'];
                    $account = "SELECT * FROM upti_withdraw WHERE withdraw_name = '$uid'";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                        $acc_name = $account_fetch['withdraw_name'];
                        $amount = $account_fetch['withdraw_amount'];
                        $remark = $account_fetch['withdraw_remarks'];
                        $status = $account_fetch['withdraw_status'];
                        
                  ?>
                  <tr>
                    <td><?php echo $number ?></td>
                    <td class="text-center"><?php echo $account_fetch['withdraw_date'] ?></td>
                    <td class="text-right"><?php echo number_format($amount) ?></td>
                    <td class="text-center"><?php echo $account_fetch['withdraw_bank']; ?></td>
                    <td class="text-center"><?php echo $account_fetch['withdraw_acc_name']; ?></td>
                    <td class="text-center"><?php echo $account_fetch['withdraw_acc_number']; ?></td>
                    <td class="text-center"><?php echo $account_fetch['withdraw_remarks']; ?></td>
                    <?php
                        if ($status == 'Approve') {
                    ?>
                    <td class="text-center"><span class="badge badge-success">Approved</span></td>
                    <?php
                        } elseif ($status == 'Pending') {
                    ?>
                    <td class="text-center"><span class="badge badge-primary"><?php echo $account_fetch['withdraw_status']; ?></span></td>
                    <?php
                        } else {
                    ?>
                    <td class="text-center"><span class="badge badge-danger">Reject</span></td>
                    
                    <?php
                        }
                    ?>
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