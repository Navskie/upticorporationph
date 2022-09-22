<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Account List</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reseller Earnings Percentage</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php if ($_SESSION['role'] == 'UPTIMAIN') { ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add">
                  Add Level
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Level</th>
                    <th>Percentage</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <?php 
                    $code_sql = "SELECT * FROM upti_level";
                    $code_qry = mysqli_query($connect, $code_sql);
                    $number = 1;
                    while ($code = mysqli_fetch_array($code_qry)) {
                  ?>
                  <tr>
                    <td><?php echo $number; ?></td>
                    <td>
                      Level <?php echo $code['levels'] ?>
                    </td>
                    <td class="text-center">
                      <span class="badge badge-danger"><?php echo $code['percent'] ?></span>
                    </td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $code['id']; ?>">Update</button>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $code['id']; ?>">Delete</button>
                    </td>
                  </tr>
                  <?php
                    include 'backend/level-edit-modal.php';
                    include 'backend/level-delete-modal.php';
                    $number++;
                    }
                  ?>
                </table>
              </div>
            </div>
            <?php include 'backend/level-add-modal.php'; ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
  </div>
<?php include 'include/footer.php'; ?>