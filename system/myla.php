<?php

include 'dbms/conn.php';

session_start();

if (isset($_POST['export'])) {
    $newDate1 = $_POST['date1'];
$date1 = date("m-d-Y", strtotime($newDate1));
$newDate2 = $_POST['date2'];
$date2 = date("m-d-Y", strtotime($newDate2));

 // Column Name
 $output = '
 <table class="table" bordered="1">
 <tr>
     <th>Date Ordered</th>
     <th>Date Delivered</th>
     <th>Seller ID</th>
     <th>Seller Name</th>
     <th>Country</th>
     <th>State</th>
     <th>POID</th>
     <th>Item Code</th>
     <th>Item Description</th>
     <th>Item Qty</th>
     <th>Price ($)</th>
     <th>Price (P)</th>
     <th>Status</th>
 <tr>
';

// Fetch Records From Database
$export_sql = "SELECT ol_poid, ol_php, ol_price, ol_country, ol_seller, ol_code, ol_qty, ol_desc, activities_date FROM upti_order_list INNER JOIN upti_activities ON ol_poid = activities_poid WHERE activities_caption = 'Order Delivered' AND activities_date BETWEEN '10-01-2022' AND '10-31-2022'";
$export_sql_qry = mysqli_query($connect, $export_sql);

foreach ($export_sql_qry as $data) {
    $ol_poid = $data['ol_poid'];
    // echo ' - ';
    $ol_php = $data['ol_php'];
    // echo ' - ';
    $ol_price = $data['ol_price'];
    // echo '<br>';

    $ol_country = $data['ol_country'];
    $ol_seller = $data['ol_seller'];
    $ol_code = $data['ol_code'];
    $ol_desc = $data['ol_desc'];
    $ol_qty = $data['ol_qty'];

    $activities_date = $data['activities_date'];

    $username = mysqli_query($connect, "SELECT users_name FROM upti_users WHERE users_code = '$ol_seller'");
    $username_fetch = mysqli_fetch_array($username);

    $users_name = $username_fetch['users_name'];

    $transaction = mysqli_query($connect, "SELECT trans_status, trans_state, trans_date FROM upti_transaction WHERE trans_poid = '$ol_poid'");
    $transaction_fetch = mysqli_fetch_array($transaction);

    $trans_status = $transaction_fetch['trans_status'];
    $trans_date = $transaction_fetch['trans_date'];
    $trans_state = $transaction_fetch['trans_state'];

    $output .='
        <tr>
            <td>'.$trans_date.'</td>
            <td>'.$activities_date.'</td>
            <td>'.$ol_seller.'</td>
            <td>'.$ol_country.'</td>
            <td>'.$users_name.'</td>
            <td>'.$trans_state.'</td>
            <td>'.$ol_poid.'</td>
            <td>'.$ol_code.'</td>
            <td>'.$ol_desc.'</td>
            <td>'.$ol_qty.'</td>
            <td>'.$ol_price.'</td>
            <td>'.$ol_php.'</td>
            <td>'.$trans_status.'</td>
        </tr>
        ';
    }
    $output .= '</table>';
    // Header for  Download
    // if (! headers_sent()) {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=SALES_REPORT".$date1.'-'.$date2.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    // }
    // Render excel data file
    echo $output;
    // ob_end_flush();
    exit;
}


// // $export_sql = "SELECT * FROM upti_transaction";
// // echo '<br>';
// $export_qry = mysqli_query($connect, $export_sql);
// $export_num = mysqli_num_rows($export_qry);

// if($export_num > 0) {
//  while($row = mysqli_fetch_array($export_qry)) {
//          $check_poid = $row['users_code'];
//          $check_trigger = "SELECT SUM(ol_php) AS total_sales FROM upti_activities INNER JOIN upti_order_list ON ol_poid = activities_poid WHERE ol_reseller = '$check_poid' AND activities_caption = 'Order Delivered'";
//          $check_trigger_sql = mysqli_query($connect, $check_trigger);
//          $check_trigger_fetch = mysqli_fetch_array($check_trigger_sql);
//      $output .='
//      <tr>
//          <td>'.$row['users_code'].'</td>
//          <td>'.$check_trigger_fetch['total_sales'].'</td>
//      </tr>
//      ';
//  }
//  $output .= '</table>';
//  // Header for  Download
//  // if (! headers_sent()) {
//  header("Content-Type: application/xls");
//  header("Content-Disposition: attachment; filename=SQ_".$date1.'-'.$date2.".xls");
//  header("Pragma: no-cache");
//  header("Expires: 0");
//  // }
//  // Render excel data file
//  echo $output;
//  // ob_end_flush();
//  exit;
// }   