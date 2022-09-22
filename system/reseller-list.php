<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIMAINS' || $_SESSION['role'] == 'SPECIAL') { ?>
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
                        <span class="float-left text-primary"><b>Reseller List</b></span>
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
                                      <th class="text-center">ID Number</th>
                                      <th class="text-center">Name</th>
                                      <th class="text-center">Username</th>
                                      <th class="text-center">Password</th>
                                      <th class="text-center">Package</th>
                                      <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <?php
                                    $creator_code = $_SESSION['code'];

                                    $account = "SELECT upti_users.users_status, upti_reseller.id, upti_reseller.reseller_package, upti_reseller.reseller_desc, upti_reseller.reseller_amount, upti_reseller.reseller_name, upti_reseller.reseller_mobile, upti_reseller.reseller_address, upti_reseller.reseller_code, upti_reseller.reseller_status, upti_reseller.reseller_main, upti_reseller.reseller_date, upti_users.users_username, upti_users.users_password FROM upti_reseller INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_users.users_status = 'Active' AND upti_users.users_main <> 'UPTIMAIN' ORDER BY id DESC";
                                    $account_qry = mysqli_query($connect, $account);
                                    $number = 1;
                                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                                ?>
                                  <tr>
                                    <td class="text-center"><?php echo $number ?></td>
                                    <td class="text-center"><?php echo $account_fetch['reseller_code'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['reseller_name'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_username'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_password'] ?></td>
                                    <td class="text-center"><button class="btn btn-sm btn-info rounded-0" data-toggle="modal" data-target="#view<?php echo $account_fetch['id']; ?>">Package</button></td>
                                    <td class="text-center"><span class="badge badge-success rounded-0"><?php echo $account_fetch['users_status'] ?></span></td>
                                  </tr>
                                  <?php
                                    include 'backend/reseller-view-modal.php';
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

  <?php } else { echo "<script>window.location='../login.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>