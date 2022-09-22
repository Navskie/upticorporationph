<div class="modal fade" id="onpacking<?php echo $account_fetch['req_reference']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h4 class="modal-title">Packing Order</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <form action="backend/po-onpacking-process.php?id=<?php echo $account_fetch['req_reference']; ?>" method="post">
            </div>
            <div class="modal-body pt-4">
                <div class="row">
                    <div class="col-6">
                        <p>Purchase Order is now On Packing!</p>
                    </div>
                    <div class="col-6">
                        <select class="form-control select2bs4" style="width: 100%;" name="bansa">
                            <option value="">Country</option>
                            <option value="KOREA">KOREA</option>
                            <option value="TAIWAN">PHILIPPINES</option>
                            <option value="PHILIPPINES">PHILIPPINES</option>
                            <option value="CND Transfer">CANADA STOCK TRANSFER</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="float-right btn btn-primary" style="border-radius: 0px !important;" name="submit">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>