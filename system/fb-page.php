<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'ADS') { ?>
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
                                    <th colspan="4" class="text-center">Manage Page</th>
                                    <th class="text-center">Page Name</th>
                                    <th class="text-center">Current Assigned</th>
                                    <th class="text-center">Old Assigned</th>
                                    <th class="text-center">Status</th>
                                  </tr>
                                </thead>
                                <?php
                                  $code_sql = "SELECT * FROM upti_page ORDER BY id DESC ";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $osr1 = $code['page_new'];
                                    $osr2 = $code['page_old'];

                                    $osr_name1 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$osr1'");
                                    $osr1_fetch = mysqli_fetch_array($osr_name1);

                                    $osr_name2 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$osr2'");
                                    $osr2_fetch = mysqli_fetch_array($osr_name2);

                                    $osr1_name = $osr1_fetch['users_name'];
                                    $osr2_name = $osr2_fetch['users_name'];
                                ?>
                                <tr>
                                  <td class="text-center" width="20"><a data-toggle="modal" data-target="#check<?php echo $code['id'] ?>" title="Active" class="btn btn-sm btn-success rounded-0"><i class="uil uil-check-circle"></i></a></td>
                                  
                                  <td class="text-center" width="20"><a data-toggle="modal" data-target="#restrict<?php echo $code['id'] ?>" title="Restrict" class="btn btn-sm btn-danger rounded-0"><i class="uil uil-times-circle"></i></a></td>

                                  <td class="text-center" width="20"><a data-toggle="modal" data-target="#edit<?php echo $code['id'] ?>" title="Edit" class="btn btn-sm btn-warning rounded-0"><i class="uil uil-comment-edit"></i></a></td>

                                  <td class="text-center" width="20"><a href="#" title="Delete" class="btn btn-sm btn-danger rounded-0"><i class="uil uil-trash"></i></a></td>
                                  
                                  <td class="text-center"><?php echo $code['page_name'] ?></td>
                                  <td class="text-center"><?php echo $osr1_name ?></td>
                                  <td class="text-center"><span class="badge badge-primary"><?php echo $osr2_name ?></span></td>
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
<script>
      <?php if (isset($_SESSION['paid'])) { ?>

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.success("<?php echo flash('paid'); ?>");

        <?php } ?>
</script>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>