<div class="modal fade" id="received<?php echo $account_fetch['req_reference']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h4 class="modal-title">Purchase Order</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <form action="backend/transfer-received-process.php?id=<?php echo $account_fetch['req_reference']; ?>" method="post">
            </div>
            <div class="modal-body pt-4">
                <div class="row">
                    <div class="col-12">
                        <p>Are you sure you want to transfer stocks now?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="float-right btn btn-primary" style="border-radius: 0px !important;" name="receive_it">Transfer</button>
                </form>
            </div>
        </div>
    </div>
</div>