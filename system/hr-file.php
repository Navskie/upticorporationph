<?php
    include 'dbms/conn.php';

    session_start();

    // Reseller OSR sales and points
    if (isset($_POST['export'])) {

        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        echo $status = $_POST['status'];
        echo $bansa = $_POST['bansa'];

        // Column Name
        $output = '
        <table class="table" bordered="1">
        <tr>
            <th>OSR</th>
            <th>POID</th>
            <th>COUNTRY</th>
            <th>STATE</th>
            <th>DATE</th>
            <th>CUSTOMER NAME</th>
            <th>AMOUNT</th>
            <th>PESO</th>
            <th>QTY</th>
            <th>CODE</th>
            <th>STATUS</th>
        <tr>
        ';

        if ($bansa == '' && $status == '') {
            // Fetch Records From Database
            $export_sql = "SELECT users_name, users_code FROM upti_users WHERE users_role ='UPTIOSR'";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            while($row = mysqli_fetch_array($export_qry)) {    
                $code = $row['users_code'];
                
                $get_trans = mysqli_query($connect, "SELECT ol_qty, trans_state, trans_subtotal, trans_poid, trans_country, trans_date, trans_fname, trans_status, ol_php, ol_code FROM upti_transaction INNER JOIN upti_order_list ON ol_poid = trans_poid INNER JOIN upti_activities ON activities_poid = trans_poid WHERE trans_seller = '$code' AND activities_caption = 'Order Delivered' AND activities_date BETWEEN '$date1' AND '$date2'");

                while ($sales = mysqli_fetch_array($get_trans)) {
                    $output .='
                    <tr>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales['trans_poid'].'</td>
                        <td>'.$sales['trans_country'].'</td>
                        <td>'.$sales['trans_state'].'</td>
                        <td>'.$sales['trans_date'].'</td>
                        <td>'.$sales['trans_fname'].'</td>
                        <td>'.$sales['trans_subtotal'].'</td>
                        <td>'.$sales['ol_php'].'</td>
                        <td>'.$sales['ol_qty'].'</td>
                        <td>'.$sales['ol_code'].'</td>
                        <td>'.$sales['trans_status'].'</td>
                    </tr>
                    ';
                }
                
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=OSR_sales".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } elseif (!empty($bansa) AND !empty($status)) {
            // echo 1;
            // Fetch Records From Database
            $export_sql = "SELECT users_name, users_code FROM upti_users WHERE users_role ='UPTIOSR'";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            while($row = mysqli_fetch_array($export_qry)) {    
                $code = $row['users_code'];
                
                $get_trans = mysqli_query($connect, "SELECT SUM(ol_php) AS salesto, trans_state, trans_subtotal, trans_poid, trans_country, trans_date, trans_fname, trans_status FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_country = '$bansa' AND trans_status = '$status' AND trans_seller = '$code' AND trans_date BETWEEN '$date1' AND '$date2' GROUP BY trans_poid");

                while ($sales = mysqli_fetch_array($get_trans)) {
                    $output .='
                    <tr>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales['trans_poid'].'</td>
                        <td>'.$sales['trans_country'].'</td>
                        <td>'.$sales['trans_state'].'</td>
                        <td>'.$sales['trans_date'].'</td>
                        <td>'.$sales['trans_fname'].'</td>
                        <td>'.$sales['trans_subtotal'].'</td>
                        <td>'.$sales['salesto'].'</td>
                        <td>'.$sales['trans_status'].'</td>
                    </tr>
                    ';

                }
                
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=OSR_sales".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } else {
          echo 'System Error ';
        }
    }
?>