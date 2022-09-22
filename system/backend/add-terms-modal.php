<div class="modal fade" id="terms<?php echo $get_transaction_fetch['trans_poid']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center"><label for="">OFFICIAL STATEMENT</label></h4>
        </div>
        <div class="modal-body">
        <form action="backend/add-terms-process.php?terms=<?php echo $get_transaction_fetch['trans_poid']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <img src="./images/statement.jpg" alt="" class="img-responsive w-100">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button class="btn"></button>
            <button class="btn btn-info rounded-0" name="agree">I AGREE</button>
        </form>
        </div>
        
    </div>
    </div>
</div>