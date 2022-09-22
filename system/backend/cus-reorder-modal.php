<div class="modal fade" id="reorder<?php echo $order['id']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Customer Re-Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to Re Order For <b><?php echo $order['trans_fname']; ?> <?php echo $order['trans_lname']; ?></b>?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a class="btn btn-success" href="backend/cus-reorder-process.php?id=<?php echo $order['id']; ?>">Process</a>
        </div>
    </div>
    </div>
</div>