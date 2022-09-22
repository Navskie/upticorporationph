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
              <li class="breadcrumb-item active">Accounts</li>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Level</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                  </tr>
                  </thead>
                  <?php
                    $creator_code = $_SESSION['code'];

                    $account = "SELECT * FROM upti_users WHERE users_status = 'Active' ORDER BY users_level DESC";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                      $levels = $account_fetch['users_level'];
                  ?>
                  <tr>
                    <td><?php echo $number ?></td>
                    <td class="text-center">
                      <?php if ($levels == 1) { ?>
                      <span class="badge badge-dark">Level <?php echo $levels ?></span>
                      <?php } elseif ($levels == 2) { ?>
                      <span class="badge badge-warning">Level <?php echo $levels ?></span>
                      <?php } else { ?>
                      <span class="badge badge-danger">Level <?php echo $levels ?></span>
                      <?php } ?>
                    </td>
                    <td><img src="images/profile/<?php echo $account_fetch['users_img'] ?>" width="50" height="50"> &nbsp;&nbsp;<?php echo $account_fetch['users_name'] ?></td>
                    <td class="text-center"><?php echo $account_fetch['users_username'] ?></td>
                    <td class="text-center"><?php echo $account_fetch['users_password'] ?></td>
                    <td class="text-center"><span class="badge badge-primary"><?php echo $account_fetch['users_code'] ?></span></td>
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
      </div>
    </section>
  </div>

<?php include 'include/footer.php'; ?>