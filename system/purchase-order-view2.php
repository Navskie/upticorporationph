<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'LOGISTIC' || $_SESSION == 'DHL') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<?php
    $generated_po = $_GET['po'];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                            <a href="logistic-supplier.php" class="float-left text-light btn btn-sm btn-secondary rounded-0"><b>Back to Purchase Order</b></a>
                            <span class="float-right text-primary"><b><?php echo $generated_po ?></b></span>
                        </div>
                        <div class="col-12"><hr></div>
                        <?php
                            // INFORMATION DISPLAY
                            $check_info = "SELECT * FROM stockist_vendor WHERE vendor_po = '$generated_po'";
                            $check_info_sql = mysqli_query($connect, $check_info);
                            $check_info_num = mysqli_num_rows($check_info_sql);
                            $check_info_fetch = mysqli_fetch_array($check_info_sql);
                        ?>                        
                        <div class="col-12">
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">Item Number & Details</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Qty</th>
                                </tr>
                                <?php
                                    $get_order = "SELECT * FROM stockist_vendor_order WHERE vo_po = '$generated_po'";
                                    $get_order_sql = mysqli_query($connect, $get_order);
                                    while($rows = mysqli_fetch_array($get_order_sql)) {
                                ?>
                                <tr>
                                    <td width="20"><?php echo $rows['vo_code'] ?></td>
                                    <td><?php echo $rows['vo_details'] ?></td>
                                    <td><?php echo $rows['vo_unit'] ?></td>
                                    <td><?php echo $rows['vo_qty'] ?></td>
                                </tr>
                                <?php } ?>
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

<?php } else { echo "<script>window.location='index.php'</script>"; } ?>