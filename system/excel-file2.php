<?php
    include 'dbms/conn.php';

    session_start();
// OSR SALES
    if (isset($_POST['asd'])) {
    //     $newDate1 = $_POST['date1'];
    //     $date1 = date("m-d-Y", strtotime($newDate1));
    //     $newDate2 = $_POST['date2'];
    //     $date2 = date("m-d-Y", strtotime($newDate2));
    //     $number = 1;
    //      $output = '
    //             <table class="table" bordered="1">
    //             <tr>
    //                 <th>OSR Name</th>
    //                 <th>Sales</th>
    //                 <th>Points</th>
    //             <tr>
    //         ';

    //         // Display Column Names as First Row
    //         // $excelData = implode('\t', array_values($fields)).'\n';

    //         // Fetch Records From Database
    //         $export_sql = "SELECT *, SUM(upti_order_list.ol_php) AS SALES, SUM(upti_order_list.ol_points) AS POINTS FROM upti_users INNER JOIN upti_order_list ON upti_users.users_code = upti_order_list.ol_seller INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS114' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS113' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS112' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS111' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' GROUP BY upti_users.users_code ORDER BY TOTAL DESC";
    //         // echo '<br>';
    //         $export_qry = mysqli_query($connect, $export_sql);
    //         $export_num = mysqli_num_rows($export_qry);

    //         while($row = mysqli_fetch_array($export_qry)) {
    //             $output .='
    //                 <tr>
    //                     <td>'.$row['users_name'].'</td>
    //                     <td>'.$row['SALES'].'</td>
    //                     <td>'.$row['POINTS'].'</td>
    //                 </tr>
    //             ';
    //         }
    //         $output .= '</table>';
    //         // Header for  Download
    //         // if (! headers_sent()) {
    //         header("Content-Type: application/xls");
    //         header("Content-Disposition: attachment; filename=Sales_Report_".$date1.'-'.$date2.".xls");
    //         header("Pragma: no-cache");
    //         header("Expires: 0");
    //         // }
    //         // Render excel data file
    //         echo $output;
    //         // ob_end_flush();
    //         exit;
    echo $item_sql = "SELECT users_name, SUM(ol_php) AS TOTAL, SUM(ol_points) AS POINTS FROM upti_users INNER JOIN upti_order_list ON upti_users.users_code = upti_order_list.ol_seller INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS114' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS113' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS112' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' OR upti_users.users_role = 'UPTIOSR' AND upti_users.users_main = 'RS111' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '05-01-2022' AND '05-31-2022' GROUP BY upti_users.users_code ORDER BY TOTAL DESC";
       $item_qry = mysqli_query($connect, $item_sql);
       echo $check = mysqli_num_rows($item_qry);
    }
?>