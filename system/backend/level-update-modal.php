<div class="modal fade" id="upgrade<?php echo $account_fetch['users_id'] ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Upgrade Reseller Account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/level-update-process.php?id=<?php echo $account_fetch['users_id']; ?>" method="post">
            <div class="row">
                <div class="col-4">
                    <label for="">ID Number</label>
                    <input type="text" disabled class="form-control" name="id" autocomplete="off" required value="<?php echo $account_fetch['users_code']; ?>">
                </div>
                <div class="col-6">
                    <label for="">Full Name</label>
                    <input type="text" disabled class="form-control" name="fname" autocomplete="off" required value="<?php echo $account_fetch['users_name']; ?>">
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="lvl">
                            <option value="<?php echo $account_fetch['users_level']; ?>"><?php echo $account_fetch['users_level']; ?></option>
                            <?php
                            $product_sql = "SELECT * FROM upti_level";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['levels'] ?>"><?php echo $product['levels'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="upgradereseller">Submit</button>
        </form>
        </div>
    </div>
    </div>
</div>