<div class="modal fade" id="delete<?php echo $get_transaction_fetch['id']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
    <div class="modal-content bg-danger">
        <div class="modal-header">
        <h4 class="modal-title">Delete Customer Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="order-information.php" method="post">
            <div class="row">
                <div class="col-12">
                    <h6>Are you sure you want to delete, All Information?</h6>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 0 !important">Close</button>
            <button class="btn btn-warning" name="delete_info" style="border-radius: 0 !important">Delete</button>
        </form>
        </div>
    </div>
    </div>
</div>