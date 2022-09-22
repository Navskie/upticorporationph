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
              <li class="breadcrumb-item active">Withdrawal Request</li>
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
                    <th>Code</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <?php
                    $account = "SELECT * FROM upti_country WHERE country_name = 'PHILIPPINES';
                    ";
                    $account_qry = mysqli_query($connect, $account);
                    $number = 1;
                    while ($ol_fetch = mysqli_fetch_array($account_qry)) {
                        $countrycode = $ol_fetch['country_code'];

                        $solo = "SELECT * FROM upti_items WHERE items_code = '$countrycode'";
                        $solo_sql = mysqli_query($connect, $solo);
                        $solo_fetch = mysqli_fetch_array($solo_sql);
                        $solo_num = mysqli_num_rows($solo_sql);

                        if ($solo_num == 0) {
                            $solo1 = "SELECT * FROM upti_package WHERE package_code = '$countrycode'";
                            $solo_sql1 = mysqli_query($connect, $solo1);
                            $solo_fetch1 = mysqli_fetch_array($solo_sql1);
                            $code = '1';
                            $desc = $solo_fetch1['package_desc'];
                            $stats = $solo_fetch1['package_status'];
                        } else {
                            $code = '0';
                            $desc = $solo_fetch['items_desc'];
                            $stats = $solo_fetch['items_status'];
                        }
                  ?>
                  <tr>
                    <td><?php echo $number ?></td>
                    <?php if ($code == '0') { ?>
                    <td class="text-center"><?php echo $ol_fetch['country_code'] ?></td>
                    <?php } else { ?>
                    <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pack<?php echo $ol_fetch['id']; ?>"><?php echo $ol_fetch['country_code']; ?></button></td>
                    <?php } ?>
                    <td class="text-center"><?php echo $desc ?></td>
                    <td class="text-center"><?php echo $ol_fetch['country_total_php'] ?></td>
                    <td class="text-center"><?php echo $stats ?></td>
                  </tr>
                  <?php
                    include 'backend/item-package-modal.php';
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