<?php
    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    $Uid = $_SESSION['uid'];
    $Ucode = $_SESSION['code'];

    date_default_timezone_set("Asia/Manila"); 
    $date_today = date('m-d-Y');

    $count_sql = "SELECT users_reseller, users_role, users_main, users_code FROM upti_users WHERE users_code = '$Ucode'";
    $count_qry = mysqli_query($connect, $count_sql);
    $count_fetch = mysqli_fetch_array($count_qry);

    $Ucount = $count_fetch['users_reseller'];
    $reseller = $count_fetch['users_main'];

    $poid = 'RS'.$Uid.'-'.$Ucount;

    $get_country = mysqli_query($connect, "SELECT trans_country, trans_mop FROM upti_transaction WHERE trans_poid = '$poid'");
    $get_country_f = mysqli_fetch_array($get_country);

    $country = $get_country_f['trans_country'];
    $mode_of_payment = $get_country_f['trans_mop'];

    // SUBTOTAL
    $subtotal_sql = "SELECT SUM(ol_subtotal) AS subtotal FROM upti_order_list WHERE ol_poid = '$poid'";
    $subtotal_qry = mysqli_query($connect, $subtotal_sql);
    $subtotal_fetch = mysqli_fetch_array($subtotal_qry);

    $subtotal = $subtotal_fetch['subtotal'];

    // SHIPPING FEE START
    $shipping_sql = "SELECT * FROM upti_shipping WHERE shipping_country = '$country'";
    $shipping_qry = mysqli_query($connect, $shipping_sql);
    $shipping_fetch = mysqli_fetch_array($shipping_qry);
    $shipping_num = mysqli_num_rows($shipping_qry);

    if ($shipping_num <= 0 || $mode_of_payment == 'Cash On Pick Up') {
        $shipping = 0;
    } else {
        $shipping = $shipping_fetch['shipping_price'];
    }

    if($country == 'HONGKONG' AND $mode_of_payment == 'Cash On Delivery') {
        // echo 'try';
        $surcharge = $subtotal * 0.025;
    } else {
        $surcharge = 0;
    }

    // Total Amount
    $total_amount = $subtotal + $surcharge + $shipping;

    if (isset($_POST['checkouts'])) {
        if ($mode_of_payment == 'Cash On Pick Up' || $mode_of_payment == 'Cash On Delivery') {
            $transaction = mysqli_query($connect, "UPDATE upti_transaction SET
                trans_date = '$date_today',
                trans_seller = '$Ucode',
                trans_my_reseller = '$reseller',
                trans_admin = 'UPTIMAIN',
                trans_subtotal = '$total_amount',
                trans_ship = '$shipping',
                trans_status = 'Pending'
            WHERE trans_poid = '$poid';
            ");

            $new_count = $Ucount + 1;

            $update_id = "UPDATE upti_users SET users_reseller = '$new_count' WHERE users_code = '$Ucode'";
            $update_id_qry = mysqli_query($connect, $update_id);

            flash("success", "Reseller Package has been submit successfully");
            header('location: osr-reseller.php');
        } else {
            $img_name = $_FILES['file']['name'];
            $img_size = $_FILES['file']['size'];
            $img_tmp = $_FILES['file']['tmp_name'];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            // echo ($img_ex);
            $img_ex_lc = strtolower($img_ex);

            $allow_ex = array("jpg", "jpeg", "png", "gif");

            if($img_name == '' && $mode_of_payment == 'Payment First' || $img_name == '' && $mode_of_payment == 'Bank') {
                flash("failed", "You forgot to attach your payment receipt Attach it now!");
                header('location: osr-reseller.php');
            } else {
                if (in_array($img_ex_lc, $allow_ex)) {
                    $new_name = $poid.'.'.$img_ex_lc;
                    $img_path_sa_buhay_niya = 'images/payment/'.$new_name;
                    move_uploaded_file($img_tmp, $img_path_sa_buhay_niya);
                
                    $transaction = mysqli_query($connect, "UPDATE upti_transaction SET
                        trans_date = '$date_today',
                        trans_seller = '$Ucode',
                        trans_my_reseller = '$reseller',
                        trans_admin = 'UPTIMAIN',
                        trans_subtotal = '$total_amount',
                        trans_ship = '$shipping',
                        trans_img = '$new_name',
                        trans_status = 'Pending'
                    WHERE trans_poid = '$poid';
                    ");
                }

                $new_count = $Ucount + 1;

                $update_id = "UPDATE upti_users SET users_reseller = '$new_count' WHERE users_code = '$Ucode'";
                $update_id_qry = mysqli_query($connect, $update_id);

                flash("success", "Reseller Package has been submit successfully");
                header('location: osr-reseller.php');
            }
        }
    }
?>