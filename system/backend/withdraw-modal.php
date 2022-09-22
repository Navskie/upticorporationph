<div class="modal fade" id="earning">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Withdrawal Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/withdraw-process.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Notice</label>
                    <p>Minimum Withdrawal is 500.00</p> 
                </div>
                <div class="col-12">
                    <label for="">Bank Name</label>
                    <input type="text" class="form-control" name="bank" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control" name="name" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" name="number" autocomplete="off" required>
                </div>

                <div class="col-6">
                    <label for="">Amount</label> <i class="text-danger">(50.00 Withdrawal Fee)</i>
                    <input type="number" class="form-control" name="amount" autocomplete="off" required>
                </div>
                <div class="col-6">
                    <label for="">Enter your password</label>
                    <input type="password" class="form-control" name="pass" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="earnmore">Withdraw</button>
        </form>
        </div>
        
    </div>
    </div>
</div>