<?php include 'include/header.php'; ?>

<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
?>

<?php include 'include/preloader.php'; ?>
<?php include 'include/stockist-navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<?php
    date_default_timezone_set('Asia/Manila');
    $Ucode = $_SESSION['code'];
    $month = date('m');
    $monthName = date("F", mktime(0, 0, 0, $month, 10));
    $year = date('Y');
    $day = date('d');
    $dates = date('m-d-Y');
    $date = $monthName.' '.$day.' ,'.$year;
    $time = date('h:m:i');

    $get_count = "SELECT * FROM stockist WHERE stockist_code = '$Ucode'";
    $get_count_qry = mysqli_query($connect, $get_count);
    $get_count_fetch = mysqli_fetch_array($get_count_qry);

    $count = $get_count_fetch['stockist_count'];
    $country = $get_count_fetch['stockist_country'];
    $state = $get_count_fetch['stockist_state'];

    $ref = 'PO-'.$Ucode.''.$year.''.$count;

    $get_address = "SELECT * FROM upti_reseller WHERE reseller_code = '$Ucode'";
    $get_address_qry = mysqli_query($connect, $get_address);
    $get_address_fetch = mysqli_fetch_array($get_address_qry);

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
                        <span class="float-left text-primary"><b>Request Purchase Order</b></span>
                        </div>
                        <div class="col-12"><hr></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <h6 class="float-left">Reference Number: </h6>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                    <h6 class="float-left"><b><?php echo $ref; ?></b></h6>
                                </div>

                                <div class="col-md-2 col-sm-6">
                                    <h6 class="float-left">Date & Time: </h6>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <h6 class="float-left"><b><?php echo $date; ?> | <?php echo $time; ?></b></h6>
                                </div>

                                <div class="col-md-2 col-sm-6">
                                    <h6 class="float-left">Full Name: </h6>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                    <h6 class="float-left"><b><?php echo $get_address_fetch['reseller_name'] ?></b></h6>
                                </div>

                                <div class="col-md-2 col-sm-6">
                                    <h6 class="float-left">Address: </h6>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <h6 class="float-left"><b><?php echo $get_address_fetch['reseller_address'] ?></b></h6>
                                </div>

                                <div class="col-md-2 col-sm-6">
                                    <h6 class="float-left">Contact Number: </h6>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                    <h6 class="float-left"><b><?php echo $get_address_fetch['reseller_mobile'] ?></b></h6>
                                </div>

                                <div class="col-md-2 col-sm-6">
                                    <h6 class="float-left">Email Address: </h6>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <h6 class="float-left"><b><?php echo $get_address_fetch['reseller_email'] ?></b></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-sm btn-danger rounded-0 float-right" data-toggle="modal" data-target="#add">Add Product</button>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example2" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                    <tr>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <?php
                                    $inventory = "SELECT * FROM stockist_po WHERE spo_ref = '$ref' ORDER BY id DESC";
                                    $inventory_qry = mysqli_query($connect, $inventory);
                                    $number = 1;
                                    while ($rows = mysqli_fetch_array($inventory_qry)) {
                                        $new_sub = $rows['spo_subtotal'];
                                ?>
                                <tr>
                                    <td class="text-center"><a href="#" class="btn btn-sm btn-danger rounded-0" data-toggle="modal" data-target="#remove<?php echo $rows['id']; ?>">Remove</a></td>
                                    <td class="text-center"><?php echo $rows['spo_item_code']; ?></td>
                                    <td class="text-center"><?php echo $rows['spo_item_desc']; ?></td>
                                    <td class="text-center">
                                        <b><?php echo $rows['spo_item_qty']; ?></b>
                                    </td>
                                    <td class="text-right">
                                        <b><?php echo $rows['spo_price']; ?></b>
                                    </td>
                                    <td class="text-right pr-2">
                                        <b><?php echo number_format($new_sub, '2') ?></b>
                                    </td>
                                </tr>
                                <?php
                                    include 'backend/po-remove-item.php';
                                    $number++; 
                                    } 
                                ?>
                            </table>
                        </div>
                        <div class="col-12">
                            <form action="" method="post">
                            <?php
                                $proceed_sql = "SELECT SUM(spo_subtotal) AS tot FROM stockist_po WHERE spo_ref = '$ref'";
                                $proceed_qry = mysqli_query($connect, $proceed_sql);
                                $proceed_fetch = mysqli_fetch_array($proceed_qry);

                                $total = $proceed_fetch['tot'];
                                $po_name = $get_address_fetch['reseller_name'];

                                if (isset($_POST['process'])) {

                                    $req_sql = "INSERT INTO stockist_request (ref_date, req_reference, req_name, ref_code, req_country, req_amount, req_status, req_state) VALUES ('$dates', '$ref','$po_name', '$Ucode', '$country','$total','Pending', '$state')";
                                    $req_qry = mysqli_query($connect, $req_sql);
                                    // echo '<br>';
                                    $count_new = $count + 1;

                                    $update_count = "UPDATE stockist SET stockist_count = '$count_new' WHERE stockist_code = '$Ucode'";
                                    $update_count_qry = mysqli_query($connect, $update_count);

                                    echo "<script>alert('Purchased Order has been submitted successfully');window.location.href='stockist-po-list.php';</script>";

                                }

                                if ($total > 0) {

                                
                            ?>
                            <div class="row">
                                <div class="col-md-10">
                                    <span class="float-right"><b>Total Amount:</b></span>
                                </div>
                                <div class="col-md-2">
                                    <span class="float-right text-success border-bottom pr-2"><b><?php echo number_format($total, '2') ?></b></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <br><br>
                                <div class="form-group"><button class="btn btn-success btn-sm form-control rounded-0" name="process">PROCEED</button></div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php include 'backend/po-stockist-modal.php'; ?>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>