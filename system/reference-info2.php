<?php include 'include/header.php'; ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

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


    $get_address1 = "SELECT * FROM stockist_request WHERE req_reference = '$ref'";
    $get_address_qry1 = mysqli_query($connect, $get_address1);
    $get_address_fetch1 = mysqli_fetch_array($get_address_qry1);

    $Ucode = $get_address_fetch1['ref_code'];
    $req_stats = $get_address_fetch1['req_status'];
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
                                     <!-- Order List Table Start -->
                                    <table id="example2" class="table table-sm table-striped table-hover border border-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Qty</th>
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
                                        </tr>
                                        <?php
                                            $number++; 
                                            } 
                                        ?>
                                    </table>
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