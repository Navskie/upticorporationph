
<div class="modal fade" id="add<?php echo $account_fetch['users_code'] ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="backend/ads-process.php?osr=<?php echo $account_fetch['users_code'] ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Add Number Inquiries</label>
                    <input type="text" class="form-control" name="inquiries" autocomplete="off" placeholder="Optional">
                </div>
                <div class="col-12">
                    <label for="">Add Daily Ads Spent</label>
                    <input type="text" class="form-control" name="spent" autocomplete="off" placeholder="Optional">
                </div>
                <div class="col-12">
                    <label for="">Add Ads MTD</label>
                    <input type="text" class="form-control" name="mtd" autocomplete="off" placeholder="Optional">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="adsteam">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>