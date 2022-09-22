<div class="modal fade" id="onprocess<?php echo $account_fetch['req_reference']; ?>">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 0px !important;">
        <div class="modal-content rounded-0">
            <div class="modal-header">
            <h4 class="modal-title">Purchase Order</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <form action="backend/po-on-process-process.php?id=<?php echo $account_fetch['req_reference']; ?>" method="post">
            </div>
            <div class="modal-body pt-4">
                <div class="row">
                    <div class="col-12">
                        <p>Purchase Order is now On Process!</p>
                    </div>
                    <?php if ($account_fetch['req_state'] == 'ALL') { ?>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">Length</label>
                            <input type="text" class="form-control" name="length" placeholder="cm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">Width</label>
                            <input type="text" class="form-control" name="width" placeholder="cm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">Height</label>
                            <input type="text" class="form-control" name="height" placeholder="cm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">Weight</label>
                            <input type="text" class="form-control" name="weight" placeholder="kg" autocomplete="off">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <?php if ($account_fetch['req_state'] == 'ALL') { ?>
                <button class="float-right btn btn-primary" style="border-radius: 0px !important;" name="submit">Proceed</button>
                <?php } else { ?>
                <button class="float-right btn btn-primary" style="border-radius: 0px !important;" name="transfer">Proceed</button>
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>