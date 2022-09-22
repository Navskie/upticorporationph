<div class="modal fade" id="edit<?php echo $country['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Country</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/cc-edit-process.php?id=<?php echo $country['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Country</label>
                    <input type="text" class="form-control" name="country" autocomplete="off" required value="<?php echo $country['cc_country']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="editbansa">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>