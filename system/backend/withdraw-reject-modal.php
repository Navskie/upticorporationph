<div class="modal fade" id="reject<?php echo $account_fetch['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Withdrawal Decline</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/withdraw-reject-process.php?id=<?php echo $account_fetch['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <label for="">Remarks</label>
                    <textarea name="comment" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-danger rounded-0" name="reject">Decline</button>
        </form>
        </div>
    </div>
    </div>
</div>