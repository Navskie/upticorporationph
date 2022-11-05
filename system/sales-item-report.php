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
             
        // Column 
        $output = '
            <table class="table" border="1">
            <tr>
                <th>ORDER DATE</th>
                <th>DATE TRIGGER</th>
                <th>SELLER ID</th> 
                <th>POID</th> 
                <th>COUNTRY</th> 
                <th>STATE</th>
                <th>ADDRESS</th>
                <th>PRICE</th> 
                <th>PESO</th> 
                <th>STATUS</th> 
            <tr> 
        ';
        
        echo $export_sql = "SELECT ol_seller, ol_poid, activities_date, ol_country, ol_php, ol_price  FROM upti_order_list
        INNER JOIN upti_activities ON activities_poid = ol_poid
        WHERE activities_caption = 'Order Delivered' AND activities_date BETWEEN '$date1' AND '$date2'";

        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $poid = $row['ol_poid'];
                $transaction = mysqli_query($connect, "SELECT trans_date, trans_address, trans_state, trans_status FROM upti_transaction WHERE trans_poid = '$poid'");
                $datas = mysqli_fetch_array($transaction);
                $output .='
                    <tr>
                        <td>'.$datas['trans_date'].'</td>
                        <td>'.$row['activities_date'].'</td>
                        <td>'.$row['ol_seller'].'</td>
                        <td>'.$row['ol_poid'].'</td>
                        <td>'.$row['ol_country'].'</td>
                        <td>'.$datas['trans_state'].'</td>
                        <td>'.$datas['trans_address'].'</td>
                        <td>'.$row['ol_price'].'</td>
                        <td>'.$row['ol_php'].'</td>
                        <td>'.$datas['trans_status'].'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=SalesItems".$date1.'-'.$date2.".xls");
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