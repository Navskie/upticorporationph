<?php
    // Export Code
    if (isset($_POST['export_refund'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $country = $_POST['country'];

        if ($country == '') {

        } else {
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
        }
             
    }
?>