<div class="modal fade" id="cancel<?php echo $id; ?>">
    <div class="modal-dialog modal-dialog-centered"">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Cancel Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <label for="">Are you sure you want to cancel this order</label>
        <form action="backend/cs-cancel-process.php?id=<?php echo $id; ?>" method="post">
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-danger float-right" name="cancel">Cancel Order</button>
        </form>
        </div>
        
    </div>
    </div>
</div>