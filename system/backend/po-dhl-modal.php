<div class="modal fade" id="dhl<?php echo $account_fetch['req_reference'] ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">DHL Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
            <?php
                $reference = $account_fetch['req_reference'];

                $get_dhl = mysqli_query($connect, "SELECT * FROM stockist_dhl WHERE dhl_reference = '$reference'");
                $get_dhl_fetch = mysqli_fetch_array($get_dhl);
            ?>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Length</label><br>
                        <span><?php echo $get_dhl_fetch['dhl_length'] ?>cm</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Width</label><br>
                        <span><?php echo $get_dhl_fetch['dhl_width'] ?>cm</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Height</label><br>
                        <span><?php echo $get_dhl_fetch['dhl_weight'] ?>cm</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Weight</label><br>
                        <span><?php echo $get_dhl_fetch['dhl_weight'] ?>kg</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>