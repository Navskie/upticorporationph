<div class="modal fade" id="edit<?php echo $shipping['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Shipping Fee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/shipping-edit-process.php?id=<?php echo $shipping['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="country">
                            <option value="<?php echo $shipping['shipping_country']; ?>"><?php echo $shipping['shipping_country']; ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label for="">Shipping Fee</label>
                    <input type="text" class="form-control" name="price" autocomplete="off" required value="<?php echo $shipping['shipping_price']; ?>">
                </div>
                <div class="col-6">
                    <label for="">Less Shipping Fee</label>
                    <input type="text" class="form-control" name="less" autocomplete="off" required value="<?php echo $shipping['shipping_less']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default rounded-0 border-info" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="shipping">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>