<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'LOGISTIC') { ?>
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
                        <span class="float-left text-primary"><b>PHILIPPINES WAREHOUSE</b></span>
                        <?php if ($_SESSION['role'] == 'UPTIMAIN') { ?>
                        <a href="warehouse.php" class="btn btn-primary btn-sm rounded-0 float-right">
                          TAIWAN
                        </a>
                        <a href="warehouse-kr.php" class="btn btn-warning btn-sm rounded-0 float-right">
                          KOREA
                        </a>
                        <a href="warehouse-uae.php" class="btn btn-danger btn-sm rounded-0 float-right">
                          DUBAI
                        </a>
                        <?php } ?>
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
                                  $code_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'PHILIPPINES' ORDER BY si_item_code ASC";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  $number = 1;
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $item_code = $code['si_item_code'];
                                    $qty = $code['si_item_stock'];
                                    // echo '<br>';
                                    $critical = $code['si_item_critical'];
                                ?>
                                <tr>
                                  <td class="text-center" width="20"><?php echo $number; ?></td>
                                  <td class="text-center" width="20"><b><?php echo $code['si_item_code'] ?></b></td>
                                  <td class="text-center"><?php echo $code['si_item_desc'] ?></td>
                                  <?php if ($critical >= $qty) { ?>
                                  <td class="text-center"><span class="badge badge-danger"><?php echo $code['si_item_stock'] ?></span></td>
                                  <?php } else { ?>
                                  <td class="text-center"><?php echo $code['si_item_stock'] ?></td>
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