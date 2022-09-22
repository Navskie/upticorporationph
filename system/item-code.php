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
                        <span class="float-left text-primary"><b>Registered Item Code</b></span>
                        <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                          Add Item Code
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
                                    <th class="text-center">Item Code</th>
                                    <th class="text-center">Main Code</th>
                                    <th class="text-center">Item Status</th>
                                    <th class="text-center">Code Category</th>
                                    <th class="text-center">Exclusive</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php 
                                  $code_sql = "SELECT * FROM upti_code ORDER BY id DESC";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number; ?></td>
                                  <td class="text-center"><?php echo $code['code_name'] ?></td>
                                  <td class="text-center"><span class="badge badge-warning"><?php echo $code['code_main'] ?></span></td>
                                  <td class="text-center"><span class="badge badge-primary"><?php echo $code['code_status'] ?></span></td>
                                  <td class="text-center"><span class="badge badge-info"><?php echo $code['code_category'] ?></span></td>
                                  <td class="text-center"><span class="badge badge-info"><?php echo $code['code_exclusive'] ?></span></td>
                                  <td class="text-center">
                                    <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#edit<?php echo $code['id']; ?>">Update</button>
                                    <button class="btn btn-danger btn-sm rounded-0" data-toggle="modal" data-target="#delete<?php echo $code['id']; ?>">Delete</button>
                                  </td>
                                </tr>
                                <?php
                                  include 'backend/code-edit-modal.php';
                                  include 'backend/code-delete-modal.php';
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
    <?php include 'backend/code-add-modal.php'; ?>
  </div>
  <?php } else { echo "<script>window.location='../login.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>