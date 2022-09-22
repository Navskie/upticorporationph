<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIMAINS') { ?>
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
                        <span class="float-left text-primary"><b>Main Reseller List</b></span>
                        <button type="button" class="btn btn-primary float-right btn-sm rounded-0" data-toggle="modal" data-target="#reseller">
                          Add Reseller
                        </button>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                  <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php
                                    $creator_code = $_SESSION['code'];

                                    $account = "SELECT upti_reseller.id, upti_reseller.reseller_name, upti_reseller.reseller_mobile, upti_reseller.reseller_address, upti_reseller.reseller_code, upti_reseller.reseller_status, upti_reseller.reseller_main, upti_reseller.reseller_date, upti_users.users_username, upti_users.users_password FROM upti_reseller INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_users.users_main = '$creator_code'";
                                    $account_qry = mysqli_query($connect, $account);
                                    $number = 1;
                                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                                ?>
                                  <tr>
                                    <td class="text-center"><?php echo $account_fetch['reseller_name'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_username'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['reseller_address'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['reseller_mobile'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger rounded-0" data-toggle="modal" data-target="#delete<?php echo $account_fetch['id']; ?>">Delete</button>
                                    </td>
                                  </tr>
                                  <?php
                                    include 'backend/main-reseller-delete-modal.php';
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
  <?php include 'backend/main-reseller-add-modal.php' ?>
  <?php } else { echo "<script>window.location='../login.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>