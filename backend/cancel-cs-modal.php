<div class="modal fade" id="cancel<?php echo $transaction['trans_ref'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want cancel <b>Ref: <?php echo $transaction['trans_ref'] ?></b> order.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="backend/cancel-cs-process.php?id=<?php echo $transaction['trans_ref'] ?>" method="post">
                    <button class="btn btn-danger bg-danger" name="cancel">Cancel Order</button>
                </form>
            </div>
        </div>
    </div>
</div>