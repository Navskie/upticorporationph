<?php
    include 'dbms/conn.php';

    session_start();

    if(isset($_POST['export'])) { 
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $country = $_POST['bansa'];
        $status = $_POST['status'];
        // NOT DELIVERED
        if (empty($country) AND empty($status)) {
             
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Date Triggered</th> 
                    <th>Poid</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>$ Sales Amount</th> 
                    <th>Php Sales Amount</th> 
                    <th>Status</th>
                <tr> 
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT trans_address, trans_poid, trans_state, trans_status, ol_date, ol_poid, ol_country, ol_subtotal, ol_php FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE upti_transaction.trans_status != 'On Order' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $check_poid = $row['trans_poid'];

                    $check_trigger = "SELECT * FROM upti_activities WHERE activities_poid = '$check_poid' AND activities_caption = 'Order Delivered'";
                    $check_trigger_sql = mysqli_query($connect, $check_trigger);
                    $check_trigger_num = mysqli_num_rows($check_trigger_sql);
                    $check_trigger_fetch = mysqli_fetch_array($check_trigger_sql); 

                    if ($check_trigger_num > 0) {
                        $caption = 'Delivered';
                        $date_trigger = $check_trigger_fetch['activities_date'];
                    } else {
                        $caption = $row['trans_status'];
                        $date_trigger = '';
                    }

                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$date_trigger.'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['trans_state'].'</td>
                            <td>'.$row['trans_address'].'</td>
                            <td>'.$row['ol_subtotal'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$caption.'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                

        } elseif ($status == '' AND $country != '') {
            
            // Column Name 
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>$ Sales Amount</th>
                    <th>Php Sales Amount</th>
                    <th>Status</th>
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT ol_date, ol_poid, ol_country, trans_state, ol_subtotal, ol_php, ol_status FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE ol_country = '$country' AND ol_date BETWEEN '$date1' AND '$date2' ORDER BY ol_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['trans_state'].'</td>
                            <td>'.$row['trans_address'].'</td>
                            <td>'.$row['ol_subtotal'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['ol_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                

        } elseif (empty($country) AND $status != 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>$ Sales Amount</th>
                    <th>Php Sales Amount</th>
                    <th>Status</th>
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = '$status' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['trans_state'].'</td>
                            <td>'.$row['trans_address'].'</td>
                            <td>'.$row['ol_subtotal'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['trans_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                

        } elseif (!empty($country) AND $status != 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>Mode of Payment</th>
                    <th>$ Sales Amount</th>
                    <th>₱ Sales Amount</th>
                    <th>Status</th>
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = '$status' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_date BETWEEN '$date1' AND '$date2' ORDER BY upti_order_list.ol_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['trans_state'].'</td>
                            <td>'.$row['trans_address'].'</td>
                            <td>'.$row['trans_mop'].'</td>
                            <td>'.$row['ol_subtotal'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['ol_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                


        // DELIVERED
        } elseif (!empty($country) AND $status == 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Date Triggered</th>
                    <th>Reseller ID</th>
                    <th>Reseller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>$ Sales Amount</th>
                    <th>₱ Sales Amount</th>
                    <th>Status</th>
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $seller = $row['ol_seller'];
                    
                    $get_name = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$seller'");
                    $get_fetch = mysqli_fetch_array($get_name);
                    $name = $get_fetch['users_name'];
                    
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['activities_date'].'</td>
                            <td>'.$seller.'</td>
                            <td>'.$name.'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['trans_state'].'</td>
                            <td>'.$row['trans_address'].'</td>
                            <td>'.$row['ol_subtotal'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['ol_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                

        } elseif (empty($country) AND $status == 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Date Triggered</th>
                    <th>Reseller ID</th>
                    <th>Reseller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>$ Sales Amount</th>
                    <th>Php Sales Amount</th>
                    <th>Status</th>
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $seller = $row['ol_seller'];
                    
                    $get_name = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$seller'");
                    $get_fetch = mysqli_fetch_array($get_name);
                    $name = $get_fetch['users_name'];
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['activities_date'].'</td>
                            <td>'.$seller.'</td>
                            <td>'.$name.'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['trans_state'].'</td>
                            <td>'.$row['trans_address'].'</td>
                            <td>'.$row['ol_subtotal'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['ol_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                

        } 
    }













    // EXPORT Quantity
    if (isset($_POST['export_qty'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $country = $_POST['bansa'];
        $status = $_POST['status'];

        if ($country == '' && $status == '') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Date Triggered</th>
                    <th>Seller ID</th>
                    <th>Seller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Peso</th>
                    <th>Status</th>
                <tr>
            ';

            // Fetch Records From Database
            $export_sql = "SELECT ol_php, ol_price, trans_date, trans_poid, ol_code, ol_desc, ol_qty, trans_country, trans_status, trans_seller FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE upti_transaction.trans_status != 'On Order' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date ASC";
            // $export_sql = "SELECT * FROM upti_transaction";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                        $check_poid = $row['trans_poid'];
                        $seller = $row['trans_seller'];
                        
                        $get_seller = "SELECT users_name FROM upti_users WHERE users_code = '$seller'";
                        $get_seller_qry = mysqli_query($connect, $get_seller);
                        $get_seller_fetch = mysqli_fetch_array($get_seller_qry);

                        $check_trigger = "SELECT activities_date FROM upti_activities WHERE activities_poid = '$check_poid' AND activities_caption = 'Order Delivered'";
                        $check_trigger_sql = mysqli_query($connect, $check_trigger);
                        $check_trigger_num = mysqli_num_rows($check_trigger_sql);
                        $check_trigger_fetch = mysqli_fetch_array($check_trigger_sql);

                        if ($check_trigger_num > 0) {
                            $caption = 'Delivered';
                            $date_trigger = $check_trigger_fetch['activities_date'];
                        } else {
                            $caption = $row['trans_status'];
                            $date_trigger = '';
                        }
                    $output .='
                    <tr>
                        <td>'.$row['trans_date'].'</td>
                        <td>'.$date_trigger.'</td>
                        <td>'.$row['trans_poid'].'</td>
                        <td>'.$seller.'</td>
                        <td>'.$get_seller_fetch['users_name'].'</td>
                        <td>'.$row['trans_country'].'</td>
                        <td>'.$row['ol_code'].'</td>
                        <td>'.$row['ol_desc'].'</td>
                        <td>'.$row['ol_qty'].'</td>
                        <td>'.$row['ol_price'].'</td>
                        <td>'.$row['ol_php'].'</td>
                        <td>'.$caption.'</td>
                    </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=SQ_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }   
                        
        } elseif (empty($country) AND $status == 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="2">
                <tr>
                    <th>Date Order</th>
                    <th>Date Triggered</th>
                    <th>Seller ID</th>
                    <th>Seller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>peso</th>
                    <th>Status</th>
                <tr>
            ';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            // while($row = mysqli_fetch_array($export_qry)) {
            //     echo $row['ol_poid'].'<br>';
            // }

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                        $seller = $row['ol_seller'];
                        
                        $get_seller = "SELECT * FROM upti_users WHERE users_code = '$seller'";
                        $get_seller_qry = mysqli_query($connect, $get_seller);
                        $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['activities_date'].'</td>
                            <td>'.$row['ol_seller'].'</td>
                            <td>'.$get_seller_fetch['users_name'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_code'].'</td>
                            <td>'.$row['ol_desc'].'</td>
                            <td>'.$row['ol_qty'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['ol_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=SQ_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                
        } elseif (!empty($country) AND $status == 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="2">
                <tr>
                    <th>Date Order</th>
                    <th>Date Triggered</th>
                    <th>Seller ID</th>
                    <th>Seller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Peso</th>
                    <th>Status</th>
                <tr>
            ';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                        $seller = $row['ol_seller'];
                        
                        $get_seller = "SELECT * FROM upti_users WHERE users_code = '$seller'";
                        $get_seller_qry = mysqli_query($connect, $get_seller);
                        $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                    $output .='
                        <tr>
                            <td>'.$row['ol_date'].'</td>
                            <td>'.$row['activities_date'].'</td>
                            <td>'.$row['ol_country'].'</td>
                            <td>'.$row['ol_seller'].'</td>
                            <td>'.$get_seller_fetch['users_name'].'</td>
                            <td>'.$row['ol_poid'].'</td>
                            <td>'.$row['ol_code'].'</td>
                            <td>'.$row['ol_desc'].'</td>
                            <td>'.$row['ol_qty'].'</td>
                            <td>'.$row['ol_price'].'</td>
                            <td>'.$row['ol_php'].'</td>
                            <td>'.$row['ol_status'].'</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=SQ_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                
        } elseif (empty($country) AND $status != 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Seller ID</th>
                    <th>Seller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Peso</th>
                    <th>Status</th> 
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = '$status' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                        $seller = $row['ol_seller'];
                        
                        $get_seller = "SELECT * FROM upti_users WHERE users_code = '$seller'";
                        $get_seller_qry = mysqli_query($connect, $get_seller);
                        $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                    $output .='
                    <tr>
                        <td>'.$row['trans_date'].'</td>
                        <td>'.$row['trans_seller'].'</td>
                        <td>'.$get_seller_fetch['users_name'].'</td>
                        <td>'.$row['ol_poid'].'</td>
                        <td>'.$row['ol_country'].'</td>
                        <td>'.$row['ol_code'].'</td>
                        <td>'.$row['ol_desc'].'</td>
                        <td>'.$row['ol_qty'].'</td>
                        <td>'.$row['ol_php'].'</td>
                        <td>'.$row['trans_status'].'</td>
                    </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=SQ_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                

        } elseif (!empty($country) AND $status != 'Delivered') {
            
            // Column Name
            $output = '
                <table class="table" bordered="1">
                <tr>
                    <th>Date Order</th>
                    <th>Seller ID</th>
                    <th>Seller Name</th>
                    <th>Poid</th>
                    <th>Country</th>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Status</th>
                <tr>
            ';

            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';

            // Fetch Records From Database
            $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = '$status' AND upti_order_list.ol_country = '$country' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.trans_date ASC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);

            if($export_num > 0) {
                while($row = mysqli_fetch_array($export_qry)) {
                    $seller = $row['ol_seller'];
                        
                    $get_seller = "SELECT * FROM upti_users WHERE users_code = '$seller'";
                    $get_seller_qry = mysqli_query($connect, $get_seller);
                    $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                    $output .='
                    <tr>
                        <td>'.$row['trans_date'].'</td>
                        <td>'.$row['trans_seller'].'</td>
                        <td>'.$get_seller_fetch['users_name'].'</td>
                        <td>'.$row['ol_poid'].'</td>
                        <td>'.$row['ol_country'].'</td>
                        <td>'.$row['ol_code'].'</td>
                        <td>'.$row['ol_desc'].'</td>
                        <td>'.$row['ol_qty'].'</td>
                        <td>'.$row['trans_status'].'</td>
                    </tr>
                    ';
                }
                $output .= '</table>';
                // Header for  Download
                // if (! headers_sent()) {
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=SQ_".$date1.'-'.$date2.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                // }
                // Render excel data file
                echo $output;
                // ob_end_flush();
                exit;
            }                
        }

    }


    // Export Code
    if (isset($_POST['export_code'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $code = $_POST['item_code'];

        // Column Name
        $output = '
        <table class="table" bordered="1">
        <tr>
            <th>Poid</th>
            <th>Seller ID</th>
            <th>Seller Name</th>
            <th>Country</th>
            <th>Item Code</th>
            <th>Item Description</th>
            <th>Quantity</th>
            <th>Status</th>
        <tr>
        ';

        // Display Column Names as First Row
        // $excelData = implode('\t', array_values($fields)).'\n';

        // Fetch Records From Database
        $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_code = '$code' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $seller = $row['ol_seller'];
                        
                $get_seller = "SELECT * FROM upti_users WHERE users_code = '$seller'";
                $get_seller_qry = mysqli_query($connect, $get_seller);
                $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                $output .='
                <tr>
                    <td>'.$row['ol_poid'].'</td>
                    <td>'.$row['ol_seller'].'</td>
                    <td>'.$get_seller_fetch['users_name'].'</td>
                    <td>'.$row['ol_country'].'</td>
                    <td>'.$row['ol_code'].'</td>
                    <td>'.$row['ol_desc'].'</td>
                    <td>'.$row['ol_qty'].'</td>
                    <td>'.$row['activities_caption'].'</td>
                </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=CR_".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } else {
            echo "<script>alert('Empty Data for this Item Code');window.location='admin-code-item.php'</script>";
        }              
    }


    // Reseller OSR sales and points
    if (isset($_POST['export_reseller_sales'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $res = $_POST['res']; 
        $stats = $_POST['stats'];

        if ($res == '' && $stats == 'Order Delivered') {
            // Column Name
            // $output = '
            // <table class="table" bordered="1">
            // <tr>
            //     <th>COUNTRY/LOCATION</th>
            //     <th>RESELLER ID</th>
            //     <th>RESELLER NAME</th>
            //     <th>Total Sales of '.$date1.' to '.$date2.'</th>
            // <tr>
            // ';

            // // Display Column Names as First Row
            // // $excelData = implode('\t', array_values($fields)).'\n';
    
            // // Fetch Records From Database
            // $export_sql = "
            // SELECT users_code, trans_country, users_name, SUM(upti_order_list.ol_php) AS TOTAL_SALES FROM upti_users
            // INNER JOIN
            // upti_order_list ON upti_users.users_code = upti_order_list.ol_reseller
            // INNER JOIN
            // upti_transaction ON upti_transaction.trans_poid = upti_order_list.ol_poid
            // INNER JOIN
            // upti_activities ON upti_transaction.trans_poid = upti_activities.activities_poid
            // WHERE upti_activities.activities_caption = 'Order Delivered' AND
            // upti_activities.activities_date BETWEEN '$date1' AND '$date2' GROUP BY users_code ORDER BY TOTAL_SALES DESC";
            // // echo '<br>';
            // $export_qry = mysqli_query($connect, $export_sql);
            // $export_num = mysqli_num_rows($export_qry);
    
            // while($row = mysqli_fetch_array($export_qry)) {
            //         $tot_sales = $row['TOTAL_SALES'];
                    
            //     $output .='
            //     <tr>
            //         <td>'.$row['trans_country'].'</td>
            //         <td>'.$row['users_code'].'</td>
            //         <td>'.$row['users_name'].'</td>
            //         <td>'.number_format($tot_sales).'</td>
            //     </tr>
            //     ';
            // }
            // $output .= '</table>';
            // // Header for  Download
            // // if (! headers_sent()) {
            // header("Content-Type: application/xls");
            // header("Content-Disposition: attachment; filename=Reseller_Sales".$date1.'-'.$date2.".xls");
            // header("Pragma: no-cache");
            // header("Expires: 0");
            // // }
            // // Render excel data file
            // echo $output;
            // // ob_end_flush();
            // exit;
        } elseif ($res == '' && $stats == 'RTS') {
            // Column Name
            $output = '
            <table class="table" bordered="1">
            <tr>
                <th>TEAM</th>
                <th>SIGNED UP BY</th>
                <th>COUNTRY/LOCATION</th>
                <th>RESELLER ID</th>
                <th>RESELLER NAME</th>
                <th>Total Sales of '.$date1.' to '.$date2.'</th>
            <tr>
            ';
    
            // Display Column Names as First Row
            // $excelData = implode('\t', array_values($fields)).'\n';
    
            // Fetch Records From Database
            $export_sql = "SELECT *, SUM(upti_order_list.ol_php) AS TOTAL_SALES FROM upti_reseller
                    INNER JOIN
                    upti_order_list ON upti_reseller.reseller_code = upti_order_list.ol_reseller
                    INNER JOIN
                    upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid
                    WHERE upti_activities.activities_caption = 'RTS' AND
                    upti_activities.activities_date BETWEEN '$date1' AND '$date2' GROUP BY upti_reseller.reseller_code ORDER BY TOTAL_SALES DESC";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            $export_num = mysqli_num_rows($export_qry);
    
            while($row = mysqli_fetch_array($export_qry)) {
                    $tot_sales = $row['TOTAL_SALES'];
                    $poid = $row['reseller_poid'];
                    
                    $get_reseller = "SELECT * FROM upti_transaction WHERE trans_poid = '$poid'";
                    $get_reseller_sql = mysqli_query($connect, $get_reseller);
                    $get_reseller_fetch = mysqli_fetch_array($get_reseller_sql);
                    
                    $seller = $get_reseller_fetch['trans_seller'];
                    
                    $get_upper = "SELECT * FROM upti_users WHERE users_code = '$seller'";
                    $get_upper_sql = mysqli_query($connect, $get_upper);
                    $get_upper_fetch = mysqli_fetch_array($get_upper_sql);
                    
                    $name_upper = $get_upper_fetch['users_name'];
                    $upper_reseller = $get_upper_fetch['users_main'];
                    
                    $get_upper1 = "SELECT * FROM upti_users WHERE users_code = '$upper_reseller'";
                    $get_upper_sql1 = mysqli_query($connect, $get_upper1);
                    $get_upper_fetch1 = mysqli_fetch_array($get_upper_sql1);
                    
                $output .='
                <tr>
                    <td>'.$get_upper_fetch1['users_name'].'</td>
                    <td>'.$name_upper.'</td>
                    <td>'.$row['reseller_country'].'</td>
                    <td>'.$row['reseller_code'].'</td>
                    <td>'.$row['reseller_name'].'</td>
                    <td>'.number_format($tot_sales).'</td>
                </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=Osr_reseller_sales".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;

        } elseif ($stats == '' && $res == '') {
            echo "<script>alert('Please select status');window.location='admin-reseller.php'</script>";
        }
    }

    // Export Code
    if (isset($_POST['export_reseller_info'])) {
        $date1 = 'Reseller';
        $date2 = 'Information';
        // Column Name
        $output = '
        <table class="table" bordered="1">
        <tr>
            <th>ID Number</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Complete Address</th>
            <th>Country</th>
        <tr>
        ';

        // Display Column Names as First Row
        // $excelData = implode('\t', array_values($fields)).'\n';

        // Fetch Records From Database
        $export_sql = "SELECT * FROM upti_users INNER JOIN upti_reseller ON upti_users.users_code = upti_reseller.reseller_code INNER JOIN upti_transaction ON upti_reseller.reseller_poid = upti_transaction.trans_poid WHERE upti_users.users_role = 'UPTIRESELLER' AND upti_users.users_status = 'Active' GROUP BY upti_users.users_code ORDER BY upti_users.users_name ASC";
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $output .='
                <tr>
                    <td>'.$row['users_code'].'</td>
                    <td>'.$row['users_name'].'</td>
                    <td>'.$row['reseller_mobile'].'</td>
                    <td>'.$row['reseller_address'].'</td>
                    <td>'.$row['trans_email'].'</td>
                    <td>'.$row['reseller_country'].'</td>
                </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } else {
            echo "<script>alert('Empty Data for this Item Code');window.location='admin-code-item.php'</script>";
        }              
    }
    
    // OSR SALES
    if (isset($_POST['osr_sales_report'])) {
      //   $item_sql = "SELECT users_name, SUM(ol_php) AS TOTAL, SUM(ol_points) AS POINTS FROM upti_users INNER JOIN upti_order_list ON upti_users.users_code = upti_order_list.ol_seller INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS114' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS113' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS112' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS111' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' GROUP BY upti_users.users_code ORDER BY TOTAL DESC";
      //   $item_qry = mysqli_query($connect, $item_sql);
      //   echo $check = mysqli_num_rows($item_qry);
      
          $newDate1 = $_POST['date1'];
          $date1 = date("m-d-Y", strtotime($newDate1));
          $newDate2 = $_POST['date2'];
          $date2 = date("m-d-Y", strtotime($newDate2));
          $status = $_POST['status'];
          // Column Name
          if ($status == 'RTS') {
              $output = '
              <table class="table" bordered="1">
              <tr>
                  <th>OSR Name</th>
                  <th>Poid</th>
                  <th>Coutry</th>
                  <th>RTS Date</th>
                  <th>Date Delivered</th>
              <tr>
              ';
      
              // Display Column Names as First Row
              // $excelData = implode('\t', array_values($fields)).'\n';
      
              // Fetch Records From Database
              $item_sql = "SELECT * FROM upti_users INNER JOIN upti_transaction ON upti_users.users_code = upti_transaction.trans_seller INNER JOIN upti_activities ON upti_transaction.trans_poid = upti_activities.activities_poid WHERE upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS114' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS113' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS112' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS111' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'S2111' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' GROUP BY upti_users.users_code";
              $item_qry = mysqli_query($connect, $item_sql);
              $export_num = mysqli_num_rows($item_qry);
              if($export_num > 0) {
              while($row = mysqli_fetch_array($item_qry)) {
                  $code_osr = $row['users_code'];
                  $count_rts = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$code_osr' AND upti_activities.activities_caption = 'RTS' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' GROUP BY ol_poid";
                  $count_rts_qry = mysqli_query($connect, $count_rts);
                  while ($count_fetch = mysqli_fetch_array($count_rts_qry)) {
                  // $total_count = $count_fetch['TOTAL'];
                  // if ($total_count != 0) {
                  $output .='
                  <tr>
                      <td>'.$row['users_name'].'</td>
                      <td>'.$count_fetch['trans_poid'].'</td>
                      <td>'.$count_fetch['ol_country'].'</td>
                      <td>'.$count_fetch['activities_date'].'</td>
                      <td></td>
                  </tr>
                  ';
                  // }
                  }
                  $get_sales_rts = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE activities_caption = 'Deliver to RTS' AND ol_seller = '$code_osr' AND activities_date BETWEEN '$date1' AND '$date2' GROUP BY ol_poid";
                  $get_sales_qry_rts = mysqli_query($connect, $get_sales_rts);
                  // $get_sales_fetch_rts = mysqli_fetch_array($get_sales_qry_rts);
                  while ($get_sales_fetch_rts = mysqli_fetch_array($get_sales_qry_rts)) {
                  $poid_number = $get_sales_fetch_rts['ol_poid'];
  
                  $trigger_sql = mysqli_query($connect, "SELECT * FROM upti_activities WHERE activities_caption = 'Order Delivered' AND activities_poid = '$poid_number'");
                  $trigger_fetch = mysqli_fetch_array($trigger_sql);
  
                  $output .=' 
                  <tr>
                      <td>'.$row['users_name'].'</td>
                      <td>'.$get_sales_fetch_rts['ol_poid'].'</td>
                      <td>'.$get_sales_fetch_rts['ol_country'].'</td>
                      <td>'.$get_sales_fetch_rts['activities_date'].'</td>
                      <td>'.$trigger_fetch['activities_date'].'</td>
                  </tr>
                  ';
                  // }
                  }
              }
              $output .= '</table>';
              // Header for  Download
              // if (! headers_sent()) {
              header("Content-Type: application/xls");
              header("Content-Disposition: attachment; filename=OSR_SALES_REPORT".$date1.'-'.$date2.".xls");
              header("Pragma: no-cache");
              header("Expires: 0");
              // }
              // Render excel data file
              echo $output;
              // ob_end_flush();
              exit;
              } else {
                  echo "<script>alert('Empty Data for this Item Code');window.location='admin-osr-report.php'</script>";
              }  
          } elseif ($status == 'Order Delivered') {
              $output = '
              <table class="table" bordered="1">
              <tr>
                  <th>OSR Name</th>
                  <th>Sales</th>
              <tr>
              ';
      
              // Display Column Names as First Row
              // $excelData = implode('\t', array_values($fields)).'\n';
      
              // Fetch Records From Database
            $item_sql = "SELECT upti_users.users_name, SUM(upti_order_list.ol_php) AS TOTAL FROM upti_users INNER JOIN upti_order_list ON upti_users.users_code = upti_order_list.ol_seller INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid 
            WHERE users_position = 'ELLAN' AND users_role = 'UPTIOSR' AND activities_caption = 'Order Delivered' AND activities_date BETWEEN '$date1' AND '$date2' OR
            users_position = 'CHRIS' AND users_role = 'UPTIOSR'AND activities_caption = 'Order Delivered' AND activities_date BETWEEN '$date1' AND '$date2' GROUP BY users_code ORDER BY TOTAL DESC";
              $item_qry = mysqli_query($connect, $item_sql);
              $export_num = mysqli_num_rows($item_qry);
              if($export_num > 0) {
              while($row = mysqli_fetch_array($item_qry)) { 
                  $output .='
                  <tr>
                      <td>'.$row['users_name'].'</td>
                      <td>'.$row['TOTAL'].'</td>
                  </tr>
                  ';
              }
              $output .= '</table>';
              // Header for  Download
              // if (! headers_sent()) {
              header("Content-Type: application/xls");
              header("Content-Disposition: attachment; filename=OSR_SALES_REPORT".$date1.'-'.$date2.".xls");
              header("Pragma: no-cache");
              header("Expires: 0");
              // }
              // Render excel data file
              echo $output;
              // ob_end_flush();
              exit;
              } else {
                  echo "<script>alert('Empty Data for this Item Code');window.location='admin-osr-report.php'</script>";
              }  
          } 
      }


    // Reseller OSR sales and points
    if (isset($_POST['reseller_count'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));

        // Column Name
        $output = '
        <table class="table" bordered="1">
        <tr>
            <th>RANK</th>
            <th>RESELLER</th>
            <th>INVITE</th>
        <tr>
        ';

        // Display Column Names as First Row
        // $excelData = implode('\t', array_values($fields)).'\n';

        // Fetch Records From Database
        $export_sql = "SELECT upti_users.users_name ,COUNT(upti_reseller.reseller_main) AS reseller_count FROM upti_users INNER JOIN upti_reseller ON upti_users.users_code = upti_reseller.reseller_main WHERE upti_users.users_role = 'UPTIRESELLER' AND upti_reseller.reseller_date BETWEEN '$date1' AND '$date2' GROUP BY upti_users.users_code ORDER BY reseller_count DESC";
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);
        $number = 1;
        while($row = mysqli_fetch_array($export_qry)) {                
            $output .='
            <tr>
                <td>'.$number.'</td>
                <td>'.$row['users_name'].'</td>
                <td>'.$row['reseller_count'].'</td>
            </tr>
            ';
            $number++;
        }
        $output .= '</table>';
        // Header for  Download
        // if (! headers_sent()) {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=Reseller_Recruit".$date1.'-'.$date2.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        // }
        // Render excel data file
        echo $output;
        // ob_end_flush();
        exit;
    }
?>