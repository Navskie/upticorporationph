<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    if (isset($_POST['submit-product'])) {
        $p_code = $_POST['p_code'];
        $description = $_POST['description'];
        $benefits = $_POST['benefits'];
        $ingredients = $_POST['ingredients'];
        $howtouse = $_POST['howtouse'];

        $register_stmt = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name = '$p_code'");
        if (mysqli_num_rows($register_stmt) > 0) {
            $code_stmt = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$p_code'");
            if (mysqli_num_rows($code_stmt) == 0) {

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

                if (in_array($main_ex_lc, $allow_ex)) {
                    $main_name = $p_code.'First'.'.'.$main_ex_lc;
                    $img_path_sa_buhay_niya = '../assets/images/product/'.$main_name;
                    move_uploaded_file($maintmp, $img_path_sa_buhay_niya);
                }

                if (in_array($second_ex_lc, $allow_ex)) {
                    $second_name = $p_code.'Second'.'.'.$second_ex_lc;
                    $img_path_sa_buhay_niya = '../assets/images/product/'.$second_name;
                    move_uploaded_file($second_tmp, $img_path_sa_buhay_niya);
                }

                if (in_array($third_ex_lc, $allow_ex)) {
                    $third_name = $p_code.'Third'.'.'.$third_ex_lc;
                    $img_path_sa_buhay_niya = '../assets/images/product/'.$third_name;
                    move_uploaded_file($third_tmp, $img_path_sa_buhay_niya);
                }

                if (in_array($forth_ex_lc, $allow_ex)) {
                    $forth_name = $p_code.'Forth'.'.'.$forth_ex_lc;
                    $img_path_sa_buhay_niya = '../assets/images/product/'.$forth_name;
                    move_uploaded_file($forth_tmp, $img_path_sa_buhay_niya);
                }

                $product_sql = mysqli_query($connect, "
                    INSERT INTO upti_product (
                        p_code,
                        p_desc,
                        p_benefits,
                        p_ingridients,
                        p_howtouse,
                        p_m_img,
                        p_1_img,
                        p_2_img,
                        p_3_img
                    ) VALUES (
                        '$p_code',
                        '$description',
                        '$benefits',
                        '$ingredients',
                        '$howtouse',
                        '$main_name',
                        '$second_name',
                        '$third_name',
                        '$forth_name'
                    )
                ");

                $p_name = $_POST['p_name'];
                $p_points = $_POST['p_points'];
                $p_status = $_POST['p_status'];
                $p_category = $_POST['p_category'];
                // $p_reseller = $_POST['p_reseller'];

                $items_sql = mysqli_query($connect, "
                    INSERT INTO upti_items (
                        items_code,
                        items_desc,
                        items_points,
                        items_status,
                        items_category
                    ) VALUES (
                        '$p_code',
                        '$p_name',
                        '$p_points',
                        '$p_status',
                        '$p_category'
                    )
                ");

                $country = $_POST['country'];
                $price = $_POST['price'];
                $earn = $_POST['earn'];
                $stockist = $_POST['stockist'];

                foreach ($country as $index => $bansa) {
                    $_country = $bansa;
                    $_price = $price[$index];
                    $_earn = $earn[$index];
                    $_stockist = $stockist[$index];
                    // echo '<br>';

                    $price_sql = mysqli_query($connect, "INSERT INTO upti_country (
                        country_code,
                        country_name,
                        country_total_php,
                        country_price,
                        country_stockist
                    ) VALUES (
                        '$p_code',
                        '$_country',
                        '$_earn',
                        '$_price',
                        '$_stockist'
                    )
                    ");
                }
                flash("success", "Item has been added successfully");
                header('location: ../creatives.php');
            } else {
                flash("failed", "Failed to add product, Item Code already exist!");
                header('location: ../creatives-add.php');
            }
        } else {
            flash("failed", "Failed to add product, Item Code not yet registered");
            header('location: ../creatives-add.php');
        }   
    }
?>