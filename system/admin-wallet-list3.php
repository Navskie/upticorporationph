<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIACCOUNTING') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/stockist-navbar.php'; ?>
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
                        <span class="float-left text-primary"><b>E-Wallet History</b></span>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                    <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">Reseller Name</th>
                                      <th class="text-center">Amount</th>
                                      <th class="text-center">Status</th>
                                      <th class="text-center">Receipt</th>
                                    </tr>
                                </thead>
                                <?php
                                    $account = "SELECT * FROM upti_earning WHERE earning_status = 'Withdrawal' ORDER BY id DESC";
                                    $account_qry = mysqli_query($connect, $account);
                                    $number = 1;
                                    while ($wallet = mysqli_fetch_array($account_qry)) {
                                        $acc_name = $wallet['earning_code'];
                                        $get_name = "SELECT * FROM upti_reseller WHERE reseller_code = '$acc_name'";
                                        $get_qry = mysqli_query($connect, $get_name);
                                        $get_fetch = mysqli_fetch_array($get_qry);
                                        $name = $get_fetch['reseller_name'];
                                ?>
                                  <tr>
                                    <td class="text-center"><?php echo $number ?></td>
                                    <td class="text-center"><?php echo $name; ?></td>
                                    <td class="text-center"><?php echo $wallet['earning_deduct'] ?></td>
                                    <td class="text-center"><?php echo $wallet['earning_status'] ?></td>
                                    <td class="text-center"><button type="button" class="btn btn-info btn-sm rounded-0" data-toggle="modal" data-target="#receipt<?php echo $wallet['id']; ?>">Receipt</button></td>
                                  </tr>
                                <?php
                                    include 'backend/wallet-receipt-modal.php';
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