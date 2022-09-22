<div class="modal fade" id="edit<?php echo $code['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Shipping Fee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/code-edit-process.php?id=<?php echo $code['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Item Status</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="status">
                            <option value="<?php echo $code['code_status']; ?>"><?php echo $code['code_status']; ?></option>
                            <option value="Single">Single</option>
                            <option value="Package">Package</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Item Category</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="category">
                            <option value="<?php echo $code['code_category']; ?>"><?php echo $code['code_category']; ?></option>
                            <option value="PROMO">PROMO</option>
                            <option value="RESELLER">RESELLER</option>
                            <option value="NON-REBATABLE">NON-REBATABLE</option>
                            <option value="REBATABLE">REBATABLE</option>
                            <option value="BUY ONE GET ANY">BUY ONE GET ANY</option>
                            <option value="FREE">FREE</option>
                            <option value="BUY ONE GET TWO">BUY ONE GET TWO</option>
                            <option value="FREE TWO">FREE TWO</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label for="">Item Code</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" required value="<?php echo $code['code_name']; ?>">
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Main Code<i class="text-danger"> For Inventory</i></label>
                        <select class="form-control select2bs4" style="width: 100%;" name="maincode">
                            <option value="<?php echo $code['code_main']; ?>"><?php echo $code['code_main']; ?></option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code WHERE code_status = 'Single' AND code_name LIKE 'UP%'";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['code_name'] ?>"><?php echo $product['code_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Combo Code<i class="text-danger"> Tie Up</i></label>
                        <select class="form-control select2bs4" style="width: 100%;" name="combo">
                            <option value="<?php echo $code['code_exclusive']; ?>"><?php echo $code['code_exclusive']; ?></option>
                            <option value="">REMOVE</option>
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
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="code">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>