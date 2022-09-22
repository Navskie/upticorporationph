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
                        <span class="float-left text-primary"><b>DUBAI WAREHOUSE</b></span>

                        <a href="warehouse.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          TAIWAN
                        </a>
                        <a href="warehouse-ph.php" class="btn btn-warning btn-sm rounded-0 float-right">
                          PHILIPPINES
                        </a>
                        <a href="warehouse-kr.php" class="btn btn-danger btn-sm rounded-0 float-right">
                          KOREA
                        </a>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <!-- Order List Table Start -->
                            <table id="example22" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th colspan="2" class="text-center">Item Description</th>
                                    <th class="text-center">Stocks</th>
                                  </tr>
                                </thead>
                                <?php
                                  $code_sql = "SELECT * FROM stockist_warehouse WHERE warehouse_country = 'UNITED ARAB EMIRATES' ORDER BY warehouse_stocks ASC";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $item_code = $code['warehouse_code'];
                                    $qty = $code['warehouse_stocks'];
                                    $country = $code['warehouse_country'];
                                    $warning_sql = mysqli_query($connect, "SELECT * FROM stockist_warning WHERE warning_code = '$item_code' AND warning_country = '$country'");
                                    $warning = mysqli_fetch_array($warning_sql);
                                    $crtitical = $warning['warning_qty'];
                                ?>
                                <tr>
                                  <td class="text-center" width="20"><?php echo $number; ?></td>
                                  <td class="text-center" width="20"><b><?php echo $code['warehouse_code'] ?></b></td>
                                  <td class="text-center"><?php echo $code['warehouse_details'] ?></td> 
                                  <?php if ($crtitical >= $qty) { ?>
                                  <td class="text-center"><span class="badge badge-danger"><?php echo $code['warehouse_stocks'] ?></span></td>
                                  <?php } else { ?>
                                  <td class="text-center"><?php echo $code['warehouse_stocks'] ?></td>
                                  <?php } ?>
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

  toastr.success("<?php echo flash('vendorsuccess'); ?>");
  <?php } ?>
  <?php if (isset($_SESSION['submitted'])) { ?>

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

toastr.success("<?php echo flash('submitted'); ?>");
<?php } ?>
</script>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>