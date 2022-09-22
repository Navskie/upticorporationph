<?php
    include './dbms/conn.php';

    if (isset($_POST['branch'])) {

        $fname = $_POST['fname'];
        $status = $_POST['status'];
        $country = $_POST['country'];
        $us = $_POST['us'];
        $pw = $_POST['pw'];

        $check_fee = "SELECT * FROM upti_users WHERE users_username = '$us'";
        $check_fee_qry = mysqli_query($connect, $check_fee);
        $check_num_row = mysqli_num_rows($check_fee_qry);

        if ($check_num_row == 0) {
            $epayment_process = "INSERT INTO upti_users (users_name, users_employee, users_status, users_username, users_password, users_role) VALUES ('$fname', '$country', '$status', '$us', '$pw', 'BRANCH')";
            $epayment_process_qry = mysqli_query($connect, $epayment_process);

            echo "<script>alert('Data has been Added successfully.');window.location.href = 'admin-branch.php';</script>";
        } else {
            echo "<script>alert('Duplicate Username is not allowed');window.location.href = 'admin-branch.php';</script>";
        }

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Branch Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="admin-branch.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" name="fname" autocomplete="off" required>
                </div>
                <div class="col-12">
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
                <div class="col-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="status">
                            <option selected="selected">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="us" autocomplete="off" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="pw" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="branch">Submit</button>
        </form>
        </div>
    </div>
    </div>
</div>