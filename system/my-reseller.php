<?php include 'include/header.php'; ?>
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
                        <span class="float-left text-primary"><b>Reseller List</b></span>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-striped table-sm table-hover border border-info"> 
                                <thead>
                                    <tr>
                                      <th class="text-center">Poid</th>
                                      <th class="text-center">Name</th>
                                      <th class="text-center">Username</th>
                                      <th class="text-center">Address</th>
                                      <th class="text-center">Mobile</th>
                                      <th class="text-center">Email</th>
                                      <th class="text-center">Package</th>
                                      <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <?php
                                    $account = "SELECT * FROM upti_reseller INNER JOIN upti_transaction ON upti_transaction.trans_poid = upti_reseller.reseller_poid INNER JOIN upti_users ON upti_reseller.reseller_code = upti_users.users_code WHERE upti_transaction.trans_seller = '$creator_code'";
                                    $account_qry = mysqli_query($connect, $account);
                                    $number = 1;
                                    while ($account_fetch = mysqli_fetch_array($account_qry)) {
                                ?>
                                  <tr>
                                    <td class="text-center"><?php echo $poid = $account_fetch['reseller_poid'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['reseller_name'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['users_username'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['trans_address'] ?></td>
                                    <td class="text-center"><?php echo $account_fetch['trans_contact'] ?></td>
                                    <td class="text-center">
                                        <?php
                                            $get_email = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                                            $get_email_qry = mysqli_query($connect, $get_email);
                                            $get_e_fetch = mysqli_fetch_array($get_email_qry);
                                            
                                            echo $get_e_fetch['trans_email'];
                                        ?>
                                    </td>
                                    <td class="text-center"><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#view<?php echo $account_fetch['reseller_poid']; ?>">Package</button></td>
                                    <td class="text-center"><span class="badge badge-warning"><?php echo $account_fetch['trans_status'] ?></span></td>
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php include 'include/footer.php'; ?>