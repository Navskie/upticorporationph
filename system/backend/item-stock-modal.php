<div class="modal fade" id="stock<?php echo $item['id']; ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Item Add Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/item-stock-process.php?id=<?php echo $item['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Number of Stocks</label>
                    <input type="number" class="form-control" name="stocks" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="">Enter Admin Password</label>
                    <input type="password" class="form-control" name="password" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" name="stock">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>