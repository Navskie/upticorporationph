<?php
    session_start();
    include '../function.php';
    include '../dbms/conn.php';

    date_default_timezone_set('Asia/Manila');

    $get_series = "SELECT * FROM upti_series WHERE remark = 'poid'";
    $get_series_sql = mysqli_query($connect, $get_series);
    $get_series_fetch = mysqli_fetch_array($get_series_sql);

    $series_count = $get_series_fetch['series'];
    $date = date('m-d-Y');
    $gene_date = date('mdY');

    $generated_po = 'PO'.$gene_date.$series_count;
    // ADD VENDOR INFORMATION
    if (isset($_POST['ipasamo'])) {
        $vendor_name = $_POST['vname'];
        $vendor_person = $_POST['vperson'];
        $vendor_address = $_POST['vaddress'];
        $vendor_number = $_POST['vnumber'];
        $vendor_email = $_POST['vemail'];

        if ($vendor_name == '' OR $vendor_person == '' OR $vendor_address == '' OR $vendor_number == '' OR $vendor_email == '') {
            flash("vendormissing", "All fields are required.");
            header('location: ../warehouse-po.php');
        } else {
            $insert_info = "INSERT INTO stockist_vendor (
                vendor_name, 
                vendor_person, 
                vendor_address, 
                vendor_number,
                vendor_email,
                vendor_po,
                vendor_date,
                vendor_status
            ) VALUES (
                '$vendor_name',
                '$vendor_person',
                '$vendor_address',
                '$vendor_number',
                '$vendor_email',
                '$generated_po',
                '$date',
                'Pending'
            )";
            $insert_info_sql = mysqli_query($connect, $insert_info);

            flash("vendorsuccess", "Vendor Information has been saved successfully!");
            header('location: ../warehouse-po.php');
        }

    }  
    // UPDATE VENDOR INFORMATION
    if (isset($_POST['iupdatemo'])) {
        $vendor_name = $_POST['vname'];
        $vendor_person = $_POST['vperson'];
        $vendor_address = $_POST['vaddress'];
        $vendor_number = $_POST['vnumber'];
        $vendor_email = $_POST['vemail'];

        if ($vendor_name == '' OR $vendor_person == '' OR $vendor_address == '' OR $vendor_number == '' OR $vendor_email == '') {
            flash("vendormissing", "All fields are required.");
            header('location: ../warehouse-po.php');
        } else {
            $update_info = "UPDATE stockist_vendor SET
                vendor_name = '$vendor_name', 
                vendor_person = '$vendor_person', 
                vendor_address = '$vendor_address', 
                vendor_number = '$vendor_number',
                vendor_email = '$vendor_email'
            WHERE vendor_po = '$generated_po'";
            $update_info_sql = mysqli_query($connect, $update_info);

            flash("vendorsuccess", "Vendor Information has been updated successfully!");
            header('location: ../warehouse-po.php');
        }
    }
    if (isset($_POST['add-order'])) {
        $code = $_POST['code'];
        
        $get_details = "SELECT * FROM upti_items WHERE items_code = '$code'";
        $get_details_sql = mysqli_query($connect, $get_details);
        $get_details_fetch = mysqli_fetch_array($get_details_sql);

        $details = $get_details_fetch['items_desc'];
        $unit = $_POST['unit'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $subtotal = $qty * $price;

        $insert_order = "INSERT INTO stockist_vendor_order (
            vo_po,
            vo_code,
            vo_details,
            vo_unit,
            vo_qty,
            vo_price,
            vo_subtotal,
            vo_date
        ) VALUES (
            '$generated_po',
            '$code',
            '$details',
            '$unit',
            '$qty',
            '$price',
            '$subtotal',
            '$date'
        )";
        $insert_order_sql = mysqli_query($connect, $insert_order);

        flash("vendorsuccess", $details." has been added successfully!");
        header('location: ../warehouse-po.php');
    }
    
    // SUBMIT PO
    if(isset($_POST['po-submitted'])) {
        $notes = $_POST['notes'];

        $update_po = "UPDATE stockist_vendor SET vendor_status = 'Pending' WHERE vendor_po = '$generated_po'";
        $update_po_sql = mysqli_query($connect, $update_po);

        $notes = "UPDATE stockist_vendor SET vendor_remarks = '$notes' WHERE vendor_po = '$generated_po'";
        $notes_qry = mysqli_query($connect, $notes);

        $series_count_new = $series_count + 1;

        $update_count = "UPDATE upti_series SET series = '$series_count_new' WHERE remark = 'poid'";
        $update_count_sql = mysqli_query($connect, $update_count);

        flash("vendorsuccess", "Purchase Order has been submitted successfully!");
        header('location: ../purchase-order.php');
    }
?>
