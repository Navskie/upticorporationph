<div class="modal fade" id="delete<?php echo $code['id']; ?>">
    <div class="modal-dialog">
    <div class="modal-content bg-danger">
        <div class="modal-header">
        <h4 class="modal-title">Delete Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to Delete this Announcement?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a class="btn btn-warning" href="backend/announce-delete-process.php?id=<?php echo $code['id']; ?>">Delete</a>
        </div>
    </div>
    </div>
</div>