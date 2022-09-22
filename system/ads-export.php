<?php 
    session_start();

    include 'dbms/conn.php';
    include 'function.php';

    if (isset($_POST['eod'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $month = date("m", strtotime($newDate1));
        $year = date("m", strtotime($newDate1));
        $range1 = $month.'-01-'.$year;
        $range2 = $month.'-31-'.$year;

        $output = '
        <table class="table" bordered="1">
        <tr>
            <th>OSR Name</th>
            <th>Today Sales</th>
            <th>Pending Sales</th>
            <th>On Process Sales</th>
            <th>In Transit Sales</th>
            <th>Delivered Sales</th>
            <th>Total Sales</th>
            <th>Total Inquiries</th>
            <th>Total Ads Spent</th>
            <th>Total Ads MTD</th>
            <th>Total ROAS Daily</th>
            <th>Total ROAS MTD</th>
            <th>Total ROAS Delivered</th>
        <tr>
        ';

        $generate_EOD = mysqli_query($connect, "SELECT * FROM upti_users WHERE 
        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS111' OR 
        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS112' OR 
        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS113' OR
        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'RS114' OR
        users_role = 'UPTIOSR' AND users_status = 'Active' AND users_main = 'S2111'
        ORDER BY users_name ASC");

        while($eod = mysqli_fetch_array($generate_EOD)) {
            $osr = $eod['users_code'];

            // TODAY SALES
            $today = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' AND upti_transaction.trans_status = 'Pending' OR upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' AND upti_transaction.trans_status = 'In Transit' OR upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' AND upti_transaction.trans_status = 'On Process' OR  upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' AND upti_transaction.trans_status = 'Delivered'";
            $today_sql = mysqli_query($connect, $today);
            $today_fetch = mysqli_fetch_array($today_sql);

            $benta_ngayon = $today_fetch['total'];
            // echo '<br>';

            // PENDING SALES
            $pending = "SELECT SUM(ol_php) AS pendingsales FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_status = 'Pending' AND trans_seller = '$osr' AND trans_date BETWEEN '$date1' AND '$date2'";
            $pending_sql = mysqli_query($connect, $pending);
            $pending_fetch = mysqli_fetch_array($pending_sql);

            $pending_ngayon = $pending_fetch['pendingsales'];

            // IN TRANSIT SALES
            $intransit = "SELECT SUM(ol_php) AS intransitsales FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_status = 'In Transit' AND trans_seller = '$osr' AND trans_date BETWEEN '$date1' AND '$date2'";
            $intransit_sql = mysqli_query($connect, $intransit);
            $intransit_fetch = mysqli_fetch_array($intransit_sql);

            $intransit_ngayon = $intransit_fetch['intransitsales'];

            // ON PROCESS
            $onprocess = "SELECT SUM(ol_php) AS onprocesssales FROM upti_transaction INNER JOIN upti_order_list ON upti_transaction.trans_poid = upti_order_list.ol_poid WHERE trans_status = 'On Process' AND trans_seller = '$osr' AND trans_date BETWEEN '$date1' AND '$date2'";
            $onprocess_sql = mysqli_query($connect, $onprocess);
            $onprocess_fetch = mysqli_fetch_array($onprocess_sql);

            $onprocess_ngayon = $onprocess_fetch['onprocesssales'];

            // DELIVERED
            $delivered = "SELECT SUM(ol_php) AS deliveredsales FROM upti_activities INNER JOIN upti_order_list ON upti_activities.activities_poid = upti_order_list.ol_poid WHERE activities_caption = 'Order Delivered' AND ol_seller = '$osr' AND activities_date BETWEEN '$range1' AND '$range2'";
            $delivered_sql = mysqli_query($connect, $delivered);
            $delivered_fetch = mysqli_fetch_array($delivered_sql);

            $delivered_ngayon = $delivered_fetch['deliveredsales'];

            // TOTAL SALES
            $total_na_benta = $pending_ngayon + $onprocess_ngayon + $intransit_ngayon + $delivered_ngayon;

            // TOTAL INQUIRIES
            $inqui = "SELECT SUM(inq_number) AS inq FROM upti_inquiries WHERE inq_osr = '$osr' AND inq_date BETWEEN '$date1' AND '$date2'";
            $inqui_sql = mysqli_query($connect, $inqui);
            $inqui_fetch = mysqli_fetch_array($inqui_sql);

            $inqui_ngayon = $inqui_fetch['inq'];

            // SPENT
            $spent = "SELECT SUM(inq_ads) AS spent FROM upti_inquiries WHERE inq_osr = '$osr' AND inq_date BETWEEN '$date1' AND '$date2'";
            $spent_sql = mysqli_query($connect, $spent);
            $spent_fetch = mysqli_fetch_array($spent_sql);

            $spent_ngayon = $spent_fetch['spent'];

            // MTD
            $mtd = "SELECT SUM(inq_mtd) AS mtd FROM upti_inquiries WHERE inq_osr = '$osr' AND inq_date BETWEEN '$date1' AND '$date2'";
            $mtd_sql = mysqli_query($connect, $mtd);
            $mtd_fetch = mysqli_fetch_array($mtd_sql);

            $mtd_ngayon = $mtd_fetch['mtd'];

            // ROAS
            if($benta_ngayon == 0 && $spent_ngayon != 0) {
                $DailyROAS = 0;
            } elseif ($benta_ngayon != 0 && $spent_ngayon == 0) {
                $DailyROAS = 0;
            } elseif ($benta_ngayon == 0 && $spent_ngayon == 0) {
                $DailyROAS = 0;
            } else {
                $DailyROAS = $benta_ngayon / $spent_ngayon;
            }

            if($total_na_benta == 0 && $mtd_ngayon != 0) {
                $MtdROAS = 0;
            } elseif ($total_na_benta != 0 && $mtd_ngayon == 0) {
                $MtdROAS = 0;
            } elseif ($total_na_benta == 0 && $mtd_ngayon == 0) {
                $MtdROAS = 0;
            } else {
                $MtdROAS = $total_na_benta / $mtd_ngayon;
            }

            if($mtd_ngayon == 0 && $delivered_ngayon != 0) {
                $DeliveredROAS = 0;
            } elseif ($mtd_ngayon != 0 && $delivered_ngayon == 0) {
                $DeliveredROAS = 0;
            } elseif ($mtd_ngayon == 0 && $delivered_ngayon == 0) {
                $DeliveredROAS = 0;
            } else {
                $DeliveredROAS = $delivered_ngayon / $mtd_ngayon;
            }

            $output .='
            <tr>
                <td>'.$eod['users_name'].'</td>
                <td>'.$benta_ngayon.'</td>
                <td>'.$pending_ngayon.'</td>
                <td>'.$onprocess_ngayon.'</td>
                <td>'.$intransit_ngayon.'</td>
                <td>'.$delivered_ngayon.'</td>
                <td>'.$total_na_benta.'</td>
                <td>'.$inqui_ngayon.'</td>
                <td>'.$spent_ngayon.'</td>
                <td>'.$mtd_ngayon.'</td>
                <td>'.number_format($DailyROAS, 2, '.', '').'</td>
                <td>'.number_format($MtdROAS, 2, '.', '').'</td>
                <td>'.number_format($DeliveredROAS, 2, '.', '').'</td>
            </tr>
            ';
        }
        $output .= '</table>';

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=EOD_Reports_".$date1.'-'.$date2.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $output;

        exit;
    }
?>