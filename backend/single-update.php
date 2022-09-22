<?php
    $code = $_GET['id'];
    session_start();
    include '../include/db.php';
    include '../function.php';

    if (isset($_POST['update-product'])) {
        $description = $_POST['description'];
        $benefits = $_POST['benefits'];
        $ingredients = $_POST['ingredients'];
        $howtouse = $_POST['howtouse'];
        $tag = $_POST['tag'];

        // main Image
        $main_file = $_FILES['main_image']['name'];
        $mainsize = $_FILES['main_image']['size'];
        $maintmp = $_FILES['main_image']['tmp_name'];
        $mainex = pathinfo($main_file, PATHINFO_EXTENSION);
        $main_ex_lc = strtolower($mainex);
        // 2nd Image
        $second_file = $_FILES['second_image']['name'];
        $second_size = $_FILES['second_image']['size'];
        $second_tmp = $_FILES['second_image']['tmp_name'];
        $second_ex = pathinfo($second_file, PATHINFO_EXTENSION);
        $second_ex_lc = strtolower($second_ex);
        // 3rd Image
        $third_file = $_FILES['third_image']['name'];
        $third_size = $_FILES['third_image']['size'];
        $third_tmp = $_FILES['third_image']['tmp_name'];
        $third_ex = pathinfo($third_file, PATHINFO_EXTENSION);
        $third_ex_lc = strtolower($third_ex);
        // 4th Image
        $forth_file = $_FILES['forth_image']['name'];
        $forth_size = $_FILES['forth_image']['size'];
        $forth_tmp = $_FILES['forth_image']['tmp_name'];
        $forth_ex = pathinfo($forth_file, PATHINFO_EXTENSION);
        $forth_ex_lc = strtolower($forth_ex);

        $allow_ex = array("jpg", "jpeg", "png", "gif", "webp");

        $product_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$code'");
        $product_fetch = mysqli_fetch_array($product_stmt);

        if ($main_file != '') {
            if (in_array($main_ex_lc, $allow_ex)) {
                $main_name = $code.'-'.uniqid().'-'.'.'.$main_ex_lc;
                $img_path_sa_buhay_niya = '../assets/images/product/'.$main_name;
                move_uploaded_file($maintmp, $img_path_sa_buhay_niya);
            }
        } else {
            $main_name = $product_fetch['p_m_img'];
        }

        if ($second_file != '') {
            if (in_array($second_ex_lc, $allow_ex)) {
                $second_name = $code.'-'.uniqid().'-'.'.'.$second_ex_lc;
                $img_path_sa_buhay_niya = '../assets/images/product/'.$second_name;
                move_uploaded_file($second_tmp, $img_path_sa_buhay_niya);
            }
        } else {
            $second_name = $product_fetch['p_1_img'];
        }

        if ($third_file != '') {
            if (in_array($third_ex_lc, $allow_ex)) {
                $third_name = $code.'-'.uniqid().'-'.'.'.$third_ex_lc;
                $img_path_sa_buhay_niya = '../assets/images/product/'.$third_name;
                move_uploaded_file($third_tmp, $img_path_sa_buhay_niya);
            }
        } else {
            $third_name = $product_fetch['p_2_img'];
        }

        if ($forth_file != '') {
            if (in_array($forth_ex_lc, $allow_ex)) {
                $forth_name = $code.'-'.uniqid().'-'.'.'.$forth_ex_lc;
                $img_path_sa_buhay_niya = '../assets/images/product/'.$forth_name;
                move_uploaded_file($forth_tmp, $img_path_sa_buhay_niya);
            }
        } else {
            $forth_name = $product_fetch['p_3_img'];
        }

        $check_pro_stmt = mysqli_query($connect, "SELECT * FROM upti_product WHERE p_code = '$code'");
        if (mysqli_num_rows($check_pro_stmt) > 0) {
            echo $product_sql = "
            UPDATE upti_product SET
            p_desc = '$description',
            p_benefits = '$benefits',
            p_ingredients = '$ingredients',
            p_howtouse = '$howtouse',
            p_tag = '$tag',
            p_m_img = '$main_name',
            p_1_img = '$second_name',
            p_2_img = '$third_name',
            p_3_img = '$forth_name' WHERE p_code = '$code'";
            mysqli_query($connect, $product_sql);
        } else {
            echo $product_sql = "
                INSERT INTO upti_product (
                    p_code,
                    p_desc,
                    p_benefits,
                    p_ingredients,
                    p_howtouse,
                    p_tag,
                    p_m_img,
                    p_1_img,
                    p_2_img,
                    p_3_img
                ) VALUES (
                    '$code',
                    '$description',
                    '$benefits',
                    '$ingredients',
                    '$howtouse',
                    '$tag',
                    '$main_name',
                    '$second_name',
                    '$third_name',
                    '$forth_name'
                )
            ";
            mysqli_query($connect, $product_sql);
        }

        $p_name = $_POST['p_name'];
        $p_points = $_POST['p_points'];
        $p_status = $_POST['p_status'];
        $p_category = $_POST['p_category'];
        // $p_reseller = $_POST['p_reseller'];
        // echo '<br>';
        $check_items = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$code'");
        if (mysqli_num_rows($check_items) > 0) {
            $items_sql = "
            UPDATE upti_items SET 
                items_desc = '$p_name',
                items_points = '$p_points',
                items_status = '$p_status',
                items_category = '$p_category'
            WHERE items_code = '$code';
            ";
            mysqli_query($connect, $items_sql);
        } else {
            $items_sql = mysqli_query($connect, "
                INSERT INTO upti_items (
                    items_code,
                    items_desc,
                    items_points,
                    items_status,
                    items_category
                ) VALUES (
                    '$code',
                    '$p_name',
                    '$p_points',
                    '$p_status',
                    '$p_category',
                )
            ");
        }
        $country = $_POST['bansa'];
        $price = $_POST['presyo'];
        $earn = $_POST['kita'];
        $stockist = $_POST['benta'];

        foreach ($country as $index => $bansa) {
            $_country = $bansa;
            $_price = $price[$index];
            $_earn = $earn[$index];
            $_stockist = $stockist[$index];

            $price_sql = mysqli_query($connect, "INSERT INTO upti_country (
                country_code,
                country_name,
                country_total_php,
                country_price,
                country_stockist
            ) VALUES (
                '$code',
                '$_country',
                '$_earn',
                '$_price',
                '$_stockist'
            )
            ");
        }
        flash("success", "Item has been updated successfully");
        header('location: ../creatives-update.php?code='.$code.'');
    }

?>