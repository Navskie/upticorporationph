<?php 
    include 'include/header.php';
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

        <form action="backend/add-products.php" method="post" enctype="multipart/form-data">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <img src="assets/images/main/default.jpg" alt="" width="100%" id="mainimg">
                    <br><br>
                    <div class="row">
                        <div class="col-4">
                            <img src="assets/images/main/default.jpg" alt="" width="100%" id="oneimg">
                        </div>
                        <div class="col-4">
                            <img src="assets/images/main/default.jpg" alt="" width="100%" id="twoimg">
                        </div>
                        <div class="col-4">
                            <img src="assets/images/main/default.jpg" alt="" width="100%" id="threeimg">
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
                        <textarea name="description" id="" cols="10" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Benefits</label>
                        <textarea name="benefits" id="" cols="10" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Ingredients</label>
                        <textarea name="ingredients" id="" cols="10" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">How to use</label>
                        <textarea name="howtouse" id="" cols="10" rows="3"></textarea>
                    </div>
                    <h4>Product Information</h4>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control rounded-0" name="p_name" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Points</label>
                                <input type="text" class="form-control rounded-0" name="p_points" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Status</label>
                                <select name="p_status" id="">
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="p_category" id="">
                                    <option value="">Select Category</option>
                                    <option value="RESELLER">RESELLER PACKAGE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Code</label>
                                <input type="text" class="form-control rounded-0" name="p_code" required id="code" AUTOCOMPLETE="off" placeholder="Type Code here">
                                <div class="codelist list-group">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Code Status</label>
                                <select name="tag" id="">
                                    <option value="">Select Status</option>
                                    <option value="All">All</option>
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
                                <div class="resellerlist list-group">
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
                                <option value="">Select Item</option>
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
                                <input type="text" name="b_qty" class="form-control rounded-0" autocomplete="off" placeholder="Input Quantity">
                            </div>
                        </div>

                        <!-- Bundle 2 -->
                        <div class="col-8">
                            <select name="b2_code" id="">
                                <option value="">Select Item</option>
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
                                <input type="text" name="b2_qty" class="form-control rounded-0" autocomplete="off" placeholder="Input Quantity">
                            </div>
                        </div>

                        <!-- Bundle 3 -->
                        <div class="col-8">
                            <select name="b3_code" id="">
                                <option value="">Select Item</option>
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
                                <input type="text" name="b3_qty" class="form-control rounded-0" autocomplete="off" placeholder="Input Quantity">
                            </div>
                        </div>

                        <!-- Bundle 4 -->
                        <div class="col-8">
                            <select name="b4_code" id="">
                                <option value="">Select Item</option>
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
                                <input type="text" name="b4_qty" class="form-control rounded-0" autocomplete="off" placeholder="Input Quantity">
                            </div>
                        </div>

                        <!-- Bundle 5 -->
                        <div class="col-8">
                            <select name="b5_code" id="">
                                <option value="">Select Item</option>
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
                                <input type="text" name="b5_qty" class="form-control rounded-0" autocomplete="off" placeholder="Input Quantity">
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <a href="javascript:void(0)" class="add-more btn btn-primary float-right">Add Price</a>
                    <h4>Product Price</h4>
                    
                    <hr>
                    
                    <div class="new-form">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <select name="country[]" id="">
                                        <option value="">Select Country</option>
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
                                    <label for="">Price</label>
                                    <input type="text" name="price[]" class="form-control rounded-0" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Earning</label>
                                    <input type="text" name="earn[]" class="form-control rounded-0" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Stockist</label>
                                    <input type="text" name="stockist[]" class="form-control rounded-0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn float-right" name="submit-product">SUBMIT</button>
                </div>
            </div>
            <!-- row -->
        </form>
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

    // AUTOCOMPLETE COUNTRY
    $(document).ready(function () {
        $('#code').keyup(function () {
            var query = $(this).val();
            // alert(query);
            if (query != '') {
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {query:query},
                    success: function(response) {
                        $('.codelist').fadeIn();
                        $('.codelist').html(response);
                    }
                });
            } else {
                $('.codelist').html('');
            }
        });
        $(document).on('click', 'li', function() {
            $("#code").val($(this).text());
            $(".codelist").html('');
        });
    });

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
                                                    <select name="country[]" id="">\
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
                                                        <input type="text" name="price[]" class="form-control rounded-0" required>\
                                                    </div>\
                                                </div>\
                                                <div class="col-2">\
                                                    <div class="form-group">\
                                                        <input type="text" name="earn[]" class="form-control rounded-0" required>\
                                                    </div>\
                                                </div>\
                                                <div class="col-2">\
                                                    <div class="form-group">\
                                                        <input type="text" name="stockist[]" class="form-control rounded-0" required>\
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