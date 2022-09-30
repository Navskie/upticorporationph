<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIOSR') { ?>
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
                            <span class="float-left text-primary"><b>Facebook Page List</b></span> 
                            <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                              Add Page
                            </button>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-bordered">
                                <thead> 
                                <tr>
                                    <th class="text-center">Page Name</th>
                                    <th class="text-center">Current Assigned</th>
                                    <th class="text-center">Status</th>
                                  </tr>
                                </thead>
                                <?php
                                  $OSR_CODE = $_SESSION['code'];

                                  $code_sql = "SELECT * FROM upti_page WHERE page_new = '$OSR_CODE' ORDER BY id DESC ";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $osr1 = $code['page_new'];
                                    $osr2 = $code['page_old'];

                                    $osr_name1 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$osr1'");
                                    $osr1_fetch = mysqli_fetch_array($osr_name1);

                                    $osr1_name = $osr1_fetch['users_name'];
                                ?>
                                <tr>                                  
                                  <td class="text-center"><?php echo $code['page_name'] ?></td>
                                  <td class="text-center"><?php echo $osr1_name ?></td>
                                  <td class="text-center" width="20">
                                    <?php
                                      $stats = $code['page_status'];
                                      if ($stats == 'Active') {
                                    ?>
                                      <span class="badge badge-success"><?php echo 'Active' ?></span>
                                    <?php
                                      } else {
                                    ?>
                                      <span class="badge badge-danger"><?php echo 'Restrict' ?></span>
                                    <?php
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <?php include 'backend/fb-check-modal.php'; ?>
                                <?php include 'backend/fb-restric-modal.php'; ?>
                                <?php include 'backend/fb-edit-modal.php'; ?>
                                <?php //include ''; ?>
                                <?php
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
<?php include 'backend/fb-add-modal.php' ?>
<?php include 'include/footer.php'; ?>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>