<div class="modal fade" id="view<?php echo $account_fetch['reseller_poid']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Packages Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            
            <hr>
            <!-- <span>Package Details</span> -->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <i>Item Code</i>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <i>Description</i>
                </div>
                <?php
                  $res_poid = $account_fetch['reseller_poid'];

                  $items_stmt = mysqli_query($connect, "SELECT * FROM upti_order_list WHERE ol_poid = '$res_poid'");

                  while ($items = mysqli_fetch_array($items_stmt)) {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <i><?php echo $items['ol_code'] ?></i>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <i><?php echo $items['ol_desc'] ?></i>
                </div>
                <?php } ?>
            </div>
            <hr>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button class="btn btn-primary" name="country">Submit</button> -->
        </div>
    </div>
    </div>
</div>