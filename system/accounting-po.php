<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIACCOUNTING') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/stockist-navbar.php'; ?>
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
                            <span class="float-left text-primary"><b>Purchase Order</b></span> 
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                             <!-- Order List Table Start -->
                            <table id="example1" class="table table-bordered">
                                <thead> 
                                <tr>
                                    <th colspan="3" class="text-center">Purchase Order Number</th>
                                    <th class="text-center">Vendor Name</th>
                                    <th class="text-center">Purchase Date</th>
                                    <th class="text-center">Complete Address</th>
                                    <th class="text-center">Status</th>
                                    <th colspan="2" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php
                                  $code_sql = "SELECT * FROM stockist_vendor ORDER BY id DESC ";
                                  $code_qry = mysqli_query($connect, $code_sql);
                                  while ($code = mysqli_fetch_array($code_qry)) {
                                    $statuss = $code['vendor_status'];
                                ?>
                                <tr>
                                  <td class="text-center" width="20"><a href="" class="btn btn-sm btn-danger rounded-0">PDF</a></td>
                                  <td class="text-center" width="20"><a href="purchase-order-view.php?po=<?php echo $code['vendor_po'] ?>" class="btn btn-sm btn-info rounded-0">VIEW</a></td>
                                  
                                  <td class="text-center"><?php echo $code['vendor_po'] ?></td>
                                  
                                  <td class="text-center"><?php echo $code['vendor_name'] ?></td>
                                  <td class="text-center"><?php echo $code['vendor_date'] ?></td>
                                  <td class="text-center"><?php echo $code['vendor_address'] ?></td>
                                  <td class="text-center"><span class="badge badge-primary"><?php echo $statuss ?></span></td>
                                  <?php if ($statuss == 'PAID' || $statuss == 'Received') { ?>
                                  <td class="text-center" width="20"><span class="badge badge-danger">Not Available</span></td>
                                  <?php }  else { ?>
                                  <td class="text-center" width="20"><a href="" class="btn btn-sm btn-success rounded-0" data-toggle="modal" data-target="#paid<?php echo $code['vendor_po'] ?>">PAID</a></td>
                                  <td class="text-center" width="20"><a href="" class="btn btn-sm btn-danger rounded-0" data-toggle="modal" data-target="#cancel<?php echo $code['vendor_po'] ?>">CANCEL</a></td>
                                  <?php } ?>
                                </tr>
                                <?php include 'stockist-backend/paid-modal.php'; ?>
                                <?php include 'stockist-backend/cancel-modal.php'; ?>
                                <?php
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
<?php include 'include/footer.php'; ?>
<script>
      <?php if (isset($_SESSION['paid'])) { ?>

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

        toastr.success("<?php echo flash('paid'); ?>");

        <?php } ?>
</script>
<?php } else { echo "<script>window.location='index.php'</script>"; } ?>