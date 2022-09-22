<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIHR') { ?>
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
                        <span class="float-left text-primary"><b>Osr List</b></span>
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
                                      <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <?php
                                    $creator_code = $_SESSION['code'];

                                    $account = "SELECT * FROM upti_users WHERE users_role ='UPTIOSR' ORDER BY users_id DESC";
                                    $account_qry = mysqli_query($connect, $account);
                                    $number = 1;
                                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                                ?>
                                  <tr>
                                    <td class="text-center"><?php echo $number ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_code'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_name'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_username'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_password'] ?></td>
                                    <td class="text-center"><span class="badge badge-success rounded-0"><?php echo $account_fetch['users_status'] ?></span></td>
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
  </div>
  <?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>