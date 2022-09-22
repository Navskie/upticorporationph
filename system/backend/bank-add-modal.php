<?php
    if (isset($_POST['bank'])) {

        $country = $_POST['country'];
        $branch = $_POST['branch'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $state = $_POST['state'];

        $epayment_process = "INSERT INTO upti_mod (mod_state, mod_country, mod_branch, mod_name, mod_number, mod_status) VALUES ('$state', '$country', '$branch', '$name', '$number', 'bank')";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        echo "<script>alert('Data has been Added successfully.');window.location.href = 'order-bank.php';</script>";

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Bank Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="order-bank.php" method="post">
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
                <div class="col-12">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="state">
                            <option value="">Select State</option>
                            <option value="ALL">ALL</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_state";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['state_name'] ?>"><?php echo $product['state_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="">Account Branch</label>
                    <input type="text" class="form-control" name="branch" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" name="number" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="bank">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>