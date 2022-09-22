<div class="modal fade" id="shipfee<?php echo $id; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add Shipping Fee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/ship-add-process.php?id=<?php echo $id; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <span> For International Country</span>
                </div>
                <div class="col-12">
                    <label for="">Add Shipping Fee Amount</label>
                    <input type="text" class="form-control" name="ship" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="addship">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>