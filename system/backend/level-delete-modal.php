<div class="modal fade" id="delete<?php echo $code['id']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Delete Reseller Level</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/level-delete-process.php?id=<?php echo $code['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Are you sure you want to delete level?</label>
                    <p>All level <?php echo $code['levels']; ?> Reseller, will no longer earn <?php echo $code['percent']; ?> commision</p>
                </div>
                <div class="col-12">
                    <label for="">Admin Password</label>
                    <input type="password" class="form-control" name="pass" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="deletelevel">Delete</button>
        </form>
        </div>
        
    </div>
    </div>
</div>