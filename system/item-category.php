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
                          Add Item Category
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
                                    <th class="text-center">Item Category</th>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                  </thead>
                                  <?php
                                    $category_sql = "SELECT * FROM upti_category";
                                    $category_qry = mysqli_query($connect, $category_sql);
                                    $number = 1;
                                    while($category = mysqli_fetch_array($category_qry)) {
                                  ?>
                                  <tr>
                                    <td class="text-center"><?php echo $number; ?></td>
                                    <td class="text-center"><?php echo $category['category_name'] ?></td>
                                    <td class="text-center"><?php echo $category['category_stamp'] ?></td>
                                    <td class="text-center">
                                      <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#edit<?php echo $category['id']; ?>">Update</button>
                                      <button class="btn btn-danger btn-sm rounded-0" data-toggle="modal" data-target="#delete<?php echo $category['id']; ?>">Delete</button>
                                    </td>
                                  </tr>
                                  <?php
                                    include 'backend/category-edit-modal.php';
                                    include 'backend/category-delete-modal.php';
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
    <?php include 'backend/category-add-modal.php'; ?>
  </div>
  <?php } else { echo "<script>window.location='../login.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>