<?php

include 'dbms/conn.php';

session_start();

 // Column Name
 $output = '
 <table class="table" bordered="1">
 <tr>
     <th>USER</th>
     <th>SALES</th>
 <tr>
';

// Fetch Records From Database
echo $export_sql = "SELECT * FROM upti_users WHERE users_role = 'UPTIRESELLER' AND users_status = 'Active'";
// $export_sql = "SELECT * FROM upti_transaction";
// echo '<br>';
$export_qry = mysqli_query($connect, $export_sql);
$export_num = mysqli_num_rows($export_qry);

if($export_num > 0) {
 while($row = mysqli_fetch_array($export_qry)) {
         $check_poid = $row['users_code'];

         $check_trigger = "SELECT SUM(ol_php) AS total_sales FROM upti_activities INNER JOIN upti_order_list ON ol_poid = activities_poid WHERE ol_reseller = '$check_poid' AND activities_caption = 'Order Delivered'";
         $check_trigger_sql = mysqli_query($connect, $check_trigger);
         $check_trigger_fetch = mysqli_fetch_array($check_trigger_sql);
     $output .='
     <tr>
         <td>'.$row['users_code'].'</td>
         <td>'.$check_trigger_fetch['total_sales'].'</td>
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