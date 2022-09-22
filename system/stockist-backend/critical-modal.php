<div class="modal fade" id="critical<?php echo $code['id'] ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
        <form action="stockist-backend/critical-process.php?id=<?php echo $code['id'] ?>" method="POST">
            <i class="fa fa-exclamation" style="font-size:48px;color:red"></i><br><br><p>Please add critical level</p>
            <div class="form-group">
                <!-- <label for="">Critical Level</label> -->
                <input type="text" name="critical" class="form-control">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-danger rounded-0" name="crit">Confirm</a>
        </div>
    </form>
    </div>
    </div>
</div>