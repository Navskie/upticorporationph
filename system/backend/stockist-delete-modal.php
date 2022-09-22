<div class="modal fade" id="stockdelete<?php echo $code['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
            <i class="fa fa-exclamation" style="font-size:48px;color:red"></i><br><br><p>Are you sure you want to Delete Stockist Holder?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default rounded-0 border-info" data-dismiss="modal">Close</button>
            <a class="btn btn-danger rounded-0" href="backend/stockist-delete-process.php?id=<?php echo $code['id']; ?>">Confirm</a>
        </div>
    </div>
    </div>
</div>