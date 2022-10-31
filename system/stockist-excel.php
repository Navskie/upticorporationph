<?php
    session_start();
    include 'dbms/conn.php';

    $uid = $_SESSION['code'];

    $reseller_ = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$uid'");
    $reseller__ = mysqli_fetch_array($reseller_);

    $country = $reseller__['stockist_country'];
    $state = $reseller__['stockist_state'];

    if (isset($_POST['export'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
             
        // Column Name
        $output = '
            <table class="table" border="1">
            <tr>
                <th>Poid</th>
                <th>Date</th>
                <th>Reseller Name</th> 
                <th>Customer Name</th> 
                <th>Email</th> 
                <th>Address</th> 
                <th>Delivery Option</th>
                <th>Mode of Payment</th>
                <th>Mobile Number</th> 
                <th>Item Code</th>
                <th>Quantity</th>
                <th>Price</th> 
            <tr> 
        ';

        // Fetch Records From Database
        if ($country == 'CANADA') {
          if ($state == 'ALBERTA') {
            $export_sql = "SELECT trans_state, trans_email, trans_contact, trans_address, trans_office, trans_mop, ol_date, trans_fname, ol_poid, ol_seller, ol_code, ol_qty, ol_price FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE trans_country = '$country' AND trans_state = '$state' AND trans_status = 'Pending' AND trans_date BETWEEN '$date1' AND '$date2'";
          } else {
            $export_sql = "SELECT trans_state, trans_email, trans_contact, trans_address, trans_office, trans_mop, ol_date, trans_fname, ol_poid, ol_seller, ol_code, ol_qty, ol_price FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE trans_country = '$country' AND trans_state != 'ALBERTA' AND trans_status = 'Pending' AND trans_date BETWEEN '$date1' AND '$date2'";
          }
        } else {
          $export_sql = "SELECT trans_state, trans_email, trans_contact, trans_address, trans_office, trans_mop, ol_date, trans_fname, ol_poid, ol_seller, ol_code, ol_qty, ol_price FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE trans_country = '$country' AND trans_state = '$state' AND trans_status = 'Pending' AND trans_date BETWEEN '$date1' AND '$date2'";
        }
        
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $seller = $row['ol_seller'];
                        
                $get_seller = "SELECT users_name FROM upti_users WHERE users_code = '$seller'";
                $get_seller_qry = mysqli_query($connect, $get_seller);
                $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                $output .='
                    <tr>
                        <td>'.$row['ol_poid'].'</td>
                        <td>'.$row['ol_date'].'</td>
                        <td>'.$get_seller_fetch['users_name'].'</td>
                        <td>'.$row['trans_state'].'</td>
                        <td>'.$row['trans_fname'].'</td>
                        <td>'.$row['trans_email'].'</td>
                        <td>'.$row['trans_address'].'</td>
                        <td>'.$row['trans_office'].'</td>
                        <td>'.$row['trans_mop'].'</td>
                        <td>'.$row['trans_contact'].'</td>
                        <td>'.$row['ol_code'].'</td>
                        <td>'.$row['ol_qty'].'</td>
                        <td>'.$row['ol_price'].'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=Pending_".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        }
    }   
                    
?>