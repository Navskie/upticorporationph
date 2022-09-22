<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $id = $_SESSION['uid'];
    $user_info = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_id = '$id'");
    $fetch_count = mysqli_fetch_array($user_info);
    $user_count = $fetch_count['users_count'];
    $ref = 'CS'.$id.'-22'.$user_count;

    if (isset($_POST['addtocart'])) {
        $profile = $_SESSION['code'];
        $item_code = $_GET['code'];
        
        $check_cart = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_code = '$item_code' AND cart_ref = '$ref'");
        $check_cart_fetch = mysqli_fetch_array($check_cart);
        if (mysqli_num_rows($check_cart) == 0) {
            $single = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$item_code'");
            $single_fetch = mysqli_fetch_array($single);
            if (mysqli_num_rows($single) > 0) {
                $description = $single_fetch['items_desc'];

                // check price
                $check_price = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'");
                $price_fetch = mysqli_fetch_array($check_price);

                $price = $price_fetch['country_price'];
                $earn = $price_fetch['country_total_php'];

                $add_cart = mysqli_query($connect, "INSERT INTO web_cart (
                    cart_id,
                    cart_ref,
                    cart_country,
                    cart_code,
                    cart_desc,
                    cart_qty,
                    cart_price,
                    cart_subtotal,
                    cart_earn,
                    cart_status
                ) VALUES (
                    '$profile',
                    '$ref',
                    '$customer_country',
                    '$item_code',
                    '$description',
                    '1',
                    '$price',
                    '$price',
                    '$earn',
                    'On Cart'
                )");

                header('location: ../shop.php');

            } else {
                $package = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$item_code'");
                $pack = mysqli_fetch_array($package);

                $pack_decs = $pack['package_desc'];

                // check price
                $check_price = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'");
                $price_fetch = mysqli_fetch_array($check_price);

                $price = $price_fetch['country_price'];
                $earn = $price_fetch['country_total_php'];

                $add_cart = mysqli_query($connect, "INSERT INTO web_cart (
                    cart_id,
                    cart_ref,
                    cart_country,
                    cart_code,
                    cart_desc,
                    cart_qty,
                    cart_price,
                    cart_subtotal,
                    cart_earn,
                    cart_status
                ) VALUES (
                    '$profile',
                    '$ref',
                    '$customer_country',
                    '$item_code',
                    '$pack_decs',
                    '1',
                    '$price',
                    '$price',
                    '$earn',
                    'On Cart'
                )");

                header('location: ../shop.php');
            }
        } else {
            $cart_list = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_code = '$item_code' AND cart_ref = '$ref'");
            $cart_fetch = mysqli_fetch_array($cart_list);
            $real_qty = $cart_fetch['cart_qty'];
            $real_price = $cart_fetch['cart_price'];
            $new_qty = $real_qty + 1;
            $new_subtotal = $real_price * $new_qty;
            $update_cart = mysqli_query($connect, "UPDATE web_cart SET cart_qty = '$new_qty', cart_subtotal = '$new_subtotal' WHERE cart_code = '$item_code' AND cart_ref = '$ref'");

            header('location: ../shop.php');
        }
    }

    if (isset($_POST['details'])) {
        $item_code = $_GET['code'];
        $profile = $_SESSION['code'];
        $qty = $_POST['qty'];
        
        $check_cart = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_code = '$item_code' AND cart_ref = '$ref'");
        $check_cart_fetch = mysqli_fetch_array($check_cart);
        if (mysqli_num_rows($check_cart) == 0) {
            $single = mysqli_query($connect, "SELECT * FROM upti_items WHERE items_code = '$item_code'");
            $single_fetch = mysqli_fetch_array($single);
            if (mysqli_num_rows($single) > 0) {
                $description = $single_fetch['items_desc'];

                // check price
                $check_price = mysqli_query($connect, "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'");
                $price_fetch = mysqli_fetch_array($check_price);

                $price = $price_fetch['country_price'];
                $earn = $price_fetch['country_total_php'];

                $add_cart = mysqli_query($connect, "INSERT INTO web_cart (
                    cart_id,
                    cart_ref,
                    cart_country,
                    cart_code,
                    cart_desc,
                    cart_qty,
                    cart_price,
                    cart_subtotal,
                    cart_earn,
                    cart_status
                ) VALUES (
                    '$profile',
                    '$ref',
                    '$customer_country',
                    '$item_code',
                    '$description',
                    '$qty',
                    '$price',
                    '$price',
                    '$earn',
                    'On Cart'
                )");

                header('location: ../shop.php');

            } else {
                $package = mysqli_query($connect, "SELECT * FROM upti_package WHERE package_code = '$item_code'");
            }
        } else {
            $cart_list = mysqli_query($connect, "SELECT * FROM web_cart WHERE cart_code = '$item_code' AND cart_ref = '$ref'");
            $cart_fetch = mysqli_fetch_array($cart_list);
            $real_qty = $cart_fetch['cart_qty'];
            $real_price = $cart_fetch['cart_price'];
            $new_qty = $real_qty + $qty;
            $new_subtotal = $real_price * $new_qty;
            $update_cart = mysqli_query($connect, "UPDATE web_cart SET cart_qty = '$new_qty', cart_subtotal = '$new_subtotal' WHERE cart_code = '$item_code' AND cart_ref = '$ref'");

            header('location: ../shop.php');
        }

    }
?>