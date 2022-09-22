<?php include 'include/header.php'; ?>
<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    $check_stockist_f = mysqli_fetch_array($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
      $code = $check_stockist_f['stockist_code'];
      $country = $check_stockist_f['stockist_country'];
      $state = $check_stockist_f['stockist_state']; 
?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <span class="text-center">Extract Sales Orders into Excel File</span>
                        </div>
                        <div class="col-6">
                            <form action="sales-generated.php" method="post">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date1">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="date2">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button class="btn btn-dark form-control rounded-0" name="export_sales">EXPORT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
  </div>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>