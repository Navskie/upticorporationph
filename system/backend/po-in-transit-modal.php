<?php
    $test = $_SESSION['role'];

    if ($test == 'UPTIACCOUNTING') {
        $new = $account_fetch['req_reference'];
    } else {
        $new = $account_fetch['id'];
    }
?>

<div class="modal fade" id="intransit<?php echo $new ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h4 class="modal-title">In Transit Status</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body pt-4">
                <form action="backend/po-in-transit-process.php?id=<?php echo $new; ?>" method="POST">
                <p>Are you sure you want to change status into In Transit?</p>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tracking Number</label>
                            <input class="form-control" name="track" type="text" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>URL link here</label>
                            <input class="form-control" name="link" type="text" autocomplete="off" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-0 btn-sm float-right" name="tracking">In Transit</button>
                </form> 
            </div>
        </div>
    </div>
</div>