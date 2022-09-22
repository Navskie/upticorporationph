  <?php
    session_start();
    include 'function.php';
    include 'dbms/conn.php'; 

    // if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
    //   $_SESSION['status'] = 'invalid';
    // }

    // if ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIMAIN') {
    //   header('Location: uptimain.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIRESELLER') {
    //   header('Location: reseller.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIMANAGER') {
    //   header('Location: manager.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTILEADER') {
    //   header('Location: leader.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIOSR') {
    //   header('Location: osr.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTICREATIVES') { 
    //   header('Location: ma-announcement.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTICSR') {
    //   header('Location: uptikier.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'SPECIAL') {
    //   header('Location: admin-reseller.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'UPTIACCOUNTING') {
    //   header('Location: accounting.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'IT/Sr Programmer') {
    //   header('Location: navskie.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'BRANCH') {
    //   header('Location: branch.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'ADS') {
    //   header('Location: ads.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'WEBSITE') {
    //   header('Location: website.php');
    // }
    // elseif ($_SESSION['status'] == 'valid' AND $_SESSION['role'] == 'Customer') {
    //   header('Location: ../profile.php');
    // }

    
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/icon/274966106_640652090373107_513539919171817442_n.ico">
    <title>Uptimised Corporation</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>
  <!-- <body class="hold-transition login-page" style="background: url('images/19366.jpg')!important; background-repeat: no-repeat !important; background-position: center !important; background-size: cover !important; background-attachment: fixed !important">  -->
  <body class="hold-transition login-page">
  <div class="login-box">
  <?php 
  // PHP program to add days to $Date 
  date_default_timezone_set('Asia/Manila');

  $date_order = '05-01-2022';
  $date_now = date('m-d-Y');

  ?> 
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body bg-light">
        <div class="login-logo">
          <img src="dist/img/logo.png" width="180">
        </div>
        <p class="login-box-msg text-uppercase">Welcome to Uptimised Corporation</p>
        <form action="" method="post">
          <!-- <div class="input-group mb-3">
            <input type="text" class="form-control border-info" placeholder="Username" name="us" autocomplete="off" style="border-radius: 0px !important">
            <div class="input-group-append">
              <div class="input-group-text text-dark border-info" style="border-radius: 0px !important">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control border-info" id="Show" placeholder="Password" name="pw" autocomplete="off" style="border-radius: 0px !important">
            <div class="input-group-append">
              <div class="input-group-text text-dark border-info" style="border-radius: 0px !important">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-12">
              <div class=" float-left">
              <a href="https://upticorporationph.com/" class="text-primary text-center"><u>Back to Login</u></a>
              </div>
              <div class="float-right">
                <a href="#" class="text-primary text-center" data-toggle="modal" data-target="#forgot-password"><u>Forgot Password</u></a>
                <br><br>
              </div>
            </div>
            <!-- <div class="col-12">
              <hr>
            </div> -->
            <!-- /.col -->
            <!-- <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block text-uppercase form-control" name="sign-in" style="border-radius: 0px !important">LOGIN</button>
            </div> -->
          
            <!-- /.col -->
          </div>
        </form>
        <!-- <button onclick="success_tost()">Try Me</button> -->
      <!-- /.login-card-body -->
    </div>
  </div>

  <?php include 'forgot-password.php'; ?>

  <script src="jquery/jquery-3.6.0.min.js"></script>
  <script src="toastr/toastr.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- /.login-box -->
  <script>
    function myfunction() {
      var show = document.getElementById('Show');
      if (show.type=='password') {
          show.type='text';
      } else {
          show.type='password';
      }
    }

    <?php if (isset($_SESSION['alert'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error("<?php echo flash('alert'); ?>");

    <?php } ?>

    <?php if (isset($_SESSION['warn'])) { ?>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error("<?php echo flash('warn'); ?>");

    <?php } ?>
  </script>
  </body>
  </html>
