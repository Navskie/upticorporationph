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
            <h1 class="m-0">Account Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account Information</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
      $myID = $_SESSION['uid'];

      $information_sql = "SELECT * FROM upti_users WHERE users_id = '$myID'";
      $information_qry = mysqli_query($connect, $information_sql);
      $information_fetch = mysqli_fetch_array($information_qry);

      $myCode = $information_fetch['users_code'];
      $myUsername = $information_fetch['users_username'];
      $myPassword = $information_fetch['users_password'];

      $information_sql_2 = "SELECT upti_reseller.reseller_name, upti_reseller.reseller_mobile, upti_reseller.reseller_address, upti_reseller.reseller_code, upti_reseller.reseller_status, upti_reseller.reseller_main, upti_reseller.reseller_date, upti_users.users_username, upti_users.users_password FROM upti_reseller INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_users.users_code = '$myCode'";
      $information_qry_2 = mysqli_query($connect, $information_sql_2);
      $information = mysqli_fetch_array($information_qry_2);

    ?>

    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update information</h3>
              </div>
              <?php
                if(isset($_POST['maininfo'])) {
                  $user = $_POST['name'];
                  if(empty($user)) {
                    $user = $myUsername;
                  }
                  $pass = $_POST['password'];
                  if(empty($pass)) {
                    $pass = $myPassword;
                  }
                  $old = $_POST['oldpass'];

                  if ($myPassword == $old) {
                    if (empty($pass)) {
                      $update_info = "UPDATE upti_users SET users_password = '$pass', users_name = '$user' WHERE users_code = '$myCode'";
                      $update_info_qry = mysqli_query($connect, $update_info);

                      echo "<script>alert('Information has been updated successfully');window.location.href = 'main-information.php';</script>";
                    } else {
                      $update_info = "UPDATE upti_users SET users_password = '$pass', users_name = '$user' WHERE users_code = '$myCode'";
                      $update_info_qry = mysqli_query($connect, $update_info);

                      echo "<script>alert('Information has been updated successfully');window.location.href = 'main-information.php';</script>";
                    }
                  } else {
                    echo "<script>alert('Incorrect Password Try Again.');window.location.href = 'main-information.php';</script>";
                  }
                }
              ?>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="main-information.php" method="post">
                  <div class="row">
                    <div class="col-2">
                    </div>

                    <div class="col-8">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="">New Name</label>
                            <input type="text" class="form-control" name="name" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="(Optional for new password)">
                          </div>
                        </div>

                        <div class="col-6">
                        <br><br>
                          <div class="form-group">
                            <input type="password" class="form-control" name="oldpass" placeholder="Type your old password" autocomplete="off" required>
                          </div>
                        </div>

                        <div class="col-6">
                        <br><br>
                          <div class="form-group">
                            <button class="btn btn-warning btn-flat form-control" name="maininfo"><b>Update Information</b></button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-2">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>

<?php include 'include/footer.php'; ?>