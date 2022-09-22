<div class="modal fade" id="edit<?php echo $epayment['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Update Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/bank-edit-process.php?id=<?php echo $epayment['id']?>" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option value="<?php echo $epayment['mod_country'] ?>"><?php echo $epayment['mod_country'] ?></option>
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
                            <option value="<?php echo $epayment['mod_state'] ?>"><?php echo $epayment['mod_state'] ?></option>
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
                    <input type="text" class="form-control" name="branch" autocomplete="off" required value="<?php echo $epayment['mod_branch'] ?>">
                </div>
                <div class="col-12">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" required value="<?php echo $epayment['mod_name'] ?>">
                </div>
                <div class="col-12">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" name="number" autocomplete="off" required value="<?php echo $epayment['mod_number'] ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-primary rounded-0" name="updatepayment">Update</button>
        </form>
        </div>
    </div>
    </div>
</div>