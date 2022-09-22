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

<?php //include 'include/preloader.php'; ?>
<?php include 'include/stockist-navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<?php
  date_default_timezone_set('Asia/Manila');
  $Ucode = $_SESSION['code'];
  $date = date('m-d-Y');
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
                            <h4 class="float-left text-info">My Inventory</h4>
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Quantity</th>
                                    </tr>
                                </thead>
                                <?php 

                                    $inventory = "SELECT * FROM stockist_inventory WHERE si_code = '$code' AND si_item_desc != '' AND si_item_state = '$state' AND si_item_country = '$country' ORDER BY id DESC";
                                    $inventory_qry = mysqli_query($connect, $inventory);
                                    $number = 1;
                                    while ($rows = mysqli_fetch_array($inventory_qry)) {
                                        $stock = $rows['si_item_stock'];
                                        $critical = $rows['si_item_critical'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $number; ?></td>
                                    <td class="text-center"><?php echo $rows['si_item_code']; ?></td>
                                    <td class="text-center"><?php echo $rows['si_item_desc']; ?></td>
                                    <td class="text-center">
                                        <?php
                                            if ($stock > $critical) {
                                                echo $stock;
                                            } else {
                                                echo '<span class="badge badge-danger">'.$stock.'</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php $number++; } ?>
                            </table>
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