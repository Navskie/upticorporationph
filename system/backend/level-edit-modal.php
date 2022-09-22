<div class="modal fade" id="edit<?php echo $code['id']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Reseller Level Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/level-edit-process.php?id=<?php echo $code['id']; ?>" method="post">
            <div class="row">
                <div class="col-6">
                    <label for="">Level</label>
                    <input type="text" class="form-control" name="lvl" autocomplete="off" required value="<?php echo $code['levels']; ?>">
                </div>
                <div class="col-6">
                    <label for="">Percentage</label>
                    <input type="text" class="form-control" name="per" autocomplete="off" required value="<?php echo $code['percent']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="leveledit">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>