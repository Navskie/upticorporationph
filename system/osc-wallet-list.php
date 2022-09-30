<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIACCOUNTING') { ?>
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
                            <span class="float-left text-primary"><b>OSC Token List</b></span> 
                            <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                              Add Token
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
                                    <th class="text-center">Date & Time</th>
                                    <th class="text-center">OSC Name</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Remarks</th>
                                  </tr>
                                </thead>
                                <?php
                                
                                  $code_sql = "SELECT * FROM upti_osc_history ORDER BY id DESC ";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $osr1 = $code['h_code'];

                                    $osr_name1 = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$osr1'");
                                    $osr1_fetch = mysqli_fetch_array($osr_name1);

                                    $osr1_name = $osr1_fetch['users_name'];

                                ?>
                                <tr>                                 
                                  <td class="text-center"><?php echo $code['h_date'] ?> <?php echo $code['h_time'] ?></td>
                                  <td class="text-center"><?php echo $osr1_name ?></td>
                                  <td class="text-center"><?php echo $code['h_credit'] ?></td>
                                  <td class="text-center"><?php echo $code['h_debit'] ?></td>
                                  <td class="text-center"><?php echo $code['h_remarks'] ?></td>
                                </tr>
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
<?php include 'backend/token-add-modal.php' ?>
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