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
              <li class="breadcrumb-item active">Leader Account</li>
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

                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#leader">
                  Add Leader
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

                    $account = "SELECT upti_leader.leader_name, upti_leader.leader_mobile, upti_leader.leader_address, upti_leader.leader_code, upti_leader.leader_status, upti_leader.leader_main, upti_leader.leader_date, upti_users.users_username, upti_users.users_password FROM upti_leader INNER JOIN upti_users ON upti_leader.leader_code = upti_users.users_code WHERE upti_users.users_main = '$creator_code'";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                  ?>
                  <tr>
                    <td><?php echo $account_fetch['leader_name'] ?></td>
                    <td><?php echo $account_fetch['users_username'] ?></td>
                    <td><?php echo $account_fetch['leader_address'] ?></td>
                    <td><?php echo $account_fetch['leader_mobile'] ?></td>
                    <td><?php echo $account_fetch['leader_code'] ?></td>
                    <td><?php echo $account_fetch['leader_date'] ?></td>
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

    <?php include 'backend/leader-modal.php' ?>
  </div>

<?php include 'include/footer.php'; ?>