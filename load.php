<?php 
    include 'include/db.php';

    $limit = 20;
    $page = 1;

    if ($_POST['page'] > 1)
    {
        $start = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
    }
    else
    {
        $start = 0;
    }

    $query = "SELECT items_code, items_desc FROM upti_items UNION SELECT package_code, package_desc FROM upti_package";

    if ($_POST['query'] != '') {
        $query .= 'WHERE items_desc LIKE "%'.str_replace(' ', '%', '$_POST["query"]').'%"';
    }

    $query .= 'ORDER BY id DESC';

    $filter_query = $query . 'LIMIT' . $start . ', '.$limit.'';

    $statement = mysqli_query($connect, $query);
    $statement_fetch = mysqli_fetch_array($statement);

    $total_data = mysqli_num_rows($statement);

    $statements = mysqli_query($connect, $filter_query);
    $statements_fetch = mysqli_fetch_array($statements);

    if ($total_data > 0) {
        while ($row = mysqli_fetch_array($statement)) {
            $d_item_code = $d_item_fetch['items_code'];

            $d_item_price = "SELECT * FROM upti_country WHERE country_name = 'PHILIPPINES' AND country_code = '$d_item_code'";
            $d_item_price_sql = mysqli_query($connect, $d_item_price);
            $d_item_price_fetch = mysqli_fetch_array($d_item_price_sql);

            $prod_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$d_item_code'");
            $get_img = mysqli_fetch_array($prod_stmt);

            if (mysqli_num_rows($prod_stmt) > 0) {
                $images = $get_img['p_m_img'];
            } else {
                $images = '';
            }
            $output .= '
            <div class="col-12">
                <!-- start product image -->
                <span class="whislist"><a href="#" class="dis"><i class="fa-thin fa-heart"></i></a></span>
                <span class="discount"><i class="fa fa-medal medds"></i></span>
                
                <div class="cart-img">
                    
                       '. if ($images == '') {.'
                    
                        <img src="assets\images\main\default.jpg">
                    
                        '.} else {.'
                    
                        <img src="assets\images\product\<?php echo $images ?>">
                    
                       '. }.'
                    
                </div>
                <!-- end product image -->

                <!--start product details -->
                <div class="product-details text-center item">
                    <!-- product name -->
                    <div class="product-name">
                        <a href="details.php" class="product-name" style="font-size: 14px;">'. echo $d_item_fetch['items_desc']; .'</a>
                    </div>
                    <!-- End product name -->
                </div>
                <form action="#" onclick="window.location.href='cart.php'"method="post" class="item">
                    <button class="btn btn-custom w-100" type="button" tabindex="0">ADD TO CART - Php'. $price = $d_item_price_fetch['country_price']; echo number_format($price); .'</button>
                </form>
                <!-- End product details -->
                <br>
            </div>
            ';
        }
    }
    else 
    {
        $output = '
        <div class="text-center">No Data Found</div>
        ';
    }
    
    $output .= '
        <div align="center"">
            <ul class="pagination">

            </ul>
        </div>
    ';

    $total_links = ceil($total_data/$limit);

    $prev = '';
    $next = '';
    $page_link = '';

    if ($total_links > 19) {
        if ($page < 5) {
            for($count = 1; $count < 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        }
        else 
        {
            $end_limit = $total_links - 5;
             if ($page > $end_limit) 
             {
                $page_array[] = 1;
                $page_array[] = '...';

                for($count = $end_limit; $count <= $total_links; $count++)
                {
                    $page_array[] = $count;
                }
             }
             else
             {
                $page_array[] = 1;
                $page_array[] = '...';

                for($count = $page -1; $count <= $page + 1; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
             }
        }
    }
    else
    {
        for($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++)
    {
        if ($page == $page_array['$count'])
        {
            $page_link .= '
                <li class="page-item active">
                    <a class="page-link" href="#">
                        '.$page_array[$count].' <span class="sr-only"></span>
                    </a>
                </li>
            ';

            $prev_id = $page_array[$count] - 1;

            if ($prev_id > 0)
            {
                $prev = '
                    <li class="page-item ">
                        <a class="page-link" href="javascript:void(0)" data-page_number="'.$prev_id.'">Previous</a>
                    </li>
                ';
            }
            else 
            {
                $prev = '
                    <li class="page-item disabled">
                        <a class="page-link" href="#" >Previous</a>
                    </li>
                ';
            }

            $next_id = $page_array[$count] + 1;

            if ($next_id >= $total_links) 
            {
                $next = '
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                ';
            }
            else
            {
                $next = '
                    <li class="page-item ">
                        <a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Previous</a>
                    </li>
                ';
            }
        }
        else
        {
            if ($page_array[$count] == '...') {
                $page_link .= '
                    <li class="page-item disabled">
                        <a class="page-link" href="#">...</a>
                    </li>
                ';
            }
            else 
            {
                $page_link .= '
                    <li class="page-item">
                        <a class="page-link" href="javascript(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a>
                    </li>
                ';
            }
        }
    }

    $output .= $prev . $page_link . $next;

    echo $output;

?>