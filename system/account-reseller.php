<?php include 'include/header.php'; ?>
<!-- <?php //include 'include/preloader.php'; ?> -->
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
              <li class="breadcrumb-item active">Reseller Account</li>
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

                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#reseller">
                  Add Reseller
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Poid</th>
                    <th>Facebook</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Reseller Status</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Package</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <?php
                    $creator_code = $_SESSION['code'];

                    $account = "SELECT upti_reseller.reseller_fb, upti_reseller.reseller_poid, upti_reseller.id, upti_reseller.reseller_package, upti_reseller.reseller_desc, upti_reseller.reseller_amount, upti_reseller.reseller_name, upti_reseller.reseller_mobile, upti_reseller.reseller_address, upti_reseller.reseller_code, upti_reseller.reseller_status, upti_reseller.reseller_main, upti_reseller.reseller_date, upti_users.users_username, upti_users.users_status, upti_users.users_password FROM upti_reseller INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_users.users_main = '$creator_code' ORDER BY upti_reseller.id DESC";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                  ?>
                  <tr>
                    <td><?php echo $account_fetch['reseller_poid'] ?></td>
                    <td class="text-center"><a href="<?php echo $account_fetch['reseller_fb'] ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fab fa-facebook-f"></i> Facebook</a></td>
                    <td><?php echo $account_fetch['reseller_name'] ?></td>
                    <td><?php echo $account_fetch['users_username'] ?></td>
                    <td><?php echo $account_fetch['users_status'] ?></td>
                    <td><?php echo $account_fetch['reseller_address'] ?></td>
                    <td><?php echo $account_fetch['reseller_mobile'] ?></td>
                    <td class="text-center"><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#view<?php echo $account_fetch['id']; ?>">Package</button></td>
                    <td class="text-center"><span class="badge badge-warning"><?php echo $account_fetch['reseller_status'] ?></span></td>
                  </tr>
                  <?php
                    include 'backend/reseller-view-modal.php';
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

    <?php include 'backend/reseller-add-modal.php' ?>
  </div>

<?php include 'include/footer.php'; ?>