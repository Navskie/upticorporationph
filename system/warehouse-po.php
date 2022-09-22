<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<?php
        // include 'function.php';

        $get_series = "SELECT * FROM upti_series WHERE remark = 'poid'";
        $get_series_sql = mysqli_query($connect, $get_series);
        $get_series_fetch = mysqli_fetch_array($get_series_sql);

        $series_count = $get_series_fetch['series'];
        $date = date('m-d-Y');
        $gene_date = date('mdY');

        $generated_po = 'PO'.$gene_date.$series_count;
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
                            <span class="float-left text-primary"><b>Vendor Information</b></span>
                            <span class="float-right text-primary"><b><?php echo $generated_po ?></b></span>
                            <form action="stockist-backend/vendor-process.php" method="POST">
                        </div>
                        <div class="col-12"><hr></div>
                        <?php
                            // INFORMATION DISPLAY
                            $check_info = "SELECT * FROM stockist_vendor WHERE vendor_po = '$generated_po'";
                            $check_info_sql = mysqli_query($connect, $check_info);
                            $check_info_num = mysqli_num_rows($check_info_sql);
                            $check_info_fetch = mysqli_fetch_array($check_info_sql);

                            if ($check_info_num == 0) {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control rounded-0" name="vname">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control rounded-0" name="vperson">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control rounded-0" name="vaddress">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control rounded-0" name="vnumber">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control rounded-0" name="vemail">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-success btn-sm rounded-0" name="ipasamo">Save</button>
                            </div>
                            </form> 
                        </div>
                        <?php } else { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control rounded-0" name="vname" value="<?php echo $check_info_fetch['vendor_name'] ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control rounded-0" name="vperson" value="<?php echo $check_info_fetch['vendor_person'] ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control rounded-0" name="vaddress" value="<?php echo $check_info_fetch['vendor_address'] ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control rounded-0" name="vnumber" value="<?php echo $check_info_fetch['vendor_number'] ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control rounded-0" name="vemail" value="<?php echo $check_info_fetch['vendor_email'] ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-success btn-sm rounded-0" name="iupdatemo">Update</button>
                            </div>
                            </form> 
                        </div>
                        <?php } ?>
                        <div class="col-12">
                            <hr>
                            <form action="stockist-backend/vendor-process.php" method="post">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="form-group" style="border-radius: 0px !important;">
                                            <label>Select Product</label>
                                            <select class="form-control select2bs4 rounded-0" style="width: 100%;" name="code">
                                                <option value="">Select Product</option>
                                                <?php
                                                $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                                                $product_qry = mysqli_query($connect, $product_sql);
                                                while ($product = mysqli_fetch_array($product_qry)) {
                                                ?>
                                                <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" class="form-control rounded-0" name="unit" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" class="form-control rounded-0" name="qty" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control rounded-0" name="price" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <label style="color: #ffffff;">Click</label>
                                        <?php if ($check_info_num == 0 ) { ?>
                                        <button class="btn btn-success btn-sm rounded-0 form-control" name="add-order" disabled>Add Item</button>
                                        <?php } else { ?>
                                        <button class="btn btn-success btn-sm rounded-0 form-control" name="add-order">Add Item</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="3" class="text-center">Item Number & Details</th>
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
                                    <td width="15"><a href="stockist-backend/remove-item.php?order=<?php echo $rows['id'] ?>" class="btn btn-sm btn-danger rounded-0"><i class="fa fa-trash"></i></a></td>
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
                            <form action="stockist-backend/vendor-process.php" method="post">
                            <div class="form-group">
                                <label>Additional Notes:</label><br>
                                <textarea name="notes" id="" cols="10" rows="5" class="form-control"></textarea>
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
                        <div class="col-12">
                            <?php if ($check_info_num == 0 ) { ?>
                            <button class="btn btn-success form-control rounded-0" name="po-submitted" disabled>SUBMIT PURCHASE ORDER</button>
                            <?php } else { ?>
                            <button class="btn btn-success form-control rounded-0" name="po-submitted">SUBMIT PURCHASE ORDER</button>
                            <?php } ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>

<?php include 'include/footer.php'; ?>
<!-- /.login-box -->
<script>
  <?php if (isset($_SESSION['vendormissing'])) { ?>

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

  toastr.error("<?php echo flash('vendormissing'); ?>");

  <?php } ?>

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
</script>

<?php } else { echo "<script>window.location='index.php'</script>"; } ?>