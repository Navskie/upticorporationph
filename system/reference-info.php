<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php if ($role != 'UPTIMAIN' || $role != 'DHL' || $role != 'LOGISTIC') { ?>
    <?php include 'include/stockist-navbar.php'; ?>
    <?php include 'include/stockist-bar.php'; ?>
<?php } else { ?>
    <?php include 'include/navbar.php'; ?>
    <?php include 'include/sidebar.php'; ?>
<?php } ?>

<?php
    date_default_timezone_set('Asia/Manila');
    $month = date('m');
    $monthName = date("F", mktime(0, 0, 0, $month, 10)); 
    $year = date('Y');
    $day = date('d');
    $dates = date('m-d-Y');
    $date = $monthName.' '.$day.' ,'.$year;
    $time = date('h:m:i');

    $ref = $_GET['poid'];
    
    $role = $_SESSION['role'];
    $Ucode = $_SESSION['code'];

    if ($role != 'UPTIMAIN') {
        $get_address1 = "SELECT * FROM stockist_request WHERE req_reference = '$ref'";
        $get_address_qry1 = mysqli_query($connect, $get_address1);
        $get_address_fetch1 = mysqli_fetch_array($get_address_qry1);

        $Ucode = $get_address_fetch1['ref_code'];
        $req_stats = $get_address_fetch1['req_status'];

        $get_address = "SELECT * FROM upti_reseller WHERE reseller_code = '$Ucode'";
        $get_address_qry = mysqli_query($connect, $get_address);
        $get_address_fetch = mysqli_fetch_array($get_address_qry);

        $fullname = $get_address_fetch['reseller_name'];
        $contact = $get_address_fetch['reseller_mobile'];
        $address = $get_address_fetch['reseller_address'];
        $email = $get_address_fetch['reseller_email'];
    } else {
        $get_address1 = "SELECT * FROM stockist_request WHERE req_reference = '$ref'";
        $get_address_qry1 = mysqli_query($connect, $get_address1);
        $get_address_fetch1 = mysqli_fetch_array($get_address_qry1);

        $req_stats = $get_address_fetch1['req_status'];

        $get_count = "SELECT * FROM upti_series WHERE remark = 'stockist'";
        $get_count_qry = mysqli_query($connect, $get_count);
        $get_count_fetch = mysqli_fetch_array($get_count_qry);

        $count = $get_count_fetch['series'];
        $country = 'PHILIPPINES';

        $fullname = 'UPTIMISED CORPORATION PH';
        $contact = '0909090909090';
        $address = 'SBFZ';
        $email = 'uptimisedcorporation2022@gmail.com';
    }
?>
<style>
    @media (min-width: 0) {
    .g-mr-15 {
        margin-right: 1.07143rem !important;
    }
    .g-ml-15 {
        margin-left: 1.07143rem !important;
    }
    }
    @media (min-width: 0){
        .g-mt-3 {
            margin-top: 0.21429rem !important;
        }
    }
    
    .g-height-50 {
        height: 50px;
    }
    
    .g-width-50 {
        width: 50px !important;
    }
    
    @media (min-width: 0){
        .g-pa-30 {
            padding: 1rem !important;
        }
    }
    
    .g-bg-secondary {
        background-color: #fafafa !important;
    }
    
    .u-shadow-v18 {
        border: 1px solid #333;
        border-radius: 20px;
        /*box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);*/
    }
    
    .g-color-gray-dark-v4 {
        color: #777 !important;
    }
    
    .g-font-size-12 {
        font-size: 0.85714rem !important;
    }
    
    .media-comment {
        margin-top:5px
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <!--REMARKS-->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card rounded-0">
                        <div class="card-body login-card-body text-dark">
                            <div class="row">
                                <div class="col-12">
                                    <span class="float-left text-primary"><b>Purchase Order Information</b></span>
                                    <span class="float-right text-primary"><b><?php echo $req_stats; ?></b></span>
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
                                            <h6 class="float-left"><b><?php echo $fullname ?></b></h6>
                                        </div>
        
                                        <div class="col-md-2 col-sm-6">
                                            <h6 class="float-left">Address: </h6>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <h6 class="float-left"><b><?php echo $address ?></b></h6>
                                        </div>
        
                                        <div class="col-md-2 col-sm-6">
                                            <h6 class="float-left">Contact Number: </h6>
                                        </div>
                                        <div class="col-md-5 col-sm-6">
                                            <h6 class="float-left"><b><?php echo $contact ?></b></h6>
                                        </div>
        
                                        <div class="col-md-2 col-sm-6">
                                            <h6 class="float-left">Email Address: </h6>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <h6 class="float-left"><b><?php echo $email ?></b></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                
                                <div class="col-12">
                                     <!-- Order List Table Start -->
                                    <table id="example2" class="table table-sm table-striped table-hover border border-info">
                                        <thead>
                                            <tr>
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

                                        $po_name = $fullname;
        
                                        if (isset($_POST['process'])) {
        
                                            $req_sql = "INSERT INTO stockist_request (ref_date, req_reference, req_name, ref_code, req_country, req_amount, req_status) VALUES ('$dates', '$ref','$po_name', '$Ucode', '$country','$total','Pending')";
                                            $req_qry = mysqli_query($connect, $req_sql);
                                            // echo '<br>';
                                            $count_new = $count + 1;
        
                                            $update_count = "UPDATE stockist SET stockist_count = '$count_new' WHERE stockist_code = '$Ucode'";
                                            $update_count_qry = mysqli_query($connect, $update_count);
        
                                            echo "<script>alert('Purchased Order has been submitted successfully');window.location.href='stockist-po-list.php';</script>";
        
                                        }                                
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
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--REMARKS-->
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <div class="card rounded-0">
                        <div class="card-body login-card-body text-dark">     
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                                if (isset($_POST['Gora'])) {
                                                    $comment = $_POST['remarks'];
                                                    
                                                    if ($role == 'UPTIRESELLER') {
                                                         $remark_sql = "INSERT INTO stockist_remarks (remarks_code, remarks_reference, remarks_comment, remarks_stockist, remarks_date, remarks_chat) VALUES ('$Ucode', '$ref', '$comment', 'Unread', '$dates', '$Ucode')";
                                                        $remark_qry = mysqli_query($connect, $remark_sql);
                                                    } else {
                                                        $remark_sql = "INSERT INTO stockist_remarks (remarks_code, remarks_reference, remarks_comment, remarks_csr, remarks_date, remarks_chat) VALUES ('$Ucode', '$ref', '$comment', 'Unread', '$dates', '$role')";
                                                        $remark_qry = mysqli_query($connect, $remark_sql);
                                                    }
                                            ?>
                                                <script>window.location='reference-info.php?poid=<?php echo $ref; ?>'</script>
                                            <?php
                                                }
                                            ?>
                                            <form action="reference-info.php" method="post">
                                                <span class="float-left text-primary"><b>REMARKS</b></span>
                                                <textarea class="form-control" name="remarks"></textarea><br>
                                                <button type="submit" class="btn btn-sm btn-success form-control rounded-0" name="Gora">SUBMIT</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <?php
                                        
                                            $remarks_loop = "SELECT * FROM stockist_remarks WHERE remarks_reference = '$ref' ORDER BY id DESC";
                                            $remarks_loop_sql = mysqli_query($connect, $remarks_loop);
                                            while ($remarks_loop_fetch = mysqli_fetch_array($remarks_loop_sql)) {
                                                $rm_code = $remarks_loop_fetch['remarks_chat'];
                                                $get_image = "SELECT * FROM upti_users WHERE users_code = '$rm_code'";
                                                $get_image_sql = mysqli_query($connect, $get_image);
                                                $get_image_fetch = mysqli_fetch_array($get_image_sql);
                                                
                                            if ($rm_code == 'UPTIACCOUNTING') {
                                        ?>
                                        <div class="col-12">
                                            <br>
                                            <div class="media g-mb-30 media-comment">
                                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                                  <div class="g-mb-15">
                                                    <h5 class="h5 g-color-gray-dark-v1 mb-0"><b><?php echo $rm_code ?></b></h5>
                                                    <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $remarks_loop_fetch['remarks_date']; ?></span>
                                                  </div>
                                                  <p><?php echo $remarks_loop_fetch['remarks_comment']; ?></p>
                                                </div>
                                                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-ml-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="col-12">
                                            <br>
                                            <div class="media g-mb-30 media-comment">
                                                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="images/profile/<?php echo $get_image_fetch['users_img'] ?>" alt="Image Description">
                                                <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                                  <div class="g-mb-15">
                                                    <h5 class="h5 g-color-gray-dark-v1 mb-0"><b><?php echo $get_image_fetch['users_name'] ?></b></h5>
                                                    <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $remarks_loop_fetch['remarks_date']; ?></span>
                                                  </div>
                                                  <p><?php echo $remarks_loop_fetch['remarks_comment']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
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
<?php //include 'backend/po-stockist-modal.php'; ?>
<?php include 'include/footer.php'; ?>