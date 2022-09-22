<div class="modal fade" id="edit<?php echo $package['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Package Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="backend/package-edit-process.php?id=<?php echo $package['id']; ?>" method="post">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label>Package Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="pack_code">
                            <option value="<?php echo $package['package_code']; ?>"><?php echo $package['package_code']; ?></option>
                            <?php
                            $product_sql = "SELECT * FROM upti_code WHERE code_status = 'Package'";
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
                        <label>Package Code</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="stats">
                            <option value="<?php echo $package['package_status']; ?>"><?php echo $package['package_status']; ?></option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <label for="">Package Description</label>
                    <input type="text" class="form-control" name="pack_desc" autocomplete="off" required value="<?php echo $package['package_desc']; ?>">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label for="">Points</label>
                    <input type="number" class="form-control" name="pack_points" autocomplete="off" required value="<?php echo $package['package_points']; ?>">
                </div>

                <div class="col-12"><br><p>Package Item List</p></div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label for="">Item Qty</label>
                    <input type="text" class="form-control" name="one_qty" autocomplete="off" value="<?php echo $package['package_one_qty']; ?>">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <label for="">Item Code</label>
                    <select class="form-control select2bs4" style="width: 100%;" name="one_code">
                        
                        <option value="<?php echo $package['package_one_code']; ?>">
                        <?php $itemcode = $package['package_one_code']; 
                            if(!empty($itemcode)) {
                                $item_get = "SELECT * FROM upti_items WHERE items_code = '$itemcode'";
                                $item_get_qry = mysqli_query($connect, $item_get);
                                $item_desc_get = mysqli_fetch_array($item_get_qry);
                                echo $item_desc_get['items_desc'];
                            } else {
                                echo 'Select Item Code';
                            }
                        ?>
                        </option>
                        <?php
                        $product_sql = "SELECT upti_code.code_name, upti_items.items_desc FROM upti_code INNER JOIN upti_items ON upti_items.items_code = upti_code.code_name WHERE code_status = 'Single'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>"><?php echo $product['items_desc']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="two_qty" autocomplete="off" value="<?php echo $package['package_two_qty']; ?>">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="two_code">
                        
                        <option value="<?php echo $package['package_two_code']; ?>">
                        
                        <?php $itemcode2 = $package['package_two_code']; 
                            if(!empty($itemcode2)) {
                                $item_get = "SELECT * FROM upti_items WHERE items_code = '$itemcode2'";
                                $item_get_qry = mysqli_query($connect, $item_get);
                                $item_desc_get = mysqli_fetch_array($item_get_qry);
                                echo $item_desc_get['items_desc'];
                            } else {
                                echo 'Select Item Code';
                            }
                        ?>
                        </option>
                        <?php
                        $product_sql = "SELECT upti_code.code_name, upti_items.items_desc FROM upti_code INNER JOIN upti_items ON upti_items.items_code = upti_code.code_name WHERE code_status = 'Single'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>"><?php echo $product['items_desc']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="three_qty" autocomplete="off" value="<?php echo $package['package_three_qty']; ?>">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="three_code">
                        
                        <option value="<?php echo $package['package_three_code']; ?>">
                      
                        <?php $itemcode3 = $package['package_three_code']; 
                            if(!empty($itemcode3)) {
                                $item_get = "SELECT * FROM upti_items WHERE items_code = '$itemcode3'";
                                $item_get_qry = mysqli_query($connect, $item_get);
                                $item_desc_get = mysqli_fetch_array($item_get_qry);
                                echo $item_desc_get['items_desc'];
                            } else {
                                echo 'Select Item Code';
                            }
                        ?>
                        </option>
                        <?php
                        $product_sql = "SELECT upti_code.code_name, upti_items.items_desc FROM upti_code INNER JOIN upti_items ON upti_items.items_code = upti_code.code_name WHERE code_status = 'Single'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>"><?php echo $product['items_desc']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="four_qty" autocomplete="off" value="<?php echo $package['package_four_qty']; ?>">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="four_code">
                        
                        <option value="<?php echo $package['package_four_code']; ?>">
                 
                        <?php $itemcode4 = $package['package_four_code']; 
                            if(!empty($itemcode4)) {
                                $item_get = "SELECT * FROM upti_items WHERE items_code = '$itemcode4'";
                                $item_get_qry = mysqli_query($connect, $item_get);
                                $item_desc_get = mysqli_fetch_array($item_get_qry);
                                echo $item_desc_get['items_desc'];
                            } else {
                                echo 'Select Item Code';
                            }
                        ?>
                        </option>
                        <?php
                        $product_sql = "SELECT upti_code.code_name, upti_items.items_desc FROM upti_code INNER JOIN upti_items ON upti_items.items_code = upti_code.code_name WHERE code_status = 'Single'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>"><?php echo $product['items_desc']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <br>
                    <input type="text" class="form-control" name="five_qty" autocomplete="off" value="<?php echo $package['package_five_qty']; ?>">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <br>
                    <select class="form-control select2bs4" style="width: 100%;" name="five_code">
                        
                        <option value="<?php echo $package['package_four_code']; ?>">
                    
                        <?php $itemcode5 = $package['package_five_code']; 
                            if(!empty($itemcode5)) {
                                $item_get = "SELECT * FROM upti_items WHERE items_code = '$itemcode5'";
                                $item_get_qry = mysqli_query($connect, $item_get);
                                $item_desc_get = mysqli_fetch_array($item_get_qry);
                                echo $item_desc_get['items_desc'];
                            } else {
                                echo 'Select Item Code';
                            }
                        ?>
                        </option>
                        <?php
                        $product_sql = "SELECT upti_code.code_name, upti_items.items_desc FROM upti_code INNER JOIN upti_items ON upti_items.items_code = upti_code.code_name WHERE code_status = 'Single'";
                        $product_qry = mysqli_query($connect, $product_sql);
                        while ($product = mysqli_fetch_array($product_qry)) {
                        ?>
                        <option value="<?php echo $product['code_name'] ?>"><?php echo $product['items_desc']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12"><hr></div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Exclusive For </label><i class="text-danger"> (Optional for single Reseller)</i>
                        <select class="form-control select2bs4" style="width: 100%;" name="exc">
                            <option value="<?php echo $package['package_exclusive']; ?>">
                                <?php 
                                
                                    if ($package['package_exclusive'] == '') {
                                        echo 'All Reseller'; 
                                    } else { 
                                        $name = $package['package_exclusive'];

                                        $get_name1 = "SELECT * FROM upti_users WHERE users_code = '$name'";
                                        $get_name_sql1 = mysqli_query($connect, $get_name1);
                                        $get_fetch = mysqli_fetch_array($get_name_sql1);

                                        echo $get_fetch['users_name'];
                                    } 
                                
                                ?>
                            </option>
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
        <button class="btn btn-primary rounded-0" name="package">Submit</button>
        </form>
        </div>
        
    </div>
    </div>
</div>