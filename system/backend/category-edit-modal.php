<div class="modal fade" id="edit<?php echo $category['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/category-edit-process.php?id=<?php echo $category['id']; ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" name="cat" autocomplete="off" required value="<?php echo $category['category_name']; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="category">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>