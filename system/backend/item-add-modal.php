<?php
    if (isset($_POST['item'])) {

        $code = $_POST['code'];
        $desc = $_POST['desc'];
        $points = $_POST['points'];
        $cat = $_POST['cat'];
        $exc = $_POST['exc'];

        $check_item = "SELECT * FROM upti_items WHERE items_code = '$code'";
        $check_item_qry = mysqli_query($connect, $check_item);
        $check_item_num = mysqli_num_rows($check_item_qry);

        if ($check_item_num == 0) {
            if ($cat == '' || $code == '') {
                echo "<script>alert('Item Code and Category is Required.');window.location.href = 'item-list.php';</script>";
            } else {
                $epayment_process = "INSERT INTO upti_items (items_code, items_desc, items_points, items_category, items_status, items_exclusive) VALUES ('$code', '$desc', '$points', '$cat', 'Active', '$exc')";
                $epayment_process_qry = mysqli_query($connect, $epayment_process);
                echo "<script>alert('Data has been Added successfully.');window.location.href = 'item-list.php';</script>";
            }
        } else {
            echo "<script>alert('Duplicate Item code is not allowed.');window.location.href = 'item-list.php';</script>";
        }

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Item Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="item-list.php" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Item Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="code">
                            <option selected="selected">Select Item Code</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code WHERE code_status = 'Single'";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['code_name'] ?>"><?php echo $product['code_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Item Category</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="cat">
                            <option selected="selected">Select Category</option>
                            <?php
                            $category_sql = "SELECT * FROM upti_category";
                            $category_qry = mysqli_query($connect, $category_sql);
                            while ($category = mysqli_fetch_array($category_qry)) {
                            ?>
                            <option value="<?php echo $category['category_name'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-9">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="desc" autocomplete="off" required>
                </div>
                <div class="col-3">
                    <label for="">Points</label>
                    <input type="text" class="form-control" name="points" autocomplete="off" required>
                </div>
                <div class="col-12"><hr></div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Exclusive For </label><i class="text-danger"> (Optional for single Reseller)</i>
                        <select class="form-control select2bs4" style="width: 100%;" name="exc">
                            <option value="">All Reseller</option>
                            <?php
                            $category_sql = "SELECT * FROM upti_users WHERE users_role = 'UPTIRESELLER' AND users_status = 'Active'";
                            $category_qry = mysqli_query($connect, $category_sql);
                            while ($category = mysqli_fetch_array($category_qry)) {
                            ?>
                            <option value="<?php echo $category['users_code'] ?>"><?php echo $category['users_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default border-info rounded-0" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="item">Submit</button>
        </form>
        </div>   
    </div>
    </div>
</div>