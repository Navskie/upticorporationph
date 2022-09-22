<?php
    include './dbms/conn.php';

    if (isset($_POST['stockist'])) {

        $date = date('m-d-Y');
        $reseller = $_POST['reseller'];
        $status = $_POST['stats'];
        $state = $_POST['state'];
        $country = $_POST['country'];

        if ($reseller == '' || $status == '' || $country == '') {
            echo "<script>alert('All fields are required');window.location.href='stock-branch.php';</script>";
        } else {
            $insert_stockist = "INSERT INTO stockist (stockist_count, stockist_code, stockist_country, stockist_status, stockist_date, stockist_state) VALUES ('1', '$reseller', '$country', 'Active', '$date', '$state')";
            $insert_stockist_qry = mysqli_query($connect, $insert_stockist);

            echo "<script>alert('Data has been added successfully');window.location.href='stock-branch.php';</script>";
        }

    }
?>
<div class="modal fade" id="stockbranch">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Register Stockist</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="stock-branch.php" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Reseller Name</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="reseller">
                            <option value="">Select Reseller</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_users WHERE users_role = 'UPTIRESELLER' AND users_status = 'Active'";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['users_code'] ?>"><?php echo $product['users_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Assign Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option value="">Select Country</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_country_currency";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['cc_country'] ?>"><?php echo $product['cc_country'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>State <small class="text-danger">For Canada Only</small></label>
                        <select class="form-control select2bs4" style="width: 100%;" name="state">
                            <option value="">Select State</option>
                            <option value="">NONE</option>
                            <option value="ALL">ALL</option>
                            <?php
                                $lugar = "SELECT * FROM upti_state";
                                $lugar_qry = mysqli_query($connect, $lugar);
                                while ($lugar_fetch = mysqli_fetch_array($lugar_qry)) {
                            ?>
                            <option value="<?php echo $lugar_fetch['state_name'] ?>"><?php echo $lugar_fetch['state_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="stats">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="role">
                            <option value="">Select Role</option>
                            <option value="MAIN">MAIN</option>
                            <option value="SUBMAIN">SUBMAIN</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="stockist">Submit</button>
        </form>
        </div>
    </div>
    </div>
</div>