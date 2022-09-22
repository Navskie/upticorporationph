
<div class="modal fade" id="forgot-password">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-0">
        <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/forgot-process.php" method="post">
            <div class="row">
                <div class="col-6">
                    <label for="">Email Address</label>
                    <input type="text" class="form-control rounded-0" name="email" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Birthday</label>
                    <input type="date" class="form-control rounded-0" name="bday" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-danger rounded-0" name="fp">Change Password</button>
        </form>
        </div>
        
    </div>
    </div>
</div>