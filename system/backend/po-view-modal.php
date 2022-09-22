<div class="modal fade" id="cancel<?php echo $rows['id']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content bg-danger">
            <div class="modal-header">
            <h4 class="modal-title">Cancel Purchase Order</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this Product?</p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 0px !important;">Close</button>
            <a class="btn btn-warning" style="border-radius: 0px !important;" href="backend/po-remove-process.php?id=<?php echo $rows['id']; ?>">Proceed</a>
            </div>
        </div>
    </div>
</div>