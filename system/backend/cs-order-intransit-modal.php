<div class="modal fade" id="intransit<?php echo $id; ?>">
    <div class="modal-dialog modal-dialog-centered"">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">In Transit Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/cs-order-intransit-process.php?id=<?php echo $id; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    Are you sure you want to change the order status into <br> <label>In Transit?</label>
                </div>
                 <div class="col-12">
                    <input type="text" class="form-control" name="tracking" required placeholder="Insert Tracking Number here">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" name="intransit">In Transit</button>
        </form>
        </div>
    </div>
    </div>
</div>