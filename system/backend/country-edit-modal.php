<div class="modal fade" id="edit<?php echo $country['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Country Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/country-edit-process.php?id=<?php echo $country['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Item Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="code">
                            <option value="<?php echo $country['country_code']; ?>"><?php echo $country['country_code']; ?></option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['code_name'] ?>"><?php echo $product['code_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="countrys">
                            <option value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name']; ?></option>
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
                <div class="col-4">
                    <label for="">Shop Price</label>
                    <input type="text" class="form-control" name="price" autocomplete="off" required value="<?php echo $country['country_price']; ?>">
                </div>
                <div class="col-4">
                    <label for="">Earnings Price</label>
                    <input type="text" class="form-control" name="php" autocomplete="off" required value="<?php echo $country['country_total_php']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="country">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>