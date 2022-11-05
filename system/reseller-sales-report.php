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
                <th>Upperline</th>
                <th>Country</th>
                <th>Reseller Id</th> 
                <th>Reseller Name</th> 
                <th>Total</th> 
            <tr> 
        ';
        
        $export_sql = "SELECT users_code, users_name, ol_seller, ol_country FROM upti_order_list
        INNER JOIN upti_activities ON ol_poid = activities_poid
        INNER JOIN upti_users ON users_code = ol_reseller
        WHERE activities_caption = 'Order Delivered' AND
        activities_date BETWEEN '$date1' AND '$date2'
        GROUP BY users_code";

        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $sellers = $row['ol_seller'];

                $get_true = mysqli_query($connect, "SELECT * FROM upti_users WHERE users_code = '$sellers' AND users_role = 'UPTIOSR'");
                $get_true_fetch = mysqli_fetch_array($get_true);
                if (mysqli_num_rows($get_true) > 0) {
                    $seller = $get_true_fetch['users_main'];
                    // echo '<br>';

                    $get_sales = mysqli_query($connect, "
                    SELECT SUM(ol_php) AS total_sales FROM upti_order_list 
                    INNER JOIN upti_activities ON activities_poid = ol_poid 
                    WHERE 
                    activities_caption = 'Order Delivered' AND 
                    ol_reseller = '$seller' AND 
                    ol_seller LIKE '%OSR%' 
                    AND activities_date BETWEEN '$date1' AND '$date2'
                    ");
                    $get_sales_fetch = mysqli_fetch_array($get_sales);

                    $sales = $tot = $get_sales_fetch['total_sales'];
                    // echo '<br>';
                } else {
                    $seller = $row['ol_seller'];
                    // echo '<br>';

                    $get_sales = mysqli_query($connect, "
                    SELECT SUM(ol_php) AS total_sales FROM upti_order_list 
                    INNER JOIN upti_activities ON activities_poid = ol_poid 
                    WHERE 
                    activities_caption = 'Order Delivered' AND 
                    ol_reseller = '$seller' AND 
                    ol_seller LIKE '%R%' 
                    AND activities_date BETWEEN '$date1' AND '$date2'
                    ");
                    $get_sales_fetch = mysqli_fetch_array($get_sales);

                    $sales = $tot = $get_sales_fetch['total_sales'];
                    // echo '<br>';
                }

                $check_reseller = mysqli_query($connect, "SELECT users_code, users_name, users_main, reseller_country FROM upti_users INNER JOIN upti_reseller  WHERE users_code = '$sellers' AND users_role = 'UPTIRESELLER'");
                $data = mysqli_fetch_array($check_reseller);
        
                if (mysqli_num_rows($check_reseller) > 0) {
                  $main = $data['users_main'];
        
                  $rawr = mysqli_query($connect, "SELECT users_name FROM upti_users WHERE users_code = '$main'");
        
                  $rawr_fetch = mysqli_fetch_array($rawr);
        
                  $upperline = $rawr_fetch['users_name'];
                }
                $output .='
                    <tr>
                        <td>'.$upperline.'</td>
                        <td>'.$row['ol_country'].'</td>
                        <td>'.$seller.'</td>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales.'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=ResellerSales".$date1.'-'.$date2.".xls");
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