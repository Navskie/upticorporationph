<div class="modal fade" id="delete<?php echo $item['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
            <i class="fa fa-exclamation" style="font-size:48px;color:red"></i><br><br><p>Are you sure you want to Delete this Item?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
            <a class="btn btn-danger rounded-0" href="backend/item-delete-process.php?id=<?php echo $item['id']; ?>">Confirm</a>
        </div>
    </div>
    </div>
</div>