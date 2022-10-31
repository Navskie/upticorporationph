<?php 
  include 'dbms/conn.php';

  session_start();
  
  $code = $_SESSION['code'];
  
  $my_account = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$code'");
  $account_f = mysqli_fetch_array($my_account);
  
  $country = $account_f['stockist_country'];
  $state = $account_f['stockist_state'];

  // require 'vendor/autoload.php';

  // use PhpOffice\PhpSpreadsheet\Spreadsheet;
  // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if (isset($_POST['export_sales'])) {
    $newDate1 = $_POST['date1'];
    $date1 = date("m-d-Y", strtotime($newDate1));
    $newDate2 = $_POST['date2'];
    $date2 = date("m-d-Y", strtotime($newDate2));

    // $export_sql = mysqli_query($connect, "SELECT ol_date, activities_date, ol_poid, ol_country, ol_price, ol_php, activities_caption FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC");
    // $export_num = mysqli_num_rows($export_sql);

    // if($export_num > 0) {
    //   $spreadsheet = new Spreadsheet;
    //   $sheet = $spreadsheet->getActiveSheet();

    //   $sheet->setCellValue('A1', 'DATE ORDER');
    //   $sheet->setCellValue('B1', 'DATE TRIGGERED');
    //   $sheet->setCellValue('C1', 'POID');
    //   $sheet->setCellValue('D1', 'COUNTRY');
    //   $sheet->setCellValue('E1', 'PRICE');
    //   $sheet->setCellValue('F1', 'PESO');
    //   $sheet->setCellValue('G1', 'STATUS');

    //   $RowCount = 2;

    //   foreach ($export_qry as $data) {
    //     $sheet->setCellValue('A'.$RowCount, $data['ol_date']);
    //     $sheet->setCellValue('B'.$RowCount, $data['activities_date']);
    //     $sheet->setCellValue('C'.$RowCount, $data['ol_poid']);
    //     $sheet->setCellValue('D'.$RowCount, $data['ol_country']);
    //     $sheet->setCellValue('E'.$RowCount, $data['ol_price']);
    //     $sheet->setCellValue('F'.$RowCount, $data['ol_php']);
    //     $sheet->setCellValue('G'.$RowCount, $data['activities_caption']);
    //     $RowCount++;
    //   }

    //   $writer = new Xlsx($spreadsheet);
    //   $final_name = 'Generated Sales.xlsx';

    //   // $writer->save($final_name);
    //   header("Content-Type: application/vnd.openxmlformats-officedocument_spreadsheetml.sheet");
    //   header('Content-Disposition: attachment; filename="'.urlencode($final_name).'"');
    //   $writer->save('php://output');
      
    // } 
    // Column Name
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
        <th>$ Sales Amount</th>
        <th>Php Sales Amount</th>
        <th>Status</th>
    <tr>
';

// Display Column Names as First Row
// $excelData = implode('\t', array_values($fields)).'\n';
if ($country == 'CANADA') {
  if ($state == 'ALBERTA') {
    // Fetch Records From Database
    $export_sql = "SELECT trans_state, activities_date, ol_date, ol_seller, ol_poid, ol_country, ol_subtotal, ol_php, ol_status FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid INNER JOIN upti_transaction ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_transaction.trans_state = 'ALBERTA' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
  } else {
    // Fetch Records From Database
    $export_sql = "SELECT trans_state, activities_date, ol_date, ol_seller, ol_poid, ol_country, ol_subtotal, ol_php, ol_status FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid INNER JOIN upti_transaction ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_transaction.trans_state != 'ALBERTA' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
  }
} else {
  // Fetch Records From Database
  $export_sql = "SELECT trans_state, activities_date, ol_date, ol_seller, ol_poid, ol_country, ol_subtotal, ol_php, ol_status FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid INNER JOIN upti_transaction ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC";
}

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
?>