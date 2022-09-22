<div class="modal fade" id="void<?php echo $ol_fetch['id']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content bg-danger">
            <div class="modal-header">
            <h4 class="modal-title">Remove Item</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to void this Item?</p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 0px !important;">Close</button>
            <a class="btn btn-warning" style="border-radius: 0px !important;" href="backend/void-item-process2.php?id=<?php echo $ol_fetch['id']; ?>">Yes</a>
            </div>
        </div>
    </div>
</div>