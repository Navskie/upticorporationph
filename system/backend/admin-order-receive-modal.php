<div class="modal fade" id="receive<?php echo $order['trans_poid']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Receive RTS Items</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/admin-order-receive-process.php?id=<?php echo $order['trans_poid']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    Are you sure you want to move RTS item in Inventory?</label>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" name="receive">Received</button>
        </form>
        </div>
    </div>
    </div>
</div>