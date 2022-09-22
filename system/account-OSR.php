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
              <li class="breadcrumb-item active">OSR Account</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#osr">
                  Add OSR
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Code</th>
                    <th>Created</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <?php
                    $creator_code = $_SESSION['code'];

                    $account = "SELECT upti_osr.osr_name, upti_osr.osr_mobile, upti_osr.osr_address, upti_osr.osr_code, upti_osr.osr_status, upti_osr.osr_main, upti_osr.osr_date, upti_users.users_username, upti_users.users_password FROM upti_osr INNER JOIN upti_users ON upti_osr.osr_code = upti_users.users_code WHERE upti_users.users_main = '$creator_code'";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                  ?>
                  <tr>
                    <td><?php echo $account_fetch['osr_name'] ?></td>
                    <td><?php echo $account_fetch['users_username'] ?></td>
                    <td><?php echo $account_fetch['osr_address'] ?></td>
                    <td><?php echo $account_fetch['osr_mobile'] ?></td>
                    <td><?php echo $account_fetch['osr_code'] ?></td>
                    <td><?php echo $account_fetch['osr_date'] ?></td>
                    <!-- <td>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>&nbsp;&nbsp;&nbsp;
                      <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td> -->
                  </tr>
                  <?php $number++; } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include 'backend/OSR-modal.php' ?>
  </div>

<?php include 'include/footer.php'; ?>