<?php
    include './dbms/conn.php';

    date_default_timezone_set('Asia/Manila');
    
    $Ucode = $_SESSION['code'];
    $date = date('m-d-Y');
    $year = date('Y');
    $time = date('h:m:i');

    $get_count = "SELECT * FROM stockist WHERE stockist_code = '$Ucode'";
    $get_count_qry = mysqli_query($connect, $get_count);
    $get_count_fetch = mysqli_fetch_array($get_count_qry);

    $count = $get_count_fetch['stockist_count'];
    $country = $get_count_fetch['stockist_country'];
    $state = $get_count_fetch['stockist_state'];
    $role = $get_count_fetch['stockist_role'];

    $ref = 'PO-'.$Ucode.''.$year.''.$count;

    if (isset($_POST['popo'])) {

        $qty = $_POST['qty'];
        $code = $_POST['code'];

        $get_desc = "SELECT * FROM upti_items WHERE items_code = '$code'";
        $get_desc_qry = mysqli_query($connect, $get_desc);
        $get_desc_fetch = mysqli_fetch_array($get_desc_qry);

        $desc = $get_desc_fetch['items_desc'];

        $get_price = "SELECT * FROM upti_country WHERE country_name = '$country' AND country_code = '$code'";
        $get_price_qry = mysqli_query($connect, $get_price);
        $get_price_fetch = mysqli_fetch_array($get_price_qry);

        $price = $get_price_fetch['country_total_php'];
        $subtotal = $price * $qty;

        $epayment_process = "INSERT INTO stockist_po 
        (spo_ref, spo_code, spo_item_code, spo_item_desc, spo_item_qty, spo_price, spo_subtotal, spo_date, spo_time, spo_status, spo_country, spo_state, spo_role)
        VALUES 
        ('$ref', '$Ucode', '$code', '$desc', '$qty', '$price', '$subtotal', '$date', '$time', 'Pending', '$country', '$state', '$role')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>window.location.href = 'stockist-po.php';</script>";
    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-0">
        <div class="modal-header">
        <h4 class="modal-title">Add Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="stockist-po.php" method="post">
            <div class="row">
                <div class="col-9">
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
                <div class="col-3">
                    <label for="">Qty</label>
                    <input type="text" class="form-control rounded-0" name="qty" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="popo">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>