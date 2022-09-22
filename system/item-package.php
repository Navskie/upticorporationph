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
                        <span class="float-left text-primary"><b>Bundle Item List</b></span>
                        <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                          Add Bundle Item
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
                                    <th class="text-center">Package Code</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Points</th>
                                    <th class="text-center">Exclusive</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php
                                  $package_sql = "SELECT * FROM upti_package";
                                  $package_qry = mysqli_query($connect, $package_sql);
                                  $number = 1;
                                  while ($package = mysqli_fetch_array($package_qry)) {
                                      $stats = $package['package_status'];
                                      $ex = $package['package_exclusive'];

                                      $get_name = "SELECT * FROM upti_users WHERE users_code = '$ex'";
                                      $get_name_sql = mysqli_query($connect, $get_name);
                                      $get_fetch = mysqli_fetch_array($get_name_sql);
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number ?></td>
                                  <td class="text-center"><b><?php echo $package['package_code']; ?></b></td>
                                  <td class="text-center"><?php echo $package['package_desc']; ?></td>
                                  <td class="text-center"><?php echo $package['package_points']; ?></td>
                                  <td class="text-center">
                                      <?php
                                          if ($ex == '') {
                                      ?>
                                      <span class="badge badge-primary">All Reseller</span>
                                      <?php
                                          } else {
                                      ?>
                                      <span class="badge badge-info"><?php echo $get_fetch['users_name']; ?></span>
                                      <?php
                                          }
                                      ?>
                                  </td>
                                  <td class="text-center">
                                      <?php
                                          if ($stats == 'Active') {
                                      ?>
                                      <span class="badge badge-success">Active</span>
                                      <?php
                                          } else {
                                      ?>
                                      <span class="badge badge-danger">Deactive</span>
                                      <?php
                                          }
                                      ?>
                                  </td>
                                  <td class="text-center"><?php echo $package['package_stamp']; ?></td>
                                  <td class="text-center">
                                    <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#edit<?php echo $package['id']; ?>">Update</button>
                                    <button class="btn btn-danger btn-sm rounded-0" data-toggle="modal" data-target="#delete<?php echo $package['id']; ?>">Delete</button>
                                  </td>
                                </tr>
                                <?php
                                  include 'backend/package-edit-modal.php';
                                  include 'backend/package-delete-modal.php';
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
    <?php include 'backend/package-add-modal.php'; ?>
  </div>
  <?php } else { echo "<script>window.location='../login.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>