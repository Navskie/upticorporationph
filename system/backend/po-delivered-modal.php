<div class="modal fade" id="delivered<?php echo $rows['req_reference']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content bg-success rounded-0">
            <div class="modal-header">
            <h4 class="modal-title">Purchase Order Change Status</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body pt-4">
                <p>Are you sure you want to change status into Received?</p>
            </div>
            <div class="modal-footer">
                <a class="float-right btn btn-default" style="border-radius: 0px !important;" href="backend/po-delivered-process.php?id=<?php echo $rows['req_reference']; ?>">Received</a>
            </div>
        </div>
    </div>
</div>