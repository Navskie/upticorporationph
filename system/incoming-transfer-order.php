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
    $country = $get_count_fetch['stockist_country'];
    $state = $get_count_fetch['stockist_state'];
    // $count = $get_count_fetch['stockist_count'];

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
                                        <th class="text-center">Status</th> 
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Triggered</th>
                                    </tr>
                                </thead>
                                <?php

                                    if ($state == 'ALL') {
                                      $inventory = "SELECT * FROM stockist_request WHERE req_country = '$country' AND req_status = 'CND Transfer' || req_country = '$country' AND req_status = 'CND OnProcess' || req_country = '$country' AND req_status = 'CND InTransit' || req_country = '$country' AND req_status = 'CND Transfered' ORDER BY id DESC";
                                    } else {
                                      $inventory = "SELECT * FROM stockist_request WHERE req_country = '$country' AND req_status = 'CND InTransit' || req_country = '$country' AND req_status = 'CND Transfered' ORDER BY id DESC";
                                    }
                                    
                                    $inventory_qry = mysqli_query($connect, $inventory);
                                    $number = 1;
                                    while ($account_fetch = mysqli_fetch_array($inventory_qry)) {
                                        $new_sub = $account_fetch['req_amount'];
                                        $status = $account_fetch['req_status'];
                                        $file = $account_fetch['req_img'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $number; ?></td>
                                        <td class="text-center"><a href="reference-info.php?poid=<?php echo $account_fetch['req_reference']; ?>" target="_blank" class="btn btn-sm btn-dark rounded-0"><?php echo $account_fetch['req_reference']; ?></a></td>
                                        <td class="text-center"><b><a href="<?php echo $account_fetch['req_link']; ?>" target="_blank"><span class="badge badge-warning"><?php echo $account_fetch['req_tracking']; ?></span></a></b></td>
                                        <td class="text-center"><?php echo $account_fetch['ref_date']; ?></td>
                                        <td class="text-center"><?php echo $account_fetch['req_name']; ?></td>
                                        <td class="text-center"><?php echo $account_fetch['req_country']; ?></td>
                                        <td class="text-center">
                                            <?php
                                                if ($status == 'Pending') {
                                                    echo '<span class="badge badge-primary">Pending</span>';
                                                } elseif ($status == 'Canceled') {
                                                    echo '<span class="badge badge-danger">Canceled</span>';
                                                } elseif ($status == 'CND OnProcess') {
                                                    echo '<span class="badge badge-primary">On Process</span>';
                                                } elseif ($status == 'CND InTransit') {
                                                    echo '<span class="badge badge-info">In Transit</span>';
                                                } elseif ($status == 'Received') {
                                                    echo '<span class="badge badge-success">Received</span>';
                                                } elseif ($status == 'CND Transfer') {
                                                  echo '<span class="badge badge-info">Transfer</span>';
                                                } elseif ($status == 'CND Transfered') {
                                                  echo '<span class="badge badge-success">Transfered</span>';
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($status == 'CND InTransit') { ?>
                                                <button type="submit" class="btn btn-success btn-sm rounded-0" data-toggle="modal" data-target="#received<?php echo $account_fetch['req_reference'] ?>">Received</button>
                                            <?php } elseif ($status == 'CND Transfered') { ?>
                                                <span class="badge badge-danger">Not Available</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php echo $account_fetch['ref_checked']; ?></td>
                                    </tr>
                                <?php
                                    include 'backend/po-on-process-modal.php';
                                    include 'backend/transfer-received-modal.php';
                                    include 'backend/po-cancel-modal.php';
                                    include 'backend/po-in-transit-modal.php';
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
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>
<?php include 'include/footer.php'; ?>
<script>
	$(function(){
		$("#fileupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	})
    <?php if (isset($_SESSION['success'])) { ?>

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

        toastr.success("<?php echo flash('success'); ?>");
        
    <?php } ?>

    <?php if (isset($_SESSION['warning'])) { ?>

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

        toastr.error("<?php echo flash('warning'); ?>");

    <?php } ?>
</script>