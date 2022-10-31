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
    SELECT users_code, users_name, ol_reseller, SUM(ol_php) AS total_sales FROM upti_order_list
    INNER JOIN upti_activities ON ol_poid = activities_poid
    INNER JOIN upti_users ON users_code = ol_reseller
    WHERE activities_caption = 'Order Delivered' AND
    activities_date BETWEEN '$date1' AND '$date2'
    GROUP BY users_code ORDER BY total_sales DESC
    ";
    $reseller_sales_qry = mysqli_query($connect, $reseller_sales);

    if (mysqli_num_rows($reseller_sales_qry))
    {
      $fileName = 'Reseller Sales Report';
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      // Column Name List
      $sheet->setCellValue('A1', 'UPPER LINE');
      // $sheet->setCellValue('B1', 'COUNTRY');
      $sheet->setCellValue('B1', 'RESELLER ID');
      $sheet->setCellValue('C1', 'RESELLER NAME');
      $sheet->setCellValue('D1', 'TOTAL SALES');

      $rowCount = 2;
      // data loop
      foreach ($reseller_sales_qry as $data) {

        $seller = $data['ol_reseller'];

        $check_reseller = mysqli_query($connect, "SELECT users_code, users_name, users_main FROM upti_users INNER JOIN upti_reseller  WHERE users_code = '$seller' AND users_role = 'UPTIRESELLER'");
        $check_fetch = mysqli_fetch_array($check_reseller);

        if (mysqli_num_rows($check_reseller) > 0) {
          $main = $check_fetch['users_main'];

          $rawr = mysqli_query($connect, "SELECT users_name FROM upti_users WHERE users_code = '$main'");

          $rawr_fetch = mysqli_fetch_array($rawr);

          $upperline = $rawr_fetch['users_name'];
        }

        $sheet->setCellValue('A'.$rowCount, $upperline);
        $sheet->setCellValue('B'.$rowCount, $data['ol_reseller']);
        $sheet->setCellValue('C'.$rowCount, $data['users_name']);
        $sheet->setCellValue('D'.$rowCount, $data['total_sales']);
        // $sheet->setCellValue('E'.$rowCount, $data['']);

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