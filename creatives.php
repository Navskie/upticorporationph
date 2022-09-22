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
                        <a href="creatives.php" class="text-danger">Manage Products</a>
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
                <a href="creatives.php" title="Manage Products" class="text-primary">Product List</a>
                <span aria-hidden="true">›</span><span><a href="creatives-add.php">Single Product</a></span>
                <span aria-hidden="true">›</span><span><a href="creatives-bundle.php">Bundle Product</a></span>
                <span aria-hidden="true">›</span><span><a href="logout.php">Logout</a></span>
            </div>
        </div>
        <!--End Breadcrumb-->
        <?php
            $rpp = 12;

            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
    
            $start_from = ($page-1)*$rpp;

            if (isset($_POST['search'])) {
                $item_code = $_POST['itemcode'];

                $code_stmt = "SELECT code_name, items_desc, items_status FROM upti_code
                INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code WHERE items_code LIKE '%".$item_code."%'
                UNION
                SELECT code_name, package_desc, package_status FROM upti_code
                INNER JOIN upti_package ON upti_code.code_name = upti_package.package_code WHERE package_code LIKE '%".$item_code."%'
                ORDER BY code_name DESC";
            } else {
                $code_stmt = "SELECT code_name, items_desc, items_status FROM upti_code
                INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code
                UNION
                SELECT code_name, package_desc, package_status FROM upti_code
                INNER JOIN upti_package ON upti_code.code_name = upti_package.package_code
                ORDER BY code_name DESC  LIMIT $start_from, $rpp";
            }
        ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7"></div>
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="row">
                    <div class="col-8">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Search Name" name="itemcode" class="form-control rounded-0 w-100" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-dark form-control w-100" name="search">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
                
                $code_qry = mysqli_query($connect, $code_stmt);
                while ($code = mysqli_fetch_array($code_qry)) {
                    $p_code = $code['code_name'];
                    $p_desc = $code['items_desc'];
                    $p_status = $code['items_status'];

                    $img_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$p_code'");
                    $img_show = mysqli_fetch_array($img_stmt);
                    if (mysqli_num_rows($img_stmt) == 0) {
                        $main = '';
                    } else {
                        $main = $img_show['p_m_img'];
                    }
            ?>
            <!-- Loop Start -->
            <div class="col-sm-12 col-md-3 col-lg-3 p-3">                
                <div class="cart-img">
                    <?php
                        if ($main == '') {
                    ?>
                        <img src="assets\images\main\default.jpg">
                    <?php
                        } else {
                    ?>
                        <img src="assets/images/product/<?php echo $main ?>" alt="" width="100%" class="pt-2">
                    <?php
                        }
                    ?>
                </div>
                <!-- end product image -->

                <!--start product details -->
                <div class="product-details text-center item">
                    <!-- product name -->
                    <div class="product-name">
                        <span class="product-name" style="font-size: 14px;"><?php echo $p_desc; ?></span>
                    </div>
                    <!-- End product name -->
                </div>
                <a href="backend/creative-redirect.php?id=<?php echo $p_code ?>" class="btn btn-custom w-100" tabindex="0">Manage -> <?php echo $p_code ?></a>
                <!-- End product details -->
                <br>
            </div>
            <!-- Loop End -->
            <?php } ?>
            
        </div>
        <?php
            $page_info = "SELECT code_name, items_desc, items_status FROM upti_code
            INNER JOIN upti_items ON upti_code.code_name = upti_items.items_code
            WHERE code_category = 'PROMO'
            UNION
            SELECT code_name, package_desc, package_status FROM upti_code
            INNER JOIN upti_package ON upti_code.code_name = upti_package.package_code
            WHERE code_category = 'PROMO'";
            $page_query = mysqli_query($connect, $page_info);
            $page_num = mysqli_num_rows($page_query);

            $tot_pages = ceil($page_num / $rpp);
        ?>
        <br><br>
        <nav class="page navigation" aria-label="...">
            <ul class="pagination">
                <?php
                    for ($loop = 1; $loop <= $tot_pages; $loop++) {
                ?>
                <li class="page-item"><a class="page-link" href="creatives.php?page=<?php echo $loop; ?>"><?php echo $loop; ?></a></li>
                <?php 
                    }
                ?>
            </ul>
        </nav>
    </div>
</div>
<!--End Body Content-->
    
<?php include 'include/footer.php'; ?>
<script src="jquery/jquery-3.6.0.min.js"></script>
<script>
    // PAGINATION
    function fetch_data(page) {
        $.ajax({
            url: "backend/pagination.php",
            method: "POST",
            data: {
                page:page
            }
            success: function(page){
                $("#get_data").html(data);
            }
        });
    }
    fetch_data();

    $(document).on("click", ".page-item", function() {
        var page = $(this).attr("id");
        fetch_data(page);
    });

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
    
</script>