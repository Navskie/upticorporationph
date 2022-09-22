<?php
  include 'dbms/conn.php';

  session_start();

  // Reseller OSR sales and points
  if (isset($_POST['ph'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'PHILIPPINES' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Philippines_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['kr'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'KOREA' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Korea_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['jp'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'JAPAN' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Japan_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['tw'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'TAIWAN' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Taiwan_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['cnd'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'CANADA' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Canada_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['hk'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'HONGKONG' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Hongkong_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['sg'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'SINGAPORE' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Singapore_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }

  if (isset($_POST['uae'])) {
    $date1 = date('m-d-Y');

      // Column Name
      $output = '
      <table class="table" bordered="1">
      <tr>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>STOCKS</th>
      <tr>
      ';

      // Display Column Names as First Row
      // $excelData = implode('\t', array_values($fields)).'\n';

      // Fetch Records From Database
      $export_sql = "SELECT * FROM stockist_inventory WHERE si_item_country = 'UNITED ARAB EMIRATES' AND si_item_desc != ''";
      // echo '<br>';
      $export_qry = mysqli_query($connect, $export_sql);
      $export_num = mysqli_num_rows($export_qry);
      $number = 1;
      while($row = mysqli_fetch_array($export_qry)) {                
          $output .='
          <tr>
              <td>'.$row['si_item_code'].'</td>
              <td>'.$row['si_item_desc'].'</td>
              <td>'.$row['si_item_stock'].'</td>
          </tr>
          ';
          $number++;
      }
      $output .= '</table>';
      // Header for  Download
      // if (! headers_sent()) {
      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=Uae_stock_".$date1.".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      // }
      // Render excel data file
      echo $output;
      // ob_end_flush();
      exit;
  }
?>