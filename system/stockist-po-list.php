<?php include 'include/header.php'; ?>

<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
?>

<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/stockist-bar.php'; ?>
<?php
    date_default_timezone_set('Asia/Manila');
    $Ucode = $_SESSION['code'];
    $month = date('m');
    $monthName = date("F", mktime(0, 0, 0, $month, 10));
    $year = date('Y');
    $day = date('d');
    $date = $monthName.' '.$day.' ,'.$year;
    $time = date('h:m:i');

    $get_count = "SELECT * FROM stockist WHERE stockist_code = '$Ucode'";
    $get_count_qry = mysqli_query($connect, $get_count);
    $get_count_fetch = mysqli_fetch_array($get_count_qry);

    $count = $get_count_fetch['stockist_count'];

    $ref = 'PO-'.$Ucode.''.$year.''.$count;
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
                        <span class="float-left text-primary"><b>Purchase Order List</b></span>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-sm table-striped table-hover border border-info">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Reference Number</th>
                                        <th class="text-center">Track Order</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Receipt</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Triggered</th>
                                    </tr>
                                </thead>
                                <?php
                                    $inventory = "SELECT * FROM stockist_request WHERE ref_code = '$Ucode' ORDER BY id DESC";
                                    $inventory_qry = mysqli_query($connect, $inventory);
                                    $number = 1;
                                    while ($rows = mysqli_fetch_array($inventory_qry)) {
                                        $new_sub = $rows['req_amount'];
                                        $status = $rows['req_status'];
                                        $file = $rows['req_img'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $number; ?></td>
                                        <td class="text-center"><a href="reference-info.php?poid=<?php echo $rows['req_reference']; ?>" target="_blank" class="btn btn-sm btn-dark rounded-0"><?php echo $rows['req_reference']; ?></a></td>
                                        <td class="text-center"><b><a href="<?php echo $rows['req_link']; ?>" target="_blank"><span class="badge badge-warning"><?php echo $rows['req_tracking']; ?></span></a></b></td>
                                        <td class="text-center"><?php echo $rows['ref_date']; ?></td>
                                        <td class="text-center"><?php echo $rows['req_name']; ?></td>
                                        <td class="text-center"><?php echo $rows['req_country']; ?></td>
                                        <td class="text-center"><?php echo $new_sub; ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($status == 'Pending') {
                                                    echo '<span class="badge badge-primary">Pending</span>';
                                                } elseif ($status == 'Canceled') {
                                                    echo '<span class="badge badge-danger">Canceled</span>';
                                                } elseif ($status == 'On Process') {
                                                    echo '<span class="badge badge-primary">On Process</span>';
                                                } elseif ($status == 'In Transit') {
                                                    echo '<span class="badge badge-info">In Transit</span>';
                                                } elseif ($status == 'Received') {
                                                    echo '<span class="badge badge-success">Received</span>';
                                                } elseif ($status == 'CND Transfer') {
                                                  echo '<span class="badge badge-info">Transfer</span>';
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if ($file == '') {
                                            ?>
                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#upload<?php echo $rows['req_reference']; ?>"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                            <?php
                                                } else {
                                            ?>
                                                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#view<?php echo $rows['req_reference']; ?>"><i class="fas fa-image"></i> Receipt</button>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($status == 'In Transit') { ?>
                                                <button type="submit" class="btn btn-success btn-sm rounded-0" data-toggle="modal" data-target="#delivered<?php echo $rows['req_reference'] ?>">Received</button>
                                            <?php } elseif ($status == 'Pending') { ?>
                                                <button class="btn btn-sm btn-danger rounded-0" data-toggle="modal" data-target="#cancel<?php echo $rows['id'] ?>">Cancel</button>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Not Available</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php echo $rows['ref_checked']; ?></td>
                                    </tr>
                                <?php
                                    include 'backend/po-delivered-modal.php';
                                    include 'backend/po-cancel-item.php';
                                    include 'backend/po-upload-file.php';
                                    include 'backend/po-file-view.php';
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
<?php include 'backend/po-stockist-modal.php'; ?>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>