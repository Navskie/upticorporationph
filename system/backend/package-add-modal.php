<?php
    if (isset($_POST['package'])) {
        $pack_type = $_POST['pack_type'];
        $pack_code = $_POST['pack_code'];
        $pack_desc = $_POST['pack_desc'];
        $pack_points = $_POST['pack_points'];
        $pack_c1 = $_POST['one_code'];
        $pack_qty1 = $_POST['one_qty'];
        $pack_c2 = $_POST['two_code'];
        $pack_qty2 = $_POST['two_qty'];
        $pack_c3 = $_POST['three_code'];
        $pack_qty3 = $_POST['three_qty'];
        $pack_c4 = $_POST['four_code'];
        $pack_qty4 = $_POST['four_qty'];
        $pack_c5 = $_POST['five_code'];
        $pack_qty5 = $_POST['five_qty'];
        $exc = $_POST['exc'];

        $get_package_sql = "SELECT * FROM upti_package WHERE package_code = '$pack_code'";
        $get_package_qry = mysqli_query($connect, $get_package_sql);
        $get_num_code = mysqli_num_rows($get_package_qry);

        if ($get_num_code == 0) {
            if ($pack_code == '') {
                echo "<script>alert('Package Code is missing.');window.location.href = 'item-package.php';</script>"; 
            } else {
                echo $packages = "INSERT INTO upti_package (package_code, package_desc, package_points, package_one_code, package_one_qty, package_two_code, package_two_qty, package_three_code, package_three_qty, package_four_code, package_four_qty, package_five_code, package_five_qty, package_status, package_category, package_exclusive) VALUES ('$pack_code', '$pack_desc' , '$pack_points', '$pack_c1', '$pack_qty1', '$pack_c2', '$pack_qty2', '$pack_c3', '$pack_qty3', '$pack_c4', '$pack_qty4', '$pack_c5', '$pack_qty5', 'Active', '$pack_type', '$exc')";
                $package_qry = mysqli_query($connect, $packages);

                echo "<script>alert('Data has been Added successfully.');window.location.href = 'item-package.php';</script>";
            }
        } else {
            echo "<script>alert('Duplicate Package code is not allowed.');window.location.href = 'item-package.php';</script>";
        }

    }
?>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Package Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="item-package.php" method="post">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label>Package Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="pack_code">
                            <option value="">Select Package Code</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code WHERE code_status = 'Package' ORDER BY id DESC";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['code_name'] ?>"><?php echo $product['code_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Package Type</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="pack_type">
                            <option value="">Select Package Type</option>
                            <option value="RESELLER">RESELLER PACKAGE</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <label for="">Package Description</label>
                    <input type="text" class="form-control" name="pack_desc" autocomplete="off" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label for="">Points</label>
                    <input type="number" class="form-control" name="pack_points" autocomplete="off" required>
                </div>

                <div class="col-12"><br><p>Package Item List</p></div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label for="">Item Qty</label>
                    <input type="text" class="form-control" name="one_qty" autocomplete="off">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <label for="">Item Code</label>
                    <select class="form-control select2bs4" style="width: 100%;" name="one_code">
                        <option value="">Select Product</option>
                        <?php
                        $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="two_qty" autocomplete="off">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="two_code">
                        <option value="">Select Product</option>
                        <?php
                        $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="three_qty" autocomplete="off">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="three_code">
                        <option value="">Select Product</option>
                        <?php
                        $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="four_qty" autocomplete="off">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="four_code">
                        <option value="">Select Product</option>
                        <?php
                        $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="five_qty" autocomplete="off">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="five_code">
                    <option value="">Select Product</option>
                        <?php
                        $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12"><hr></div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Exclusive For </label><i class="text-danger"> (Optional for single Reseller)</i>
                        <select class="form-control select2bs4" style="width: 100%;" name="exc">
                        <option value="">Select Product</option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'";
                            $product_qry = mysqli_query($connect, $product_sql);
                            while ($product = mysqli_fetch_array($product_qry)) {
                            ?>
                            <option value="<?php echo $product['code_name'] ?>">[<?php echo $product['code_name'] ?>] → <?php echo $product['items_desc'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default rounded-0 border-info" data-dismiss="modal">Close</button>
        <button class="btn btn-primary rounded-0" name="package">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>