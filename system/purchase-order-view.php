<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIACCOUNTING') { ?>
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
                            <a href="purchase-order.php" class="float-left text-light btn btn-sm btn-secondary rounded-0"><b>Back to Purchase Order</b></a>
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
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control rounded-0" name="vname" disabled value="<?php echo $check_info_fetch['vendor_name'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control rounded-0" name="vperson" disabled value="<?php echo $check_info_fetch['vendor_person'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control rounded-0" name="vaddress" disabled value="<?php echo $check_info_fetch['vendor_address'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control rounded-0" name="vnumber" disabled value="<?php echo $check_info_fetch['vendor_number'] ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control rounded-0" name="vemail" disabled value="<?php echo $check_info_fetch['vendor_email'] ?>">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">Item Number & Details</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Total</th>
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
                                    <td><?php echo $rows['vo_price'] ?></td>
                                    <td><?php echo $rows['vo_subtotal'] ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Additional Notes:</label><br>
                                <textarea name="remarks" id="" cols="10" rows="5" class="form-control" disabled><?php echo $check_info_fetch['vendor_remarks'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="float-right"><b>Subtotal</b></p>
                                </div>
                                <?php
                                    $get_total = "SELECT SUM(vo_subtotal) AS total FROM stockist_vendor_order WHERE vo_po = '$generated_po'";
                                    $get_total_qry = mysqli_query($connect, $get_total);
                                    $get_total_fetch = mysqli_fetch_array($get_total_qry);
                                ?>
                                <div class="col-6">
                                    <p class="float-right"><?php echo $get_total_fetch['total'] ?></p>
                                </div>
                            </div>
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