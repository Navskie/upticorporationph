<div class="modal fade" id="image<?php echo $id; ?>"">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Attachment File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <?php
                        $get_img = "SELECT * FROM upti_transaction WHERE id = '$id'";
                        $get_qry = mysqli_query($connect, $get_img);
                        $get_fetch = mysqli_fetch_array($get_qry);
                    ?>
                    <img src="images/payment/<?php echo $get_fetch['trans_img']; ?>"" alt="" width="100%" class="image-responsive">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>