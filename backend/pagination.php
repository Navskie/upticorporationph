<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    // fetching data
    $limit = 10;
    $page = 0;
    $output = '';
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $limit;

    $code_stmt = mysqli_query($connect, "SELECT code_name, code_category, code_status, code_exclusive FROM upti_code ORDER BY id DESC LIMIT $start_from, $limit");
    while ($code = mysqli_fetch_array($code_stmt)) {
        $p_code = $code['code_name'];
        $single_stmt = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$p_code'");
        $single_fetch = mysqli_fetch_array($single_stmt);

        if (mysqli_num_rows($single_stmt) == 0) {
            $package_stmt = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$p_code'");
            $package_fetch = mysqli_fetch_array($package_stmt);

            $p_desc = $package_fetch['package_desc'];
            $p_status = $package_fetch['package_status'];
        } else {
            $p_desc = $single_fetch['items_desc'];
            $p_status = $single_fetch['items_status'];
        }
        
        $output .= '
        <div class="col-sm-12 col-md-6 col-lg-6 p-3">
            <div class="row mx-2" style="border: 1px solid #cfd2fc;">
                <div class="col-sm-12 col-md-4 col-lg-4" style="border-right: 1px solid #cfd2fc;">
                    <img src="assets/images/main/default.jpg" alt="" width="100%">
                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-12 pb-2 text-center">
                            <span class=""><span class="badge badge-danger">'. echo $code['code_status']; .'</span> <span class="badge badge-info">'. echo $code['code_name']; .'</span></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-12">
                            <h6><b>'. echo $p_desc; .'</b>
                            '. if ($p_status == 'Active') { .'
                            <span class="float-right badge badge-success mr-2">ACTIVE</span></h6>
                            '. } else { .'
                            <span class="float-right badge badge-danger mr-2">DEACTIVE</span></h6>
                            '. } .'
                        </div>
                        <div class="col-12 pb-2">
                            '. if ($code['code_exclusive'] != '') { .'
                            <span class="badge badge-primary">Exclusive for '. echo $code['code_exclusive']; .'</span>
                            '. } .'
                            <span class="badge badge-primary">'. echo $code['code_category']; .'</span>
                        </div>
                        <!-- Prices Loop Start -->
                        '.
                            $price_stmt = mysqli_query($connect, "SELECT country_price, country_name FROM upti_country WHERE country_code = '$p_code'");
                            while ($prices = mysqli_fetch_array($price_stmt)) {
                                $country_price = $prices['country_price'];
                                $country_name = $prices['country_name'];

                                $sign_stmt = mysqli_query($connect, "SELECT cc_sign FROM upti_country_currency WHERE cc_country = '$country_name'");
                                $sign_fetch = mysqli_fetch_array($sign_stmt);

                        .'
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <span style="font-size: 17px;"><b>'. echo $sign_fetch['cc_sign'] .'</b> <p class="float-right">'. echo number_format($country_price, '2'); .'</p></span>
                        </div>
                        '. } .'
                        <!-- Price Loop End -->
                    </div>
                </div>
            </div>
        </div>
        ';
    } else {
        $output .= '<h4 class="text-center">No Data Found!</h4>'
    }

    // Pagination
    $pagination_stmt = mysqli_query($connect, "SELECT code_name, code_category, code_status, code_exclusive FROM upti_code");
    $total_records = mysqli_num_rows($pagination_stmt);
    $total_pages = ceil($total_records/$limit);
    $output .= '
        <ul class="pagination">
    ';

    if ($page > 1) {
        $previous = $page - 1;
        $output .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
        $output .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
    }

    for ($i=1; $i<=$total_pages; $i++) {
        $active_class = '';
        if ($i == $page) {
            $active_class = "active";
        }
        $output .= '<li class="page-item '.$active_class.'" id="'.$i.'"><span class="page-link">'.$i.'</span></li>';
    }

    if ($page < $total_pages) {
        $page++;
        $output .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';
        $output .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
    }

    $output .= '</ul>';

    echo $output;
?>