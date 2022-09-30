<?php

  session_start();
  include './function.php';
  $connect = mysqli_connect('localhost', 'u438882109_betatestph	', '@User2022', 'u438882109_betatestph'); 
  // $connect = mysqli_connect('localhost', 'root', '', 'uptimisedph');

  date_default_timezone_set('Asia/Manila');
  $araw_ngayon = date('m-d-Y');
	
	if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
		$_SESSION['status'] = 'invalid';
		header('Location: index.php');
	}

  $user_id = $_SESSION['uid'];
  $role = $_SESSION['role'];
  $email_code = $_SESSION['code'];
  
  // Get User Full Details
  $get_info = "SELECT * FROM upti_users WHERE users_id = '$user_id'";
  $get_info_qry = mysqli_query($connect, $get_info);
  $get_info_fetch = mysqli_fetch_array($get_info_qry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="images/icon/274966106_640652090373107_513539919171817442_n.ico">
  <title>Uptimised PH - <?php echo $get_info_fetch['users_name'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
 <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
    }
    .course {
      background: #fff;
      display: flex;
      border-radius: 15px 40px; 
      font-family: 'Poppins', sans-serif;
      box-shadow: 1px 2px 5px 0px rgba(0,0,0,0.30);
    }

    .course .preview {
      border-radius: 15px 0px 0px 40px;
      padding: 15px;
      display: flex;
      flex-wrap: wrap;
      align-content: center;
    }

    .course .info {
      padding: 15px;
      /*display: flex;*/
      /*flex-wrap: wrap;*/
      /*align-content: center;*/
    }

    .course h6 {
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .course h2 {
      letter-spacing: 2px;
      margin: 10px 0;
    }

    .course h2 i {
      font-size: 50px;
      text-align: center;
    }
    .select2-container--bootstrap4 .select2-selection {
        border-radius: 0px !important;
        border: 1px solid #17a2b8;
    }
    .select2-search--dropdown .select2-search__field {
        border-radius: 0px !important;
        border: 1px solid #17a2b8;
    }
    .modal-content {
        border-radius: 0px !important;
    }
    input, textarea {
        border: 1px solid #17a2b8 !important;
        border-radius: 0px !important;
    }
    .small-box {
      border-radius: 0px !important;
    }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">