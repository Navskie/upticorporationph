<div class="modal fade" id="paid<?php echo $code['vendor_po'] ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form method="POST" action="stockist-backend/paid-process.php?id=<?php echo $code['vendor_po'] ?>">
        <div class="modal-body text-center">
            <i class="fa fa-exclamation" style="font-size:48px;color:red"></i><br><br><p>Are you sure payment has been made for this Purchase Order?</p>
            <div class="form-group">
                <label for="">Please Select Country</label>
                <select class="form-control select2bs4" style="width: 100%;" name="bansa">
                    <option value="">Country</option>    
                    <option value="KOREA">KOREA</option>
                    <option value="PHILIPPINES">PHILIPPINES</option>
                    <option value="TAIWAN">TAIWAN</option>
                    <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                </select>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
            <button class="btn btn-danger rounded-0" name="PAID">Confirm</a>
        </div>
    </div>
    </form>
    </div>
</div>