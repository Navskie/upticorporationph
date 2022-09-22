<div class="modal fade" id="received<?php echo $code['vendor_po'] ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Warning</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body text-center">
            <form action="stockist-backend/received-process.php?id=<?php echo $code['vendor_po'] ?>" method="POST">
                <i class="fa fa-exclamation" style="font-size:48px;color:red"></i><br><br><p>Are you sure? <br> Do you want to add this to your inventory?</p>
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">No</button>
                <button class="btn btn-primary rounded-0" name="po-received">Yes</a>
            </div>
            </form>
        </div>
    </div>
</div>