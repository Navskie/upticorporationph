<div class="modal fade" id="onprocess<?php echo $id; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">On Process Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/admin-order-on-process-process.php?id=<?php echo $id; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    Are you sure you want to change the order status into <br> <label>On Process?</label>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" name="onprocess">On Process</button>
        </form>
        </div>
    </div>
    </div>
</div>