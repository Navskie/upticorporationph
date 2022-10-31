<?php
  include 'dbms/conn.php';

  // $path = 'Code_Quantity_Report.xlsx';
  session_start();

  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if (isset($_POST['export'])) {
    $newDate1 = $_POST['date1'];
    $date1 = date("m-d-Y", strtotime($newDate1));
    $newDate2 = $_POST['date2'];
    $date2 = date("m-d-Y", strtotime($newDate2));

    $reseller_sales = "
    SELECT ol_seller, ol_poid, activities_date, ol_country, ol_php, ol_price  FROM upti_order_list
    INNER JOIN upti_activities ON activities_poid = ol_poid
    WHERE activities_caption = 'Order Delivered' AND activities_date BETWEEN '$date1' AND '$date2';
    ";
    $reseller_sales_qry = mysqli_query($connect, $reseller_sales);

    if (mysqli_num_rows($reseller_sales_qry))
    {
      $fileName = 'Sales Report';
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      // Column Name List
      $sheet->setCellValue('A1', 'ORDER DATE');
      $sheet->setCellValue('B1', 'TRIGGER DATE');
      $sheet->setCellValue('D1', 'SELLER ID');
      $sheet->setCellValue('E1', 'POID');
      $sheet->setCellValue('F1', 'COUNTRY');
      $sheet->setCellValue('G1', 'STATE');
      $sheet->setCellValue('H1', 'ADDRESS');
      $sheet->setCellValue('I1', 'PRICE');
      $sheet->setCellValue('J1', 'PESO');
      $sheet->setCellValue('K1', 'STATUS');

      $rowCount = 2;
      // data loop
      foreach ($reseller_sales_qry as $data) {

        $poid = $data['ol_poid'];

        $transaction = mysqli_query($connect, "SELECT trans_date, trans_address, trans_state, trans_status FROM upti_transaction WHERE trans_poid = '$poid'");

        $datas = mysqli_fetch_array($transaction);

        $sheet->setCellValue('A'.$rowCount, $datas['trans_date']);
        $sheet->setCellValue('B'.$rowCount, $data['activities_date']);
        $sheet->setCellValue('C'.$rowCount, $data['ol_seller']);
        $sheet->setCellValue('D'.$rowCount, $data['ol_poid']);
        $sheet->setCellValue('E'.$rowCount, $data['ol_country']);
        $sheet->setCellValue('F'.$rowCount, $datas['trans_state']);
        $sheet->setCellValue('G'.$rowCount, $datas['trans_address']);
        $sheet->setCellValue('H'.$rowCount, $data['ol_price']);
        $sheet->setCellValue('I'.$rowCount, $data['ol_php']);
        $sheet->setCellValue('J'.$rowCount, $datas['trans_status']);

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