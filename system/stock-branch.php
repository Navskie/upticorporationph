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
                        <span class="float-left text-primary"><b>Stockist Branch Account</b></span>

                        <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#stockbranch">
                          Register Stockist
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
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">Dated Added</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php
                                $Ucode = $_SESSION['code'];
                                  $code_sql = "SELECT * FROM stockist ORDER BY id DESC";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $status = $code['stockist_status'];
                                    $codes = $code['stockist_code'];

                                    $get_name = "SELECT * FROM upti_users WHERE users_code = '$codes'";
                                    $get_name_qry = mysqli_query($connect, $get_name);
                                    $get_name_fetch = mysqli_fetch_array($get_name_qry);
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number; ?></td>
                                  <td class="text-center"><?php echo $get_name_fetch['users_name'] ?></td>
                                  <td class="text-center"><?php echo $code['stockist_country'] ?></td>
                                  <td class="text-center"><?php echo $code['stockist_state'] ?></td>
                                  <td class="text-center"><?php echo $code['stockist_date'] ?></td>
                                  <td class="text-center"><?php echo $code['stockist_role'] ?></td>
                                  <td class="text-center"><?php if ($status == 'Active') { echo '<span class="badge badge-success">Active</span>'; } else { echo '<span class="badge badge-danger">Deactive</span>'; } ?></td>
                                  <td class="text-center">
                                    <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#stockedit<?php echo $code['id']; ?>">Update</button>
                                    <button class="btn btn-danger  btn-sm rounded-0" data-toggle="modal" data-target="#stockdelete<?php echo $code['id']; ?>">Delete</button>
                                  </td>
                                </tr>
                                <?php
                                    include 'backend/stockist-edit-modal.php';
                                    include 'backend/stockist-delete-modal.php';
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
  <?php include 'backend/stockist-modal.php'; ?>

<?php include 'include/footer.php'; ?>

<?php } else { echo "<script>window.location='../login.php'</script>"; } ?>