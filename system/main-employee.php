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
                        <span class="float-left text-primary"><b>Uptimised Employee List</b></span>

                        <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                          Add Employee
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
                                    <th class="text-center">Position</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php 
                                  $code_sql = "SELECT * FROM upti_users WHERE users_employee = 'EMPLOYEE'";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                      $status = $code['users_status'];
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number; ?></td>
                                  <td class="text-center"><?php echo $code['users_name'] ?></td>
                                  <td class="text-center"><?php echo $code['users_username'] ?></td>
                                  <td class="text-center"><?php echo $code['users_position'] ?></td>
                                  <td class="text-center"><?php if ($status == 'Active') { echo '<span class="badge badge-success rounded-0">Active</span>'; } else { echo '<span class="badge badge-danger rounded-0">Deactive</span>'; } ?></td>
                                  <td class="text-center">
                                    <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#edit<?php echo $code['users_id']; ?>">Update</button>
                                    <button class="btn btn-danger btn-sm rounded-0" data-toggle="modal" data-target="#delete<?php echo $code['users_id']; ?>">Delete</button>
                                  </td>
                                </tr>
                                <?php
                                  include 'backend/employee-edit-modal.php';
                                  include 'backend/employee-delete-modal.php';
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
  <?php include 'backend/employee-add-modal.php'; ?>
  <?php } else { echo "<script>window.location='../login.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>