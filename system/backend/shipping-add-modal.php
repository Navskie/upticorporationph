<?php
    if (isset($_POST['shipping'])) {

        $country = $_POST['country'];
        $price = $_POST['price'];
        $less = $_POST['less'];

        $check_fee = "SELECT * FROM upti_shipping WHERE shipping_country = '$country'";
        $check_fee_qry = mysqli_query($connect, $check_fee);
        $check_num_row = mysqli_num_rows($check_fee_qry);

        if ($check_num_row == 0) {
            $epayment_process = "INSERT INTO upti_shipping (shipping_country, shipping_price, shipping_less, shipping_status) VALUES ('$country', '$price', '$less', 'Active')";
            $epayment_process_qry = mysqli_query($connect, $epayment_process);

            echo "<script>alert('Data has been Added successfully.');window.location.href = 'order-shipping.php';</script>";
        } else {
            echo "<script>alert('Shipping fee in this country is already have.');window.location.href = 'order-shipping.php';</script>";
        }

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Shipping Fee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="order-shipping.php" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option selected="selected">Select Country</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_country";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['country_name'] ?>"><?php echo $product['country_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label for="">Shipping Fee</label>
                    <input type="text" class="form-control" name="price" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Less Shipping Fee</label>
                    <input type="text" class="form-control" name="less" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="shipping">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>