<?php
    session_start();
    include 'function.php';
    include 'dbms/conn.php';

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');

    $Uid = $_SESSION['uid'];
    $Urole = $_SESSION['role'];
    $Ucode = $_SESSION['code'];
    $Ureseller = $_SESSION['code'];

    $count_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);
 
    $Ucount = $count_fetch['users_count'];

    if($Urole == 'UPTIOSR') {
        $upline_sql = "SELECT * FROM upti_users WHERE users_code = '$Ucode'";
        $upline_qry = mysqli_query($connect, $upline_sql);
        $upline_fetch = mysqli_fetch_array($upline_qry);

        $Ucode = $upline_fetch['users_code'];
        $Ureseller = $upline_fetch['users_main'];
        $Ucount = $upline_fetch['users_count'];
    }
    // Get Users Code & Users Upline Code

    $poid = 'PD'.$Uid.'-'.$Ucount;
    // Poid Number / Reference Number

    $get_country = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
    $get_country_qry = mysqli_query($connect, $get_country);
    $get_country_fetch = mysqli_fetch_array($get_country_qry);

    $customer_country = $get_country_fetch['trans_country'];

    if ($customer_country == 'OMAN') {
        $customer_country = 'UNITED ARAB EMIRATES';
    } elseif ($customer_country == 'KUWAIT') {
        $customer_country = 'UNITED ARAB EMIRATES';
    } elseif ($customer_country == 'QATAR') {
        $customer_country = 'UNITED ARAB EMIRATES';
    } elseif ($customer_country == 'BAHRAIN') {
        $customer_country = 'UNITED ARAB EMIRATES';
    }

    if(isset($_POST['get_free2'])) {
        $item_code = $_POST['free2'];

        $check_boga_sql = "SELECT * FROM upti_code WHERE code_name = '$item_code' AND code_category = 'FREE TWO'";
        $check_boga_qrys = mysqli_query($connect, $check_boga_sql);
        $check_boga_num = mysqli_num_rows($check_boga_qrys);
        $check_boga_fetch = mysqli_fetch_array($check_boga_qrys);

        // check stocks
        $maincode = $check_boga_fetch['code_main'];

        $get_inventory = mysqli_query($connect, "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$maincode'");
        $inventory = mysqli_fetch_array($get_inventory);

        $stocks = $inventory['si_item_stock'];

        if ($stocks > 0) {

            if ($check_boga_num >= 1) {
            $get_free_count = "SELECT * FROM upti_free_2 WHERE f2_poid = '$poid'";
            $get_free_count_sql = mysqli_query($connect, $get_free_count);
            $get_free_count_fetch = mysqli_fetch_array($get_free_count_sql);
            
            $number_of_free = $get_free_count_fetch['f2_number'];
            
                if ($number_of_free == 1) {
                    $delete1 = "DELETE FROM upti_free_2 WHERE f2_poid = '$poid'";
                    $delete_qry1 = mysqli_query($connect, $delete1);
                } else {
                    $new_number = $number_of_free - 1;
                    $update_free = "UPDATE upti_free_2 SET f2_number = '$new_number' WHERE f2_poid = '$poid'";
                    $update_free_sql = mysqli_query($connect, $update_free);
                }
            
            }

                // Get Item Code Information
                $check_package = "SELECT * FROM upti_package WHERE package_code = '$item_code'";
                $check_package_qry = mysqli_query($connect, $check_package);
                $check_package_fetch = mysqli_fetch_array($check_package_qry);
                $check_package_num = mysqli_num_rows($check_package_qry);
        
                if($check_package_num < 1) {
                    $check_item = "SELECT * FROM upti_items WHERE items_code = '$item_code'";
                    $check_item_qry = mysqli_query($connect, $check_item);
                    $check_item_fetch = mysqli_fetch_array($check_item_qry);
                    $check_item_num = mysqli_num_rows($check_item_qry);
        
                    $description = $check_item_fetch['items_desc'];
                    $points = $check_item_fetch['items_points'];
                } else {
                    $description = $check_package_fetch['package_desc'];
                    $points = $check_package_fetch['package_points'];
                }
        
                // Change Country if National into Philippines
                if ($customer_country == 'INTERNATIONAL') {
                    $customer_country = 'PHILIPPINES';
                }
        
                // Get Country Price
                $get_price = "SELECT * FROM upti_country WHERE country_code = '$item_code' AND country_name = '$customer_country'";
                $get_price_qry = mysqli_query($connect, $get_price);
                $get_price_fetch = mysqli_fetch_array($get_price_qry);
        
                $philippines = 0;
                $c_price = $get_price_fetch['country_price'];
                $total_c_price = 1 * $c_price;
        
                $insert_order = "INSERT INTO upti_order_list (
                    ol_country,
                    ol_poid,
                    ol_code,
                    ol_seller,
                    ol_reseller,
                    ol_admin,
                    ol_desc,
                    ol_price,
                    ol_php,
                    ol_qty,
                    ol_points,
                    ol_subtotal,
                    ol_status,
                    ol_date
                ) VALUES (
                    '$customer_country',
                    '$poid',
                    '$item_code',
                    '$Ucode',
                    '$Ureseller',
                    'UPTIMAIN',
                    '$description',
                    '$c_price',
                    '$philippines',
                    '1',
                    '$points',
                    '$total_c_price',
                    'Pending',
                    '$date_today'
                )";
                $upline_qry = mysqli_query($connect, $insert_order);
        
                flash("success", "Item has been added successfully");
                header('location: order-list.php');
            } else {
                flash("warning", "Insufficient Stocks!");
                header('location: order-list.php');
            }
        }
?>