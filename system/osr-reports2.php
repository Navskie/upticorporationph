<?php include 'include/header.php'; ?>
<?php //include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Account List</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
        $mycode = $_SESSION['code'];       

        if (isset($_POST['country'])) {
            $newDate1 = $_POST['date1'];
            $date1 = date("m-d-Y", strtotime($newDate1));
            $newDate2 = $_POST['date2'];
            $date2 = date("m-d-Y", strtotime($newDate2));
            $status = $_POST['status'];
            $osr = $_POST['osr'];
            $country = $_POST['countrys'];
            // echo '<br>';

            if ($status == 'Delivered' AND !empty($osr) AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_activities.activities_caption = 'Order Delivered' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'Delivered' AND empty($osr) AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_reseller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_reseller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_reseller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'Pending' AND empty($osr) AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_php) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'In Transit' AND empty($osr) AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_php) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'On Process' AND empty($osr) AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_php) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_reseller = '$mycode' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'RTS') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_reseller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_reseller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_reseller = '$mycode' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'RTS' AND !empty($osr) AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_seller = '$osr' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_seller = '$osr' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_seller = '$osr' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'Pending' AND $osr != '' AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'Pending' AND $osr != '' AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'In Transit' AND $osr != '' AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'On Process' AND $osr != '' AND empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'Pending' AND $osr != '' AND $country != '') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'On Process' AND $osr != '' AND $country != '') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'On Process' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'Pending' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'In Transit' AND $osr != '' AND $country != '') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2' ORDER BY upti_transaction.id DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_transaction ON upti_order_list.ol_poid = upti_transaction.trans_poid WHERE upti_transaction.trans_status = 'In Transit' AND upti_order_list.ol_country = '$country' AND upti_order_list.ol_seller = '$osr' AND upti_transaction.trans_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'Delivered' AND !empty($osr) AND !empty($country)) {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $get_name = "SELECT * FROM upti_users WHERE users_code = '$osr'";
                $get_name_qry = mysqli_query($connect, $get_name);
                $get_name_fetch = mysqli_fetch_array($get_name_qry);

                $name = $get_name_fetch['users_name'];

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_seller = '$osr' AND upti_activities.activities_caption = 'Order Delivered' AND upti_order_list.ol_country = '$country' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            } elseif ($status == 'RTS' AND !empty($osr) AND $country != '') {
                $order_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_seller = '$osr' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2' ORDER BY upti_activities.activities_date DESC";
                $order_qry = mysqli_query($connect, $order_sql);

                $total = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_seller = '$osr' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $total_sql = mysqli_query($connect, $total);
                $total_fetch = mysqli_fetch_array($total_sql);

                $name = '';

                $totals = "SELECT SUM(upti_order_list.ol_points) AS points FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_activities.activities_caption = 'RTS' AND upti_order_list.ol_seller = '$osr' AND upti_activities.activities_date BETWEEN '$date1' AND '$date2'";
                $totals_sql = mysqli_query($connect, $totals);
                $totals_fetch = mysqli_fetch_array($totals_sql);
                $puntos = $totals_fetch['points'];
                $sum = $total_fetch['total'];
            }
        } else {
            $order_sql = "SELECT * FROM upti_order_list WHERE ol_status= '[uptimised]'";
            $order_qry = mysqli_query($connect, $order_sql);

            $name = '';
            $sum = 0;
            $puntos = '';
        }

    ?>
    <!-- START HERE -->
    <section class="content">
      <div class="container-fluid">
          
      <form action="osr-reports2.php" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo number_format($sum) ?></h3>

                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php if ($puntos == '') {echo '0';} else {echo $puntos;}?></h3>

                            <p>Point Sales</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" name="date1" class="form-control" min="1997-01-01" max="2300-12-31">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" name="date2" class="form-control" min="1997-01-01" max="2300-12-31">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="countrys">
                                    <option value="">Select Country</option>
                                    <?php
                                    $product_sql = "SELECT * FROM upti_country_currency";
                                    $product_qry = mysqli_query($connect, $product_sql);
                                    while ($product = mysqli_fetch_array($product_qry)) {
                                    ?>
                                    <option value="<?php echo $product['cc_country'] ?>"><?php echo $product['cc_country'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>OSR</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="osr">
                                    <option value="">Select OSR</option>
                                    <?php
                                    $product_sql = "SELECT * FROM upti_users WHERE 
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_position = 'ELLAN' OR
                                    users_role = 'UPTIOSR' AND users_status = 'Active' AND users_position = 'CHRIS'
                                    ";
                                    $product_qry = mysqli_query($connect, $product_sql);
                                    while ($product = mysqli_fetch_array($product_qry)) {
                                    ?>
                                    <option value="<?php echo $product['users_code'] ?>"><?php echo $product['users_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="In Transit">In Transit</option>
                                    <option value="On Process">On Process</option>
                                    <option value="RTS">RTS</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Action</label><br>
                        <button class="btn btn-success form-control" name="country">Generate Report</button>
                    </div>
                </div>
            </div>
        
        <div class="row">
          <div class="col-12">
            
            <div class="card">                    
                <div class="card-header">
                    <!--<button class="btn btn-success float-right" name="export-excel" title="Export Excel File">-->
                    <!--    <i class="fas fa-file-excel"></i>-->
                    <!--</button>-->
                </div>
            </form>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <h2 class="float-left"><b><?php echo $name ?></b></h2>
                    <br>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Poid</th>
                            <th class="text-center">Country</th>
                            <th class="text-center">Date Ordered</th>
                            <th class="text-center">Date Trigged</th>
                            <th class="text-center">Points</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <?php
                        $number =1;
                        while ($order = mysqli_fetch_array($order_qry)) {
                            $total = $order['ol_php'];
                            $statuss = $order['ol_status'];
                            $poids = $order['ol_poid'];

                            if ($statuss == 'Delivered') {
                                $date_trg = $order['activities_date'];
                            } else {
                                $date_trg = 'NULL';
                            }
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $number; ?></td>
                        <td class="text-center"><?php echo $order['ol_poid']; ?></td>
                        <td class="text-center"><?php echo $order['ol_country']; ?></td>
                        <td class="text-center"><?php echo $order['ol_date']; ?></td>
                        <td class="text-center"><?php echo $date_trg ?></td>
                        <td class="text-center"><?php echo $order['ol_points']; ?></td>
                        <td class="text-right"><?php echo number_format($total) ?></td>
                        <td class="text-center">
                            <?php
                                if ($statuss == 'Pending') {
                            ?>
                            <span class="badge badge-primary"><?php echo $statuss ?></span>
                            <?php
                                } elseif ($statuss == 'Delivered') {
                            ?>
                            <span class="badge badge-success"><?php echo $statuss ?></span>
                            <?php
                                } elseif ($statuss == 'In Transit') {
                            ?>
                            <span class="badge badge-secondary"><?php echo $statuss ?></span>
                            <?php
                                } elseif ($statuss == 'On Process') {
                            ?>
                            <span class="badge badge-info"><?php echo $statuss ?></span>
                            <?php
                                } elseif ($statuss == 'RTS') {
                            ?>
                            <span class="badge badge-danger"><?php echo $statuss ?></span>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        $number++;
                        }
                    ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include 'include/footer.php'; ?>