<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN') { ?>
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
                            <span class="float-left text-primary"><b>COUNTRY STOCKS CRITICAL SETTINGS</b></span>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <!-- Order List Table Start -->
                            <table id="example1" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Stocks</th>
                                    <th class="text-center">Critical</th>
                                    <th class="text-center">Action</th>
                                  </tr> 
                                </thead>
                                <?php
                                  $code_sql = "SELECT * FROM stockist_inventory ORDER BY si_item_country ASC";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                //   $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $qty = $code['si_item_stock'];
                                    $critical = $code['si_item_critical'];
                                    if ($qty > $critical) {
                                        $result = '<span class="badge badge-success">GOOD</span>';
                                    } else {
                                        $result = '<span class="badge badge-danger">WARNING</span>';
                                    }
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $code['si_item_country'] ?></td> 
                                  <td class="text-center" width="20"><b><?php echo $code['si_item_code'] ?></b></td>
                                  <td class="text-center"><?php echo $code['si_item_desc'] ?></td> 
                                  <td class="text-center"><span class="badge badge-primary"><?php echo $code['si_item_stock'] ?></span></td>
                                  <td class="text-center"><span class="badge badge-danger"><?php echo $code['si_item_critical'] ?></span></td>
                                  <td class="text-center">
                                    <button class="btn btn-sm btn-danger rounded-0" data-toggle="modal" data-target="#critical<?php echo $code['id']; ?>">Set Critical</button>
                                  </td>
                                </tr>
                                <?php
                                    include 'stockist-backend/critical-modal.php';
                                    // $number++;
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
  <?php include 'backend/stockist-modal.php'; ?>

  <?php include 'include/footer.php'; ?>

  <script>
  <?php if (isset($_SESSION['vendorsuccess'])) { ?>

  toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-center",
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

  toastr.success("<?php echo flash('vendorsuccess'); ?>");
  <?php } ?>
  <?php if (isset($_SESSION['submitted'])) { ?>

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-center",
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

toastr.success("<?php echo flash('submitted'); ?>");
<?php } ?>
</script>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>