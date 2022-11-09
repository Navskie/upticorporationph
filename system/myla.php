<?php

include 'dbms/conn.php';

session_start();

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
     <th>State</th>
     <th>Item Code</th>
     <th>Item Description</th>
     <th>Quantity</th>
     <th>Price</th>
     <th>Peso</th>
     <th>Status</th>
 <tr>
';

// Fetch Records From Database
echo $export_sql = "SELECT ol_php, ol_price, trans_date, trans_poid, trans_state, ol_code, ol_desc, ol_qty, trans_country, trans_status, trans_seller FROM upti_transaction
INNER JOIN upti_order_list ON trans_poid = ol_poid
INNER JOIN upti_activities ON activities_poid = trans_poid
WHERE 
activities_caption = 'Order Delivered' AND 
trans_state = 'ALBERTA' AND 
activities_date BETWEEN '10-01-2022' AND '10-31-2022' 
ORDER BY activities_date ASC";
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
         <td>'.$row['trans_state'].'</td>
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