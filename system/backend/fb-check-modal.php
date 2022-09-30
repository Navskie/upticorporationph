<div class="modal fade" id="check<?php echo $code['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Notification</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/fb-check-process.php?id=<?php echo $code['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    Are you sure you want to change the Page status into Active?
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-success" name="activate">Activate</button>
        </form>
        </div>
    </div>
    </div>
</div>