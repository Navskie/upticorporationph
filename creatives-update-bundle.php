<?php
    $code = $_GET['code'];
    include 'include/header.php';

    $items_stmt = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$code'");
    // echo mysqli_num_rows($items_stmt);
    $items = mysqli_fetch_array($items_stmt);
    if(mysqli_num_rows($items_stmt) > 0) {
        $name = $items['package_desc'];
        $status = $items['package_status'];
        $points = $items['package_points'];
        $category = $items['package_category'];

        $c1 = $items['package_one_code'];

        $get_name = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$c1'");
        $name_desc = mysqli_fetch_array($get_name);
        $d = $name_desc['items_desc'];

        $q1 = $items['package_one_qty'];

        $c2 = $items['package_two_code'];

        $get_name2 = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$c2'");
        $name_desc2 = mysqli_fetch_array($get_name2);
        $d2 = $name_desc2['items_desc'];

        $q2 = $items['package_two_qty'];

        $c3 = $items['package_three_code'];

        $get_name3 = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$c3'");
        $name_desc3 = mysqli_fetch_array($get_name3);
        $d3 = $name_desc3['items_desc'];

        $q3 = $items['package_three_qty'];

        $c4 = $items['package_four_code'];

        $get_name4 = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$c4'");
        $name_desc4 = mysqli_fetch_array($get_name4);
        $d4 = $name_desc4['items_desc'];

        $q4 = $items['package_four_qty'];

        $c5 = $items['package_five_code'];

        $get_name5 = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$c5'");
        $name_desc5 = mysqli_fetch_array($get_name5);
        $d5 = $name_desc5['items_desc'];

        $q5 = $items['package_five_qty'];

    } else {
        $name = '';
        $status = '';
        $points = '';
        $category = '';

        $c1 = '';
        $q1 = '';

        $c2 = '';
        $q2 = '';

        $c3 = '';
        $q3 = '';

        $c4 = '';
        $q4 = '';

        $c5 = '';
        $q5 = '';
    }

    $product_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$code'");
    $product = mysqli_fetch_array($product_stmt);
    if (mysqli_num_rows($product_stmt) > 0) {
        $main_img = $product['p_m_img'];
        $one_img = $product['p_1_img'];
        $two_img = $product['p_2_img'];
        $three_img = $product['p_3_img'];
        $p_desc = $product['p_desc'];
        $p_benefits = $product['p_benefits'];
        $p_ingredients = $product['p_ingredients'];
        $p_howtouse = $product['p_howtouse'];
        $p_tag = $product['p_tag'];
    } else {
        $main_img = '';
        $one_img = '';
        $two_img = '';
        $three_img = '';
        $p_desc = '';
        $p_benefits = '';
        $p_ingredients = '';
        $p_howtouse = '';
        $p_tag = '';
    }

    $code_stmt = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$code'");
    $code_fetch = mysqli_fetch_array($code_stmt);
?>

<!--Body Content-->
<div id="page-content">     

    <div class="container">
        <br>
        <!--Breadcrumb-->
        <div class="bredcrumbWrap" style="background: #fff !important; border-top: 2px solid #000; border-bottom: 2px solid #000">
            <div class="container breadcrumbs font-weight-bold">
                <div class="row text-center">
                    <div class="col-3">
                        <a href="#" class="text-danger">Manage Products</a>
                    </div>
                    <div class="col-3">
                        <a href="#">Manage Website</a>
                    </div>
                    <div class="col-3">
                        <a href="#">Manage Shipping</a>
                    </div>
                    <div class="col-3">
                        <a href="#">Manage Code</a>
                    </div>
                </div>
            </div>
        </div>
        <!--End Breadcrumb-->
        <!--Breadcrumb-->
        <div class="bredcrumbWrap">
            <div class="container breadcrumbs">
                <a href="creatives.php" title="Manage Products">Manage Product</a>
                <span aria-hidden="true">›</span><span><a href="creatives-add.php">Single Product</a></span>
                <span aria-hidden="true">›</span><span><a href="creatives-bundle.php" class="text-primary">Bundle Product</a></span>
            </div>
        </div>
        <!--End Breadcrumb-->

        <form action="backend/bundle-update.php?id=<?php echo $code ?>" method="post" enctype="multipart/form-data">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <?php if ($main_img == '') { ?>
                        <img src="assets/images/main/default.jpg" alt="" width="100%" id="mainimg">
                    <?php } else { ?>
                        <img src="assets/images/product/<?php echo $main_img ?>" alt="" width="100%" id="mainimg">
                    <?php } ?>
                    <br><br>
                    <div class="row">
                        <div class="col-4">
                        <?php if ($one_img == '') { ?>
                            <img src="assets/images/main/default.jpg" alt="" width="100%" id="oneimg">
                        <?php } else { ?>
                            <img src="assets/images/product/<?php echo $one_img ?>" alt="" width="100%" id="oneimg">
                        <?php } ?>
                        </div>
                        <div class="col-4">
                        <?php if ($two_img == '') { ?>
                            <img src="assets/images/main/default.jpg" alt="" width="100%" id="twoimg">
                        <?php } else { ?>
                            <img src="assets/images/product/<?php echo $two_img ?>" alt="" width="100%" id="twoimg">
                        <?php } ?>
                        </div>
                        <div class="col-4">
                        <?php if ($three_img == '') { ?>
                            <img src="assets/images/main/default.jpg" alt="" width="100%" id="threeimg">
                        <?php } else { ?>
                            <img src="assets/images/product/<?php echo $three_img ?>" alt="" width="100%" id="threeimg">
                        <?php } ?>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="">Main Image</label>
                        <input type="file" class="form-control rounded-0" name="main_image" id="mainupload">
                    </div>
                    <div class="form-group">
                        <label for="">Slide One Image</label>
                        <input type="file" class="form-control rounded-0" name="second_image" id="oneupload">
                    </div>
                    <div class="form-group">
                        <label for="">Slide Two Image</label>
                        <input type="file" class="form-control rounded-0" name="third_image" id="twoupload">
                    </div>
                    <div class="form-group">
                        <label for="">Slide Three Image</label>
                        <input type="file" class="form-control rounded-0" name="forth_image" id="threeupload">
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 col-lg-8">
                <h4>Product Details</h4>
                    <hr>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="10" rows="3"><?php echo $p_desc ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Benefits</label>
                        <textarea name="benefits" id="" cols="10" rows="3"><?php echo $p_benefits ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Ingredients</label>
                        <textarea name="ingredients" id="" cols="10" rows="3"><?php echo $p_ingredients ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">How to use</label>
                        <textarea name="howtouse" id="" cols="10" rows="3"><?php echo $p_howtouse ?></textarea>
                    </div>
                    <h4>Product Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control rounded-0" name="p_name" required autocomplete="off" value="<?php echo $name ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Points</label>
                                <input type="text" class="form-control rounded-0" name="p_points" required autocomplete="off" value="<?php echo $points ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Status</label>
                                <select name="p_status" id="">
                                    <option  value="<?php echo $status ?>"><?php echo $status ?></option>
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="p_category" id="">
                                    <option value="<?php echo $category ?>"><?php echo $category ?></option>
                                    <option value="RESELLER">RESELLER PACKAGE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Code</label>
                                <input type="text" class="form-control rounded-0" name="p_code" required id="code" AUTOCOMPLETE="off" placeholder="Type Code here" disabled  value="<?php echo $code ?>">
                                <div class="codelist list-group">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Code Tag</label>
                                <select name="tag" id="">
                                    <option value="<?php echo $p_tag ?>"><?php echo $p_tag ?></option>
                                    <option value="">Delete</option>
                                    <option value="Best Seller">Best Seller</option>
                                    <option value="Promo">Promo</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Membership">Membership</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label for="">Reseller Exclusive</label>
                                <input type="text" class="form-control rounded-0" name="p_reseller" placeholder="Optional" autocomplete="off" id="reseller">
                                <div class="resellerlist list-group">a
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <br>
                    <h4>Create Bundle</h4>
                    <div class="row">
                        <!-- Bundle 1 -->
                        <div class="col-8">
                            <select name="b_code" id="">
                                <option value="<?php echo $c1 ?>"><?php echo $d ?></option>
                                <?php
                                    $country_sql = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'");
                                    while($location = mysqli_fetch_array($country_sql)) {
                                ?>
                                    <option value="<?php echo $location['items_code'] ?>">[<?php echo $location['items_code'] ?>] - <?php echo $location['items_desc'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="b_qty" class="form-control rounded-0" autocomplete="off" value="<?php echo $q1 ?>">
                            </div>
                        </div>

                        <!-- Bundle 2 -->
                        <div class="col-8">
                            <select name="b2_code" id="">
                                <option value="<?php echo $c2 ?>"><?php echo $d2 ?></option>
                                <?php
                                    $country_sql = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'");
                                    while($location = mysqli_fetch_array($country_sql)) {
                                ?>
                                    <option value="<?php echo $location['items_code'] ?>">[<?php echo $location['items_code'] ?>] - <?php echo $location['items_desc'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="b2_qty" class="form-control rounded-0" autocomplete="off" value="<?php echo $q2 ?>">
                            </div>
                        </div>

                        <!-- Bundle 3 -->
                        <div class="col-8">
                            <select name="b3_code" id="">
                                <option value="<?php echo $c3 ?>"><?php echo $d3 ?></option>
                                <?php
                                    $country_sql = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'");
                                    while($location = mysqli_fetch_array($country_sql)) {
                                ?>
                                    <option value="<?php echo $location['items_code'] ?>">[<?php echo $location['items_code'] ?>] - <?php echo $location['items_desc'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="b3_qty" class="form-control rounded-0" autocomplete="off" value="<?php echo $q3 ?>">
                            </div>
                        </div>

                        <!-- Bundle 4 -->
                        <div class="col-8">
                            <select name="b4_code" id="">
                                <option value="<?php echo $c4 ?>"><?php echo $d4 ?></option>
                                <?php
                                    $country_sql = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'");
                                    while($location = mysqli_fetch_array($country_sql)) {
                                ?>
                                    <option value="<?php echo $location['items_code'] ?>">[<?php echo $location['items_code'] ?>] - <?php echo $location['items_desc'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="b4_qty" class="form-control rounded-0" autocomplete="off" value="<?php echo $q4 ?>">
                            </div>
                        </div>

                        <!-- Bundle 5 -->
                        <div class="col-8">
                            <select name="b5_code" id="">
                                <option value="<?php echo $c5 ?>"><?php echo $d5 ?></option>
                                <?php
                                    $country_sql = mysqli_query($connect, "SELECT * FROM upti_code INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE upti_code.code_status = 'Single' AND upti_code.code_name LIKE 'UP%'");
                                    while($location = mysqli_fetch_array($country_sql)) {
                                ?>
                                    <option value="<?php echo $location['items_code'] ?>">[<?php echo $location['items_code'] ?>] - <?php echo $location['items_desc'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="b5_qty" class="form-control rounded-0" autocomplete="off" value="<?php echo $q5 ?>">
                            </div>
                        </div>
                    </div>
                    
                    <br><br>
                    <hr>
                    <a href="javascript:void(0)" class="add-more btn btn-primary float-right">Add More Price</a>
                    <br><br>
                    
                    <div class="new-form">
                        <br>
                    </div>
                    <br><br>
                    <button class="btn float-right" name="update-bundle">Submit Update</button>
                    </form>
                    <br><br>
                    <hr>
                    <h4>Bundle Price</h4>
                    
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Country</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Price</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Earning</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Stockist</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Action</label>
                                </div>
                            </div>
                            <?php
                                $price_stmt = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$code'");
                                while ($presyo = mysqli_fetch_array($price_stmt)) {
                            ?>
                            <div class="col-4">
                                <form action="backend/price.php?price=<?php echo $presyo['id'] ?>" method="post">
                                <div class="form-group">
                                    <select name="country" id="">
                                        <option value="<?php echo $presyo['country_name'] ?>"><?php echo $presyo['country_name'] ?></option>
                                        <?php
                                            $country_sql = mysqli_query($connect, "SELECT * FROM upti_country_currency");
                                            while($location = mysqli_fetch_array($country_sql)) {
                                        ?>
                                            <option value="<?php echo $location['cc_country'] ?>"><?php echo $location['cc_country'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control rounded-0" required value="<?php echo $presyo['country_price'] ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" name="earn" class="form-control rounded-0" required value="<?php echo $presyo['country_total_php'] ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" name="stockist" class="form-control rounded-0" required value="<?php echo $presyo['country_stockist'] ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button class="form-control btn w-100" name="price_update">Update</button>
                                    </form>
                                </div>
                            </div> 
                            <?php
                                }
                            ?>
                        </div>
                    
                    <hr>
                </div>
            </div>
            <!-- row -->
    </div>
</div>
<!--End Body Content-->
    
<?php include 'include/footer.php'; ?>
<script src="jquery/jquery-3.6.0.min.js"></script>
<script>

    // IMAGE MAIN
    $(function(){
		$("#mainupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#mainimg").attr("src",x);
			console.log(event);
		});
	})
    // IMAGE 1
    $(function(){
		$("#oneupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#oneimg").attr("src",x);
			console.log(event);
		});
	})
    // IMAGE 2
    $(function(){
		$("#twoupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#twoimg").attr("src",x);
			console.log(event);
		});
	})
    // IMAGE 3
    $(function(){
		$("#threeupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#threeimg").attr("src",x);
			console.log(event);
		});
	})

    // SUCCESS TOASTR
    <?php if (isset($_SESSION['success'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success("<?php echo flash('success'); ?>");

    <?php } ?>

    // FAILED TOASTR
    <?php if (isset($_SESSION['failed'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error("<?php echo flash('failed'); ?>");

    <?php } ?>
// ADD MORE PRICE
$(document).ready(function (){
        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.main-form').remove();
        });

        $(document).on('click', '.add-more', function() {
            $('.new-form').append('<div class="main-form">\
                                            <div class="row text-center">\
                                                <div class="col-4">\
                                                    <div class="form-group">\
                                                    <select name="bansa[]" id="">\
                                                        <option value="">Select Country</option>\
                                                        <?php
                                                            $country_sql = mysqli_query($connect, "SELECT * FROM upti_country_currency");
                                                            while($location = mysqli_fetch_array($country_sql)) {
                                                        ?>
                                                            <option value="<?php echo $location['cc_country'] ?>"><?php echo $location['cc_country'] ?></option>\
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>\
                                                    </div>\
                                                </div>\
                                                <div class="col-2">\
                                                    <div class="form-group">\
                                                        <input type="text" name="presyo[]" class="form-control rounded-0" required>\
                                                    </div>\
                                                </div>\
                                                <div class="col-2">\
                                                    <div class="form-group">\
                                                        <input type="text" name="kita[]" class="form-control rounded-0" required>\
                                                    </div>\
                                                </div>\
                                                <div class="col-2">\
                                                    <div class="form-group">\
                                                        <input type="text" name="benta[]" class="form-control rounded-0" required>\
                                                    </div>\
                                                </div>\
                                                <div class="col-1">\
                                                    <div class="form-group">\
                                                        <button class="remove-btn btn btn-sm btn-danger form-control" style="background: red;">Trash</button>\
                                                    </div>\
                                                </div>\
                                            </div>\</div>');
        });
    });
</script>