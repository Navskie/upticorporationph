<?php

    include '../dbms/conn.php';
    include '../function.php';

    session_start();

    $id = $_GET['id'];

    $uid = $_SESSION['uid'];
    date_default_timezone_set('Asia/Manila');
    $time = date("h:m:i");
    $datenow = date('m-d-Y');
    
    $get_poid = "SELECT * FROM upti_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);
    
    $poid = $get_poid_fetch['trans_poid'];

    // loop the order list item 
    $get_stocks = "SELECT * FROM upti_order_list WHERE ol_poid = '$poid'";
    $get_stocks_qry = mysqli_query($connect, $get_stocks);
    while($get_stocks_fetch = mysqli_fetch_array($get_stocks_qry)) {
        $ol_code = $get_stocks_fetch['ol_code'];
        $ol_desc = $get_stocks_fetch['ol_desc'];
        $ol_qty = $get_stocks_fetch['ol_qty'];
        $ol_country = $get_stocks_fetch['ol_country'];

        
        if ($ol_country == 'OMAN') {
            $ol_country = 'UNITED ARAB EMIRATES';
        } elseif ($ol_country == 'KUWAIT') {
            $ol_country = 'UNITED ARAB EMIRATES';
        } elseif ($ol_country == 'QATAR') {
            $ol_country = 'UNITED ARAB EMIRATES';
        } elseif ($ol_country == 'BAHRAIN') {
            $ol_country = 'UNITED ARAB EMIRATES';
        }

        $get_left = "SELECT LEFT(items_code, 2), code_status, code_main FROM upti_items INNER JOIN upti_code ON upti_items.items_code = upti_code.code_name WHERE items_code = '$ol_code'";
        $get_left_qry = mysqli_query($connect, $get_left);
        $get_left_fetch = mysqli_fetch_array($get_left_qry);
        $get_left_num = mysqli_num_rows($get_left_qry);

        // GET 2 LETTER WORD FOR ITEM CODE
        if ($get_left_num == 1) {
            $basihan = $get_left_fetch['LEFT(items_code, 2)'];
        } else {
            $basihan = 'BIHIRA';
        }

        // 

        if ($get_left_num == 1) {
            
            // Check if Single Item i not equal to UP001 and up
            if($basihan != 'UP' ) {
                $get_main_code = "SELECT * FROM upti_code WHERE code_name = '$ol_code'";
                $get_main_code_qry = mysqli_query($connect, $get_main_code);
                $get_main_code_fetch = mysqli_fetch_array($get_main_code_qry);

                $ol_code = $get_main_code_fetch['code_main'];
            }

            // Get the name of the UP selected
            $get_name_item = "SELECT * FROM upti_items WHERE items_code = '$ol_code'";
            $get_name_item_sql = mysqli_query($connect, $get_name_item);
            $get_name_fetch = mysqli_fetch_array($get_name_item_sql);

            // UP001 and up 
            $ol_desc = $get_name_fetch['items_desc'];

            // check if the item canceled is on the stockist inventory
            $stockist_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$ol_code' AND si_item_country = '$ol_country'";
            $stockist_qry = mysqli_query($connect, $stockist_sql);
            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            $stockist_num = mysqli_num_rows($stockist_qry);

            // get stockist code if this item is not in the stockist inventory
            $get_stockist = "SELECT * FROM stockist WHERE stockist_country = '$ol_country'";
            $get_stockist_qry = mysqli_query($connect, $get_stockist);
            $get_stockist_fetch = mysqli_fetch_array($get_stockist_qry);

            $stockist_code = $get_stockist_fetch['stockist_code'];

            if ($stockist_num == 0) {
                $balik_stock = "INSERT INTO stockist_inventory (
                    si_code,
                    si_item_code,
                    si_item_desc,
                    si_item_stock,
                    si_item_added,
                    si_item_country
                ) VALUES (
                    '$stockist_code',
                    '$ol_code',
                    '$ol_desc',
                    '$ol_qty',
                    '$datenow',
                    '$ol_country'
                )";
                $balik_stock_qry = mysqli_query($connect, $balik_stock);
            } else {
                // New Stocks
                $new_stocks = $ol_qty + $stockist_fetch['si_item_stock'];

                $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$ol_code' AND si_code = '$stockist_code' AND si_item_country = '$ol_country'";
                $update_stock_qry = mysqli_query($connect, $update_stock);
            }

        } else {
            $package_get = "SELECT * FROM upti_package WHERE package_code = '$ol_code'";
            $package_get_qry = mysqli_query($connect, $package_get);
            $package_fetch = mysqli_fetch_array($package_get_qry);

            // ITEM 1
            $c1 = $package_fetch['package_one_code'];
            $q1 = $package_fetch['package_one_qty'];

            // Get the name of the UP selected
            $get_name_item = "SELECT * FROM upti_items WHERE items_code = '$c1'";
            $get_name_item_sql = mysqli_query($connect, $get_name_item);
            $get_name_fetch = mysqli_fetch_array($get_name_item_sql);

            // UP001 and up 
            $ol_desc = $get_name_fetch['items_desc'];
            
            // check if the item canceled is on the stockist inventory
            $stockist_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c1' AND si_item_country = '$ol_country'";
            $stockist_qry = mysqli_query($connect, $stockist_sql);
            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            $stockist_num = mysqli_num_rows($stockist_qry);

            // get stockist code if this item is not in the stockist inventory
            $get_stockist = "SELECT * FROM stockist WHERE stockist_country = '$ol_country'";
            $get_stockist_qry = mysqli_query($connect, $get_stockist);
            $get_stockist_fetch = mysqli_fetch_array($get_stockist_qry);

            $stockist_code = $get_stockist_fetch['stockist_code'];

            if ($stockist_num == 0) {
                $balik_stock = "INSERT INTO stockist_inventory (
                    si_code,
                    si_item_code,
                    si_item_desc,
                    si_item_stock,
                    si_item_added,
                    si_item_country
                ) VALUES (
                    '$stockist_code',
                    '$c1',
                    '$ol_desc',
                    '$q1',
                    '$datenow',
                    '$ol_country'
                )";
                $balik_stock_qry = mysqli_query($connect, $balik_stock);
            } else {
                // New Stocks
                $new_stocks = $q1 + $stockist_fetch['si_item_stock'];

                $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$c1' AND si_code = '$stockist_code' AND si_item_country = '$ol_country'";
                $update_stock_qry = mysqli_query($connect, $update_stock);
            }
            // ITEM 1 ENDDDDDDDDDDDDDDDD

            // ITEM 2
            $c2 = $package_fetch['package_two_code'];
            $q2 = $package_fetch['package_two_qty'] * $ol_qty;

            // Get the name of the UP selected
            $get_name_item = "SELECT * FROM upti_items WHERE items_code = '$c2'";
            $get_name_item_sql = mysqli_query($connect, $get_name_item);
            $get_name_fetch = mysqli_fetch_array($get_name_item_sql);

            // UP001 and up 
            $ol_desc = $get_name_fetch['items_desc'];
            
            // check if the item canceled is on the stockist inventory
            $stockist_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c2' AND si_item_country = '$ol_country'";
            $stockist_qry = mysqli_query($connect, $stockist_sql);
            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            $stockist_num = mysqli_num_rows($stockist_qry);

            // get stockist code if this item is not in the stockist inventory
            $get_stockist = "SELECT * FROM stockist WHERE stockist_country = '$ol_country'";
            $get_stockist_qry = mysqli_query($connect, $get_stockist);
            $get_stockist_fetch = mysqli_fetch_array($get_stockist_qry);

            $stockist_code = $get_stockist_fetch['stockist_code'];

            if ($stockist_num == 0) {
                $balik_stock = "INSERT INTO stockist_inventory (
                    si_code,
                    si_item_code,
                    si_item_desc,
                    si_item_stock,
                    si_item_added,
                    si_item_country
                ) VALUES (
                    '$stockist_code',
                    '$c2',
                    '$ol_desc',
                    '$q2',
                    '$datenow',
                    '$ol_country'
                )";
                $balik_stock_qry = mysqli_query($connect, $balik_stock);
            } else {
                // New Stocks
                $new_stocks = $q2 + $stockist_fetch['si_item_stock'];

                $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$c2' AND si_code = '$stockist_code' AND si_item_country = '$ol_country'";
                $update_stock_qry = mysqli_query($connect, $update_stock);
            }
            // ITEM 2 ENDDDDDDDDDDDDDDDD

            // ITEM 3
            $c3 = $package_fetch['package_three_code'];
            $q3 = $package_fetch['package_three_qty'] * $ol_qty;

            // Get the name of the UP selected
            $get_name_item = "SELECT * FROM upti_items WHERE items_code = '$c3'";
            $get_name_item_sql = mysqli_query($connect, $get_name_item);
            $get_name_fetch = mysqli_fetch_array($get_name_item_sql);

            // UP001 and up 
            $ol_desc = $get_name_fetch['items_desc'];
            
            // check if the item canceled is on the stockist inventory
            $stockist_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c3' AND si_item_country = '$ol_country'";
            $stockist_qry = mysqli_query($connect, $stockist_sql);
            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            $stockist_num = mysqli_num_rows($stockist_qry);

            // get stockist code if this item is not in the stockist inventory
            $get_stockist = "SELECT * FROM stockist WHERE stockist_country = '$ol_country'";
            $get_stockist_qry = mysqli_query($connect, $get_stockist);
            $get_stockist_fetch = mysqli_fetch_array($get_stockist_qry);

            $stockist_code = $get_stockist_fetch['stockist_code'];

            if ($stockist_num == 0) {
                $balik_stock = "INSERT INTO stockist_inventory (
                    si_code,
                    si_item_code,
                    si_item_desc,
                    si_item_stock,
                    si_item_added,
                    si_item_country
                ) VALUES (
                    '$stockist_code',
                    '$c3',
                    '$ol_desc',
                    '$q3',
                    '$datenow',
                    '$ol_country'
                )";
                $balik_stock_qry = mysqli_query($connect, $balik_stock);
            } else {
                // New Stocks
                $new_stocks = $q3 + $stockist_fetch['si_item_stock'];

                $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$c3' AND si_code = '$stockist_code' AND si_item_country = '$ol_country'";
                $update_stock_qry = mysqli_query($connect, $update_stock);
            }
            // ITEM 3 ENDDDDDDDDDDDDDDDD

            // ITEM 4
            $c4 = $package_fetch['package_four_code'];
            $q4 = $package_fetch['package_four_qty'] * $ol_qty;

            // Get the name of the UP selected
            $get_name_item = "SELECT * FROM upti_items WHERE items_code = '$c4'";
            $get_name_item_sql = mysqli_query($connect, $get_name_item);
            $get_name_fetch = mysqli_fetch_array($get_name_item_sql);

            // UP001 and up 
            $ol_desc = $get_name_fetch['items_desc'];
            
            // check if the item canceled is on the stockist inventory
            $stockist_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c4' AND si_item_country = '$ol_country'";
            $stockist_qry = mysqli_query($connect, $stockist_sql);
            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            $stockist_num = mysqli_num_rows($stockist_qry);

            // get stockist code if this item is not in the stockist inventory
            $get_stockist = "SELECT * FROM stockist WHERE stockist_country = '$ol_country'";
            $get_stockist_qry = mysqli_query($connect, $get_stockist);
            $get_stockist_fetch = mysqli_fetch_array($get_stockist_qry);

            $stockist_code = $get_stockist_fetch['stockist_code'];

            if ($stockist_num == 0) {
                $balik_stock = "INSERT INTO stockist_inventory (
                    si_code,
                    si_item_code,
                    si_item_desc,
                    si_item_stock,
                    si_item_added,
                    si_item_country
                ) VALUES (
                    '$stockist_code',
                    '$c4',
                    '$ol_desc',
                    '$q4',
                    '$datenow',
                    '$ol_country'
                )";
                $balik_stock_qry = mysqli_query($connect, $balik_stock);
            } else {
                // New Stocks
                $new_stocks = $q4 + $stockist_fetch['si_item_stock'];

                $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$c4' AND si_code = '$stockist_code' AND si_item_country = '$ol_country'";
                $update_stock_qry = mysqli_query($connect, $update_stock);
            }
            // ITEM 4 ENDDDDDDDDDDDDDDDD

            // ITEM 5
            $c5 = $package_fetch['package_five_code'];
            $q5 = $package_fetch['package_five_qty'] * $ol_qty;

            // Get the name of the UP selected
            $get_name_item = "SELECT * FROM upti_items WHERE items_code = '$c5'";
            $get_name_item_sql = mysqli_query($connect, $get_name_item);
            $get_name_fetch = mysqli_fetch_array($get_name_item_sql);

            // UP001 and up 
            $ol_desc = $get_name_fetch['items_desc'];
            
            // check if the item canceled is on the stockist inventory
            $stockist_sql = "SELECT * FROM stockist_inventory WHERE si_item_code = '$c5' AND si_item_country = '$ol_country'";
            $stockist_qry = mysqli_query($connect, $stockist_sql);
            $stockist_fetch = mysqli_fetch_array($stockist_qry);
            $stockist_num = mysqli_num_rows($stockist_qry);

            // get stockist code if this item is not in the stockist inventory
            $get_stockist = "SELECT * FROM stockist WHERE stockist_country = '$ol_country'";
            $get_stockist_qry = mysqli_query($connect, $get_stockist);
            $get_stockist_fetch = mysqli_fetch_array($get_stockist_qry);

            $stockist_code = $get_stockist_fetch['stockist_code'];

            if ($stockist_num == 0) {
                $balik_stock = "INSERT INTO stockist_inventory (
                    si_code,
                    si_item_code,
                    si_item_desc,
                    si_item_stock,
                    si_item_added,
                    si_item_country
                ) VALUES (
                    '$stockist_code',
                    '$c5',
                    '$ol_desc',
                    '$q5',
                    '$datenow',
                    '$ol_country'
                )";
                $balik_stock_qry = mysqli_query($connect, $balik_stock);
            } else {
                // New Stocks
                $new_stocks = $q5 + $stockist_fetch['si_item_stock'];

                $update_stock = "UPDATE stockist_inventory SET si_item_stock = '$new_stocks' WHERE si_item_code = '$c5' AND si_code = '$stockist_code' AND si_item_country = '$ol_country'";
                $update_stock_qry = mysqli_query($connect, $update_stock);
            }
            // ITEM 5 ENDDDDDDDDDDDDDDDD
        }
    }
    
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];
    $desc = $namex.' Update '.$poid.' set Ordered Status into Cancel';

    // HISTORY
    $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', $time', '$datenow', '$namex', 'Canceled', '$desc')";
    $act_qry = mysqli_query($connect, $act);

    $update_stats = "UPDATE upti_transaction SET trans_status = 'Canceled' WHERE id = '$id'";
    $update_stats_qyr = mysqli_query($connect, $update_stats);
    
    $update_stats1 = "UPDATE upti_order_list SET ol_status = 'Canceled' WHERE ol_poid = '$poid'";
    $update_stats_qyr1 = mysqli_query($connect, $update_stats1);

    flash("success", "Order Status has been changed to Cancel Successfully");

    header('Location: ../poid-list.php?id='.$id.'');
        
    ?>