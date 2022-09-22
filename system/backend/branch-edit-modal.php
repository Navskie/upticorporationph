<div class="modal fade" id="edit<?php echo $code['users_id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Branch Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/branch-edit-process.php?id=<?php echo $code['users_id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" name="fname" autocomplete="off" required value="<?php echo $code['users_name']; ?>">
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
                            <option value="<?php echo $code['users_status']; ?>"><?php echo $code['users_status']; ?></option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="us" autocomplete="off" required value="<?php echo $code['users_username']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="pw" autocomplete="off" required value="<?php echo $code['users_password']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="editbranch">Submit</button>
        </form>
        </div>
    </div>
    </div>
</div>