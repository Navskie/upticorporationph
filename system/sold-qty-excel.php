<?php
  include 'dbms/conn.php';

  // $path = 'Code_Quantity_Report.xlsx';
  session_start();

  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if (isset($_POST['SQR'])) {
    $newDate1 = $_POST['date1'];
    $date1 = date("m-d-Y", strtotime($newDate1));
    $newDate2 = $_POST['date2'];
    $date2 = date("m-d-Y", strtotime($newDate2));
    $country = $_POST['country'];
    $status = $_POST['status'];

    if ($status === '' && $country === '') {
      $code_stmt = mysqli_query($connect, "SELECT ol_php, ol_date, users_name, ol_poid, ol_country, ol_desc, ol_qty, ol_status FROM upti_order_list INNER JOIN upti_users ON ol_seller = users_code WHERE ol_date BETWEEN '$date1' AND '$date2'
      ");
    } elseif ($status !== 'Order Delivered' && $country === '') {

    } elseif ($status === 'Order Delivered' && $country === '') {

    } elseif ($status !== 'Order Delivered' && $country === '') {

    } elseif ($status === 'Order Delivered' && $country === '') {

    }

    if (mysqli_num_rows($code_stmt))
    {
      $fileName = 'Sold_Quantity_Report';
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      // Column Name List
      $sheet->setCellValue('A1', 'DATE ORDER');
      $sheet->setCellValue('B1', 'DATE TRIGGERED');
      $sheet->setCellValue('C1', 'SELLER NAME');
      $sheet->setCellValue('D1', 'POID');
      $sheet->setCellValue('E1', 'COUNTRY');
      $sheet->setCellValue('F1', 'DESCRIPTION');
      $sheet->setCellValue('G1', 'QTY');
      $sheet->setCellValue('H1', 'PESO');
      $sheet->setCellValue('I1', 'STATUS');

      $rowCount = 2;
      // data loop
      foreach ($code_stmt as $data) {
        $poid = $data['ol_poid'];
        $status = mysqli_query($connect, "SELECT activities_date FROM upti_activities WHERE activities_poid = '$poid' AND activities_caption = 'Order Delivered'");
        $status_fetch = mysqli_fetch_array($status);

        if (mysqli_num_rows($status) > 0) {
          $date_triggered = $status_fetch['activities_date'];
        } else {
          $date_triggered = '';
        }

        $sheet->setCellValue('A'.$rowCount, $data['ol_date']);
        $sheet->setCellValue('B'.$rowCount, $date_triggered);
        $sheet->setCellValue('C'.$rowCount, $data['users_name']);
        $sheet->setCellValue('D'.$rowCount, $data['ol_poid']);
        $sheet->setCellValue('E'.$rowCount, $data['ol_country']);
        $sheet->setCellValue('F'.$rowCount, $data['ol_desc']);
        $sheet->setCellValue('G'.$rowCount, $data['ol_qty']);
        $sheet->setCellValue('H'.$rowCount, $data['ol_php']);
        $sheet->setCellValue('I'.$rowCount, $data['ol_status']);
        $rowCount++;
      }

      $writer = new Xlsx($spreadsheet);
      $new_FileName = $fileName.'.xlsx';

      // $writer->save($new_FileName);

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="'.urlencode($new_FileName).'"');
      $writer->save('php://output');
    }
    else
    {
      echo 'no record found.';
    }
  }
?>