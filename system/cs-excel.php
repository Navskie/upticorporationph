<?php
    session_start();
    include 'dbms/conn.php';

    $uid = $_SESSION['code'];

    $reseller_ = mysqli_query($connect, "SELECT * FROM upti_reseller WHERE reseller_code = '$uid'");
    $reseller__ = mysqli_fetch_array($reseller_);

    $country = $reseller__['reseller_country'];

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
        $export_sql = "SELECT trans_email, trans_mobile, trans_address, trans_office, trans_mop, trans_date, trans_name, trans_ref, cart_code, cart_qty, cart_price FROM web_cart INNER JOIN web_transaction ON web_cart.cart_ref = web_transaction.trans_ref WHERE trans_country = '$country' AND trans_status = 'Pending' AND trans_date BETWEEN '$date1' AND '$date2'";
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {

                $output .='
                    <tr>
                        <td>'.$row['trans_ref'].'</td>
                        <td>'.$row['trans_date'].'</td>
                        <td>'.$row['trans_name'].'</td>
                        <td>'.$row['trans_email'].'</td>
                        <td>'.$row['trans_address'].'</td>
                        <td>'.$row['trans_office'].'</td>
                        <td>'.$row['trans_mop'].'</td>
                        <td>'.$row['trans_mobile'].'</td>
                        <td>'.$row['cart_code'].'</td>
                        <td>'.$row['cart_qty'].'</td>
                        <td>'.$row['cart_price'].'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=CustomerPending_".$date1.'-'.$date2.".xls");
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