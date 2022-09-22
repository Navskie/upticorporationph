<?php
  include 'dbms/conn.php';

  // $path = 'Code_Quantity_Report.xlsx';
  session_start();

  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if (isset($_POST['CQR'])) {
    $newDate1 = $_POST['date1'];
    $date1 = date("m-d-Y", strtotime($newDate1));
    $newDate2 = $_POST['date2'];
    $date2 = date("m-d-Y", strtotime($newDate2));
    $item_code = $_POST['item_code'];

    $code_stmt = mysqli_query($connect, "SELECT ol_poid, ol_seller, users_name, ol_country, ol_code, ol_qty FROM upti_order_list INNER JOIN upti_users ON ol_seller = users_code WHERE ol_code = '$item_code' AND ol_date BETWEEN '$date1' AND '$date2'");
    if (mysqli_num_rows($code_stmt))
    {
      $fileName = 'Code_Quantity_Report';
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      // Column Name List
      $sheet->setCellValue('A1', 'POID');
      $sheet->setCellValue('B1', 'SELLER CODE');
      $sheet->setCellValue('C1', 'SELLER NAME');
      $sheet->setCellValue('D1', 'COUNTRY');
      $sheet->setCellValue('E1', 'ITEM CODE');
      $sheet->setCellValue('F1', 'QTY');

      $rowCount = 2;
      // data loop
      foreach ($code_stmt as $data) {
        $sheet->setCellValue('A'.$rowCount, $data['ol_poid']);
        $sheet->setCellValue('B'.$rowCount, $data['ol_seller']);
        $sheet->setCellValue('C'.$rowCount, $data['users_name']);
        $sheet->setCellValue('D'.$rowCount, $data['ol_country']);
        $sheet->setCellValue('E'.$rowCount, $data['ol_code']);
        $sheet->setCellValue('F'.$rowCount, $data['ol_qty']);
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