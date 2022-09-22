<?php 
  include 'dbms/conn.php';

  session_start();
  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if(isset($_POST['export'])) {
    $newDate1 = $_POST['date1'];
    $date1 = date("m-d-Y", strtotime($newDate1));
    $newDate2 = $_POST['date2'];
    $date2 = date("m-d-Y", strtotime($newDate2));
    $country = $_POST['bansa'];
    $status = $_POST['status'];

    if ($status === '' && $country === '') {
      // echo 'empty';
      // Column Name
      // $output = '
      // <table class="table" border="1">
      //   <tr>
      //     <th>Date Order</th>
      //     <th>Date Delivered</th> 
      //     <th>POID</th> 
      //     <th>Country</th> 
      //     <th>State</th> 
      //     <th>Address</th>
      //     <th>Sales Amount</th>
      //     <th>Peso Amount</th> 
      //     <th>Status</th>
      //   <tr> 
      // ';
      $export_sql = mysqli_query($connect, "SELECT ol_date, activities_date, ol_poid, ol_country, ol_price, ol_php, activities_caption FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date ASC");
      $export_num = mysqli_num_rows($export_sql);

      if($export_num > 0) {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'DATE ORDER');
        $sheet->setCellValue('B1', 'DATE TRIGGERED');
        $sheet->setCellValue('C1', 'POID');
        $sheet->setCellValue('D1', 'COUNTRY');
        $sheet->setCellValue('E1', 'PRICE');
        $sheet->setCellValue('F1', 'PESO');
        $sheet->setCellValue('G1', 'STATUS');

        $RowCount = 2;

        foreach ($export_qry as $data) {
          $sheet->setCellValue('A'.$RowCount, $data['ol_date']);
          $sheet->setCellValue('B'.$RowCount, $data['activities_date']);
          $sheet->setCellValue('C'.$RowCount, $data['ol_poid']);
          $sheet->setCellValue('D'.$RowCount, $data['ol_country']);
          $sheet->setCellValue('E'.$RowCount, $data['ol_price']);
          $sheet->setCellValue('F'.$RowCount, $data['ol_php']);
          $sheet->setCellValue('G'.$RowCount, $data['activities_caption']);
          $RowCount++;
        }

        $writer = new Xlsx($spreadsheet);
        $final_name = 'All_Sales_Generated.xlsx';

        // $writer->save($final_name);
        header("Content-Type: application/vnd.openxmlformats-officedocument_spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="'.urlencode($final_name).'"');
        $writer->save('php://output');
        
      } 
    }
  }
?>