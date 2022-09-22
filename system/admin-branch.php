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
                        <span class="float-left text-primary"><b>CSR Branch Account</b></span>

                        <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                          Add Branch
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
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php 
                                  $code_sql = "SELECT * FROM upti_users WHERE users_role = 'BRANCH'";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $status = $code['users_status'];
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number; ?></td>
                                  <td class="text-center"><?php echo $code['users_name'] ?></td>
                                  <td class="text-center"><?php echo $code['users_username'] ?></td>
                                  <td class="text-center"><?php echo $code['users_password'] ?></td>
                                  <td class="text-center"><?php echo $code['users_employee'] ?></td>
                                  <td class="text-center"><?php if ($status == 'Active') { echo '<span class="badge badge-success">Active</span>'; } else { echo '<span class="badge badge-danger">Deactive</span>'; } ?></td>
                                  <td class="text-center">
                                    <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#edit<?php echo $code['users_id']; ?>">Update</button>
                                    <button class="btn btn-danger  btn-sm rounded-0" data-toggle="modal" data-target="#delete<?php echo $code['users_id']; ?>">Delete</button>
                                  </td>
                                </tr>
                                <?php
                                    include 'backend/branch-edit-modal.php';
                                    include 'backend/branch-delete-modal.php';
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
  <?php include 'backend/branch-add-modal.php'; ?>

<?php include 'include/footer.php'; ?>

<?php } else { echo "<script>window.location='../login.php'</script>"; } ?>